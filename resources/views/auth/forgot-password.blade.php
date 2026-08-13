<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lupa Password - PASIH</title>
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

    <h1 class="text-2xl font-extrabold text-blue-900 tracking-tight mb-2">Lupa Password?</h1>
    <p class="text-xs sm:text-sm text-slate-500 mb-6 font-medium leading-relaxed">
      Masukkan alamat email Anda untuk menerima tautan atur ulang kata sandi.
    </p>

    @if(session('status'))
      <div class="mb-6 rounded-xl bg-emerald-50 text-emerald-700 px-4 py-3 text-xs sm:text-sm font-medium border border-emerald-200/80 shadow-xs flex items-start gap-2">
        <svg class="w-5 h-5 shrink-0 mt-0.5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
        <span>{{ session('status') }}</span>
      </div>
    @endif

    @if($errors->any())
      <div class="mb-6 rounded-xl bg-rose-50 text-rose-700 px-4 py-3 text-xs sm:text-sm font-medium border border-rose-200/80 shadow-xs flex items-start gap-2">
        <svg class="w-5 h-5 shrink-0 mt-0.5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
        <span>{{ $errors->first() }}</span>
      </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
      @csrf
      <div class="space-y-1.5">
        <label class="block text-xs font-bold text-blue-900 uppercase tracking-wider">Email <span class="text-rose-500">*</span></label>
        <input
          type="email"
          name="email"
          value="{{ old('email') }}"
          required
          placeholder="Masukkan Alamat Email"
          class="w-full h-11 px-4 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-yellow-500/50 focus:border-yellow-500 transition-all text-sm font-medium focus:outline-none"
        >
      </div>

      <button type="submit" class="w-full h-12 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white font-bold text-base shadow-lg shadow-yellow-500/30 transition-all flex items-center justify-center gap-2">
        <span>Kirim Link Reset Password</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
      </button>
    </form>
  </div>
</body>
</html>
