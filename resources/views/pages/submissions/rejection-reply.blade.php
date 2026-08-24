@extends('layouts.app')
@section('title', 'Unggah Surat Balasan Penolakan')

@section('content')
  <div class="space-y-5">
    <div>
      <h1 class="pasih-page-title">Unggah Surat Balasan Penolakan</h1>
      <p class="mt-1 pasih-page-breadcrumb">
        <a href="{{ route('dashboard') }}" class="hover:text-slate-700 hover:underline">Dashboard</a>
        <span class="mx-1">/</span>
        <a href="{{ route('submissions.index') }}" class="hover:text-slate-700 hover:underline">Permohonan</a>
        <span class="mx-1">/</span>
        <span>Surat Balasan Penolakan</span>
      </p>
    </div>

    <div class="rounded-xl bg-white ring-1 ring-slate-200 overflow-hidden">
      <div class="px-4 py-3 border-b border-slate-200">
        <h2 class="text-[18px] font-bold text-slate-800">Unggah Surat Balasan Penolakan ke Pemda</h2>
      </div>
      <form method="POST" action="{{ route('submissions.rejection-reply.store', $submission) }}" enctype="multipart/form-data" class="p-5 space-y-5">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <label class="block text-sm font-medium text-slate-700">
            Judul Peraturan Daerah
            <input type="text" disabled value="{{ $submission->perda_title ?: '-' }}" class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] bg-slate-100 text-sm text-slate-500">
          </label>
          <label class="block text-sm font-medium text-slate-700">
            Instansi Pengaju
            <input type="text" disabled value="{{ $submission->submitter?->instansi?->nama_instansi ?? $submission->submitter?->name ?? '-' }}" class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] bg-slate-100 text-sm text-slate-500">
          </label>
        </div>

        @if($submission->latestStatus?->note)
          <div class="p-4 rounded-lg bg-amber-50 border border-amber-200 text-amber-900 text-sm">
            <strong>Catatan Penolakan dari Operator Kanwil:</strong>
            <p class="mt-1 text-slate-700">{{ $submission->latestStatus->note }}</p>
          </div>
        @endif

        <label class="block text-sm font-medium text-slate-700">
          Upload Surat Balasan Penolakan <span class="text-red-500">*</span>
          <p class="mt-1 text-xs text-slate-500">Format: PDF/DOC/DOCX, maksimal 5 MB.</p>
          <input
            type="file"
            name="surat_balasan_penolakan"
            required
            accept=".pdf,.doc,.docx"
            class="mt-2 block w-full rounded-xl border border-[#B9B9B9] bg-white text-sm text-slate-700 file:mr-3 file:rounded-l-xl file:border-0 file:bg-slate-100 file:px-4 file:py-3 file:text-base file:text-slate-700">
          @error('surat_balasan_penolakan')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </label>

        <div class="pt-1 flex gap-3">
          <button type="submit" class="inline-flex items-center gap-2 h-10 px-4 rounded-md bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 4v12m0 0l-4-4m4 4l4-4" />
            </svg>
            Kirim Surat Balasan
          </button>
          <a href="{{ route('submissions.index') }}" class="inline-flex items-center h-10 px-4 rounded-md border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50">
            Batal
          </a>
        </div>
      </form>
    </div>
  </div>
@endsection
