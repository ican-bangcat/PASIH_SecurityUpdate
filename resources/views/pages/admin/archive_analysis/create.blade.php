@extends('layouts.app')
@section('title', 'Tambah Arsip Data Lama')

@section('content')
  <div class="space-y-5">
    <div>
      <h1 class="pasih-page-title">Tambah Arsip Data Lama</h1>
      <p class="mt-2 pasih-page-breadcrumb">
        <a href="{{ route('dashboard') }}" class="hover:text-slate-700 hover:underline">Dashboard</a>
        <span class="mx-1">/</span>
        <a href="{{ route('admin.archive-analysis.index') }}" class="hover:text-slate-700 hover:underline">Arsip Data Lama</a>
        <span class="mx-1">/</span>
        <span>Tambah Arsip</span>
      </p>
    </div>

    @if($errors->any())
      <div class="rounded-xl bg-rose-50 text-rose-700 ring-1 ring-rose-200 px-4 py-3 text-sm">
        {{ $errors->first() }}
      </div>
    @endif

    <div class="rounded-xl bg-white ring-1 ring-slate-200 overflow-hidden shadow-xs">
      <div class="px-5 py-4 border-b border-slate-200 bg-slate-50/50">
        <h2 class="text-base font-bold text-slate-800">Form Input Data Lama (Arsip Hasil Analisis & Evaluasi Hukum)</h2>
        <p class="text-xs text-slate-500 mt-0.5">Data yang diinputkan akan langsung diterbitkan ke halaman Publik Hasil Analisis & Evaluasi Hukum.</p>
      </div>

      <form method="POST" action="{{ route('admin.archive-analysis.store') }}" enctype="multipart/form-data" class="p-5 md:p-6 space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <label class="block text-sm font-medium text-slate-700">
            Instansi Pengaju <span class="text-rose-500">*</span>
            <select name="instansi_id" required class="mt-2 w-full h-11 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm focus:outline-none focus:ring-0 focus:border-[#B9B9B9]">
              <option value="">-- Pilih Instansi Pengaju --</option>
              @foreach($instansiList as $instansi)
                <option value="{{ $instansi->id_instansi }}" @selected((string) old('instansi_id') === (string) $instansi->id_instansi)>
                  {{ $instansi->nama_instansi }}
                </option>
              @endforeach
            </select>
            @error('instansi_id')
              <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
            @enderror
          </label>

          <label class="block text-sm font-medium text-slate-700">
            Nomor Surat / Perda <span class="text-rose-500">*</span>
            <input type="text" name="nomor_surat" value="{{ old('nomor_surat') }}" required placeholder="Contoh: 009/Perda/9K" class="mt-2 w-full h-11 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm">
            @error('nomor_surat')
              <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
            @enderror
          </label>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <label class="block text-sm font-medium text-slate-700">
            Judul Peraturan Daerah <span class="text-rose-500">*</span>
            <input type="text" name="perda_title" value="{{ old('perda_title') }}" required placeholder="Contoh: Peraturan Daerah Kabupaten Rokan Hilir Nomor 9 Tahun 2019..." class="mt-2 w-full h-11 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm">
            @error('perda_title')
              <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
            @enderror
          </label>

          <label class="block text-sm font-medium text-slate-700">
            Perihal <span class="text-rose-500">*</span>
            <input type="text" name="perihal" value="{{ old('perihal') }}" required placeholder="Contoh: Permohonan Analisis dan Evaluasi Perda..." class="mt-2 w-full h-11 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm">
            @error('perihal')
              <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
            @enderror
          </label>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <label class="block text-sm font-medium text-slate-700">
            Tanggal / Tahun Selesai <span class="text-rose-500">*</span>
            <input type="date" name="completed_at" value="{{ old('completed_at', now()->toDateString()) }}" required class="mt-2 w-full h-11 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm">
            @error('completed_at')
              <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
            @enderror
          </label>

          <label class="block text-sm font-medium text-slate-700">
            Deskripsi Singkat (Opsional)
            <input type="text" name="description" value="{{ old('description') }}" placeholder="Keterangan / deskripsi permohonan..." class="mt-2 w-full h-11 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm">
          </label>
        </div>

        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-4">
          <h3 class="text-sm font-bold text-slate-800">Berkas Dokumen PDF/Word</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <label class="block text-sm font-medium text-slate-700">
              Dokumen Peraturan Daerah (Perda) <span class="text-rose-500">*</span>
              <p class="text-xs text-slate-500 mt-0.5">Format: PDF, DOC, DOCX. Maksimal 5 MB.</p>
              <input type="file" name="peraturan_daerah" required accept=".pdf,.doc,.docx" class="mt-2 block w-full rounded-xl border border-[#B9B9B9] bg-white text-sm text-slate-700 file:mr-3 file:rounded-l-xl file:border-0 file:bg-slate-100 file:px-4 file:py-3 file:text-sm file:text-slate-700">
              @error('peraturan_daerah')
                <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
              @enderror
            </label>

            <label class="block text-sm font-medium text-slate-700">
              Dokumen Hasil Analisis & Evaluasi <span class="text-rose-500">*</span>
              <p class="text-xs text-slate-500 mt-0.5">Format: PDF, DOC, DOCX. Maksimal 5 MB.</p>
              <input type="file" name="hasil_analisis" required accept=".pdf,.doc,.docx" class="mt-2 block w-full rounded-xl border border-[#B9B9B9] bg-white text-sm text-slate-700 file:mr-3 file:rounded-l-xl file:border-0 file:bg-slate-100 file:px-4 file:py-3 file:text-sm file:text-slate-700">
              @error('hasil_analisis')
                <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
              @enderror
            </label>
          </div>
        </div>

        <div class="space-y-4">
          <h3 class="text-sm font-bold text-slate-800">Rincian Hasil Analisis & Evaluasi</h3>

          <label class="block text-sm font-medium text-slate-700">
            Ringkasan Analisis <span class="text-rose-500">*</span>
            <textarea name="ringkasan_analisis" rows="3" required placeholder="Masukkan ringkasan analisis..." class="mt-2 w-full px-4 py-3 rounded-md border border-[#B9B9B9] text-sm">{{ old('ringkasan_analisis') }}</textarea>
            @error('ringkasan_analisis')
              <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
            @enderror
          </label>

          <label class="block text-sm font-medium text-slate-700">
            Hasil Evaluasi <span class="text-rose-500">*</span>
            <textarea name="hasil_evaluasi" rows="3" required placeholder="Masukkan hasil evaluasi hukum..." class="mt-2 w-full px-4 py-3 rounded-md border border-[#B9B9B9] text-sm">{{ old('hasil_evaluasi') }}</textarea>
            @error('hasil_evaluasi')
              <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
            @enderror
          </label>

          <label class="block text-sm font-medium text-slate-700">
            Rekomendasi <span class="text-rose-500">*</span>
            <textarea name="rekomendasi" rows="3" required placeholder="Masukkan rekomendasi hasil analisis..." class="mt-2 w-full px-4 py-3 rounded-md border border-[#B9B9B9] text-sm">{{ old('rekomendasi') }}</textarea>
            @error('rekomendasi')
              <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
            @enderror
          </label>
        </div>

        <div class="pt-3 flex gap-3">
          <button type="submit" class="inline-flex items-center gap-2 h-11 px-5 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 shadow-sm transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            Terbitkan Data Lama
          </button>
          <a href="{{ route('admin.archive-analysis.index') }}" class="inline-flex items-center justify-center h-11 px-5 rounded-xl border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50 transition-all">
            Batal
          </a>
        </div>
      </form>
    </div>
  </div>
@endsection
