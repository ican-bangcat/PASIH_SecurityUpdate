@extends('layouts.app')
@section('title', 'Tentukan Penanggung Jawab')

@section('content')
  <div class="space-y-5">
    <div>
      <h1 class="pasih-page-title">Penugasan Analisis</h1>
      <p class="mt-1 pasih-page-breadcrumb">
        <a href="{{ route('dashboard') }}" class="hover:text-slate-700 hover:underline">Dashboard</a>
        <span class="mx-1">/</span>
        <a href="{{ route('assignments.index') }}" class="hover:text-slate-700 hover:underline">Penugasan</a>
        <span class="mx-1">/</span>
        <span>Penugasan Analisis</span>
      </p>
    </div>

    @if($errors->any())
      <div class="rounded-xl bg-rose-50 text-rose-700 ring-1 ring-rose-200 px-4 py-3 text-sm font-medium">
        {{ $errors->first() }}
      </div>
    @endif

    <div id="assignPicStandaloneAlert" class="hidden rounded-xl px-4 py-3 text-sm font-medium"></div>

    <div class="rounded-xl bg-white ring-1 ring-slate-200 overflow-hidden">
      <div class="px-4 py-3 border-b border-slate-200">
        <h2 class="text-[18px] font-bold text-slate-800">Penetapan Penanggung Jawab Analisis Peraturan Daerah</h2>
      </div>
      <form id="assignPicStandaloneForm" method="POST" action="{{ route('assignments.assign-pic.store', $assignment) }}" enctype="multipart/form-data" class="p-5 space-y-5">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <label class="block text-sm font-medium text-slate-700">
            Judul Peraturan Daerah
            <input type="text" disabled value="{{ $assignment->submission?->perda_title ?: '-' }}" class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] bg-slate-100 text-sm text-slate-500">
          </label>
          <label class="block text-sm font-medium text-slate-700">
            Instansi Pengaju
            <input type="text" disabled value="{{ $assignment->submission?->submitter?->instansi?->nama_instansi ?? $assignment->submission?->submitter?->name ?? '-' }}" class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] bg-slate-100 text-sm text-slate-500">
          </label>
        </div>

        <label class="block text-sm font-medium text-slate-700">
          Penanggung Jawab Analisis <span class="text-red-500">*</span>
          <select name="analyst_id" class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm focus:outline-none focus:ring-0 focus:border-[#B9B9B9]" required>
            <option value="">Pilih Analis</option>
            @foreach($analysts as $analyst)
              <option value="{{ $analyst->id }}" @selected((string) old('analyst_id') === (string) $analyst->id)>{{ $analyst->name }}</option>
            @endforeach
          </select>
        </label>

        <label class="block text-sm font-medium text-slate-700">
          Deadline <span class="text-red-500">*</span>
          <input type="date" name="deadline_at" min="{{ now()->toDateString() }}" required value="{{ old('deadline_at', optional($assignment->deadline_at)?->format('Y-m-d')) }}" class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm">
        </label>

        <label class="block text-sm font-medium text-slate-700">
          Upload Surat Balasan ke Pemda <span class="text-slate-400 text-xs font-normal">(Opsional)</span>
          <p class="mt-1 text-xs text-slate-500">Format: PDF/DOC/DOCX, maksimal 10 MB.</p>
          <input
            type="file"
            name="surat_balasan_kemenkum"
            data-max-size="10485760"
            accept=".pdf,.doc,.docx"
            class="mt-2 block w-full rounded-xl border border-[#B9B9B9] bg-white text-sm text-slate-700 file:mr-3 file:rounded-l-xl file:border-0 file:bg-slate-100 file:px-4 file:py-3 file:text-base file:text-slate-700">
          @error('surat_balasan_kemenkum')
            <p class="text-red-500 text-sm -mt-2">{{ $message }}</p>
          @enderror
        </label>

        <div class="pt-1">
          <button type="submit" id="assignPicStandaloneBtn" class="inline-flex items-center gap-2 h-10 px-4 rounded-md bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700">
           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 4v12m0 0l-4-4m4 4l4-4" />
          </svg>
            <span id="assignPicStandaloneBtnText">Simpan</span>
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('assignPicStandaloneForm');
    const alertEl = document.getElementById('assignPicStandaloneAlert');
    const btn = document.getElementById('assignPicStandaloneBtn');
    const btnText = document.getElementById('assignPicStandaloneBtnText');
    if (!form) return;

    function showAlert(message, isError) {
      if (!alertEl) return;
      alertEl.textContent = message;
      alertEl.className = isError
        ? 'rounded-xl px-4 py-3 text-sm font-medium bg-rose-50 text-rose-700 ring-1 ring-rose-200'
        : 'rounded-xl px-4 py-3 text-sm font-medium bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200';
      alertEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function hideAlert() {
      if (alertEl) {
        alertEl.textContent = '';
        alertEl.className = 'hidden rounded-xl px-4 py-3 text-sm font-medium';
      }
    }

    function setLoading(loading) {
      if (!btn || !btnText) return;
      btn.disabled = loading;
      btnText.textContent = loading ? 'Menyimpan...' : 'Simpan';
      btn.classList.toggle('opacity-60', loading);
      btn.classList.toggle('cursor-not-allowed', loading);
    }

    form.addEventListener('submit', function(e) {
      e.preventDefault();
      hideAlert();
      setLoading(true);

      const formData = new FormData(form);
      const csrfToken = formData.get('_token') || document.querySelector('meta[name="csrf-token"]')?.content || '';

      fetch(form.action, {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        },
        body: formData,
      })
      .then(function(response) {
        return response.json().then(function(data) {
          return { status: response.status, ok: response.ok, data: data };
        }).catch(function() {
          if (!response.ok) {
            return { status: response.status, ok: false, data: { success: false, message: 'Server mengembalikan respons tidak valid (kemungkinan diblokir WAF). Status: ' + response.status } };
          }
          return { status: response.status, ok: true, data: { success: true, message: 'Penanggung jawab analisis berhasil ditetapkan', redirect: '{{ route("assignments.index") }}' } };
        });
      })
      .then(function(result) {
        if (result.data.success) {
          showAlert(result.data.message || 'Berhasil!', false);
          setTimeout(function() {
            window.location.href = result.data.redirect || '{{ route("assignments.index") }}';
          }, 800);
        } else {
          let errorMsg = result.data.message || 'Terjadi kesalahan.';
          if (result.data.errors) {
            const errorList = Object.values(result.data.errors).flat();
            if (errorList.length > 0) {
              errorMsg = errorList.join(' ');
            }
          }
          showAlert(errorMsg, true);
          setLoading(false);
        }
      })
      .catch(function(err) {
        showAlert('Gagal mengirim data. Periksa koneksi internet Anda atau coba lagi. (' + (err.message || 'Network error') + ')', true);
        setLoading(false);
      });
    });
  });
</script>
@endpush

