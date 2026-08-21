@extends('layouts.app')
@section('title', 'Edit Foto Banner Beranda')

@section('content')
  <div class="space-y-5">
    @if($errors->any())
      <div class="rounded-xl bg-rose-50 text-rose-700 ring-1 ring-rose-200 px-4 py-3 text-sm">
        {{ $errors->first() }}
      </div>
    @endif

    <div class="flex items-start justify-between gap-4">
      <div>
        <h1 class="pasih-page-title">Edit Foto Banner Beranda</h1>
        <p class="mt-2 pasih-page-breadcrumb">
          <a href="{{ route('dashboard') }}" class="hover:text-slate-700 hover:underline">Dashboard</a>
          <span class="mx-1">/</span>
          <a href="{{ route('admin.banners.index') }}" class="hover:text-slate-700 hover:underline">Galeri Beranda</a>
          <span class="mx-1">/</span>
          <span>Edit Foto</span>
        </p>
      </div>
    </div>

    <div class="rounded-xl bg-white ring-1 ring-slate-200 overflow-hidden shadow-xs">
      <div class="px-4 py-3 border-b border-slate-200 flex items-center justify-between">
        <h2 class="text-[18px] font-bold text-slate-800">Ubah Data Foto Banner</h2>
        <a href="{{ route('home') }}" target="_blank" class="text-xs text-blue-900 font-semibold hover:underline">
          Lihat Landing Page &rarr;
        </a>
      </div>

      <form method="POST" action="{{ route('admin.banners.update', $banner) }}" enctype="multipart/form-data" class="p-6 space-y-5">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <!-- Upload Foto Kegiatan -->
          <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-slate-700">
              Foto Banner Kegiatan
            </label>
            <p class="mt-1 text-xs text-slate-500">
              Biarkan kosong jika tidak ingin mengganti foto banner yang sudah ada.
            </p>

            @if($banner->image_url)
              <div class="my-3 flex items-center gap-4 p-3.5 bg-slate-50 rounded-xl border border-slate-200">
                <img src="{{ $banner->image_url }}" alt="Foto Saat Ini" class="w-32 h-20 object-cover rounded-lg border border-slate-200 shadow-xs">
                <div>
                  <p class="text-xs font-semibold text-slate-700">Foto Banner Saat Ini</p>
                  <p class="text-[11px] text-slate-500 font-mono truncate max-w-xs mt-0.5">{{ $banner->image_path }}</p>
                  <span class="inline-flex items-center px-2 py-0.5 mt-1.5 rounded-md text-[10px] font-bold bg-slate-200 text-slate-700">Slide #{{ $banner->order }}</span>
                </div>
              </div>
            @endif

            <input
              type="file"
              name="image"
              id="banner-image-input-edit"
              accept=".jpg,.jpeg,.png,.webp"
              class="mt-2 block w-full rounded-md border border-[#B9B9B9] bg-white text-sm text-slate-700 file:mr-3 file:rounded-l-md file:border-0 file:bg-slate-100 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-slate-200 cursor-pointer"
            >
            <div id="image-preview-container-edit" class="mt-3 hidden">
              <p class="text-xs font-semibold text-slate-600 mb-1">Pratinjau Foto Pengganti Baru:</p>
              <img id="image-preview-edit" src="#" alt="Preview Pengganti" class="max-h-56 rounded-xl object-cover border border-slate-200 shadow-xs">
            </div>
            @error('image')
              <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Judul / Keterangan Kegiatan -->
          <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-slate-700">
              Judul / Keterangan Foto Kegiatan
            </label>
            <input
              type="text"
              name="title"
              value="{{ old('title', $banner->title) }}"
              placeholder="Contoh: Dokumentasi Harmonisasi..."
              class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm placeholder:text-slate-400 focus:border-blue-900 focus:ring-1 focus:ring-blue-900"
            >
            @error('title')
              <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Urutan Tampilan Slide -->
          <div>
            <label class="block text-sm font-semibold text-slate-700">
              Nomor Urutan Slide <span class="text-rose-500">*</span>
            </label>
            <input
              type="number"
              name="order"
              min="0"
              value="{{ old('order', $banner->order) }}"
              required
              class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm focus:border-blue-900 focus:ring-1 focus:ring-blue-900"
            >
            @error('order')
              <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Status Aktif -->
          <div>
            <label class="block text-sm font-semibold text-slate-700">
              Status Tampilan <span class="text-rose-500">*</span>
            </label>
            <select
              name="is_active"
              required
              class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm bg-white focus:border-blue-900 focus:ring-1 focus:ring-blue-900"
            >
              <option value="1" @selected(old('is_active', (string)(int)$banner->is_active) === '1')>Aktif (Tampilkan di Beranda)</option>
              <option value="0" @selected(old('is_active', (string)(int)$banner->is_active) === '0')>Nonaktif (Sembunyikan Sementara)</option>
            </select>
            @error('is_active')
              <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Deskripsi Tambahan -->
          <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-slate-700">
              Deskripsi / Catatan Tambahan
            </label>
            <textarea
              name="description"
              rows="3"
              class="mt-2 w-full px-4 py-2 rounded-md border border-[#B9B9B9] text-sm focus:border-blue-900 focus:ring-1 focus:ring-blue-900"
            >{{ old('description', $banner->description) }}</textarea>
            @error('description')
              <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="pt-4 border-t border-slate-200 flex items-center gap-3">
          <button type="submit" class="inline-flex items-center gap-2 h-10 px-5 rounded-md bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 shadow-sm transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            Perbarui Foto Banner
          </button>
          <a href="{{ route('admin.banners.index') }}" class="inline-flex items-center justify-center h-10 px-4 rounded-md border border-slate-300 text-slate-700 text-sm font-semibold hover:bg-slate-50 transition">
            Batal
          </a>
        </div>
      </form>
    </div>
  </div>

  <script>
    const imageInput = document.getElementById('banner-image-input-edit');
    const previewContainer = document.getElementById('image-preview-container-edit');
    const previewImg = document.getElementById('image-preview-edit');

    imageInput?.addEventListener('change', function () {
      const file = this.files?.[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          previewImg.src = e.target.result;
          previewContainer.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
      } else {
        previewContainer.classList.add('hidden');
        previewImg.src = '#';
      }
    });
  </script>
@endsection
