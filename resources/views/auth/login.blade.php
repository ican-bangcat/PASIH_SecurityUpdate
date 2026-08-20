<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - PASIH</title>
  <link rel="icon" type="image/png" href="{{ asset('images/logo_pasih_perda.png') }}">
  <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo_pasih_perda.png') }}">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  @vite(['resources/css/app.css','resources/js/app.js'])
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="min-h-screen bg-[#f8fafc] font-['Poppins',sans-serif] text-slate-800 flex items-center justify-center p-4 sm:p-6 lg:p-8">
  
  <!-- Main Card Container -->
  <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row min-h-[620px] border border-slate-200/80">
    
    <!-- Left Side: Rich Dark Blue Panel (Matching Landing Page Vibe) -->
    <div class="md:w-1/2 bg-[#192750] text-white p-8 sm:p-12 lg:p-16 flex flex-col justify-between relative overflow-hidden">
        
        <!-- Decorative Concentric Circles & Gradient Overlay -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-blue-500/10 blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-yellow-500/10 blur-3xl"></div>
            <svg viewBox="0 0 800 800" class="absolute top-[-15%] right-[-25%] w-[130%] h-[130%] text-white/5" stroke="currentColor" fill="none" stroke-width="1.5">
                <circle cx="400" cy="400" r="150" />
                <circle cx="400" cy="400" r="250" />
                <circle cx="400" cy="400" r="350" />
                <circle cx="400" cy="400" r="450" />
                <circle cx="400" cy="400" r="550" />
            </svg>
        </div>

        <!-- Top Content -->
        <div class="relative z-10">
            <!-- Dual Logo Badge -->
            <div class="mb-10 inline-flex items-center gap-3 bg-white/10 backdrop-blur-md p-2.5 px-4 rounded-2xl border border-white/20 shadow-sm">
                <img src="{{ asset('images/loginlogo2.png') }}" alt="Logo Kemenkum" class="h-9 w-auto object-contain">
                <img src="{{ asset('images/logo_pasih_perda.png') }}" alt="Logo PASIH PERDA" class="h-11 w-auto object-contain">
            </div>

            <!-- Hero Welcome Heading -->
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-[1.15] text-white">
                Selamat Datang di <span class="text-yellow-400">PASIH PERDA!</span> 👋
            </h1>
            <p class="text-blue-100/80 text-sm sm:text-base leading-relaxed font-medium mt-4 max-w-md">
                Sistem Pendampingan Analisis &amp; Evaluasi Hukum Peraturan Daerah Kantor Wilayah Kementerian Hukum Riau.
            </p>
        </div>

        <!-- Left Footer Copy -->
        <div class="relative z-10 pt-8 mt-auto border-t border-white/10 text-xs text-blue-200/60 font-semibold flex items-center justify-between">
            <span>&copy; {{ date('Y') }} PASIH - Kemenkum Riau</span>
            <span class="hidden sm:inline">Politeknik Caltex Riau</span>
        </div>
    </div>

    <!-- Right Side: Clean Login Form (Matching Landing Page Colors) -->
    <div class="md:w-1/2 bg-white p-8 sm:p-12 lg:p-14 flex flex-col justify-between relative">
        
        <!-- Header Top Navigation -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo_pasih_perda.png') }}" alt="Logo PASIH PERDA" class="h-9 w-auto object-contain">
                <div class="flex flex-col">
                    <span class="text-lg font-extrabold text-blue-900 leading-tight">PASIH</span>
                    <span class="text-[9px] font-semibold text-slate-400">Kemenkum Riau</span>
                </div>
            </div>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 font-semibold text-xs transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Beranda
            </a>
        </div>

        <div class="w-full max-w-sm mx-auto my-auto">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-blue-900 tracking-tight mb-2">Selamat Datang Kembali!</h2>
            <p class="text-xs sm:text-sm text-slate-500 mb-8 font-medium leading-relaxed">
                Silakan masuk menggunakan akun yang telah terdaftar pada sistem kami.
            </p>

            <!-- Error Messages -->
            @if($errors->any())
              <div class="mb-6 rounded-xl bg-rose-50 text-rose-700 px-4 py-3 text-xs sm:text-sm font-medium flex items-start gap-2.5 border border-rose-200/80 shadow-xs">
                <svg class="w-5 h-5 shrink-0 mt-0.5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                <span>{{ $errors->first() }}</span>
              </div>
            @endif

            <div id="recaptcha-inline-error" class="mb-6 rounded-xl bg-rose-50 text-rose-700 px-4 py-3 text-xs sm:text-sm font-medium hidden flex items-start gap-2.5 border border-rose-200/80 shadow-xs">
              <svg class="w-5 h-5 shrink-0 mt-0.5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
              <span>Silakan centang reCAPTCHA terlebih dahulu.</span>
            </div>

            <!-- Form -->
            <form id="login-form" method="POST" action="{{ route('login.attempt') }}" class="space-y-5">
                @csrf

                <!-- Email Input -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-blue-900 uppercase tracking-wider">Email <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            placeholder="Masukkan Alamat Email"
                            class="w-full h-11 px-4 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-yellow-500/50 focus:border-yellow-500 transition-all text-sm font-medium focus:outline-none"
                        >
                    </div>
                </div>

                <!-- Password Input -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-blue-900 uppercase tracking-wider">Password <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            placeholder="Masukkan Password"
                            class="w-full h-11 px-4 pr-11 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-yellow-500/50 focus:border-yellow-500 transition-all text-sm font-medium focus:outline-none"
                        >
                        <button
                            type="button"
                            id="toggle-password"
                            aria-label="Tampilkan password"
                            aria-pressed="false"
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-800 transition-colors focus:outline-none"
                        >
                            <svg id="eye-open" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg id="eye-closed" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.584 10.587A2 2 0 0012 14a2 2 0 001.413-3.416M9.88 5.09A9.76 9.76 0 0112 5c4.478 0 8.269 2.943 9.543 7a9.97 9.97 0 01-4.132 5.411M6.228 6.231C4.383 7.477 3.06 9.518 2.457 12A9.97 9.97 0 006.59 17.411"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between pt-1 text-xs">
                    <label class="inline-flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-yellow-500 focus:ring-yellow-500 cursor-pointer" {{ old('remember') ? 'checked' : '' }}>
                        <span class="font-semibold text-slate-600">Ingat saya</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="font-bold text-yellow-600 hover:text-yellow-700 hover:underline transition-colors">
                        Lupa Password?
                    </a>
                </div>

                <!-- reCAPTCHA -->
                <div class="pt-2 flex justify-start recaptcha-wrap">
                    <div class="g-recaptcha recaptcha-el" data-sitekey="{{ config('services.recaptcha.site_key') }}" data-callback="onRecaptchaSuccess" data-expired-callback="onRecaptchaExpired"></div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full h-12 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white font-bold text-base shadow-lg shadow-yellow-500/30 transition-all flex items-center justify-center gap-2">
                    <span>Masuk Sekarang</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
  </div>

  <script>
    const passwordInput = document.getElementById('password');
    const togglePasswordButton = document.getElementById('toggle-password');
    const eyeOpenIcon = document.getElementById('eye-open');
    const eyeClosedIcon = document.getElementById('eye-closed');
    const loginForm = document.getElementById('login-form');
    const recaptchaInlineError = document.getElementById('recaptcha-inline-error');
    const emailInput = loginForm.querySelector('input[name="email"]');
    const passwordField = loginForm.querySelector('input[name="password"]');

    const setLoginFieldValidityMessage = function (field) {
      field.setCustomValidity('');

      const label = (field.getAttribute('data-label') || field.getAttribute('name') || 'kolom ini').toLowerCase();
      if (field.validity.valueMissing) {
        field.setCustomValidity(`Silakan isi ${label} terlebih dahulu.`);
        return;
      }

      if (field.validity.typeMismatch && field.type === 'email') {
        field.setCustomValidity('Format email tidak valid. Contoh: nama@domain.com.');
      }
    };

    togglePasswordButton.addEventListener('click', function () {
      const isHidden = passwordInput.type === 'password';
      passwordInput.type = isHidden ? 'text' : 'password';

      eyeOpenIcon.classList.toggle('hidden', !isHidden);
      eyeClosedIcon.classList.toggle('hidden', isHidden);
      togglePasswordButton.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
      togglePasswordButton.setAttribute('aria-pressed', String(isHidden));
    });

    loginForm.addEventListener('submit', function (event) {
      const recaptchaValue = document.querySelector('[name="g-recaptcha-response"]')?.value;

      if (!recaptchaValue) {
        event.preventDefault();
        recaptchaInlineError.classList.remove('hidden');
      }
    });

    [emailInput, passwordField].forEach(function (field) {
      if (!field) {
        return;
      }

      field.setAttribute('data-label', field.getAttribute('name') === 'email' ? 'Email' : 'Password');

      field.addEventListener('invalid', function () {
        setLoginFieldValidityMessage(field);
      });

      field.addEventListener('input', function () {
        field.setCustomValidity('');
      });
    });

    window.onRecaptchaSuccess = function () {
      recaptchaInlineError.classList.add('hidden');
    };

    window.onRecaptchaExpired = function () {
      recaptchaInlineError.classList.remove('hidden');
    };

    const recaptchaBaseWidth = 304;
    const recaptchaBaseHeight = 78;
    const recaptchaWrap = document.querySelector('.recaptcha-wrap');
    const recaptchaElement = document.querySelector('.recaptcha-el');

    const fitRecaptchaToContainer = function () {
      if (!recaptchaWrap || !recaptchaElement) {
        return;
      }

      const availableWidth = recaptchaWrap.clientWidth;
      const scale = Math.min(1, availableWidth / recaptchaBaseWidth);

      recaptchaElement.style.transform = `scale(${scale})`;
      recaptchaElement.style.transformOrigin = 'left top';
      recaptchaWrap.style.height = `${recaptchaBaseHeight * scale}px`;
    };

    window.addEventListener('resize', fitRecaptchaToContainer);
    window.addEventListener('load', fitRecaptchaToContainer);
    fitRecaptchaToContainer();
  </script>
</body>
</html>
