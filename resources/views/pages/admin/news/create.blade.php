@extends('layouts.app')
@section('title', 'Tambah Berita')

@section('content')
  <!-- MDTimePicker CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@dmuy/timepicker@2.0.2/dist/mdtimepicker.min.css">

  <div class="space-y-5">
    @if($errors->any())
      <div class="rounded-xl bg-rose-50 text-rose-700 ring-1 ring-rose-200 px-4 py-3 text-sm">
        {{ $errors->first() }}
      </div>
    @endif

    <div class="flex items-start justify-between gap-4">
      <div>
        <h1 class="pasih-page-title">Tambah Berita</h1>
        <p class="mt-2 pasih-page-breadcrumb">
          <a href="{{ route('dashboard') }}" class="hover:text-slate-700 hover:underline">Dashboard</a>
          <span class="mx-1">/</span>
          <a href="{{ route('admin.news.index') }}" class="hover:text-slate-700 hover:underline">Manajemen Berita</a>
          <span class="mx-1">/</span>
          <span>Tambah Berita</span>
        </p>
      </div>
    </div>

    <div class="rounded-xl bg-white ring-1 ring-slate-200 overflow-hidden shadow-xs">
      <div class="px-4 py-3 border-b border-slate-200">
        <h2 class="text-[18px] font-bold text-slate-800">Formulir Tambah Berita</h2>
      </div>

      <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data" class="p-6 space-y-5">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <!-- Judul Berita -->
          <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-slate-700">
              Judul Berita <span class="text-rose-500">*</span>
            </label>
            <input
              type="text"
              name="title"
              value="{{ old('title') }}"
              required
              placeholder="Contoh: Kanwil Kemenkumham Riau Gelar Rapat Pengharmonisasian..."
              class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm placeholder:text-slate-400 focus:border-blue-900 focus:ring-1 focus:ring-blue-900"
            >
            @error('title')
              <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Nama Penulis / Kontributor -->
          <div>
            <label class="block text-sm font-semibold text-slate-700">
              Nama Penulis / Kontributor
            </label>
            <input
              type="text"
              name="author_name"
              value="{{ old('author_name', auth()->user()?->name ?? 'Humas Kanwil Kemenkumham Riau') }}"
              placeholder="Contoh: Humas Kanwil Kemenkumham Riau"
              class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm placeholder:text-slate-400 focus:border-blue-900 focus:ring-1 focus:ring-blue-900"
            >
            <p class="mt-1 text-xs text-slate-500">Nama yang ditampilkan sebagai penulis berita.</p>
            @error('author_name')
              <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Status -->
          <div>
            <label class="block text-sm font-semibold text-slate-700">
              Status Berita <span class="text-rose-500">*</span>
            </label>
            <select
              name="status"
              required
              class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm bg-white focus:border-blue-900 focus:ring-1 focus:ring-blue-900"
            >
              <option value="published" @selected(old('status', 'published') === 'published')>Langsung Publikasikan</option>
              <option value="draft" @selected(old('status') === 'draft')>Simpan Sebagai Draft</option>
            </select>
            @error('status')
              <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Tanggal & Jam Publikasi (Format 24 Jam Indonesia) -->
          <div>
            <label class="block text-sm font-semibold text-slate-700">
              Tanggal Publikasi
            </label>
            <input
              type="date"
              id="published_date"
              name="published_date"
              value="{{ old('published_date', now()->format('Y-m-d')) }}"
              class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm focus:border-blue-900 focus:ring-1 focus:ring-blue-900 bg-white"
            >
            @error('published_date')
              <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label class="block text-sm font-semibold text-slate-700">
              Jam Publikasi
            </label>
            <div class="relative mt-2">
              <input
                type="text"
                id="published_time"
                name="published_time"
                value="{{ old('published_time', now()->format('H:i')) }}"
                readonly
                placeholder="Pilih Jam (Contoh: 14:30)..."
                class="w-full h-10 pl-4 pr-10 py-2 rounded-md border border-[#B9B9B9] text-sm font-semibold text-slate-800 focus:border-blue-900 focus:ring-1 focus:ring-blue-900 bg-white cursor-pointer shadow-xs"
              >
              <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-blue-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
            </div>
            @error('published_time')
              <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Gambar Sampul -->
          <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-slate-700">
              Gambar Sampul / Cover Image
            </label>
            <p class="mt-1 text-xs text-slate-500">
              Format: JPG, JPEG, PNG, atau WEBP. Maksimal ukuran file 5 MB (Rekomendasi rasio 16:9 atau 4:3).
            </p>
            <input
              type="file"
              name="image"
              id="news-image-input"
              accept=".jpg,.jpeg,.png,.webp"
              class="mt-2 block w-full rounded-md border border-[#B9B9B9] bg-white text-sm text-slate-700 file:mr-3 file:rounded-l-md file:border-0 file:bg-slate-100 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-slate-200 cursor-pointer"
            >
            <div id="image-preview-container" class="mt-3 hidden">
              <p class="text-xs font-semibold text-slate-600 mb-1">Pratinjau Gambar:</p>
              <img id="image-preview" src="#" alt="Preview Gambar" class="max-h-48 rounded-lg object-cover border border-slate-200 shadow-xs">
            </div>
            @error('image')
              <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Ringkasan / Excerpt -->
          <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-slate-700">
              Ringkasan Berita (Opsional)
            </label>
            <p class="mt-1 text-xs text-slate-500">
              Teks singkat yang akan tampil di kartu berita landing page. Jika dikosongkan, akan otomatis diambil dari paragraf awal konten.
            </p>
            <textarea
              name="excerpt"
              rows="2"
              placeholder="Tuliskan ringkasan singkat artikel..."
              class="mt-2 w-full px-4 py-2 rounded-md border border-[#B9B9B9] text-sm placeholder:text-slate-400 focus:border-blue-900 focus:ring-1 focus:ring-blue-900"
            >{{ old('excerpt') }}</textarea>
            @error('excerpt')
              <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Isi Konten Berita dengan CKEditor 5 -->
          <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-slate-700 mb-2">
              Isi Konten Berita <span class="text-rose-500">*</span>
            </label>
            <div class="ckeditor-wrapper">
              <textarea
                name="content"
                id="editor"
                placeholder="Tuliskan isi berita lengkap di sini..."
              >{{ old('content') }}</textarea>
            </div>
            @error('content')
              <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="pt-4 border-t border-slate-200 flex items-center gap-3">
          <button type="submit" class="inline-flex items-center gap-2 h-10 px-5 rounded-md bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 shadow-sm transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 4v12m0 0l-4-4m4 4l4-4" />
            </svg>
            Simpan Berita
          </button>
          <a href="{{ route('admin.news.index') }}" class="inline-flex items-center justify-center h-10 px-4 rounded-md border border-slate-300 text-slate-700 text-sm font-semibold hover:bg-slate-50 transition">
            Batal
          </a>
        </div>
      </form>
    </div>
  </div>

  <style>
    /* CKEditor Custom Styling */
    .ck-editor__editable_inline {
      min-height: 280px;
      font-size: 14px;
      line-height: 1.6;
    }
    .ck.ck-editor {
      width: 100% !important;
    }

    /* Polished Material Clock Picker Styling */
    .mdtp__wrapper {
      border-radius: 1.25rem !important;
      overflow: hidden !important;
      box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.35) !important;
      font-family: inherit !important;
    }
    .mdtp__wrapper.blue .mdtp__time_holder {
      background-color: #1e3a8a !important; /* PASIH Dark Blue */
      padding: 1.25rem 1rem !important;
    }
    .mdtp__time_holder .mdtp__time {
      font-size: 2.75rem !important;
      font-weight: 800 !important;
      letter-spacing: -0.025em !important;
    }
    .mdtp__clock_holder {
      padding: 1.25rem 1rem 0.75rem !important;
      background-color: #ffffff !important;
    }
    .mdtp__clock .mdtp__digit.active {
      background-color: #1e3a8a !important;
    }
    .mdtp__clock .mdtp__clock_hand {
      background-color: #1e3a8a !important;
    }
    .mdtp__clock .mdtp__clock_hand:after {
      background-color: #1e3a8a !important;
    }
    .mdtp__buttons {
      padding: 0.75rem 1.25rem !important;
      border-top: 1px solid #f1f5f9 !important;
      background-color: #fafafa !important;
    }
    .mdtp__button {
      font-weight: 700 !important;
      font-size: 0.8125rem !important;
      color: #1e3a8a !important;
      padding: 0.5rem 1rem !important;
      border-radius: 0.5rem !important;
      text-transform: uppercase !important;
      letter-spacing: 0.05em !important;
      transition: all 0.15s ease-in-out !important;
    }
    .mdtp__button:hover {
      background-color: #e2e8f0 !important;
      color: #0f172a !important;
    }
  </style>

  <!-- CKEditor 5 CDN -->
  <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
  <!-- MDTimePicker JS CDN -->
  <script src="https://cdn.jsdelivr.net/npm/@dmuy/timepicker@2.0.2/dist/mdtimepicker.min.js"></script>

  <script>
    // Initialize MDTimePicker in 24-Hour Indonesian Format
    mdtimepicker('#published_time', {
      timeFormat: 'hh:mm:ss.000',
      format: 'hh:mm',
      theme: 'blue',
      readOnly: true,
      clearBtn: false,
      is24hour: true
    });

    // Localize button labels to Indonesian
    document.addEventListener('click', function(e) {
      if (e.target && e.target.id === 'published_time') {
        setTimeout(function() {
          const cancelBtn = document.querySelector('.mdtp__button.cancel');
          const okBtn = document.querySelector('.mdtp__button.ok');
          if (cancelBtn) cancelBtn.textContent = 'BATAL';
          if (okBtn) okBtn.textContent = 'PILIH JAM';
        }, 50);
      }
    });

    // Initialize CKEditor 5
    ClassicEditor
      .create(document.querySelector('#editor'), {
        toolbar: [
          'heading', '|',
          'bold', 'italic', 'underline', 'strikethrough', '|',
          'bulletedList', 'numberedList', 'blockQuote', '|',
          'link', 'insertTable', '|',
          'undo', 'redo'
        ],
        placeholder: 'Tuliskan isi berita lengkap di sini...'
      })
      .catch(error => {
        console.error('CKEditor Init Error:', error);
      });

    // Image Preview
    const imageInput = document.getElementById('news-image-input');
    const previewContainer = document.getElementById('image-preview-container');
    const previewImg = document.getElementById('image-preview');

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
