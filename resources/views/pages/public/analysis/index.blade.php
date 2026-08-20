@extends('layouts.public')

@section('title', 'Hasil Analisis & Evaluasi Hukum Publik - PASIH PERDA')
@section('public_body_class', 'bg-slate-50')

@section('content')
    <!-- Hero / Header Banner -->
    <div class="relative bg-gradient-to-br from-blue-950 via-blue-900 to-[#192750] text-white pt-10 pb-16 lg:pb-20 overflow-hidden border-b border-blue-800">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:20px_20px] pointer-events-none"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-yellow-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs sm:text-sm text-blue-200/80 mb-6 font-medium" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-yellow-400 transition-colors flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Beranda
                </a>
                <span class="text-blue-300/40">/</span>
                <span class="text-white font-semibold">Hasil Analisis &amp; Evaluasi Hukum</span>
            </nav>

            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6">
                <div class="max-w-3xl space-y-3">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-yellow-400 text-xs font-bold tracking-wider uppercase backdrop-blur-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Repositori Regulasi Daerah
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">
                        Hasil Analisis &amp; <span class="text-yellow-400">Evaluasi Hukum</span>
                    </h1>
                    <p class="text-blue-100/90 text-sm sm:text-base leading-relaxed max-w-2xl font-medium">
                        Transparansi dan keterbukaan informasi dokumen hasil analisis, evaluasi, dan rekomendasi hukum terhadap peraturan daerah oleh Kantor Wilayah Kementerian Hukum Riau.
                    </p>
                </div>

                <!-- Stats Badges -->
                <div class="flex items-center gap-3 shrink-0">
                    <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-2xl p-4 min-w-[130px] text-center">
                        <div class="text-2xl sm:text-3xl font-black text-yellow-400">{{ $results->total() }}</div>
                        <div class="text-xs text-blue-200/80 font-semibold mt-0.5">Dokumen Publik</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-2xl p-4 min-w-[130px] text-center">
                        <div class="text-2xl sm:text-3xl font-black text-white">{{ $instansiOptions->count() }}</div>
                        <div class="text-xs text-blue-200/80 font-semibold mt-0.5">Pemerintah Daerah</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Container (Floating over banner) -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 pb-16 space-y-6 relative z-20">
        
        <!-- Filter & Search Card -->
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/70 border border-slate-200/80 p-5 sm:p-6 transition-all">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 mb-4 border-b border-slate-100">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-yellow-50 text-yellow-600 flex items-center justify-center font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-sm sm:text-base font-bold text-slate-800">Filter &amp; Pencarian Dokumen</h2>
                        <p class="text-xs text-slate-500">Saring peraturan berdasarkan instansi, tahun pengesahan, atau kata kunci</p>
                    </div>
                </div>

                @if($search !== '' || $instansiId > 0 || $year !== '')
                    <a href="{{ route('public.analysis.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 text-xs font-semibold transition-colors border border-slate-200 hover:border-rose-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reset Filter
                    </a>
                @endif
            </div>

            <form method="GET" action="{{ route('public.analysis.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <!-- Search Input -->
                <div class="md:col-span-6 lg:col-span-5">
                    <label for="q" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kata Kunci / Judul</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input 
                            id="q" 
                            type="text" 
                            name="q" 
                            value="{{ $search }}" 
                            placeholder="Cari judul peraturan daerah, nomor, topik..." 
                            class="w-full h-11 pl-10 pr-4 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-white text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500/20 focus:border-yellow-500 transition-all"
                        >
                    </div>
                </div>

                <!-- Instansi Dropdown -->
                <div class="md:col-span-6 lg:col-span-4">
                    <label for="instansi_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Instansi Pengaju</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <select 
                            id="instansi_id" 
                            name="instansi_id" 
                            class="w-full h-11 pl-10 pr-8 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-white text-sm text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500/20 focus:border-yellow-500 transition-all cursor-pointer"
                            onchange="this.form.submit()"
                        >
                            <option value="0">Semua Instansi (Provinsi &amp; Kab/Kota)</option>
                            @foreach($instansiOptions as $instansi)
                                <option value="{{ $instansi->id_instansi }}" @selected($instansiId === (int) $instansi->id_instansi)>
                                    {{ $instansi->nama_instansi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Year Dropdown -->
                <div class="md:col-span-6 lg:col-span-2">
                    <label for="year" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tahun</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <select 
                            id="year" 
                            name="year" 
                            class="w-full h-11 pl-10 pr-8 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-white text-sm text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500/20 focus:border-yellow-500 transition-all cursor-pointer"
                            onchange="this.form.submit()"
                        >
                            <option value="">Semua Tahun</option>
                            @foreach($years as $yearOption)
                                <option value="{{ $yearOption }}" @selected((string) $year === (string) $yearOption)>
                                    {{ $yearOption }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="md:col-span-6 lg:col-span-1 flex items-end">
                    <button type="submit" class="w-full h-11 rounded-xl bg-blue-900 hover:bg-blue-800 text-white font-bold text-sm shadow-md shadow-blue-900/20 flex items-center justify-center gap-1.5 transition-all hover:scale-[1.02]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span class="lg:hidden">Cari Data</span>
                    </button>
                </div>

                <input type="hidden" name="per_page" value="{{ $perPage }}">
            </form>
        </div>

        <!-- Table & Results Card -->
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-200/80 overflow-hidden">
            
            <!-- Table Header Toolbar -->
            <div class="px-5 py-4 bg-slate-50/60 border-b border-slate-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-900">
                        {{ $results->total() }} Data
                    </span>
                    <span class="text-xs sm:text-sm text-slate-500 font-medium">
                        Menampilkan hasil <strong class="text-slate-800">{{ $results->firstItem() ?? 0 }}</strong> - <strong class="text-slate-800">{{ $results->lastItem() ?? 0 }}</strong>
                    </span>
                </div>

                <!-- Per Page Selector -->
                <form method="GET" action="{{ route('public.analysis.index') }}" class="flex items-center gap-2 self-end sm:self-auto text-xs text-slate-500 font-medium">
                    <label for="per_page_select">Tampilkan per halaman:</label>
                    <select 
                        id="per_page_select" 
                        name="per_page" 
                        class="h-8 pl-2.5 pr-6 rounded-lg border border-slate-200 bg-white text-xs font-semibold text-slate-700 focus:outline-none focus:ring-1 focus:ring-yellow-500 cursor-pointer"
                        onchange="this.form.submit()"
                    >
                        <option value="5" @selected($perPage === 5)>5 Data</option>
                        <option value="10" @selected($perPage === 10)>10 Data</option>
                        <option value="25" @selected($perPage === 25)>25 Data</option>
                    </select>
                    <input type="hidden" name="q" value="{{ $search }}">
                    <input type="hidden" name="instansi_id" value="{{ $instansiId }}">
                    <input type="hidden" name="year" value="{{ $year }}">
                </form>
            </div>

            <!-- Table Container -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-100/70 border-b border-slate-200 text-[11px] font-extrabold text-slate-600 uppercase tracking-wider">
                            <th class="py-3.5 px-4 text-center w-12">No</th>
                            <th class="py-3.5 px-5">Judul Peraturan Daerah</th>
                            <th class="py-3.5 px-5">Instansi Pengaju</th>
                            <th class="py-3.5 px-4 text-center">Tahun</th>
                            <th class="py-3.5 px-4 text-center">Dokumen Perda</th>
                            <th class="py-3.5 px-4 text-center">Hasil Analisis</th>
                            <th class="py-3.5 px-5 text-center w-24">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($results as $item)
                            @php
                                $rowNumber = ($results->firstItem() ?? 1) + $loop->index;
                                $submission = $item->submission;
                                $perdaDocument = $submission?->documents?->where('document_type', 'peraturan_daerah')->sortByDesc('id')->first();
                                $analysisDocument = $item->documents?->where('document_type', 'hasil_analisis')->sortByDesc('id')->first();
                                $yearCompleted = optional($item->completed_at)->format('Y') ?: '-';
                            @endphp
                            <tr class="hover:bg-blue-50/40 transition-colors duration-150 group">
                                <!-- Number -->
                                <td class="py-4 px-4 text-center text-xs font-semibold text-slate-400">
                                    {{ $rowNumber }}
                                </td>

                                <!-- Perda Title -->
                                <td class="py-4 px-5 max-w-xs md:max-w-md">
                                    <div class="flex items-start gap-2.5">
                                        <div class="w-7 h-7 rounded-lg bg-blue-100/60 text-blue-900 flex items-center justify-center shrink-0 mt-0.5 group-hover:bg-blue-900 group-hover:text-yellow-400 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <a href="{{ route('public.analysis.show', $item) }}" class="font-bold text-slate-800 group-hover:text-blue-900 hover:underline line-clamp-2 leading-snug transition-colors">
                                                {{ $submission?->perda_title ?: 'Tanpa Judul Peraturan Daerah' }}
                                            </a>
                                            @if($submission?->nomor_surat)
                                                <div class="text-xs text-slate-400 mt-1 flex items-center gap-1">
                                                    <span>No. Surat: {{ $submission->nomor_surat }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <!-- Instansi -->
                                <td class="py-4 px-5 text-slate-600">
                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-medium text-xs border border-slate-200/60">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <span>{{ $submission?->submitter?->instansi?->nama_instansi ?? '-' }}</span>
                                    </div>
                                </td>

                                <!-- Year -->
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-block font-bold text-xs px-2.5 py-1 rounded-full bg-blue-50 text-blue-900 border border-blue-100">
                                        {{ $yearCompleted }}
                                    </span>
                                </td>

                                <!-- Perda Document -->
                                <td class="py-4 px-4 text-center">
                                    @if($perdaDocument && !empty($perdaDocument->file_path))
                                        <a 
                                            href="{{ asset('storage/'.$perdaDocument->file_path) }}" 
                                            target="_blank" 
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-100 hover:scale-105 border border-rose-200 font-bold text-xs shadow-xs transition-all" 
                                            title="Buka Dokumen Peraturan Daerah"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-rose-600" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                            </svg>
                                            <span>PDF Perda</span>
                                        </a>
                                    @else
                                        <span class="text-xs text-slate-400 font-medium italic">Tidak Tersedia</span>
                                    @endif
                                </td>

                                <!-- Analysis Document -->
                                <td class="py-4 px-4 text-center">
                                    @if($analysisDocument && !empty($analysisDocument->file_path))
                                        <a 
                                            href="{{ asset('storage/'.$analysisDocument->file_path) }}" 
                                            target="_blank" 
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 hover:scale-105 border border-emerald-200 font-bold text-xs shadow-xs transition-all" 
                                            title="Buka Dokumen Hasil Analisis"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z" clip-rule="evenodd" />
                                            </svg>
                                            <span>PDF Analisis</span>
                                        </a>
                                    @else
                                        <span class="text-xs text-slate-400 font-medium italic">Tidak Tersedia</span>
                                    @endif
                                </td>

                                <!-- Action -->
                                <td class="py-4 px-5 text-center">
                                    <a 
                                        href="{{ route('public.analysis.show', $item) }}" 
                                        class="inline-flex items-center justify-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-blue-900 hover:bg-yellow-500 text-white hover:text-blue-950 font-bold text-xs shadow-xs hover:shadow-md transition-all duration-200" 
                                        title="Lihat Detail Analisis"
                                    >
                                        <span>Detail</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-16 px-4 text-center">
                                    <div class="max-w-md mx-auto flex flex-col items-center">
                                        <div class="w-16 h-16 rounded-2xl bg-yellow-50 border border-yellow-100 flex items-center justify-center text-yellow-600 mb-4 shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-base font-bold text-slate-800 mb-1">Tidak Ada Data Ditemukan</h3>
                                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-5 text-center">
                                            Belum ada dokumen hasil analisis yang sesuai dengan kriteria filter atau kata kunci pencarian Anda.
                                        </p>
                                        @if($search !== '' || $instansiId > 0 || $year !== '')
                                            <a href="{{ route('public.analysis.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-900 hover:bg-blue-800 text-white font-bold text-xs shadow-md transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                </svg>
                                                Lihat Semua Data
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Table Pagination & Footer -->
            @if($results->hasPages() || $results->total() > 0)
                <div class="px-5 py-4 bg-slate-50/80 border-t border-slate-200/80 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="text-xs sm:text-sm text-slate-600 font-medium">
                        Halaman <span class="font-bold text-blue-900">{{ $results->currentPage() }}</span> dari <span class="font-bold text-blue-900">{{ $results->lastPage() }}</span>
                    </div>
                    <div>
                        {{ $results->onEachSide(1)->links('vendor.pagination.pasih') }}
                    </div>
                </div>
            @endif
        </div>
    </main>
@endsection
