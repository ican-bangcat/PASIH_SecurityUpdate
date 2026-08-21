@extends('layouts.app')
@section('title', 'Manajemen Galeri Beranda')

@section('content')
  <div class="space-y-5">
    @if(session('success'))
      <div class="rounded-xl bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200 px-4 py-3 text-sm flex items-center justify-between">
        <div class="flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600 shrink-0" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
          </svg>
          <span>{{ session('success') }}</span>
        </div>
      </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
      <div>
        <h1 class="pasih-page-title">Galeri &amp; Banner Beranda</h1>
        <p class="mt-2 pasih-page-breadcrumb">
          <a href="{{ route('dashboard') }}" class="hover:text-slate-700 hover:underline">Dashboard</a>
          <span class="mx-1">/</span>
          <span>Galeri Beranda</span>
        </p>
      </div>

      <div class="flex items-center gap-3">
        <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1.5 h-10 px-3.5 rounded-xl border border-slate-300 text-slate-700 text-sm font-semibold hover:bg-slate-50 transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
          Lihat di Landing Page
        </a>
        <a href="{{ route('admin.banners.create') }}" class="inline-flex items-center justify-center gap-2 h-10 px-4 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 shadow-sm transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
          </svg>
          Tambah Foto Kegiatan
        </a>
      </div>
    </div>

    <!-- Table Container -->
    <div class="rounded-xl bg-white ring-1 ring-slate-200 overflow-hidden shadow-xs">
      <div class="p-4 border-b border-slate-200 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.banners.index') }}" class="flex items-center gap-2 text-sm text-slate-600">
          <span>Tampilkan</span>
          <select name="per_page" onchange="this.form.submit()" class="h-9 px-2.5 rounded-md border border-[#B9B9B9] text-sm bg-white focus:border-blue-900 focus:ring-1 focus:ring-blue-900">
            <option value="10" @selected($perPage === 10)>10</option>
            <option value="25" @selected($perPage === 25)>25</option>
            <option value="50" @selected($perPage === 50)>50</option>
          </select>
          <span>entri</span>
          @if($search)
            <input type="hidden" name="q" value="{{ $search }}">
          @endif
        </form>

        <form method="GET" action="{{ route('admin.banners.index') }}" class="flex items-center gap-2 max-w-sm w-full">
          <div class="relative w-full">
            <input
              type="text"
              name="q"
              value="{{ $search }}"
              placeholder="Cari foto banner kegiatan..."
              class="w-full h-9 pl-9 pr-3 rounded-md border border-[#B9B9B9] text-sm placeholder:text-slate-400 focus:border-blue-900 focus:ring-1 focus:ring-blue-900"
            >
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </div>
          </div>
          @if($search)
            <a href="{{ route('admin.banners.index') }}" class="text-xs text-slate-500 hover:text-slate-700">Reset</a>
          @endif
        </form>
      </div>

      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
          <thead class="bg-slate-50 text-slate-700 font-semibold">
            <tr>
              <th class="px-4 py-3 text-center w-12">No</th>
              <th class="px-4 py-3 text-center w-36">Foto Slider</th>
              <th class="px-4 py-3 text-left">Judul / Keterangan Kegiatan</th>
              <th class="px-4 py-3 text-center w-24">Urutan</th>
              <th class="px-4 py-3 text-center w-32">Status</th>
              <th class="px-4 py-3 text-center w-28">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-200 bg-white">
            @forelse($banners as $banner)
              @php
                $rowNumber = ($banners->firstItem() ?? 1) + $loop->index;
              @endphp
              <tr class="hover:bg-slate-50/70 transition-colors text-slate-700">
                <td class="px-4 py-3.5 text-center font-medium">{{ $rowNumber }}</td>
                <td class="px-4 py-3.5 text-center">
                  @if($banner->image_url)
                    <img src="{{ $banner->image_url }}" alt="{{ $banner->title ?? 'Banner' }}" class="w-24 h-16 object-cover rounded-lg mx-auto shadow-xs border border-slate-200 hover:scale-105 transition-transform duration-200">
                  @else
                    <div class="w-24 h-16 bg-slate-100 rounded-lg mx-auto flex items-center justify-center text-slate-400 border border-dashed border-slate-300">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                  @endif
                </td>
                <td class="px-4 py-3.5">
                  <div class="font-semibold text-slate-900 line-clamp-1">
                    {{ $banner->title ?: 'Foto Kegiatan #' . $banner->order }}
                  </div>
                  @if($banner->description)
                    <div class="text-xs text-slate-500 line-clamp-1 mt-0.5">{{ $banner->description }}</div>
                  @endif
                  <div class="text-[11px] font-mono text-slate-400 truncate max-w-xs mt-1">{{ $banner->image_path }}</div>
                </td>
                <td class="px-4 py-3.5 text-center whitespace-nowrap">
                  <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                    Slide #{{ $banner->order }}
                  </span>
                </td>
                <td class="px-4 py-3.5 text-center whitespace-nowrap">
                  <form method="POST" action="{{ route('admin.banners.toggle-status', $banner) }}" class="inline-block">
                    @csrf
                    @method('PATCH')
                    <button
                      type="submit"
                      title="Klik untuk mengubah status aktif"
                      class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold transition cursor-pointer {{ $banner->is_active ? 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/20 hover:bg-emerald-100' : 'bg-slate-100 text-slate-500 ring-1 ring-slate-300 hover:bg-slate-200' }}"
                    >
                      <span class="w-1.5 h-1.5 rounded-full {{ $banner->is_active ? 'bg-emerald-600' : 'bg-slate-400' }}"></span>
                      {{ $banner->is_active ? 'Aktif' : 'Nonaktif' }}
                    </button>
                  </form>
                </td>
                <td class="px-4 py-3.5 text-center whitespace-nowrap">
                  <div class="inline-flex items-center gap-1.5">
                    <a href="{{ route('admin.banners.edit', $banner) }}" title="Edit Foto Banner" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-amber-400 text-white hover:bg-amber-500 transition shadow-xs">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z" />
                      </svg>
                    </a>
                    <form method="POST" action="{{ route('admin.banners.destroy', $banner) }}" data-confirm-type="delete" data-confirm-message="Apakah Anda yakin ingin menghapus foto banner kegiatan ini?">
                      @csrf
                      @method('DELETE')
                      <button type="submit" title="Hapus Foto Banner" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-rose-500 text-white hover:bg-rose-600 transition shadow-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="px-4 py-12 text-center text-slate-500">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-slate-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                  <p class="font-semibold text-slate-600">Belum ada foto banner kegiatan yang ditambahkan.</p>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="px-4 py-3 border-t border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs text-slate-600">
        <div>
          Menampilkan {{ $banners->firstItem() ?? 0 }} sampai {{ $banners->lastItem() ?? 0 }} dari {{ $banners->total() }} entri
        </div>
        <div>
          {{ $banners->links('vendor.pagination.pasih') }}
        </div>
      </div>
    </div>
  </div>
@endsection
