<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Atur Ulang Password - PASIH</title>
  <link rel="icon" type="image/png" href="{{ asset('images/logo_pasih_perda.png') }}">
  <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo_pasih_perda.png') }}">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#f8fafc] font-['Poppins',sans-serif] text-slate-800 flex items-center justify-center p-4 sm:p-6">
  <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-200/80 p-8 sm:p-10">
    <div class="flex items-center justify-between mb-8">
      <div class="flex items-center gap-2.5">
        <img src="{{ asset('images/logo_pasih_perda.png') }}" alt="Logo PASIH PERDA" class="h-9 w-auto object-contain">
        <div class="flex flex-col">
          <span class="text-lg font-extrabold text-blue-900 leading-tight">PASIH</span>
          <span class="text-[9px] font-semibold text-slate-400">Kemenkum Riau</span>
        </div>
      </div>
      <a href="{{ route('login') }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 font-semibold text-xs transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
        </svg>
        Login
      </a>
    </div>

    <h1 class="text-2xl font-extrabold text-blue-900 tracking-tight mb-2">Atur Ulang Password</h1>
    <p class="text-xs sm:text-sm text-slate-500 mb-6 font-medium leading-relaxed">
      Silakan buat kata sandi baru untuk akun Anda.
    </p>

    @if($errors->any())
      <div class="mb-6 rounded-xl bg-rose-50 text-rose-700 px-4 py-3 text-xs sm:text-sm font-medium border border-rose-200/80 shadow-xs flex items-start gap-2">
        <svg class="w-5 h-5 shrink-0 mt-0.5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
        <span>{{ $errors->first() }}</span>
      </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">

      <div class="space-y-1.5">
        <label class="block text-xs font-bold text-blue-900 uppercase tracking-wider">Email <span class="text-rose-500">*</span></label>
        <input
          type="email"
          name="email"
          value="{{ old('email', $email) }}"
          required
          readonly
          class="w-full h-11 px-4 rounded-xl bg-slate-100 border border-slate-200 text-slate-500 text-sm font-medium cursor-not-allowed"
        >
      </div>

      <div class="space-y-1.5">
        <label class="block text-xs font-bold text-blue-900 uppercase tracking-wider">Password Baru <span class="text-rose-500">*</span></label>
        <div class="relative">
          <input
            id="new-password"
            type="password"
            name="password"
            required
            minlength="15"
            placeholder="Masukkan Password Baru"
            class="w-full h-11 px-4 pr-11 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-yellow-500/50 focus:border-yellow-500 transition-all text-sm font-medium focus:outline-none"
          >
          <button
            type="button"
            data-toggle-password
            data-target="new-password"
            aria-label="Tampilkan password"
            aria-pressed="false"
            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-800 transition-colors focus:outline-none"
          >
            <svg data-eye-open xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z"/>
              <circle cx="12" cy="12" r="3"/>
            </svg>
            <svg data-eye-closed xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18"/>
              <path stroke-linecap="round" stroke-linejoin="round" d="M10.584 10.587A2 2 0 0012 14a2 2 0 001.413-3.416M9.88 5.09A9.76 9.76 0 0112 5c4.478 0 8.269 2.943 9.543 7a9.97 9.97 0 01-4.132 5.411M6.228 6.231C4.383 7.477 3.06 9.518 2.457 12A9.97 9.97 0 006.59 17.411"/>
            </svg>
          </button>
        </div>
        <p class="text-[11px] font-medium text-slate-400">Minimal 15 karakter.</p>
      </div>

      <div class="space-y-1.5">
        <label class="block text-xs font-bold text-blue-900 uppercase tracking-wider">Konfirmasi Password <span class="text-rose-500">*</span></label>
        <div class="relative">
          <input
            id="confirm-password"
            type="password"
            name="password_confirmation"
            required
            minlength="15"
            placeholder="Ulangi Password Baru"
            class="w-full h-11 px-4 pr-11 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-yellow-500/50 focus:border-yellow-500 transition-all text-sm font-medium focus:outline-none"
          >
          <button
            type="button"
            data-toggle-password
            data-target="confirm-password"
            aria-label="Tampilkan password"
            aria-pressed="false"
            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-800 transition-colors focus:outline-none"
          >
            <svg data-eye-open xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z"/>
              <circle cx="12" cy="12" r="3"/>
            </svg>
            <svg data-eye-closed xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18"/>
              <path stroke-linecap="round" stroke-linejoin="round" d="M10.584 10.587A2 2 0 0012 14a2 2 0 001.413-3.416M9.88 5.09A9.76 9.76 0 0112 5c4.478 0 8.269 2.943 9.543 7a9.97 9.97 0 01-4.132 5.411M6.228 6.231C4.383 7.477 3.06 9.518 2.457 12A9.97 9.97 0 006.59 17.411"/>
            </svg>
          </button>
        </div>
      </div>

      <button type="submit" class="w-full h-12 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white font-bold text-base shadow-lg shadow-yellow-500/30 transition-all flex items-center justify-center gap-2">
        <span>Simpan Password Baru</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
      </button>
    </form>
  </div>
  <script>
    document.querySelectorAll('[data-toggle-password]').forEach((button) => {
      const targetId = button.getAttribute('data-target');
      const input = targetId ? document.getElementById(targetId) : null;
      const eyeOpenIcon = button.querySelector('[data-eye-open]');
      const eyeClosedIcon = button.querySelector('[data-eye-closed]');

      if (!input || !eyeOpenIcon || !eyeClosedIcon) return;

      button.addEventListener('click', function () {
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';

        eyeOpenIcon.classList.toggle('hidden', !isHidden);
        eyeClosedIcon.classList.toggle('hidden', isHidden);
        button.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
        button.setAttribute('aria-pressed', String(isHidden));
      });
    });
  </script>
</body>
</html>
