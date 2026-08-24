<?php

use App\Models\Role;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
    Role::firstOrCreate(['nama_role' => 'operator_pemda']);
    Role::firstOrCreate(['nama_role' => 'operator_kanwil']);
    Role::firstOrCreate(['nama_role' => 'ketua_tim_analisis']);
});

it('allows operator kanwil to reject submission and routes to ketua tim for rejection reply letter upload', function () {
    $pemdaRole = Role::where('nama_role', 'operator_pemda')->first();
    $kanwilRole = Role::where('nama_role', 'operator_kanwil')->first();
    $ketuaTimRole = Role::where('nama_role', 'ketua_tim_analisis')->first();

    $pemdaUser = User::factory()->create(['id_role' => $pemdaRole->id_role]);
    $kanwilUser = User::factory()->create(['id_role' => $kanwilRole->id_role]);
    $ketuaTimUser = User::factory()->create(['id_role' => $ketuaTimRole->id_role]);

    $submission = Submission::create([
        'submitter_id' => $pemdaUser->id,
        'nomor_surat' => '123/PERDA/2026',
        'perihal' => 'Pengajuan Ranperda',
        'perda_title' => 'Ranperda Ketertiban Umum',
        'description' => 'Mohon analisis',
    ]);
    $submission->recordStatus('submitted', $pemdaUser->id);

    // Operator Kanwil rejects submission
    $response = $this->actingAs($kanwilUser)->post(route('submissions.status-disposisi.save', $submission), [
        'status' => 'rejected',
        'status_note' => 'Dokumen permohonan kurang lengkap',
    ]);

    $response->assertRedirect(route('submissions.index'));
    expect($submission->fresh()->status->value)->toBe('pending_reply_letter');

    // Ketua Tim Analisis uploads rejection reply letter
    $file = UploadedFile::fake()->create('surat_penolakan.pdf', 100, 'application/pdf');
    $replyResponse = $this->actingAs($ketuaTimUser)->post(route('submissions.rejection-reply.store', $submission), [
        'surat_balasan_penolakan' => $file,
    ]);

    $replyResponse->assertRedirect(route('submissions.index'));
    expect($submission->fresh()->status->value)->toBe('rejected');
    expect($submission->fresh()->replyDocument)->not->toBeNull();
    expect($submission->fresh()->replyDocument->kategori_surat)->toBe('surat_penolakan');
});

it('allows kadiv to reject submission during assignment step and routes to ketua tim', function () {
    $pemdaRole = Role::firstOrCreate(['nama_role' => 'operator_pemda']);
    $kadivRole = Role::firstOrCreate(['nama_role' => 'kepala_divisi_p3h']);
    $ketuaTimRole = Role::firstOrCreate(['nama_role' => 'ketua_tim_analisis']);

    $pemdaUser = User::factory()->create(['id_role' => $pemdaRole->id_role]);
    $kadivUser = User::factory()->create(['id_role' => $kadivRole->id_role]);

    $submission = Submission::create([
        'submitter_id' => $pemdaUser->id,
        'nomor_surat' => '124/PERDA/2026',
        'perihal' => 'Pengajuan Ranperda 2',
        'perda_title' => 'Ranperda Bangunan Gedung',
        'description' => 'Mohon analisis',
    ]);
    $submission->recordStatus('accepted', $pemdaUser->id);

    // Kadiv rejects submission at assignment step
    $response = $this->actingAs($kadivUser)->post(route('submissions.penugasan.save', $submission), [
        'decision' => 'reject',
        'rejection_note' => 'Permohonan ditolak oleh Kadiv',
    ]);

    $response->assertRedirect(route('submissions.index'));
    expect($submission->fresh()->status->value)->toBe('pending_reply_letter');
});
