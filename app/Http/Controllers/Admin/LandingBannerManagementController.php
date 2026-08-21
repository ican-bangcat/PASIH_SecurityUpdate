<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingBanner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LandingBannerManagementController extends Controller
{
    public function index(Request $request): View
    {
        $perPage = (int) $request->integer('per_page', 10);
        $perPage = in_array($perPage, [10, 25, 50], true) ? $perPage : 10;
        $search = trim((string) $request->string('q'));

        $query = LandingBanner::query()
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc');

        if ($search !== '') {
            $query->where(function ($builder) use ($search): void {
                $builder
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        return view('pages.admin.banners.index', [
            'banners' => $query->paginate($perPage)->withQueryString(),
            'perPage' => $perPage,
            'search' => $search,
        ]);
    }

    public function create(): View
    {
        $nextOrder = (int) LandingBanner::query()->max('order') + 1;

        return view('pages.admin.banners.create', [
            'nextOrder' => $nextOrder,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:0', 'max:9999'],
            'is_active' => ['nullable', 'boolean'],
            'description' => ['nullable', 'string', 'max:500'],
            'image' => ['required', 'file', 'max:5120', 'mimes:jpg,jpeg,png,webp'],
        ], [
            'image.required' => 'Foto banner kegiatan wajib diunggah.',
            'image.max' => 'Ukuran gambar maksimal 5 MB.',
            'image.mimes' => 'Format gambar harus berupa JPG, JPEG, PNG, atau WEBP.',
            'order.required' => 'Nomor urutan wajib diisi.',
            'order.integer' => 'Nomor urutan harus berupa angka.',
        ]);

        $file = $this->validateUploadedFile(
            $request->file('image'),
            'image',
            'Upload foto banner gagal. Pastikan file valid dan ukuran tidak melebihi 5MB.'
        );

        $imagePath = $this->storeBannerImage($file);

        LandingBanner::query()->create([
            'title' => ! empty($validated['title']) ? trim((string) $validated['title']) : null,
            'image_path' => $imagePath,
            'order' => (int) $validated['order'],
            'is_active' => $request->boolean('is_active', true),
            'description' => ! empty($validated['description']) ? trim((string) $validated['description']) : null,
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Foto banner kegiatan berhasil ditambahkan.');
    }

    public function edit(LandingBanner $banner): View
    {
        return view('pages.admin.banners.edit', [
            'banner' => $banner,
        ]);
    }

    public function update(Request $request, LandingBanner $banner): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:0', 'max:9999'],
            'is_active' => ['nullable', 'boolean'],
            'description' => ['nullable', 'string', 'max:500'],
            'image' => ['nullable', 'file', 'max:5120', 'mimes:jpg,jpeg,png,webp'],
        ], [
            'image.max' => 'Ukuran gambar maksimal 5 MB.',
            'image.mimes' => 'Format gambar harus berupa JPG, JPEG, PNG, atau WEBP.',
            'order.required' => 'Nomor urutan wajib diisi.',
            'order.integer' => 'Nomor urutan harus berupa angka.',
        ]);

        $banner->title = ! empty($validated['title']) ? trim((string) $validated['title']) : null;
        $banner->order = (int) $validated['order'];
        $banner->is_active = $request->boolean('is_active', false);
        $banner->description = ! empty($validated['description']) ? trim((string) $validated['description']) : null;

        if ($request->hasFile('image')) {
            $file = $this->validateUploadedFile(
                $request->file('image'),
                'image',
                'Upload foto banner pengganti gagal. Pastikan file valid dan ukuran tidak melebihi 5MB.'
            );
            $oldPath = (string) $banner->image_path;
            $banner->image_path = $this->storeBannerImage($file);
            $this->deletePhysicalFile($oldPath);
        }

        $banner->save();

        return redirect()->route('admin.banners.index')->with('success', 'Foto banner kegiatan berhasil diperbarui.');
    }

    public function toggleStatus(LandingBanner $banner): RedirectResponse
    {
        $banner->is_active = ! $banner->is_active;
        $banner->save();

        $statusText = $banner->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Banner kegiatan berhasil {$statusText}.");
    }

    public function destroy(LandingBanner $banner): RedirectResponse
    {
        $oldPath = (string) $banner->image_path;
        $banner->delete();
        $this->deletePhysicalFile($oldPath);

        return redirect()->route('admin.banners.index')->with('success', 'Foto banner kegiatan berhasil dihapus.');
    }

    private function validateUploadedFile(
        mixed $file,
        string $field,
        string $message
    ): UploadedFile {
        if (! $file instanceof UploadedFile || ! $file->isValid() || blank($file->getRealPath())) {
            throw ValidationException::withMessages([$field => $message]);
        }

        return $file;
    }

    private function storeBannerImage(UploadedFile $file): string
    {
        $destinationPath = public_path('storage/banners');

        if (! is_dir($destinationPath) && ! mkdir($destinationPath, 0755, true) && ! is_dir($destinationPath)) {
            throw ValidationException::withMessages([
                'image' => 'Folder upload foto banner tidak dapat dibuat.',
            ]);
        }

        $extension = $file->getClientOriginalExtension();
        $extension = $extension !== '' ? $extension : 'jpg';
        $fileName = 'banner_'.now()->format('YmdHis').'_'.Str::lower(Str::random(6)).'.'.$extension;

        $file->move($destinationPath, $fileName);

        return 'banners/'.$fileName;
    }

    private function deletePhysicalFile(string $relativePath): void
    {
        if ($relativePath === '' || Str::startsWith($relativePath, 'images/')) {
            return;
        }

        $candidates = [
            public_path('storage/'.$relativePath),
            storage_path('app/public/'.$relativePath),
            public_path($relativePath),
        ];

        foreach ($candidates as $path) {
            if (is_file($path)) {
                @unlink($path);

                return;
            }
        }
    }
}
