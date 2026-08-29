@extends('layouts.app')
@section('title', 'Ubah Permohonan')

@section('content')
  <div class="space-y-5">
    <div>
      <h1 class="pasih-page-title">Ubah Permohonan Peraturan Daerah</h1>
      <p class="mt-1 pasih-page-breadcrumb">
        <a href="{{ route('dashboard') }}" class="hover:text-slate-700 hover:underline">Dashboard</a>
        <span class="mx-1">/</span>
        <a href="{{ route('submissions.index') }}" class="hover:text-slate-700 hover:underline">Permohonan</a>
        <span class="mx-1">/</span>
        <span>Ubah Permohonan</span>
      </p>
    </div>

    <!-- Alert Container -->
    <div id="global-alert" class="hidden rounded-xl px-4 py-3 text-sm font-medium"></div>

    @if(session('success'))
      <div class="rounded-xl bg-emerald-50 text-emerald-800 ring-1 ring-emerald-200 px-4 py-3 text-sm font-medium flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-600 shrink-0" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    @if($errors->any())
      <div class="rounded-xl bg-rose-50 text-rose-700 ring-1 ring-rose-200 px-4 py-3 text-sm font-medium">
        {{ $errors->first() }}
      </div>
    @endif

    @php
      $docMap = $submission->documents->keyBy('document_type');
      $suratPermohonanDoc = $docMap->get('surat_permohonan');
      $perdaDoc = $docMap->get('peraturan_daerah');
      $pelaksanaDoc = $docMap->get('peraturan_pelaksana_perda');

      $getPreviewUrl = function($doc) {
        if (!$doc) return null;
        $isPdf = str_ends_with(strtolower($doc->file_name), '.pdf') || str_ends_with(strtolower($doc->file_path), '.pdf');
        return $isPdf ? route('documents.preview.submission', $doc) : asset('storage/'.$doc->file_path);
      };
    @endphp

    <!-- KOTAK 1: DATA PERMOHONAN -->
    <div class="rounded-xl bg-white ring-1 ring-slate-200 overflow-hidden shadow-xs">
      <div class="px-5 py-4 border-b border-slate-200 bg-slate-50/70 flex items-center justify-between">
        <div>
          <h2 class="text-base font-bold text-slate-800">1. Data Permohonan</h2>
          <p class="text-xs text-slate-500 mt-0.5">Informasi utama pengajuan permohonan analisis peraturan daerah.</p>
        </div>
        <span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
          </svg>
          Data Tersimpan
        </span>
      </div>

      <form id="submission-info-form" method="POST" action="{{ route('submissions.update', $submission) }}" class="p-5 space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <label class="block text-sm font-medium text-slate-700">
            Tanggal Pengajuan
            <input
              type="text"
              value="{{ optional($submission->submitted_at)->format('d-m-Y H:i') ?: optional($submission->created_at)->format('d-m-Y H:i') ?: '-' }}"
              disabled
              class="mt-1.5 w-full h-10 px-3.5 rounded-lg border border-slate-200 bg-slate-100 text-sm text-slate-500 cursor-not-allowed"
            >
          </label>

          <label class="block text-sm font-medium text-slate-700">
            Instansi Pengaju
            <input
              type="text"
              value="{{ $submission->submitter?->instansi?->nama_instansi ?? '-' }}"
              disabled
              class="mt-1.5 w-full h-10 px-3.5 rounded-lg border border-slate-200 bg-slate-100 text-sm text-slate-500 cursor-not-allowed"
            >
          </label>

          <label class="block text-sm font-medium text-slate-700">
            Judul Peraturan Daerah <span class="text-rose-500">*</span>
            <input
              type="text"
              name="perda_title"
              id="input-perda-title"
              value="{{ old('perda_title', $submission->perda_title) }}"
              placeholder="Masukkan Judul Peraturan Daerah"
              required
              class="mt-1.5 w-full h-10 px-3.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition-all placeholder:text-slate-400"
            >
          </label>

          <label class="block text-sm font-medium text-slate-700">
            Nomor Surat <span class="text-rose-500">*</span>
            <input
              type="text"
              name="nomor_surat"
              id="input-nomor-surat"
              value="{{ old('nomor_surat', $submission->nomor_surat) }}"
              placeholder="Masukkan Nomor Surat"
              required
              class="mt-1.5 w-full h-10 px-3.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition-all placeholder:text-slate-400"
            >
          </label>
        </div>

        <label class="block text-sm font-medium text-slate-700">
          Perihal <span class="text-rose-500">*</span>
          <input
            type="text"
            name="perihal"
            id="input-perihal"
            value="{{ old('perihal', $submission->perihal) }}"
            placeholder="Masukkan Perihal Surat"
            required
            class="mt-1.5 w-full h-10 px-3.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition-all placeholder:text-slate-400"
          >
        </label>

        <label class="block text-sm font-medium text-slate-700">
          Deskripsi Permohonan <span class="text-rose-500">*</span>
          <textarea
            required
            name="description"
            id="input-description"
            rows="3"
            placeholder="Masukkan Deskripsi Permohonan"
            class="mt-1.5 w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition-all placeholder:text-slate-400"
          >{{ old('description', $submission->description) }}</textarea>
        </label>

        <div class="pt-2 flex items-center gap-3">
          <button
            type="submit"
            id="btn-save-info"
            class="inline-flex items-center gap-2 h-10 px-5 rounded-lg bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 active:scale-95 shadow-sm transition-all cursor-pointer"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
            </svg>
            <span id="btn-save-info-text">Simpan Perubahan Data</span>
          </button>
        </div>
      </form>
    </div>

    <!-- KOTAK 2: UPLOAD DOKUMEN PERMOHONAN -->
    <div id="section-upload-documents" class="rounded-xl bg-white ring-1 ring-slate-200 overflow-hidden shadow-xs">
      <div class="px-5 py-4 border-b border-slate-200 bg-slate-50/70">
        <h2 class="text-base font-bold text-slate-800">2. Upload Dokumen Permohonan</h2>
        <p class="text-xs text-slate-500 mt-0.5">Format: PDF/DOC/DOCX, maksimal ukuran tiap file 10 MB. Dokumen akan langsung tersimpan ke server secara otomatis saat dipilih.</p>
      </div>

      <div class="p-5 space-y-4">
        <!-- Card 1: Surat Permohonan (Wajib) -->
        <div class="rounded-xl ring-1 ring-slate-200 p-4 bg-white hover:ring-slate-300 transition-all">
          <div class="flex items-center justify-between gap-3 mb-2">
            <div>
              <span class="text-sm font-bold text-slate-800">Surat Permohonan</span>
              <span class="text-rose-500 text-xs font-semibold ml-1">* (Wajib)</span>
              <span class="text-slate-400 text-xs ml-1.5">(Maks. 10 MB)</span>
            </div>
            <div id="container-action-surat_permohonan">
              @if($suratPermohonanDoc)
                <a href="{{ $getPreviewUrl($suratPermohonanDoc) }}" target="_blank" class="inline-flex shrink-0 items-center gap-1 h-8 px-3 rounded-lg bg-white text-slate-700 text-xs font-semibold ring-1 ring-slate-300 hover:bg-slate-100 transition-all shadow-xs">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                  Lihat
                </a>
              @else
                <span class="text-xs text-slate-400 font-medium">Belum diunggah</span>
              @endif
            </div>
          </div>
          <input
            type="file"
            name="file_surat_permohonan"
            id="file-surat_permohonan"
            data-doc-type="surat_permohonan"
            data-max-size="10485760"
            accept=".pdf,.doc,.docx"
            class="block w-full rounded-xl border border-slate-300 bg-slate-50 text-sm text-slate-700 file:mr-3 file:rounded-l-xl file:border-0 file:bg-blue-50 file:text-blue-700 file:font-semibold file:px-4 file:py-2.5 file:text-xs hover:file:bg-blue-100 transition-all cursor-pointer"
          >
          <div id="status-surat_permohonan">
            @if($suratPermohonanDoc)
              <div class="mt-2 text-xs font-semibold text-emerald-600 flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-600 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>✓ Berhasil diunggah: <strong class="font-bold text-slate-800">{{ $suratPermohonanDoc->file_name }}</strong></span>
              </div>
            @endif
          </div>
        </div>

        <!-- Card 2: Peraturan Daerah (Wajib) -->
        <div class="rounded-xl ring-1 ring-slate-200 p-4 bg-white hover:ring-slate-300 transition-all">
          <div class="flex items-center justify-between gap-3 mb-2">
            <div>
              <span class="text-sm font-bold text-slate-800">Peraturan Daerah</span>
              <span class="text-rose-500 text-xs font-semibold ml-1">* (Wajib)</span>
              <span class="text-slate-400 text-xs ml-1.5">(Maks. 10 MB)</span>
            </div>
            <div id="container-action-peraturan_daerah">
              @if($perdaDoc)
                <a href="{{ $getPreviewUrl($perdaDoc) }}" target="_blank" class="inline-flex shrink-0 items-center gap-1 h-8 px-3 rounded-lg bg-white text-slate-700 text-xs font-semibold ring-1 ring-slate-300 hover:bg-slate-100 transition-all shadow-xs">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                  Lihat
                </a>
              @else
                <span class="text-xs text-slate-400 font-medium">Belum diunggah</span>
              @endif
            </div>
          </div>
          <input
            type="file"
            name="file_peraturan_daerah"
            id="file-peraturan_daerah"
            data-doc-type="peraturan_daerah"
            data-max-size="10485760"
            accept=".pdf,.doc,.docx"
            class="block w-full rounded-xl border border-slate-300 bg-slate-50 text-sm text-slate-700 file:mr-3 file:rounded-l-xl file:border-0 file:bg-blue-50 file:text-blue-700 file:font-semibold file:px-4 file:py-2.5 file:text-xs hover:file:bg-blue-100 transition-all cursor-pointer"
          >
          <div id="status-peraturan_daerah">
            @if($perdaDoc)
              <div class="mt-2 text-xs font-semibold text-emerald-600 flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-600 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>✓ Berhasil diunggah: <strong class="font-bold text-slate-800">{{ $perdaDoc->file_name }}</strong></span>
              </div>
            @endif
          </div>
        </div>

        <!-- Card 3: Peraturan Pelaksana Perda (Opsional) -->
        <div class="rounded-xl ring-1 ring-slate-200 p-4 bg-white hover:ring-slate-300 transition-all">
          <div class="flex items-center justify-between gap-3 mb-2">
            <div>
              <span class="text-sm font-bold text-slate-800">Peraturan Pelaksana Perda</span>
              <span class="text-slate-400 text-xs ml-1">(Opsional, Maks. 10 MB)</span>
            </div>
            <div id="container-action-peraturan_pelaksana_perda">
              @if($pelaksanaDoc)
                <a href="{{ $getPreviewUrl($pelaksanaDoc) }}" target="_blank" class="inline-flex shrink-0 items-center gap-1 h-8 px-3 rounded-lg bg-white text-slate-700 text-xs font-semibold ring-1 ring-slate-300 hover:bg-slate-100 transition-all shadow-xs">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                  Lihat
                </a>
              @else
                <span class="text-xs text-slate-400 font-medium">Belum diunggah</span>
              @endif
            </div>
          </div>
          <input
            type="file"
            name="file_peraturan_pelaksana_perda"
            id="file-peraturan_pelaksana_perda"
            data-doc-type="peraturan_pelaksana_perda"
            data-max-size="10485760"
            accept=".pdf,.doc,.docx"
            class="block w-full rounded-xl border border-slate-300 bg-slate-50 text-sm text-slate-700 file:mr-3 file:rounded-l-xl file:border-0 file:bg-blue-50 file:text-blue-700 file:font-semibold file:px-4 file:py-2.5 file:text-xs hover:file:bg-blue-100 transition-all cursor-pointer"
          >
          <div id="status-peraturan_pelaksana_perda">
            @if($pelaksanaDoc)
              <div class="mt-2 text-xs font-semibold text-emerald-600 flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-600 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>✓ Berhasil diunggah: <strong class="font-bold text-slate-800">{{ $pelaksanaDoc->file_name }}</strong></span>
              </div>
            @endif
          </div>
        </div>
      </div>

      <!-- KOTAK 3: TOMBOL SELESAI -->
      <div class="px-5 py-4 bg-slate-50/80 border-t border-slate-200 flex items-center justify-between gap-3">
        <a
          href="{{ route('submissions.index') }}"
          class="inline-flex items-center h-10 px-4 rounded-lg bg-white text-slate-700 text-xs font-semibold ring-1 ring-slate-300 hover:bg-slate-100 transition-all"
        >
          Kembali ke Daftar
        </a>

        <button
          type="button"
          id="btn-finish-submission"
          class="inline-flex items-center gap-2 h-10 px-6 rounded-lg bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 active:scale-95 shadow-sm transition-all cursor-pointer"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
          </svg>
          Selesai &amp; Ajukan
        </button>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const submissionId = {{ $submission->id }};
      const uploadUrl = "{{ route('submissions.documents.upload', $submission) }}";
      const finishUrl = "{{ route('submissions.finish', $submission) }}";
      const uploadedDocs = {
        surat_permohonan: {{ $suratPermohonanDoc ? 'true' : 'false' }},
        peraturan_daerah: {{ $perdaDoc ? 'true' : 'false' }},
        peraturan_pelaksana_perda: {{ $pelaksanaDoc ? 'true' : 'false' }}
      };

      const infoForm = document.getElementById('submission-info-form');
      const btnSaveInfo = document.getElementById('btn-save-info');
      const btnSaveInfoText = document.getElementById('btn-save-info-text');

      const globalAlert = document.getElementById('global-alert');
      const btnFinish = document.getElementById('btn-finish-submission');
      const csrfToken = document.querySelector('input[name="_token"]')?.value || '{{ csrf_token() }}';

      function showGlobalAlert(message, type = 'success') {
        globalAlert.classList.remove('hidden', 'bg-emerald-50', 'text-emerald-800', 'ring-emerald-200', 'bg-rose-50', 'text-rose-800', 'ring-rose-200');
        if (type === 'success') {
          globalAlert.classList.add('bg-emerald-50', 'text-emerald-800', 'ring-1', 'ring-emerald-200');
        } else {
          globalAlert.classList.add('bg-rose-50', 'text-rose-800', 'ring-1', 'ring-rose-200');
        }
        globalAlert.innerHTML = message;
        globalAlert.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }

      // 1. UPDATE DATA PERMOHONAN VIA AJAX
      infoForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const formData = new FormData(infoForm);

        btnSaveInfo.disabled = true;
        btnSaveInfo.classList.add('opacity-75');
        btnSaveInfoText.textContent = 'Menyimpan...';

        try {
          const response = await fetch(infoForm.getAttribute('action'), {
            method: 'POST',
            body: formData,
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
              'Accept': 'application/json',
            }
          });

          const result = await response.json();

          if (response.ok && result.success) {
            showGlobalAlert(`✓ ${result.message}`, 'success');
          } else {
            const errMsg = result.message || Object.values(result.errors || {}).flat().join('<br>') || 'Terjadi kesalahan saat menyimpan data.';
            showGlobalAlert(`✕ ${errMsg}`, 'error');
          }
        } catch (error) {
          console.error(error);
          showGlobalAlert('✕ Terjadi gangguan jaringan saat menyimpan data permohonan.', 'error');
        } finally {
          btnSaveInfo.disabled = false;
          btnSaveInfo.classList.remove('opacity-75');
          btnSaveInfoText.textContent = 'Simpan Perubahan Data';
        }
      });

      // 2. AUTO UPLOAD DOKUMEN SAAT MEMILIH FILE
      document.querySelectorAll('#section-upload-documents input[type="file"]').forEach(fileInput => {
        fileInput.addEventListener('change', async function () {
          const file = this.files[0];
          if (!file) return;

          const docType = this.getAttribute('data-doc-type');
          const statusContainer = document.getElementById(`status-${docType}`);
          const actionContainer = document.getElementById(`container-action-${docType}`);
          const maxSize = parseInt(this.getAttribute('data-max-size') || '10485760', 10);

          // Cek ukuran file di client side (10 MB)
          if (file.size > maxSize) {
            statusContainer.innerHTML = `
              <div class="mt-2 text-xs font-semibold text-rose-600 flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <span>Ukuran file (${(file.size / 1024 / 1024).toFixed(2)} MB) melebihi batas maksimal 10 MB.</span>
              </div>
            `;
            this.value = '';
            return;
          }

          // Tampilkan loading upload
          statusContainer.innerHTML = `
            <div class="mt-2 text-xs font-semibold text-blue-600 flex items-center gap-1.5">
              <svg class="animate-spin w-4 h-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
              </svg>
              <span>Sedang mengunggah file ke server...</span>
            </div>
          `;

          const uploadFormData = new FormData();
          uploadFormData.append('_token', csrfToken);
          uploadFormData.append('document_type', docType);
          uploadFormData.append('file', file);

          try {
            const response = await fetch(uploadUrl, {
              method: 'POST',
              body: uploadFormData,
              headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
              }
            });

            const result = await response.json();

            if (response.ok && result.success) {
              uploadedDocs[docType] = true;

              // Alert sukses di bawah file input
              statusContainer.innerHTML = `
                <div class="mt-2 text-xs font-semibold text-emerald-600 flex items-center gap-1.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-600 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                  </svg>
                  <span>✓ Berhasil diunggah: <strong class="font-bold text-slate-800">${result.document.file_name}</strong></span>
                </div>
              `;

              // Tombol Lihat di ujung kanan
              actionContainer.innerHTML = `
                <a href="${result.document.preview_url}" target="_blank" class="inline-flex shrink-0 items-center gap-1 h-8 px-3 rounded-lg bg-white text-slate-700 text-xs font-semibold ring-1 ring-slate-300 hover:bg-slate-100 transition-all shadow-xs">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                  Lihat
                </a>
              `;
            } else {
              const errMsg = result.message || 'Upload dokumen gagal.';
              statusContainer.innerHTML = `
                <div class="mt-2 text-xs font-semibold text-rose-600 flex items-center gap-1.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                  </svg>
                  <span>${errMsg}</span>
                </div>
              `;
            }
          } catch (error) {
            console.error(error);
            statusContainer.innerHTML = `
              <div class="mt-2 text-xs font-semibold text-rose-600 flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <span>Terjadi gangguan jaringan saat mengunggah dokumen.</span>
              </div>
            `;
          }
        });
      });

      // 3. TOMBOL SELESAI
      btnFinish.addEventListener('click', async function () {
        if (!uploadedDocs.surat_permohonan || !uploadedDocs.peraturan_daerah) {
          alert('Harap unggah Surat Permohonan dan Peraturan Daerah terlebih dahulu sebelum menyelesaikan permohonan.');
          return;
        }

        btnFinish.disabled = true;
        btnFinish.textContent = 'Menyelesaikan...';

        try {
          const response = await fetch(finishUrl, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': csrfToken,
              'X-Requested-With': 'XMLHttpRequest',
              'Accept': 'application/json',
            }
          });

          const result = await response.json();
          if (response.ok && result.success) {
            window.location.href = result.redirect_url;
          } else {
            alert(result.message || 'Gagal menyelesaikan permohonan.');
            btnFinish.disabled = false;
            btnFinish.textContent = 'Selesai & Ajukan';
          }
        } catch (err) {
          console.error(err);
          // Fallback form post
          const form = document.createElement('form');
          form.method = 'POST';
          form.action = finishUrl;
          const csrf = document.createElement('input');
          csrf.type = 'hidden';
          csrf.name = '_token';
          csrf.value = csrfToken;
          form.appendChild(csrf);
          document.body.appendChild(form);
          form.submit();
        }
      });
    });
  </script>
@endsection
