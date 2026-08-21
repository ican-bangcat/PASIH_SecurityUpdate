@extends('layouts.public')

@section('title', 'Berita Terkini - PASIH')
@section('public_body_class', 'bg-[#f8fafc]')

@section('content')
  <!-- Header Banner -->
  <section class="relative bg-white border-b border-slate-200 py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center max-w-3xl mx-auto space-y-4">
        <span class="text-yellow-500 font-bold text-xs sm:text-sm tracking-widest uppercase inline-block">
          Portal Berita &amp; Informasi
        </span>
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-blue-900 tracking-tight leading-tight">
          Seputar Peraturan Daerah &amp; Harmonisasi
        </h1>
        <p class="text-sm sm:text-base text-slate-600 leading-relaxed font-medium">
          Dapatkan wawasan, publikasi terkini, dan informasi kegiatan terkait analisis dan evaluasi hukum peraturan daerah di lingkungan Pemerintah Provinsi Riau.
        </p>

        <!-- Search Bar -->
        <div class="pt-4 max-w-xl mx-auto">
          <form method="GET" action="{{ route('public.news.index') }}" class="flex items-center gap-2 bg-white rounded-2xl p-1.5 shadow-md border border-slate-200">
            <div class="flex-1 flex items-center pl-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
              <input
                type="text"
                name="q"
                value="{{ $search }}"
                placeholder="Cari judul berita atau topik..."
                class="w-full px-3 py-2 text-sm text-slate-700 bg-transparent border-0 focus:outline-none focus:ring-0 placeholder:text-slate-400"
              >
            </div>
            @if($search)
              <a href="{{ route('public.news.index') }}" class="px-2 text-xs font-semibold text-slate-500 hover:text-slate-700">Reset</a>
            @endif
            <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-blue-900 hover:bg-blue-800 text-white font-semibold text-sm transition-colors shadow-xs">
              Cari
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- News Grid -->
  <section class="py-14 sm:py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      @if($search)
        <div class="mb-8 flex items-center justify-between">
          <p class="text-sm text-slate-600">
            Menampilkan hasil pencarian untuk: <strong class="text-slate-900">&ldquo;{{ $search }}&rdquo;</strong> ({{ $newsList->total() }} berita)
          </p>
          <a href="{{ route('public.news.index') }}" class="text-xs font-bold text-blue-900 hover:underline">&larr; Lihat Semua</a>
        </div>
      @endif

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($newsList as $news)
          <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100 flex flex-col group">
            <div class="h-52 overflow-hidden relative bg-slate-200">
              @if($news->image_url)
                <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
              @else
                <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-400">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </div>
              @endif
            </div>
            <div class="p-6 flex flex-col flex-1">
              <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                <span>{{ optional($news->published_at)->translatedFormat('d F Y') ?: optional($news->created_at)->translatedFormat('d F Y') }}</span>
              </div>
              <h3 class="text-lg font-bold text-blue-900 mb-3 group-hover:text-yellow-600 transition-colors line-clamp-2">
                <a href="{{ route('public.news.show', $news->slug) }}">{{ $news->title }}</a>
              </h3>
              <p class="text-slate-600 text-sm leading-relaxed mb-6 flex-1 line-clamp-3">
                {{ $news->excerpt }}
              </p>
              <a href="{{ route('public.news.show', $news->slug) }}" class="text-yellow-600 font-bold text-sm inline-flex items-center hover:text-yellow-700">
                Baca Selengkapnya
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
              </a>
            </div>
          </article>
        @empty
          <div class="col-span-full py-16 text-center text-slate-500 bg-white rounded-2xl border border-slate-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            <p class="font-bold text-slate-700 text-base">Tidak ada berita yang ditemukan.</p>
            <p class="text-xs text-slate-400 mt-1">Coba gunakan kata kunci pencarian yang lain.</p>
          </div>
        @endforelse
      </div>

      <!-- Pagination -->
      <div class="mt-12 flex justify-center">
        {{ $newsList->links('vendor.pagination.pasih') }}
      </div>
    </div>
  </section>
@endsection
