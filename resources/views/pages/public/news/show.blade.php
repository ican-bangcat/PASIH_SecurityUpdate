@extends('layouts.public')

@section('title', $news->title . ' - PASIH')
@section('public_body_class', 'bg-[#f8fafc]')

@section('content')
  <!-- Breadcrumb & Top Bar -->
  <div class="bg-white border-b border-slate-200 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <nav class="flex items-center gap-2 text-xs sm:text-sm text-slate-500 font-medium overflow-x-auto whitespace-nowrap">
        <a href="{{ route('home') }}" class="hover:text-blue-900 transition">Beranda</a>
        <span>/</span>
        <a href="{{ route('public.news.index') }}" class="hover:text-blue-900 transition">Berita</a>
        <span>/</span>
        <span class="text-slate-800 font-semibold truncate max-w-xs sm:max-w-md">{{ $news->title }}</span>
      </nav>
    </div>
  </div>

  <!-- Article Section -->
  <section class="py-10 lg:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-12">
        <!-- Main Article Content (2 Cols) -->
        <main class="lg:col-span-2 space-y-8">
          <article class="bg-white rounded-3xl p-6 sm:p-8 lg:p-10 border border-slate-200/80 shadow-xs space-y-6">
            <!-- Article Header -->
            <div class="space-y-4 border-b border-slate-100 pb-6">
              <div class="flex flex-wrap items-center gap-3 text-xs sm:text-sm font-semibold text-slate-500">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-900 ring-1 ring-blue-900/10">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-900" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                  Berita Terkini
                </span>
                <span>•</span>
                <span class="flex items-center gap-1">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                  {{ optional($news->published_at)->translatedFormat('l, d F Y') ?: optional($news->created_at)->translatedFormat('l, d F Y') }}
                </span>
                <span>•</span>
                <span>Oleh: <strong class="text-slate-700">{{ $news->author_display_name }}</strong></span>
              </div>

              <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-blue-900 tracking-tight leading-tight">
                {{ $news->title }}
              </h1>
            </div>

            <!-- Cover Image -->
            @if($news->image_url)
              <div class="rounded-2xl overflow-hidden aspect-[16/9] w-full bg-slate-100 border border-slate-200/80 shadow-sm">
                <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
              </div>
            @endif

            <!-- Excerpt / Highlight -->
            @if($news->excerpt)
              <div class="p-4 sm:p-5 rounded-2xl bg-slate-50 border-l-4 border-yellow-500 text-slate-700 font-medium text-sm sm:text-base leading-relaxed">
                {{ $news->excerpt }}
              </div>
            @endif

            <!-- Main Body (CKEditor Rich Content) -->
            <div class="news-article-content text-slate-800 text-base sm:text-lg leading-relaxed space-y-4 pt-2 font-normal">
              {!! $news->content !!}
            </div>

            <!-- Footer / Back Link -->
            <div class="pt-8 border-t border-slate-100 flex flex-wrap items-center justify-between gap-4">
              <a href="{{ route('public.news.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-blue-900 hover:text-yellow-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali ke Semua Berita
              </a>

              <a href="{{ route('home') }}" class="text-xs font-semibold text-slate-500 hover:text-slate-800">
                &larr; Halaman Utama PASIH
              </a>
            </div>
          </article>
        </main>

        <!-- Sidebar / Berita Lainnya (1 Col) -->
        <aside class="space-y-8">
          <!-- Recent News Widget -->
          <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-5">
            <h3 class="text-base font-extrabold text-blue-900 border-b border-slate-100 pb-3 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
              Berita Terbaru Lainnya
            </h3>

            <div class="space-y-4">
              @forelse($recentNews as $item)
                <a href="{{ route('public.news.show', $item->slug) }}" class="flex gap-3.5 group items-start">
                  @if($item->image_url)
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-20 h-16 object-cover rounded-xl shrink-0 border border-slate-100 group-hover:opacity-90">
                  @else
                    <div class="w-20 h-16 bg-slate-100 rounded-xl shrink-0 flex items-center justify-center text-slate-400 border border-slate-200">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                  @endif
                  <div class="min-w-0 flex-1 space-y-1">
                    <span class="text-[11px] font-semibold text-slate-400 block">
                      {{ optional($item->published_at)->translatedFormat('d M Y') ?: optional($item->created_at)->translatedFormat('d M Y') }}
                    </span>
                    <h4 class="text-xs font-bold text-slate-800 group-hover:text-yellow-600 transition-colors line-clamp-2 leading-snug">
                      {{ $item->title }}
                    </h4>
                  </div>
                </a>
              @empty
                <p class="text-xs text-slate-400">Belum ada berita lainnya.</p>
              @endforelse
            </div>
          </div>
        </aside>
      </div>
    </div>
  </section>

  <style>
    .news-article-content p {
      margin-bottom: 1.25rem;
      line-height: 1.8;
    }
    .news-article-content h2, .news-article-content h3, .news-article-content h4 {
      font-weight: 700;
      color: #1e3a8a;
      margin-top: 1.5rem;
      margin-bottom: 0.75rem;
    }
    .news-article-content ul, .news-article-content ol {
      margin-left: 1.5rem;
      margin-bottom: 1.25rem;
    }
    .news-article-content ul {
      list-style-type: disc;
    }
    .news-article-content ol {
      list-style-type: decimal;
    }
    .news-article-content blockquote {
      border-left: 4px solid #eab308;
      padding-left: 1rem;
      font-style: italic;
      color: #475569;
      margin: 1.25rem 0;
    }
    .news-article-content a {
      color: #2563eb;
      text-decoration: underline;
    }
  </style>
@endsection
