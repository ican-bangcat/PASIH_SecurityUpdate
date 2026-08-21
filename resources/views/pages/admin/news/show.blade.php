@extends('layouts.app')
@section('title', 'Detail Berita')

@section('content')
  <div class="space-y-5">
    @if(session('success'))
      <div class="rounded-xl bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200 px-4 py-3 text-sm flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600 shrink-0" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
      <div>
        <h1 class="pasih-page-title">Detail Berita</h1>
        <p class="mt-2 pasih-page-breadcrumb">
          <a href="{{ route('dashboard') }}" class="hover:text-slate-700 hover:underline">Dashboard</a>
          <span class="mx-1">/</span>
          <a href="{{ route('admin.news.index') }}" class="hover:text-slate-700 hover:underline">Manajemen Berita</a>
          <span class="mx-1">/</span>
          <span>Detail</span>
        </p>
      </div>

      <div class="flex items-center gap-2">
        @if($news->status === 'published')
          <a href="{{ route('public.news.show', $news->slug) }}" target="_blank" class="inline-flex items-center gap-1.5 h-10 px-3.5 rounded-xl border border-slate-300 text-slate-700 text-sm font-semibold hover:bg-slate-50 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            Buka Halaman Publik
          </a>
        @endif
        <a href="{{ route('admin.news.edit', $news) }}" class="inline-flex items-center gap-1.5 h-10 px-4 rounded-xl bg-amber-400 text-white text-sm font-semibold hover:bg-amber-500 transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z" /></svg>
          Edit Berita
        </a>
      </div>
    </div>

    <div class="rounded-xl bg-white ring-1 ring-slate-200 overflow-hidden shadow-xs">
      <div class="p-6 md:p-8 space-y-6">
        <!-- Metadata Header -->
        <div class="space-y-3 border-b border-slate-200 pb-6">
          <div class="flex flex-wrap items-center gap-3">
            @if($news->status === 'published')
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/20">
                Publikasi
              </span>
            @else
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 ring-1 ring-amber-600/20">
                Draft
              </span>
            @endif

            <span class="text-xs text-slate-500">
              Dipublikasikan pada: <strong class="text-slate-700">{{ optional($news->published_at)->format('d F Y - H:i') ?: '-' }}</strong>
            </span>

            <span class="text-xs text-slate-500">
              Penulis: <strong class="text-slate-700">{{ $news->author_display_name }}</strong>
            </span>
          </div>

          <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 leading-tight">
            {{ $news->title }}
          </h1>

          <p class="text-xs font-mono text-slate-400">
            Slug: /berita/{{ $news->slug }}
          </p>
        </div>

        <!-- Cover Image -->
        @if($news->image_url)
          <div class="rounded-xl overflow-hidden aspect-[16/9] max-h-96 w-full bg-slate-100 border border-slate-200 shadow-sm">
            <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
          </div>
        @endif

        <!-- Ringkasan / Excerpt Box -->
        @if($news->excerpt)
          <div class="p-4 bg-slate-50 rounded-xl border-l-4 border-blue-900 text-slate-700 italic text-sm leading-relaxed">
            &ldquo;{{ $news->excerpt }}&rdquo;
          </div>
        @endif

        <!-- Body Konten -->
        <div class="prose max-w-none text-slate-800 leading-relaxed space-y-4 pt-2 font-normal">
          {!! $news->content !!}
        </div>

        <!-- Action Footer -->
        <div class="pt-6 border-t border-slate-200 flex items-center justify-between">
          <a href="{{ route('admin.news.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-slate-900">
            &larr; Kembali ke Daftar Berita
          </a>

          <form method="POST" action="{{ route('admin.news.destroy', $news) }}" data-confirm-type="delete" data-confirm-message="Apakah Anda yakin ingin menghapus berita ini?">
            @csrf
            @method('DELETE')
            <button type="submit" class="inline-flex items-center gap-1.5 text-sm font-semibold text-rose-600 hover:text-rose-700">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-1 12a2 2 0 01-2 2H8a2 2 0 01-2-2L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" /></svg>
              Hapus Berita Ini
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
