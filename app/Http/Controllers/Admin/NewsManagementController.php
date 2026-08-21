<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class NewsManagementController extends Controller
{
    public function index(Request $request): View
    {
        $perPage = (int) $request->integer('per_page', 5);
        $perPage = in_array($perPage, [5, 10, 25], true) ? $perPage : 5;
        $search = trim((string) $request->string('q'));

        $query = News::query()
            ->with('author')
            ->latest('created_at');

        if ($search !== '') {
            $query->where(function ($builder) use ($search): void {
                $builder
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('author_name', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhereRaw("DATE_FORMAT(published_at, '%d-%m-%Y') like ?", ["%{$search}%"])
                    ->orWhereHas('author', function ($authorQuery) use ($search): void {
                        $authorQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        return view('pages.admin.news.index', [
            'newsList' => $query->paginate($perPage)->withQueryString(),
            'perPage' => $perPage,
            'search' => $search,
        ]);
    }

    public function create(): View
    {
        return view('pages.admin.news.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author_name' => ['nullable', 'string', 'max:150'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'status' => ['required', Rule::in(['published', 'draft'])],
            'published_date' => ['nullable', 'date'],
            'published_hour' => ['nullable', 'integer', 'between:0,23'],
            'published_minute' => ['nullable', 'integer', 'between:0,59'],
            'published_time' => ['nullable', 'string', 'max:30'],
            'image' => ['nullable', 'file', 'max:5120', 'mimes:jpg,jpeg,png,webp'],
        ], [
            'title.required' => 'Judul berita wajib diisi.',
            'content.required' => 'Konten berita wajib diisi.',
            'image.max' => 'Ukuran gambar maksimal 5 MB.',
            'image.mimes' => 'Format gambar harus berupa JPG, JPEG, PNG, atau WEBP.',
        ]);

        $title = trim((string) $validated['title']);
        $slug = $this->generateUniqueSlug($title);
        $publishedAt = $this->resolvePublishedAt(
            $validated['published_date'] ?? null,
            $validated['published_time'] ?? null,
            isset($validated['published_hour']) ? (string) $validated['published_hour'] : null,
            isset($validated['published_minute']) ? (string) $validated['published_minute'] : null,
            $validated['status']
        );

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $this->validateUploadedFile(
                $request->file('image'),
                'image',
                'Upload gambar gagal. Pastikan file valid dan ukuran tidak melebihi 5MB.'
            );
            $imagePath = $this->storeNewsImage($file, $slug);
        }

        $sanitizedContent = $this->sanitizeHtml($validated['content']);
        $plainExcerpt = ! empty($validated['excerpt'])
            ? trim((string) $validated['excerpt'])
            : Str::limit(strip_tags($sanitizedContent), 160);

        News::query()->create([
            'title' => $title,
            'slug' => $slug,
            'author_name' => ! empty($validated['author_name']) ? trim((string) $validated['author_name']) : null,
            'excerpt' => $plainExcerpt,
            'content' => $sanitizedContent,
            'image_path' => $imagePath,
            'status' => $validated['status'],
            'published_at' => $publishedAt,
            'author_id' => $request->user()?->id,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function show(News $news): View
    {
        $news->load('author');

        return view('pages.admin.news.show', [
            'news' => $news,
        ]);
    }

    public function edit(News $news): View
    {
        $news->load('author');

        return view('pages.admin.news.edit', [
            'news' => $news,
        ]);
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author_name' => ['nullable', 'string', 'max:150'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'status' => ['required', Rule::in(['published', 'draft'])],
            'published_date' => ['nullable', 'date'],
            'published_hour' => ['nullable', 'integer', 'between:0,23'],
            'published_minute' => ['nullable', 'integer', 'between:0,59'],
            'published_time' => ['nullable', 'string', 'max:30'],
            'image' => ['nullable', 'file', 'max:5120', 'mimes:jpg,jpeg,png,webp'],
        ], [
            'title.required' => 'Judul berita wajib diisi.',
            'content.required' => 'Konten berita wajib diisi.',
            'image.max' => 'Ukuran gambar maksimal 5 MB.',
            'image.mimes' => 'Format gambar harus berupa JPG, JPEG, PNG, atau WEBP.',
        ]);

        $title = trim((string) $validated['title']);
        if ($title !== $news->title) {
            $news->slug = $this->generateUniqueSlug($title, $news->id);
        }

        $publishedAt = $this->resolvePublishedAt(
            $validated['published_date'] ?? null,
            $validated['published_time'] ?? null,
            isset($validated['published_hour']) ? (string) $validated['published_hour'] : null,
            isset($validated['published_minute']) ? (string) $validated['published_minute'] : null,
            $validated['status'],
            $news->published_at
        );

        $sanitizedContent = $this->sanitizeHtml($validated['content']);
        $plainExcerpt = ! empty($validated['excerpt'])
            ? trim((string) $validated['excerpt'])
            : Str::limit(strip_tags($sanitizedContent), 160);

        $news->title = $title;
        $news->author_name = ! empty($validated['author_name']) ? trim((string) $validated['author_name']) : null;
        $news->excerpt = $plainExcerpt;
        $news->content = $sanitizedContent;
        $news->status = $validated['status'];
        $news->published_at = $publishedAt;

        if ($request->hasFile('image')) {
            $file = $this->validateUploadedFile(
                $request->file('image'),
                'image',
                'Upload gambar gagal. Pastikan file valid dan ukuran tidak melebihi 5MB.'
            );
            $oldPath = (string) $news->image_path;
            $news->image_path = $this->storeNewsImage($file, $news->slug);
            $this->deletePhysicalFile($oldPath);
        }

        $news->save();

        return redirect()->route('admin.news.show', $news)->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(News $news): RedirectResponse
    {
        $oldPath = (string) $news->image_path;
        $news->delete();
        $this->deletePhysicalFile($oldPath);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus');
    }

    /**
     * Resolves the publication datetime from date, time, and hour/minute inputs.
     */
    private function resolvePublishedAt(
        ?string $date,
        ?string $time,
        ?string $hour,
        ?string $minute,
        string $status,
        ?Carbon $fallback = null
    ): ?Carbon {
        if (! empty($date)) {
            if (! empty($time)) {
                try {
                    return Carbon::parse($date.' '.$time);
                } catch (\Throwable) {
                    // Fallback to next format attempts
                }
            }

            if ($hour !== null && $minute !== null) {
                $timeStr = sprintf('%02d:%02d:00', (int) $hour, (int) $minute);
                try {
                    return Carbon::parse($date.' '.$timeStr);
                } catch (\Throwable) {
                    // Fallback
                }
            }

            try {
                return Carbon::parse($date.' 00:00:00');
            } catch (\Throwable) {
                return now();
            }
        }

        if ($status === 'published') {
            return $fallback ?? now();
        }

        return null;
    }

    /**
     * Sanitize HTML content against XSS while preserving legitimate WYSIWYG tags.
     */
    private function sanitizeHtml(string $html): string
    {
        // 1. Remove dangerous script, iframe, style, object, embed, form tags and contents
        $html = preg_replace('/<(script|style|iframe|object|embed|applet|form|input|button)\b[^>]*>(.*?)<\/\1>/is', '', $html) ?? $html;
        $html = preg_replace('/<(script|style|iframe|object|embed|applet|form|input|button|meta|link)\b[^>]*\/?>/is', '', $html) ?? $html;

        // 2. Remove inline event handlers (e.g. onclick, onload, onerror)
        $html = preg_replace('/\s+on[a-zA-Z]+\s*=\s*(["\'][^"\']*["\']|[^\s>]+)/is', '', $html) ?? $html;

        // 3. Remove javascript: pseudo-protocols in href or src
        $html = preg_replace('/(href|src)\s*=\s*["\']\s*javascript:[^"\']*["\']/is', '', $html) ?? $html;

        // 4. Strip everything except safe semantic HTML tags
        $allowedTags = '<p><br><strong><b><em><i><u><s><strike><sub><sup><h2><h3><h4><h5><h6><ul><ol><li><blockquote><hr><table><thead><tbody><tfoot><tr><th><td><figure><figcaption><img><a><span><div>';

        return strip_tags($html, $allowedTags);
    }

    private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        $baseSlug = $baseSlug !== '' ? $baseSlug : 'berita-'.Str::lower(Str::random(6));
        $slug = $baseSlug;
        $count = 1;

        while (
            News::query()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$baseSlug}-{$count}";
            $count++;
        }

        return $slug;
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

    private function storeNewsImage(UploadedFile $file, string $slug): string
    {
        $destinationPath = public_path('storage/news');

        if (! is_dir($destinationPath) && ! mkdir($destinationPath, 0755, true) && ! is_dir($destinationPath)) {
            throw ValidationException::withMessages([
                'image' => 'Folder upload gambar berita tidak dapat dibuat.',
            ]);
        }

        $extension = $file->getClientOriginalExtension();
        $extension = $extension !== '' ? $extension : 'jpg';
        $fileName = 'news_'.Str::limit($slug, 40, '').'_'.now()->format('YmdHis').'_'.Str::lower(Str::random(4)).'.'.$extension;

        $file->move($destinationPath, $fileName);

        return 'news/'.$fileName;
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
