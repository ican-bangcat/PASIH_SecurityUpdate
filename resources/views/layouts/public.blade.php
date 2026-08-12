<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'PASIH')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo_pasih_perda.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo_pasih_perda.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php
    $publicBodyClass = trim($__env->yieldContent('public_body_class'));
@endphp
<body class="public-page {{ $publicBodyClass }} min-h-screen bg-slate-100 text-slate-800">
    @php
        $isPublicAnalysisPage = request()->routeIs('public.analysis.*');
    @endphp

    <header class="sticky top-0 z-50 bg-white border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <img class="h-11 w-auto object-contain rounded-md" src="{{ asset('images/loginlogo2.png') }}" alt="Logo Kementerian Hukum">
                <img class="h-11 w-auto object-contain rounded-md" src="{{ asset('images/logo_pasih_perda.png') }}" alt="Logo PASIH PERDA">
                <div class="flex flex-col">
                    <span class="text-xl font-extrabold text-blue-900 leading-tight">PASIH</span>
                    <span class="text-[10px] font-semibold text-slate-500 max-w-[200px] leading-snug">Pendampingan Analisis &amp; Evaluasi Hukum Peraturan Daerah</span>
                </div>
            </div>

            @if(request()->routeIs('home'))
                <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600">
                    <a href="#beranda" class="text-blue-900 transition-colors">Beranda</a>
                    <a href="#tentang" class="hover:text-blue-900 transition-colors">Tentang Sistem</a>
                    <a href="#kontak" class="hover:text-blue-900 transition-colors">Kontak Kami</a>
                </nav>
            @else
                <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600">
                    <a href="{{ route('home') }}" class="hover:text-blue-900 transition-colors">Beranda</a>
                    <a href="{{ route('public.analysis.index') }}" class="{{ $isPublicAnalysisPage ? 'text-blue-900' : 'hover:text-blue-900' }} transition-colors">Hasil Analisis</a>
                </nav>
            @endif

            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="hidden md:inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold text-sm transition-colors shadow-sm">
                    Masuk
                </a>
                <button
                    type="button"
                    data-sidebar-toggle
                    aria-label="Buka menu"
                    class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-slate-500 hover:text-blue-900 hover:bg-slate-100"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <div data-sidebar-overlay class="fixed inset-0 z-[60] hidden bg-slate-900/50 backdrop-blur-[1px] md:hidden"></div>

    <aside
        data-sidebar-drawer
        class="fixed inset-y-0 left-0 z-[70] flex w-[280px] -translate-x-full flex-col overflow-y-auto bg-white shadow-2xl transition-transform duration-200 ease-out md:hidden"
    >
        <div class="px-4 py-4 border-b border-slate-200 flex items-center justify-between gap-3">
            <div class="flex items-center gap-2 min-w-0">
                <img src="{{ asset('images/loginlogo2.png') }}" alt="Logo Kementerian Hukum" class="h-9 w-auto rounded-md object-contain">
                <img src="{{ asset('images/logo_pasih_perda.png') }}" alt="Logo PASIH PERDA" class="h-9 w-auto rounded-md object-contain">
                <div class="min-w-0">
                    <div class="font-extrabold tracking-tight text-lg text-[#29346b] truncate">PASIH</div>
                    <div class="text-[11px] leading-snug text-slate-500">Pendampingan Analisis &amp; Evaluasi Peraturan Daerah Kementerian Hukum Provinsi Riau</div>
                </div>
            </div>
            <button
                type="button"
                data-sidebar-close
                aria-label="Tutup menu"
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-300 text-slate-700"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav class="px-4 py-4 space-y-2">
            <a
                href="{{ route('home') }}"
                data-sidebar-link
                class="block rounded-xl px-4 py-3 text-sm font-semibold {{ request()->routeIs('home') ? 'bg-[#eef2ff] text-[#1f275e]' : 'text-slate-700 hover:bg-slate-100' }}"
            >
                Beranda
            </a>
            <a
                href="{{ route('public.analysis.index') }}"
                data-sidebar-link
                class="block rounded-xl px-4 py-3 text-sm font-semibold {{ $isPublicAnalysisPage ? 'bg-[#eef2ff] text-[#1f275e]' : 'text-slate-700 hover:bg-slate-100' }}"
            >
                Hasil Analisis
            </a>
        </nav>

        <div class="public-sidebar-login-wrap mt-auto px-4 py-4">
            <a
                href="{{ route('login') }}"
                data-sidebar-link
                class="block w-full rounded-xl px-4 py-3 text-sm font-semibold bg-[#1f275e] text-white hover:bg-[#27316a] text-center"
            >
                Login
            </a>
        </div>
    </aside>

    @yield('content')

    @hasSection('public_footer')
        @yield('public_footer')
    @else
        <footer class="public-footer">
            <div class="public-copyright">
                &copy; 2026 PASIH - Kementerian Hukum Riau. Dikembangkan bersama Politeknik Caltex Riau.
            </div>
        </footer>
    @endif
</body>
</html>
