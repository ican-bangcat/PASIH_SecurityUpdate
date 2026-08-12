<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login PASIH</title>
  <link rel="icon" type="image/png" href="{{ asset('images/logo_pasih_perda.png') }}">
  <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo_pasih_perda.png') }}">
  @vite(['resources/css/app.css','resources/js/app.js'])
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="min-h-screen bg-white font-sans text-slate-900">
  
  <div class="flex w-full min-h-screen">
    
    <!-- Left Side: Dark Blue Panel -->
    <div class="hidden md:flex md:w-[60%] bg-blue-900 text-white p-12 lg:p-20 flex-col justify-between relative overflow-hidden">
        
        <!-- Decorative Concentric Lines -->
        <div class="absolute inset-0 pointer-events-none opacity-10">
            <!-- Simple SVG concentric circles matching the vibe -->
            <svg viewBox="0 0 800 800" class="absolute top-[-10%] right-[-30%] w-[120%] h-[120%] text-white" stroke="currentColor" fill="none" stroke-width="1.5">
                <circle cx="400" cy="400" r="150" />
                <circle cx="400" cy="400" r="250" />
                <circle cx="400" cy="400" r="350" />
                <circle cx="400" cy="400" r="450" />
                <circle cx="400" cy="400" r="550" />
            </svg>
        </div>

        <div class="relative z-10">
            <!-- Icon/Logo -->
            <div class="mb-12">
                <div class="bg-white/10 backdrop-blur-md p-3 rounded-2xl inline-block border border-white/20 shadow-sm">
                    <img src="{{ asset('images/loginlogo1.png') }}" alt="Logo PASIH" class="h-14 object-contain">
                </div>
            </div>

            <!-- Text Content -->
            <h1 class="text-5xl lg:text-[4rem] font-bold mb-4 leading-tight tracking-tight">
                Hello<br>PASIH! 👋
            </h1>
            <p class="text-blue-100/90 text-lg max-w-md mt-6 leading-relaxed font-medium">
                Sistem Pendampingan Analisis dan Evaluasi Hukum Peraturan Daerah. Selesaikan proses fasilitasi secara cepat dan transparan!
            </p>
        </div>

        <!-- Footer Text -->
        <div class="relative z-10 text-sm text-blue-200/60 font-medium">
            &copy; {{ date('Y') }} PASIH Kemenkumham Riau. All rights reserved.
        </div>
    </div>

    <!-- Right Side: Form -->
    <div class="w-full md:w-[40%] flex flex-col justify-center bg-white p-8 sm:p-12 lg:px-20 relative shadow-[-20px_0_40px_rgba(0,0,0,0.05)] z-10">
        
        <!-- Brand Name Top Left -->
        <div class="absolute top-8 left-8 sm:top-12 sm:left-12 lg:left-24 lg:top-12">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/loginlogo1.png') }}" alt="Logo PASIH" class="h-9 object-contain">
                <span class="text-2xl font-extrabold text-slate-900 tracking-tight">PASIH</span>
            </div>
        </div>

        <div class="max-w-sm w-full mx-auto mt-12 md:mt-0">
            <h2 class="text-[28px] font-bold text-slate-900 mb-1">Selamat Datang Kembali!</h2>
            <p class="text-[13px] text-slate-500 mb-10 font-medium leading-relaxed">
                Silakan masuk menggunakan akun yang telah terdaftar pada sistem kami.
            </p>

            <!-- Error Messages -->
            @if($errors->any())
              <div class="mb-6 rounded-lg bg-rose-50 text-rose-700 px-4 py-3 text-sm font-medium flex items-start gap-2 border border-rose-100">
                <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                <span>{{ $errors->first() }}</span>
              </div>
            @endif
            <div id="recaptcha-inline-error" class="mb-6 rounded-lg bg-rose-50 text-rose-700 px-4 py-3 text-sm font-medium hidden flex items-start gap-2 border border-rose-100">
              <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
              <span>Silakan centang reCAPTCHA terlebih dahulu.</span>
            </div>

            <!-- Form -->
            <form id="login-form" method="POST" action="{{ route('login.attempt') }}" class="space-y-6">
                @csrf

                <!-- Email Input (Bottom border only) -->
                <div class="relative">
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        placeholder="Alamat Email"
                        class="w-full h-10 bg-transparent border-0 border-b border-slate-300 px-0 py-2 text-slate-900 placeholder:text-slate-400 focus:ring-0 focus:border-slate-900 transition-colors text-[15px] font-medium focus:outline-none"
                    >
                </div>

                <!-- Password Input (Bottom border only) -->
                <div class="relative pt-2">
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        placeholder="Kata Sandi"
                        class="w-full h-10 bg-transparent border-0 border-b border-slate-300 px-0 pr-10 py-2 text-slate-900 placeholder:text-slate-400 focus:ring-0 focus:border-slate-900 transition-colors text-[15px] font-medium focus:outline-none"
                    >
                    <button
                        type="button"
                        id="toggle-password"
                        aria-label="Tampilkan password"
                        aria-pressed="false"
                        class="absolute bottom-2 right-0 flex items-center text-slate-400 hover:text-slate-800 transition-colors focus:outline-none"
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

                <!-- reCAPTCHA -->
                <div class="pt-2 flex justify-start recaptcha-wrap">
                    <div class="g-recaptcha recaptcha-el" data-sitekey="{{ config('services.recaptcha.site_key') }}" data-callback="onRecaptchaSuccess" data-expired-callback="onRecaptchaExpired"></div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="mt-8 w-full h-[46px] bg-[#1a1a1a] hover:bg-black text-white rounded-[6px] text-[15px] font-semibold transition-colors">
                    Masuk Sekarang
                </button>

                <div class="text-center mt-6">
                    <span class="text-[13px] text-slate-500 font-medium">Lupa kata sandi? </span>
                    <a href="{{ route('password.request') }}" class="text-[13px] font-bold text-slate-900 hover:underline">Klik di sini</a>
                </div>
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
      recaptchaElement.style.transformOrigin = 'center top';
      recaptchaWrap.style.height = `${recaptchaBaseHeight * scale}px`;
    };

    window.addEventListener('resize', fitRecaptchaToContainer);
    window.addEventListener('load', fitRecaptchaToContainer);
    fitRecaptchaToContainer();
  </script>
</body>
</html>
