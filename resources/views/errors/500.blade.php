@php
  $dashboardUrl = auth()->check() ? route('dashboard') : url('/');
@endphp
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kesalahan Server — PASIH</title>
  <link rel="icon" type="image/png" href="{{ asset('images/logo_pasih_perda.png') }}">
  @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex items-center justify-center p-4">
  <div class="w-full max-w-lg text-center space-y-6">
    {{-- Icon --}}
    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-slate-100 ring-4 ring-slate-50">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17l-5.1-5.1m0 0L12 4.37l5.68 5.7m-11.38 0h11.38M12 20.63V4.37" />
      </svg>
    </div>

    {{-- Title --}}
    <div>
      <p class="text-sm font-semibold text-slate-500 tracking-wide uppercase">Error 500</p>
      <h1 class="mt-2 text-2xl font-bold text-slate-800 sm:text-3xl">Kesalahan Server</h1>
    </div>

    {{-- Description --}}
    <p class="text-slate-600 leading-relaxed">
      Terjadi kesalahan pada server saat memproses permintaan Anda.
      Silakan coba lagi nanti atau hubungi administrator.
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
        onclick="location.reload()"
        class="inline-flex items-center gap-2 h-11 px-6 rounded-lg bg-white text-slate-700 text-sm font-semibold ring-1 ring-slate-200 hover:bg-slate-50 transition-colors"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
        </svg>
        Coba Lagi
      </button>
    </div>
  </div>
</body>
</html>
