<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AssignmentStatus;
use App\Enums\SubmissionStatus;
use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentAnalysisApproval;
use App\Models\AssignmentDocument;
use App\Models\Instansi;
use App\Models\Submission;
use App\Models\SubmissionDocument;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ArchiveAnalysisManagementController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->string('q'));
        $perPage = (int) $request->integer('per_page', 5);
        $perPage = in_array($perPage, [5, 10, 25], true) ? $perPage : 5;

        $query = Assignment::query()
            ->with([
                'submission.submitter.instansi',
                'submission.documents',
                'documents',
                'assignedBy',
            ])
            ->whereStatus('completed')
            ->where('instruction', 'like', '%Arsip%')
            ->latest('updated_at');

        if ($search !== '') {
            $query->whereHas('submission', function ($builder) use ($search): void {
                $builder
                    ->where('perda_title', 'like', "%{$search}%")
                    ->orWhere('nomor_surat', 'like', "%{$search}%")
                    ->orWhere('perihal', 'like', "%{$search}%")
                    ->orWhereHas('submitter.instansi', function ($instansiQuery) use ($search): void {
                        $instansiQuery->where('nama_instansi', 'like', "%{$search}%");
                    });
            });
        }

        return view('pages.admin.archive_analysis.index', [
            'archives' => $query->paginate($perPage)->withQueryString(),
            'search' => $search,
            'perPage' => $perPage,
        ]);
    }

    public function create()
    {
        return view('pages.admin.archive_analysis.create', [
            'instansiList' => Instansi::query()->orderBy('nama_instansi')->get(['id_instansi', 'nama_instansi']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'instansi_id' => ['required', 'exists:instansi,id_instansi'],
            'perda_title' => ['required', 'string', 'max:255'],
            'nomor_surat' => ['required', 'string', 'max:255'],
            'perihal' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'completed_at' => ['required', 'date'],
            'peraturan_daerah' => ['required', 'file', 'max:5120', 'mimes:pdf,doc,docx'],
            'hasil_analisis' => ['required', 'file', 'max:5120', 'mimes:pdf,doc,docx'],
            'ringkasan_analisis' => ['required', 'string'],
            'hasil_evaluasi' => ['required', 'string'],
            'rekomendasi' => ['required', 'string'],
        ]);

        $completedDate = Carbon::parse($validated['completed_at']);
        $instansi = Instansi::query()->findOrFail($validated['instansi_id']);
        $instansiName = $instansi->nama_instansi;

        $submitterId = User::query()
            ->where('id_instansi', $instansi->id_instansi)
            ->value('id') ?? $request->user()->id;

        DB::transaction(function () use ($request, $validated, $completedDate, $instansiName, $submitterId): void {
            $submission = Submission::query()->create([
                'submitter_id' => $submitterId,
                'nomor_surat' => $validated['nomor_surat'],
                'perihal' => $validated['perihal'],
                'perda_title' => trim((string) $validated['perda_title']),
                'description' => $validated['description'] ?? null,
                'created_at' => $completedDate,
                'updated_at' => $completedDate,
            ]);

            $submission->statuses()->create([
                'user_id' => $request->user()->id,
                'status' => SubmissionStatus::Completed->value,
                'note' => 'Arsip Data Lama diunggah langsung oleh Admin.',
                'created_at' => $completedDate,
                'updated_at' => $completedDate,
            ]);

            $perdaFile = $this->validateUploadedFile(
                $request->file('peraturan_daerah'),
                'peraturan_daerah',
                'Upload dokumen Peraturan Daerah gagal.'
            );
            $storedPerda = $this->storeFile($perdaFile, 'permohonan', $instansiName, 'Peraturan Daerah', $completedDate);

            SubmissionDocument::query()->create([
                'submission_id' => $submission->id,
                'uploaded_by' => $request->user()->id,
                'document_type' => 'peraturan_daerah',
                'file_name' => $storedPerda['file_name'],
                'file_path' => $storedPerda['file_path'],
                'mime_type' => $storedPerda['mime_type'],
                'file_size' => $storedPerda['file_size'],
                'created_at' => $completedDate,
                'updated_at' => $completedDate,
            ]);

            $assignment = Assignment::query()->create([
                'submission_id' => $submission->id,
                'assigned_by_id' => $request->user()->id,
                'instruction' => 'Data Hasil Analisis & Evaluasi Hukum Data Lama (Arsip)',
                'created_at' => $completedDate,
                'updated_at' => $completedDate,
            ]);

            $statusLog = $assignment->statusLogs()->create([
                'user_id' => $request->user()->id,
                'status' => AssignmentStatus::Completed->value,
                'created_at' => $completedDate,
                'updated_at' => $completedDate,
            ]);

            AssignmentAnalysisApproval::query()->create([
                'assignment_id' => $assignment->id,
                'assigned_by_id' => $request->user()->id,
                'assignment_statuses_id' => $statusLog->id,
                'note' => 'Arsip data lama disetujui langsung oleh Admin',
                'created_at' => $completedDate,
                'updated_at' => $completedDate,
            ]);

            $analisisFile = $this->validateUploadedFile(
                $request->file('hasil_analisis'),
                'hasil_analisis',
                'Upload dokumen Hasil Analisis gagal.'
            );
            $storedAnalisis = $this->storeFile($analisisFile, 'penugasan', $instansiName, 'Hasil Analisis', $completedDate);

            AssignmentDocument::query()->create([
                'assignment_id' => $assignment->id,
                'uploaded_by' => $request->user()->id,
                'document_type' => 'hasil_analisis',
                'file_name' => $storedAnalisis['file_name'],
                'file_path' => $storedAnalisis['file_path'],
                'mime_type' => $storedAnalisis['mime_type'],
                'file_size' => $storedAnalisis['file_size'],
                'ringkasan_analisis' => $validated['ringkasan_analisis'],
                'hasil_evaluasi' => $validated['hasil_evaluasi'],
                'rekomendasi' => $validated['rekomendasi'],
                'created_at' => $completedDate,
                'updated_at' => $completedDate,
            ]);
        });

        return redirect()->route('admin.archive-analysis.index')->with('success', 'Arsip Data Lama Hasil Analisis berhasil ditambahkan dan langsung terbit di halaman publik.');
    }

    public function destroy(Assignment $assignment)
    {
        $submission = $assignment->submission;

        DB::transaction(function () use ($assignment, $submission): void {
            $assignment->delete();
            if ($submission) {
                $submission->delete();
            }
        });

        return redirect()->route('admin.archive-analysis.index')->with('success', 'Arsip data lama berhasil dihapus');
    }

    private function validateUploadedFile(mixed $file, string $field, string $message): UploadedFile
    {
        if (! $file instanceof UploadedFile || ! $file->isValid() || blank($file->getRealPath())) {
            throw ValidationException::withMessages([$field => $message]);
        }

        return $file;
    }

    /**
     * @return array{file_name:string,file_path:string,mime_type:?string,file_size:int|false}
     */
    private function storeFile(UploadedFile $file, string $folder, string $instansiName, string $documentLabel, Carbon $timestamp): array
    {
        $destinationPath = public_path('storage/'.$folder);

        if (! is_dir($destinationPath) && ! mkdir($destinationPath, 0755, true) && ! is_dir($destinationPath)) {
            throw ValidationException::withMessages([
                'file' => "Folder upload {$folder} tidak dapat dibuat.",
            ]);
        }

        $displayName = $this->buildDisplayDocumentName($instansiName, $documentLabel, $timestamp);
        $extension = $file->getClientOriginalExtension();
        $storedName = $displayName.($extension ? '.'.$extension : '');
        if (file_exists($destinationPath.DIRECTORY_SEPARATOR.$storedName)) {
            $storedName = $displayName.'_'.Str::lower(Str::random(4)).($extension ? '.'.$extension : '');
        }
        $fileSize = $file->getSize();
        $mimeType = $file->getClientMimeType();

        $file->move($destinationPath, $storedName);

        return [
            'file_name' => $displayName,
            'file_path' => $folder.'/'.$storedName,
            'mime_type' => $mimeType,
            'file_size' => $fileSize,
        ];
    }

    private function buildDisplayDocumentName(string $instansiName, string $documentLabel, Carbon $timestamp): string
    {
        $normalize = function (string $value): string {
            $parts = preg_split('/[^A-Za-z0-9]+/', trim($value)) ?: [];
            $parts = array_filter($parts, static fn ($part) => $part !== '');

            return $parts === [] ? 'Dokumen' : implode('', $parts);
        };

        return $normalize($instansiName).'_'.$normalize($documentLabel).'_'.$timestamp->format('YmdHis');
    }
}
