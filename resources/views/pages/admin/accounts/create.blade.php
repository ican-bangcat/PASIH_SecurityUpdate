@extends('layouts.app')
@section('title', 'Tambah Akun')

@section('content')
  <div class="space-y-5">
    @if($errors->any())
      <div class="rounded-xl bg-rose-50 text-rose-700 ring-1 ring-rose-200 px-4 py-3 text-sm">
        {{ $errors->first() }}
      </div>
    @endif

    <div class="flex items-start justify-between gap-4">
      <div>
        <h1 class="pasih-page-title">Tambah Akun</h1>
        <p class="mt-2 pasih-page-breadcrumb">
          <a href="{{ route('dashboard') }}" class="hover:text-slate-700 hover:underline">Dashboard</a>
          <span class="mx-1">/</span>
          <a href="{{ route('admin.accounts.index') }}" class="hover:text-slate-700 hover:underline">Manajemen Akun</a>
          <span class="mx-1">/</span>
          <span>Tambah Akun</span>
        </p>
      </div>
    </div>

    <div class="rounded-xl bg-white ring-1 ring-slate-200 overflow-hidden">
      <div class="px-4 py-3 border-b border-slate-200">
        <h2 class="text-[18px] font-bold text-slate-800">Data Akun</h2>
      </div>

      <form method="POST" action="{{ route('admin.accounts.store') }}" class="p-4 space-y-4">
        @csrf
        <div>
          <label class="block text-sm font-semibold text-slate-700">Nama <span class="text-red-500">*</span></label>
          <input type="text" name="name" value="{{ old('name') }}" required placeholder="Masukkan Nama" class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm placeholder:text-[14px]">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-semibold text-slate-700">Email <span class="text-red-500">*</span></label>
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="Masukkan Alamat Email" class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm placeholder:text-[14px]">
          </div>
          <div>
            <label class="block text-sm font-semibold text-slate-700">Password <span class="text-red-500">*</span></label>
            <input
              type="password"
              name="password"
              id="passwordInput"
              required
              minlength="15"
              placeholder="Masukkan Password"
              class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm placeholder:text-[14px]"
            >
            <div class="mt-2 text-xs grid grid-cols-2 gap-2 text-rose-500" id="passwordRules">
              <div class="flex items-center gap-1.5 transition-colors" id="rule-lower">
                <svg class="w-3.5 h-3.5 rule-icon" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="4"/></svg>
                <span>Minimal satu huruf kecil</span>
              </div>
              <div class="flex items-center gap-1.5 transition-colors" id="rule-upper">
                <svg class="w-3.5 h-3.5 rule-icon" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="4"/></svg>
                <span>Minimal satu huruf besar</span>
              </div>
              <div class="flex items-center gap-1.5 transition-colors" id="rule-number">
                <svg class="w-3.5 h-3.5 rule-icon" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="4"/></svg>
                <span>Minimal satu angka</span>
              </div>
              <div class="flex items-center gap-1.5 transition-colors" id="rule-special">
                <svg class="w-3.5 h-3.5 rule-icon" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="4"/></svg>
                <span>Minimal satu karakter spesial</span>
              </div>
              <div class="flex items-center gap-1.5 transition-colors" id="rule-length">
                <svg class="w-3.5 h-3.5 rule-icon" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="4"/></svg>
                <span>Minimal 15 karakter</span>
              </div>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-semibold text-slate-700">
                Role <span class="text-red-500">*</span>
            </label>
            <select name="role" required
                class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm placeholder:text-[14px] focus:outline-none focus:ring-0 focus:border-[#B9B9B9]">

                <option value="">Pilih Role</option>

                @foreach($roles as $role)
                    <option value="{{ $role->nama_role }}"
                        @selected(old('role') === $role->nama_role)>

                        {{ Str::title(str_replace('_', ' ', $role->nama_role)) }}

                    </option>
                @endforeach
            </select>
          </div>
          <div>
            <label class="block text-sm font-semibold text-slate-700">Instansi <span class="text-red-500">*</span></label>
            <select name="id_instansi" required class="mt-2 w-full h-10 px-4 py-2 rounded-md border border-[#B9B9B9] text-sm placeholder:text-[14px] focus:outline-none focus:ring-0 focus:border-[#B9B9B9]">
              <option value="">Pilih Instansi</option>
              @foreach($institutions as $institution)
                <option value="{{ $institution->id_instansi }}" @selected((string) old('id_instansi') === (string) $institution->id_instansi)>{{ $institution->nama_instansi }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="pt-1">
          <button type="submit" id="submitBtn" disabled class="inline-flex items-center gap-2 h-10 px-4 rounded-md bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition-all opacity-50 cursor-not-allowed">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 4v12m0 0l-4-4m4 4l4-4" />
            </svg>
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const passwordInput = document.getElementById('passwordInput');
      const submitBtn = document.getElementById('submitBtn');

      const rules = {
        lower: { regex: /[a-z]/, element: document.getElementById('rule-lower') },
        upper: { regex: /[A-Z]/, element: document.getElementById('rule-upper') },
        number: { regex: /[0-9]/, element: document.getElementById('rule-number') },
        special: { regex: /[^A-Za-z0-9]/, element: document.getElementById('rule-special') },
        length: { regex: /.{15,}/, element: document.getElementById('rule-length') }
      };

      const dotIcon = `<circle cx="10" cy="10" r="4"/>`;
      const checkIcon = `<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />`;

      function updateValidation() {
        const password = passwordInput.value;
        let allValid = true;

        for (const key in rules) {
          const rule = rules[key];
          const isValid = rule.regex.test(password);
          
          if (!isValid) allValid = false;

          // Update classes
          if (isValid) {
            rule.element.classList.remove('text-rose-500');
            rule.element.classList.add('text-emerald-600');
            rule.element.querySelector('.rule-icon').innerHTML = checkIcon;
          } else {
            rule.element.classList.remove('text-emerald-600');
            rule.element.classList.add('text-rose-500');
            rule.element.querySelector('.rule-icon').innerHTML = dotIcon;
          }
        }

        if (allValid) {
          submitBtn.disabled = false;
          submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
          submitBtn.disabled = true;
          submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
      }

      passwordInput.addEventListener('input', updateValidation);
      
      // Initialize state on load
      updateValidation();
    });
  </script>
@endsection

