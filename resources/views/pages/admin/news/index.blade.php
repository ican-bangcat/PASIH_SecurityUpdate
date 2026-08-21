@extends('layouts.app')
@section('title', 'Manajemen Berita')

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
        <h1 class="pasih-page-title">Manajemen Berita</h1>
        <p class="mt-2 pasih-page-breadcrumb">
          <a href="{{ route('dashboard') }}" class="hover:text-slate-700 hover:underline">Dashboard</a>
          <span class="mx-1">/</span>
          <span>Manajemen Berita</span>
        </p>
      </div>

      <a href="{{ route('admin.news.create') }}" class="pasih-add-btn inline-flex items-center gap-2 h-11 px-4 rounded-xl bg-blue-950 text-white text-sm font-semibold hover:bg-blue-900 shadow-sm transition-all">
        <span class="text-base font-bold">+</span> Tambah Berita
      </a>
    </div>

    <div class="rounded-xl bg-white ring-1 ring-slate-200 overflow-hidden shadow-xs">
      <div class="px-4 py-3 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <form method="GET" action="{{ route('admin.news.index') }}" class="flex items-center gap-2 text-sm text-slate-700">
          <span>Tampil</span>
          <select name="per_page" class="h-8 rounded-md border-slate-300 text-sm focus:outline-none focus:ring-0 focus:border-slate-300" onchange="this.form.submit()">
            <option value="5" @selected($perPage === 5)>5</option>
            <option value="10" @selected($perPage === 10)>10</option>
            <option value="25" @selected($perPage === 25)>25</option>
          </select>
          <span>Data</span>
          <input type="hidden" name="q" value="{{ $search }}">
        </form>

        <form method="GET" action="{{ route('admin.news.index') }}" class="flex items-center gap-2 text-sm text-slate-700">
          <label for="q">Cari:</label>
          <input id="q" type="text" name="q" value="{{ $search }}" placeholder="Cari judul / isi..." class="h-8 w-48 px-3 rounded-md border border-[#B9B9B9] text-sm">
          <input type="hidden" name="per_page" value="{{ $perPage }}">
        </form>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-sm">
          <thead class="bg-slate-50 text-slate-600 font-semibold border-b border-slate-200">
            <tr>
              <th class="px-4 py-3 text-center w-12">No</th>
              <th class="px-4 py-3 text-center w-24">Sampul</th>
              <th class="px-4 py-3 text-left">Judul Berita</th>
              <th class="px-4 py-3 text-left">Penulis</th>
              <th class="px-4 py-3 text-center">Status</th>
              <th class="px-4 py-3 text-left">Tanggal Publikasi</th>
              <th class="px-4 py-3 text-center w-28">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            @forelse($newsList as $news)
              @php
                $rowNumber = ($newsList->firstItem() ?? 1) + $loop->index;
              @endphp
              <tr class="hover:bg-slate-50/70 transition-colors text-slate-700">
                <td class="px-4 py-3.5 text-center font-medium">{{ $rowNumber }}</td>
                <td class="px-4 py-3.5 text-center">
                  @if($news->image_url)
                    <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-14 h-10 object-cover rounded-md mx-auto shadow-xs border border-slate-200">
                  @else
                    <div class="w-14 h-10 bg-slate-100 rounded-md mx-auto flex items-center justify-center text-slate-400 border border-dashed border-slate-300">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                  @endif
                </td>
                <td class="px-4 py-3.5">
                  <div class="font-semibold text-slate-900 line-clamp-1 hover:text-blue-900">
                    <a href="{{ route('admin.news.show', $news) }}">{{ $news->title }}</a>
                  </div>
                  <div class="text-xs text-slate-500 line-clamp-1 mt-0.5">{{ $news->excerpt }}</div>
                </td>
                <td class="px-4 py-3.5 whitespace-nowrap text-slate-600 font-medium">{{ $news->author_display_name }}</td>
                <td class="px-4 py-3.5 text-center whitespace-nowrap">
                  @if($news->status === 'published')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/20">
                      Publikasi
                    </span>
                  @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 ring-1 ring-amber-600/20">
                      Draft
                    </span>
                  @endif
                </td>
                <td class="px-4 py-3.5 whitespace-nowrap text-slate-600">
                  {{ optional($news->published_at)->format('d-m-Y H:i') ?: '-' }}
                </td>
                <td class="px-4 py-3.5 text-center whitespace-nowrap">
                  <div class="flex items-center justify-center gap-1.5">
                    <a href="{{ route('admin.news.show', $news) }}" class="h-8 w-8 rounded-md bg-blue-600 text-white inline-flex items-center justify-center hover:bg-blue-700 transition" title="Detail">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /><circle cx="12" cy="12" r="3" /></svg>
                    </a>
                    <a href="{{ route('admin.news.edit', $news) }}" class="h-8 w-8 rounded-md bg-amber-400 text-white inline-flex items-center justify-center hover:bg-amber-500 transition" title="Edit">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z" /></svg>
                    </a>
                    <form method="POST" action="{{ route('admin.news.destroy', $news) }}" data-confirm-type="delete" data-confirm-message="Apakah Anda yakin ingin menghapus berita ini?">
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
                <td colspan="7" class="px-4 py-8 text-center text-slate-500">
                  <div class="flex flex-col items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-slate-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <span>Belum ada data berita.</span>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="px-4 py-3 border-t border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-sm text-slate-600">
        <div>
          Menampilkan {{ $newsList->firstItem() ?? 0 }} - {{ $newsList->lastItem() ?? 0 }} dari {{ $newsList->total() }} data
        </div>
        <div>
          {{ $newsList->onEachSide(1)->links('vendor.pagination.pasih') }}
        </div>
      </div>
    </div>
  </div>
@endsection
