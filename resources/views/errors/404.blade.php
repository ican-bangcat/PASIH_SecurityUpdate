@php
  $dashboardUrl = auth()->check() ? route('dashboard') : url('/');
@endphp
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Halaman Tidak Ditemukan — PASIH</title>
  <link rel="icon" type="image/png" href="{{ asset('images/logo_pasih_perda.png') }}">
  @if (file_exists(public_path('build/manifest.json')))
    @vite(['resources/css/app.css'])
  @else
    <script src="https://cdn.tailwindcss.com"></script>
  @endif
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex items-center justify-center p-4">
  <div class="w-full max-w-lg text-center space-y-6">
    {{-- Icon --}}
    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-blue-100 ring-4 ring-blue-50">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
      </svg>
    </div>

    {{-- Title --}}
    <div>
      <p class="text-sm font-semibold text-blue-600 tracking-wide uppercase">Error 404</p>
      <h1 class="mt-2 text-2xl font-bold text-slate-800 sm:text-3xl">Halaman Tidak Ditemukan</h1>
    </div>

    {{-- Description --}}
    <p class="text-slate-600 leading-relaxed">
      Halaman yang Anda cari tidak tersedia atau telah dipindahkan.
      Periksa kembali URL Anda atau kembali ke halaman utama.
    </p>

    {{-- Button --}}
    <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
      <a
        href="{{ $dashboardUrl }}"
        class="inline-flex items-center gap-2 h-11 px-6 rounded-lg bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition-colors shadow-sm"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z" />
        </svg>
        Kembali ke Dashboard
      </a>
      <button
        onclick="history.back()"
        class="inline-flex items-center gap-2 h-11 px-6 rounded-lg bg-white text-slate-700 text-sm font-semibold ring-1 ring-slate-200 hover:bg-slate-50 transition-colors"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali
      </button>
    </div>
  </div>
</body>
</html>
