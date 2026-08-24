@extends('layouts.app')
@section('title', 'Penugasan & Keputusan Permohonan')

@section('content')
  <div class="space-y-4 sm:space-y-5">
    <div>
      <h1 class="pasih-page-title">Penugasan / Keputusan Permohonan</h1>
      <p class="mt-1 pasih-page-breadcrumb">
        <a href="{{ route('dashboard') }}" class="hover:text-slate-700 hover:underline">Dashboard</a>
        <span class="mx-1">/</span>
        <a href="{{ route('submissions.index') }}" class="hover:text-slate-700 hover:underline">Permohonan</a>
        <span class="mx-1">/</span>
        <span>Penugasan & Keputusan</span>
      </p>
    </div>

    @if($errors->any())
      <div class="rounded-xl bg-rose-50 text-rose-700 ring-1 ring-rose-200 px-4 py-3 text-sm">
        {{ $errors->first() }}
      </div>
    @endif

    <div class="rounded-lg bg-white ring-1 ring-slate-200 overflow-hidden">
      <div class="px-4 sm:px-5 py-4 border-b border-slate-200">
        <h2 class="text-base sm:text-[18px] font-bold text-slate-800">Penetapan Penugasan Analis / Penolakan Permohonan</h2>
      </div>

      <form method="POST" action="{{ route('submissions.penugasan.save', $submission) }}" class="p-4 sm:p-5 space-y-4 sm:space-y-5" x-data="{ decision: '{{ old('decision', 'approve') }}' }">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
          <label class="block text-sm font-medium text-slate-700">
            Judul Peraturan Daerah
            <input type="text" disabled value="{{ $submission->perda_title }}" class="mt-2 w-full h-11 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm bg-slate-100 text-slate-600">
          </label>
          <label class="block text-sm font-medium text-slate-700">
            Nomor Surat
            <input type="text" disabled value="{{ $submission->nomor_surat }}" class="mt-2 w-full h-11 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm bg-slate-100 text-slate-600">
          </label>
          <label class="block text-sm font-medium text-slate-700">
            Tanggal Pengajuan
            <input type="text" disabled value="{{ optional($submission->submitted_at)->format('d - m - Y') ?: '-' }}" class="mt-2 w-full h-11 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm bg-slate-100 text-slate-600">
          </label>
          <label class="block text-sm font-medium text-slate-700">
            Instansi Pengaju
            <input type="text" disabled value="{{ $submission->submitter?->instansi?->nama_instansi ?? '-' }}" class="mt-2 w-full h-11 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm bg-slate-100 text-slate-600">
          </label>
        </div>

        <div>
          <label class="block text-sm font-medium text-slate-700 mb-2">
            Keputusan <span class="text-red-500">*</span>
          </label>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <label class="flex items-center gap-3 p-3 rounded-lg border border-slate-300 cursor-pointer hover:bg-slate-50" :class="{ 'border-emerald-600 bg-emerald-50/50': decision === 'approve' }">
              <input type="radio" name="decision" value="approve" x-model="decision" class="h-4 w-4 text-emerald-600 focus:ring-emerald-500">
              <div>
                <div class="text-sm font-semibold text-slate-800">Setujui & Lanjutkan Penugasan</div>
                <div class="text-xs text-slate-500">Permohonan disetujui dan diteruskan ke Ketua Tim untuk penunjukan PIC Analis.</div>
              </div>
            </label>
            <label class="flex items-center gap-3 p-3 rounded-lg border border-slate-300 cursor-pointer hover:bg-slate-50" :class="{ 'border-rose-600 bg-rose-50/50': decision === 'reject' }">
              <input type="radio" name="decision" value="reject" x-model="decision" class="h-4 w-4 text-rose-600 focus:ring-rose-500">
              <div>
                <div class="text-sm font-semibold text-slate-800">Tolak Permohonan</div>
                <div class="text-xs text-slate-500">Ditolak & dikembalikan ke Pemda (masuk ke Ketua Tim untuk upload Surat Balasan).</div>
              </div>
            </label>
          </div>
        </div>

        <div x-show="decision === 'approve'">
          <label class="block text-sm font-medium text-slate-700">
            Catatan Penugasan <span class="text-red-500">*</span>
            <textarea name="instruction" rows="4" placeholder="Masukkan Catatan Untuk Penugasan" class="mt-2 w-full px-4 py-3 rounded-md border border-[#B9B9B9] text-sm">{{ old('instruction') }}</textarea>
          </label>
        </div>

        <div x-show="decision === 'reject'" x-cloak>
          <label class="block text-sm font-medium text-slate-700">
            Alasan Penolakan <span class="text-red-500">*</span>
            <textarea name="rejection_note" rows="4" placeholder="Masukkan alasan penolakan permohonan" class="mt-2 w-full px-4 py-3 rounded-md border border-[#B9B9B9] text-sm">{{ old('rejection_note') }}</textarea>
          </label>
        </div>

        <div class="flex gap-3">
          <button type="submit" class="inline-flex w-full sm:w-auto justify-center items-center gap-2 h-10 px-4 rounded-md bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 4v12m0 0l-4-4m4 4l4-4" />
            </svg>
            Simpan Keputusan
          </button>
          <a href="{{ route('submissions.index') }}" class="inline-flex items-center justify-center h-10 px-4 rounded-md border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50">
            Batal
          </a>
        </div>
      </form>
    </div>
  </div>
@endsection
