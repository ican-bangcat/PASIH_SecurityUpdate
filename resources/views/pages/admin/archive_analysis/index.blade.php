@extends('layouts.app')
@section('title', 'Arsip Data Lama Hasil Analisis')

@section('content')
  <div class="space-y-5">
    @if(session('success'))
      <div class="rounded-xl bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200 px-4 py-3 text-sm flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600 shrink-0" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    @if($errors->any())
      <div class="rounded-xl bg-rose-50 text-rose-700 ring-1 ring-rose-200 px-4 py-3 text-sm">
        {{ $errors->first() }}
      </div>
    @endif

    <div class="flex items-start justify-between gap-4">
      <div>
        <h1 class="pasih-page-title">Arsip Data Lama Hasil Analisis</h1>
        <p class="mt-2 pasih-page-breadcrumb">
          <a href="{{ route('dashboard') }}" class="hover:text-slate-700 hover:underline">Dashboard</a>
          <span class="mx-1">/</span>
          <span>Arsip Data Lama</span>
        </p>
      </div>

      <a href="{{ route('admin.archive-analysis.create') }}" class="pasih-add-btn inline-flex items-center gap-2 h-11 px-4 rounded-xl bg-blue-950 text-white text-sm font-semibold hover:bg-blue-900 shadow-sm transition-all">
        <span class="text-base font-bold">+</span> Tambah Data Lama
      </a>
    </div>

    <div class="rounded-xl bg-white ring-1 ring-slate-200 overflow-hidden shadow-xs">
      <div class="px-4 py-3 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <form method="GET" action="{{ route('admin.archive-analysis.index') }}" class="flex items-center gap-2 text-sm text-slate-700">
          <span>Tampil</span>
          <select name="per_page" class="h-8 rounded-md border-slate-300 text-sm focus:outline-none focus:ring-0 focus:border-slate-300" onchange="this.form.submit()">
            <option value="5" @selected($perPage === 5)>5</option>
            <option value="10" @selected($perPage === 10)>10</option>
            <option value="25" @selected($perPage === 25)>25</option>
          </select>
          <span>Data</span>
          <input type="hidden" name="q" value="{{ $search }}">
        </form>

        <form method="GET" action="{{ route('admin.archive-analysis.index') }}" class="flex items-center gap-2 text-sm text-slate-700">
          <label for="q">Cari:</label>
          <input id="q" type="text" name="q" value="{{ $search }}" placeholder="Cari Perda / Instansi..." class="h-8 w-48 px-3 rounded-md border border-[#B9B9B9] text-sm">
          <input type="hidden" name="per_page" value="{{ $perPage }}">
        </form>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-sm">
          <thead class="bg-slate-50 text-slate-600 font-semibold border-b border-slate-200">
            <tr>
              <th class="px-4 py-3 text-center w-12">No</th>
              <th class="px-4 py-3 text-left">Judul Peraturan Daerah</th>
              <th class="px-4 py-3 text-left">Instansi Pengaju</th>
              <th class="px-4 py-3 text-center">Tahun Selesai</th>
              <th class="px-4 py-3 text-center">Status Publik</th>
              <th class="px-4 py-3 text-center w-28">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            @forelse($archives as $assignment)
              @php
                $rowNumber = ($archives->firstItem() ?? 1) + $loop->index;
                $submission = $assignment->submission;
              @endphp
              <tr class="hover:bg-slate-50/70 transition-colors text-slate-700">
                <td class="px-4 py-3.5 text-center font-medium">{{ $rowNumber }}</td>
                <td class="px-4 py-3.5">
                  <div class="font-semibold text-slate-900 line-clamp-2">
                    {{ $submission?->perda_title ?: '-' }}
                  </div>
                  <div class="text-xs text-slate-500 mt-0.5">Nomor: {{ $submission?->nomor_surat ?: '-' }}</div>
                </td>
                <td class="px-4 py-3.5 text-slate-700 font-medium">
                  {{ $submission?->submitter?->instansi?->nama_instansi ?? $submission?->pemda_name ?? '-' }}
                </td>
                <td class="px-4 py-3.5 text-center whitespace-nowrap font-medium text-slate-700">
                  {{ optional($assignment->completed_at)->format('Y') ?: '-' }}
                </td>
                <td class="px-4 py-3.5 text-center whitespace-nowrap">
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/20">
                    Terbit di Publik
                  </span>
                </td>
                <td class="px-4 py-3.5 text-center whitespace-nowrap">
                  <div class="flex items-center justify-center gap-1.5">
                    <a href="{{ route('public.analysis.show', $assignment) }}" target="_blank" class="h-8 w-8 rounded-md bg-blue-600 text-white inline-flex items-center justify-center hover:bg-blue-700 transition" title="Lihat di Publik">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /><circle cx="12" cy="12" r="3" /></svg>
                    </a>
                    <form method="POST" action="{{ route('admin.archive-analysis.destroy', $assignment) }}" data-confirm-type="delete" data-confirm-message="Apakah Anda yakin ingin menghapus arsip data lama ini?">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="h-8 w-8 rounded-md bg-rose-600 text-white inline-flex items-center justify-center hover:bg-rose-700 transition" title="Hapus">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-1 12a2 2 0 01-2 2H8a2 2 0 01-2-2L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" /></svg>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="px-4 py-8 text-center text-slate-500">
                  <div class="flex flex-col items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-slate-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
                    <span>Belum ada arsip data lama yang diunggah.</span>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="px-4 py-3 border-t border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-sm text-slate-600">
        <div>
          Menampilkan {{ $archives->firstItem() ?? 0 }} - {{ $archives->lastItem() ?? 0 }} dari {{ $archives->total() }} data
        </div>
        <div>
          {{ $archives->onEachSide(1)->links('vendor.pagination.pasih') }}
        </div>
      </div>
    </div>
  </div>
@endsection
