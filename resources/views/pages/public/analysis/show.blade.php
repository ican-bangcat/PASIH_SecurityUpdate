@extends('layouts.public')

@section('title', 'Detail Hasil Analisis & Evaluasi Hukum - PASIH PERDA')
@section('public_body_class', 'bg-slate-50')

@section('content')
    @php
        $submission = $assignment->submission;
        $analysisDoc = $latestAnalysisDocument;
        $perdaDoc = $perdaDocument;
        $yearCompleted = optional($assignment->completed_at)->format('Y') ?: '-';
    @endphp

    <!-- Hero / Header Banner -->
    <div class="relative bg-gradient-to-br from-blue-950 via-blue-900 to-[#192750] text-white pt-10 pb-16 lg:pb-20 overflow-hidden border-b border-blue-800">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:20px_20px] pointer-events-none"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-yellow-500/10 rounded-full blur-3xl pointer-events-none"></div>

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
                <a href="{{ route('public.analysis.index') }}" class="hover:text-yellow-400 transition-colors">Hasil Analisis</a>
                <span class="text-blue-300/40">/</span>
                <span class="text-white font-semibold truncate max-w-xs sm:max-w-sm">Detail Analisis</span>
            </nav>

            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6">
                <div class="max-w-4xl space-y-3">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-yellow-400 text-xs font-bold tracking-wider uppercase backdrop-blur-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                        </svg>
                        Informasi &amp; Hasil Evaluasi Regulasi
                    </div>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight leading-tight">
                        {{ $submission?->perda_title ?: 'Detail Hasil Analisis Peraturan Daerah' }}
                    </h1>
                    <div class="flex flex-wrap items-center gap-3 pt-1 text-xs sm:text-sm text-blue-100 font-medium">
                        <span class="inline-flex items-center gap-1.5 bg-blue-800/80 px-3 py-1 rounded-lg border border-blue-700/60">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            {{ $submission?->submitter?->instansi?->nama_instansi ?? 'Instansi Tidak Diketahui' }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 bg-blue-800/80 px-3 py-1 rounded-lg border border-blue-700/60">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Tahun Selesai: {{ $yearCompleted }}
                        </span>
                    </div>
                </div>

                <div class="shrink-0">
                    <a href="{{ route('public.analysis.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs sm:text-sm border border-white/20 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Container -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 pb-16 space-y-6 relative z-20">
        
        <!-- Informasi Peraturan Daerah Card -->
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/70 border border-slate-200/80 p-5 md:p-6">
            <div class="flex items-center gap-2.5 pb-4 mb-4 border-b border-slate-100">
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-900 flex items-center justify-center font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-800">Informasi Pokok Peraturan Daerah</h2>
                    <p class="text-xs text-slate-500">Ringkasan metadata permohonan analisis</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2 rounded-xl bg-slate-50 border border-slate-200/80 p-4">
                    <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1">Judul Peraturan Daerah</div>
                    <div class="text-sm font-bold text-slate-800 leading-snug">{{ $submission?->perda_title ?: '-' }}</div>
                </div>

                <div class="rounded-xl bg-slate-50 border border-slate-200/80 p-4">
                    <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1">Tahun Pengesahan / Analisis</div>
                    <div class="text-sm font-bold text-blue-900">{{ $yearCompleted }}</div>
                </div>

                <div class="md:col-span-2 rounded-xl bg-slate-50 border border-slate-200/80 p-4">
                    <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1">Instansi Pemerintah Daerah</div>
                    <div class="text-sm font-bold text-slate-800">{{ $submission?->submitter?->instansi?->nama_instansi ?? '-' }}</div>
                </div>

                <div class="rounded-xl bg-slate-50 border border-slate-200/80 p-4">
                    <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1">Nomor Surat Permohonan</div>
                    <div class="text-sm font-bold text-slate-800">{{ $submission?->nomor_surat ?: '-' }}</div>
                </div>
            </div>
        </div>

        <!-- Ringkasan Hasil Analisis Card -->
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/70 border border-slate-200/80 p-5 md:p-6">
            <div class="flex items-center gap-2.5 pb-4 mb-4 border-b border-slate-100">
                <div class="w-8 h-8 rounded-lg bg-yellow-50 text-yellow-600 flex items-center justify-center font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-800">Substansi &amp; Rekomendasi Hasil Analisis</h2>
                    <p class="text-xs text-slate-500">Poin penting hasil evaluasi oleh Pejabat Analis Hukum</p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="rounded-xl bg-slate-50 border border-slate-200/80 p-4">
                    <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1.5 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                        Ringkasan Analisis
                    </div>
                    <div class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">{{ trim((string) ($analysisDoc?->ringkasan_analisis ?? '')) ?: '-' }}</div>
                </div>

                <div class="rounded-xl bg-slate-50 border border-slate-200/80 p-4">
                    <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1.5 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        Hasil Evaluasi
                    </div>
                    <div class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">{{ trim((string) ($analysisDoc?->hasil_evaluasi ?? '')) ?: '-' }}</div>
                </div>

                <div class="rounded-xl bg-blue-50/60 border border-blue-100 p-4">
                    <div class="text-[11px] font-bold uppercase tracking-wider text-blue-900 mb-1.5 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                        Rekomendasi Hukum
                    </div>
                    <div class="text-sm text-slate-800 font-medium leading-relaxed whitespace-pre-line">{{ trim((string) ($analysisDoc?->rekomendasi ?? '')) ?: '-' }}</div>
                </div>
            </div>
        </div>

        <!-- Dokumen Peraturan Daerah Card -->
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/70 border border-slate-200/80 p-5 md:p-6">
            <div class="flex items-center gap-2.5 pb-4 mb-4 border-b border-slate-100">
                <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-800">Berkas Dokumen Peraturan Daerah</h2>
                    <p class="text-xs text-slate-500">Naskah peraturan daerah yang dianalisis</p>
                </div>
            </div>

            <div class="rounded-xl border border-slate-200/80 overflow-hidden">
                @if($perdaDoc && !empty($perdaDoc->file_path))
                    @php
                        $perdaFileUrl = asset('storage/'.$perdaDoc->file_path);
                        $perdaFileName = strtolower($perdaDoc->file_name ?? '');
                        $perdaFilePath = strtolower($perdaDoc->file_path ?? '');
                        $perdaIsPdf = str_ends_with($perdaFileName, '.pdf') || str_ends_with($perdaFilePath, '.pdf');
                        $perdaPreviewUrl = $perdaIsPdf ? route('public.documents.preview.submission', $perdaDoc) : null;
                        $perdaPreviewDataUrl = $perdaIsPdf ? route('public.documents.preview.submission', ['document' => $perdaDoc, 'base64' => 1]) : null;
                        $perdaOpenUrl = $perdaIsPdf ? $perdaPreviewUrl : $perdaFileUrl;
                        $perdaDownloadUrl = route('public.documents.download.submission', $perdaDoc);
                    @endphp
                    <div class="flex items-center justify-between gap-3 px-4 py-3.5 bg-slate-50 border-b border-slate-200/80">
                        <div class="min-w-0 flex-1 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-rose-100 text-rose-700 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <div class="truncate text-sm font-bold text-slate-800">
                                    <span>{{ $perdaDoc->file_name ?? 'Dokumen Peraturan Daerah' }}</span>
                                    <span id="perda-page-info" class="text-xs font-normal text-slate-500 ml-1"></span>
                                </div>
                                <div class="text-xs text-slate-400">Diunggah: {{ optional($perdaDoc->created_at)->format('d M Y, H:i') ?: '-' }}</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <a href="{{ $perdaOpenUrl }}" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold text-xs border border-rose-200 shadow-xs transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                Buka di Tab Baru
                            </a>
                            <a href="{{ $perdaDownloadUrl }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold text-xs border border-blue-200 shadow-xs transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Unduh PDF
                            </a>
                        </div>
                    </div>
                    @if($perdaIsPdf)
                        <div class="bg-slate-100 p-3 md:p-4">
                            <div
                                class="overflow-hidden rounded-xl border border-slate-200 bg-slate-200"
                                data-pdf-viewer
                                data-pdf-url="{{ $perdaPreviewDataUrl }}"
                                data-pdf-name="{{ $perdaDoc->file_name ?? 'Dokumen Perda' }}"
                                data-pdf-page-info-target="perda-page-info"
                            >
                                <div class="h-[58vh] min-h-[420px] max-h-[840px] overflow-auto p-3" data-pdf-scroll>
                                    <div class="flex flex-col items-center gap-3" data-pdf-pages>
                                        <div class="text-xs text-slate-500 font-medium py-8">Menyiapkan preview PDF...</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="px-4 py-8 text-center text-sm text-slate-400 bg-white font-medium">Dokumen naskah perda belum tersedia untuk publikasi.</div>
                @endif
            </div>
        </div>

        <!-- Dokumen Hasil Analisis Card -->
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/70 border border-slate-200/80 p-5 md:p-6">
            <div class="flex items-center gap-2.5 pb-4 mb-4 border-b border-slate-100">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-800">Berkas Dokumen Hasil Analisis</h2>
                    <p class="text-xs text-slate-500">Laporan resmi hasil analisis dan evaluasi hukum</p>
                </div>
            </div>

            <div class="rounded-xl border border-slate-200/80 overflow-hidden">
                @if($analysisDoc && !empty($analysisDoc->file_path))
                    @php
                        $analysisFileUrl = asset('storage/'.$analysisDoc->file_path);
                        $analysisFileName = strtolower($analysisDoc->file_name ?? '');
                        $analysisFilePath = strtolower($analysisDoc->file_path ?? '');
                        $analysisIsPdf = str_ends_with($analysisFileName, '.pdf') || str_ends_with($analysisFilePath, '.pdf');
                        $analysisPreviewUrl = $analysisIsPdf ? route('public.documents.preview.assignment', $analysisDoc) : null;
                        $analysisPreviewDataUrl = $analysisIsPdf ? route('public.documents.preview.assignment', ['document' => $analysisDoc, 'base64' => 1]) : null;
                        $analysisOpenUrl = $analysisIsPdf ? $analysisPreviewUrl : $analysisFileUrl;
                        $analysisDownloadUrl = route('public.documents.download.assignment', $analysisDoc);
                    @endphp
                    <div class="flex items-center justify-between gap-3 px-4 py-3.5 bg-slate-50 border-b border-slate-200/80">
                        <div class="min-w-0 flex-1 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <div class="truncate text-sm font-bold text-slate-800">
                                    <span>{{ $analysisDoc->file_name ?? 'Dokumen Hasil Analisis' }}</span>
                                    <span id="analysis-page-info" class="text-xs font-normal text-slate-500 ml-1"></span>
                                </div>
                                <div class="text-xs text-slate-400">Diunggah: {{ optional($analysisDoc->created_at)->format('d M Y, H:i') ?: '-' }}</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <a href="{{ $analysisOpenUrl }}" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-bold text-xs border border-emerald-200 shadow-xs transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                Buka di Tab Baru
                            </a>
                            <a href="{{ $analysisDownloadUrl }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold text-xs border border-blue-200 shadow-xs transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Unduh PDF
                            </a>
                        </div>
                    </div>
                    @if($analysisIsPdf)
                        <div class="bg-slate-100 p-3 md:p-4">
                            <div
                                class="overflow-hidden rounded-xl border border-slate-200 bg-slate-200"
                                data-pdf-viewer
                                data-pdf-url="{{ $analysisPreviewDataUrl }}"
                                data-pdf-name="{{ $analysisDoc->file_name ?? 'Dokumen Hasil Analisis' }}"
                                data-pdf-page-info-target="analysis-page-info"
                            >
                                <div class="h-[58vh] min-h-[420px] max-h-[840px] overflow-auto p-3" data-pdf-scroll>
                                    <div class="flex flex-col items-center gap-3" data-pdf-pages>
                                        <div class="text-xs text-slate-500 font-medium py-8">Menyiapkan preview PDF...</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="px-4 py-8 text-center text-sm text-slate-400 bg-white font-medium">Dokumen hasil analisis belum diunggah.</div>
                @endif
            </div>
        </div>
    </main>
@endsection
