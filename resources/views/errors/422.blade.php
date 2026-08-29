@php
  $dashboardUrl = auth()->check() ? route('dashboard') : url('/');
@endphp
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Tidak Valid — PASIH</title>
  <link rel="icon" type="image/png" href="{{ asset('images/logo_pasih_perda.png') }}">
  @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex items-center justify-center p-4">
  <div class="w-full max-w-lg text-center space-y-6">
    {{-- Icon --}}
    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-amber-100 ring-4 ring-amber-50">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
      </svg>
    </div>

    {{-- Title --}}
    <div>
      <p class="text-sm font-semibold text-amber-600 tracking-wide uppercase">Error 422</p>
      <h1 class="mt-2 text-2xl font-bold text-slate-800 sm:text-3xl">Data Tidak Dapat Diproses</h1>
    </div>

    {{-- Description --}}
    <p class="text-slate-600 leading-relaxed">
      Data yang Anda kirim tidak dapat diproses. Pastikan semua kolom terisi dengan benar
      dan file yang diunggah sesuai format serta ukuran yang ditentukan.
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
