@extends('layouts.public')

@section('title', 'PASIH - Home Page')
@section('public_body_class', 'welcome-page-v2 bg-[#f8fafc]')

@section('content')
    <!-- Hero Section (Full Viewport First Screen) -->
    <section id="beranda" class="relative bg-white pt-6 pb-10 sm:pt-10 sm:pb-12 lg:pt-12 lg:pb-14 lg:min-h-[calc(100vh-80px)] flex items-center overflow-hidden border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-8 items-center">
                <!-- Text Content -->
                <div class="space-y-4 sm:space-y-5 text-center lg:text-left">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-blue-900 tracking-tight leading-[1.15] sm:leading-[1.1]">
                        Hasil Analisis &amp; Evaluasi <span class="text-yellow-500">Hukum</span> Peraturan Daerah
                    </h1>

                    <p class="text-sm sm:text-base md:text-lg text-slate-600 leading-relaxed font-medium max-w-lg mx-auto lg:mx-0">
                        Menyediakan hasil analisis dan evaluasi hukum peraturan daerah oleh Kementerian Hukum Riau yang dapat diakses serta dimanfaatkan oleh masyarakat, termasuk untuk keperluan akademik dan penelitian
                    </p>

                    <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center justify-center lg:justify-start gap-3 sm:gap-4">
                        <a href="{{ route('public.analysis.index') }}" class="inline-flex items-center justify-center px-6 sm:px-8 py-3.5 sm:py-4 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white font-bold text-sm sm:text-base shadow-lg shadow-yellow-500/30 transition-all text-center">
                            Lihat Hasil Analisis
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="https://riau.kemenkum.go.id/" target="_blank" class="inline-flex items-center justify-center px-6 sm:px-8 py-3.5 sm:py-4 rounded-xl bg-white border-2 border-slate-200 text-blue-900 font-bold text-sm sm:text-base hover:border-blue-900 transition-all text-center">
                            Website Kemenkum Riau
                        </a>
                    </div>
                </div>

                <!-- Image / Graphics Content -->
                <div class="flex flex-col items-center lg:items-start space-y-4 w-full">
                    <!-- Main hero image (Dynamic Slider) -->
                    <div class="w-full max-w-md mx-auto aspect-[16/9] sm:aspect-[4/3] rounded-2xl overflow-hidden bg-slate-200 shadow-xl border border-slate-200/80 relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/10 to-blue-900/30 mix-blend-multiply z-10 pointer-events-none"></div>
                        
                        <!-- Slider Images -->
                        <div id="hero-slider" class="relative w-full h-full">
                            @forelse ($heroSlides ?? [] as $index => $slide)
                                @php
                                    $imgUrl = is_string($slide) ? asset($slide) : ($slide->image_url ?? asset('images/2000.jpg.jpeg'));
                                    $slideTitle = is_string($slide) ? 'Foto Kegiatan ' . ($index + 1) : ($slide->title ?? 'Foto Kegiatan ' . ($index + 1));
                                @endphp
                                <img src="{{ $imgUrl }}" alt="{{ $slideTitle }}" class="hero-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" />
                            @empty
                                <img src="{{ asset('images/2000.jpg.jpeg') }}" alt="Foto Kegiatan" class="hero-slide absolute inset-0 w-full h-full object-cover opacity-100" />
                            @endforelse
                        </div>

                        <!-- Dots Indicator -->
                        @if(!empty($heroSlides) && count($heroSlides) > 1)
                            <div class="absolute bottom-2.5 sm:bottom-3.5 left-0 right-0 z-20 flex justify-center items-center pointer-events-auto px-2">
                                <div class="bg-slate-900/40 backdrop-blur-md px-2.5 py-1 rounded-full flex items-center gap-1.5 border border-white/20 shadow-sm max-w-full overflow-x-auto">
                                    @foreach ($heroSlides as $index => $slide)
                                        <button 
                                            type="button" 
                                            class="hero-dot {{ $index === 0 ? 'w-4 sm:w-5 bg-yellow-400 opacity-100' : 'w-1.5 sm:w-2 bg-white/70 opacity-60 hover:opacity-100' }} !min-h-0 !h-1.5 sm:!h-2 !p-0 !border-0 rounded-full transition-all duration-300 cursor-pointer shrink-0" 
                                            onclick="setSlide({{ $index }})" 
                                            aria-label="Slide {{ $index + 1 }}"
                                        ></button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Logo Pemda Under Hero Image -->
                    <div class="w-full max-w-md mx-auto pt-4 flex justify-center">
                        <img src="{{ asset('images/LOGO PEMDA.png') }}" alt="Logo Pemerintah Daerah" class="w-full h-auto object-contain hover:scale-105 transition-transform duration-300">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News / Berita Section -->
    <section id="berita" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6">
                <div>
                    <span class="text-yellow-500 font-bold text-sm tracking-widest uppercase block mb-2">Berita Terkini</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-blue-900">Seputar Peraturan Daerah &amp; Harmonisasi</h2>
                </div>
                <div>
                    <a href="{{ route('public.news.index') }}" class="inline-flex items-center text-sm font-bold text-blue-900 hover:text-yellow-600 transition-colors">
                        Lihat Semua Berita
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($latestNews ?? [] as $news)
                    <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100 flex flex-col group">
                        <div class="h-52 overflow-hidden relative bg-slate-200">
                            @if($news->image_url)
                                <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                <span>{{ optional($news->published_at)->translatedFormat('d F Y') ?: optional($news->created_at)->translatedFormat('d F Y') }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-blue-900 mb-3 group-hover:text-yellow-600 transition-colors line-clamp-2">
                                <a href="{{ route('public.news.show', $news->slug) }}">{{ $news->title }}</a>
                            </h3>
                            <p class="text-slate-600 text-sm leading-relaxed mb-6 flex-1 line-clamp-3">
                                {{ $news->excerpt }}
                            </p>
                            <a href="{{ route('public.news.show', $news->slug) }}" class="text-yellow-600 font-bold text-sm inline-flex items-center hover:text-yellow-700">
                                Baca Selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 py-12 text-center text-slate-500 bg-white rounded-2xl border border-slate-100">
                        <p class="font-semibold text-slate-600">Belum ada berita terkini yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Info Section (Crafting Excellence / Tentang Kami) -->
    <section id="tentang-kami" class="py-20 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1 relative">
                    <div class="relative rounded-3xl overflow-hidden aspect-[4/3]">
                        <img src="{{ asset('images/2.webp') }}" alt="Tim PASIH" class="w-full h-full object-cover">
                    </div>
                    <!-- Small overlaid box -->
                </div>
                
                <div class="order-1 lg:order-2 space-y-6">
                    <span class="text-yellow-500 font-bold text-sm tracking-widest uppercase">Tentang Kami</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-blue-900 leading-tight">Mewujudkan Produk Hukum Daerah Yang Berkualitas</h2>
                    <p class="text-slate-600 text-lg leading-relaxed">
Kami berkomitmen memberikan pendampingan secara profesional dalam tahapan analisis dan evaluasi terhadap peraturan daerah provinsi, dan kabupaten/kota di Provinsi Riau:                    </p>
                    <ul class="space-y-4 pt-4">
                        <li class="flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-yellow-100 flex items-center justify-center shrink-0 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-slate-700 font-medium">Analis Hukum &amp; Pejabat Fungsional di bidang hukum yang responsif dan profesional</span>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-yellow-100 flex items-center justify-center shrink-0 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-slate-700 font-medium">Proses Cepat, Tepat &amp; Transparan</span>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-yellow-100 flex items-center justify-center shrink-0 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-slate-700 font-medium">Integrasi Data Terpadu se-Provinsi</span>
                        </li>
                    </ul>
                    <div class="pt-4">
                        <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-lg bg-blue-900 text-white font-semibold text-sm hover:bg-blue-800 transition-colors">
                            {{ auth()->check() ? 'Buka Dashboard' : 'Mulai Sekarang' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Script Hero Image Slider -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentSlide = 0;
            const slides = document.querySelectorAll('.hero-slide');
            const dots = document.querySelectorAll('.hero-dot');
            const totalSlides = slides.length;
            if (totalSlides === 0) return;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    if (i === index) {
                        slide.classList.remove('opacity-0');
                        slide.classList.add('opacity-100');
                    } else {
                        slide.classList.remove('opacity-100');
                        slide.classList.add('opacity-0');
                    }
                });
                dots.forEach((dot, i) => {
                    if (i === index) {
                        dot.classList.remove('opacity-60', 'w-1.5', 'sm:w-2', 'bg-white/70');
                        dot.classList.add('opacity-100', 'w-4', 'sm:w-5', 'bg-yellow-400');
                    } else {
                        dot.classList.remove('opacity-100', 'w-4', 'sm:w-5', 'bg-yellow-400');
                        dot.classList.add('opacity-60', 'w-1.5', 'sm:w-2', 'bg-white/70');
                    }
                });
                currentSlide = index;
            }

            window.setSlide = function(index) {
                showSlide(index);
            };

            setInterval(function() {
                let nextIndex = (currentSlide + 1) % totalSlides;
                showSlide(nextIndex);
            }, 4000);
        });
    </script>
@endsection

@section('public_footer')
    <!-- Footer Section -->
    <footer id="kontak" class="bg-[#192750] text-white pt-16 pb-8 border-t-[8px] border-yellow-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 pb-12 border-b border-blue-900/50">
                <!-- Brand Info -->
                <div class="lg:col-span-4">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-14 h-14 bg-white rounded-xl flex items-center justify-center overflow-hidden shrink-0">
                            <img src="{{ asset('images/logo_pasih_perda.png') }}" alt="Logo PASIH PERDA" class="w-full h-full object-contain p-1" />
                        </div>
                        <div>
                            <span class="font-extrabold text-xl text-white tracking-wide">PASIH</span>
                            <div class="text-[10px] text-blue-300 font-bold tracking-wider uppercase mt-0.5">Kemenkum Riau</div>
                        </div>
                    </div>
                    <p class="text-blue-100/80 text-sm leading-relaxed mb-8">
Melalui Pasih Perda, Kantor Wilayah Kementerian Hukum Riau berupaya mendorong efektivitas pelaksanaan analisis dan evaluasi terhadap peraturan daerah dalam rangka meningkatkan tata kelola regulasi pada 13 pemerintah daerah melalui platform berbasis website. Pengembangan Pasih Perda selaras dengan tuntutan perkembangan teknologi informasi serta tuntutan pelayanan publik yang mendorong kinerja cepat, transparan, dan akuntabel.                    </p>
                    
                    <h4 class="font-bold text-white text-base mb-4">Punya Pertanyaan?</h4>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-4 text-blue-100/90 text-sm">
                            <div class="w-10 h-10 rounded-full bg-blue-800 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            </div>
                            <div>
                                <div class="text-xs text-blue-300 mb-0.5">Hubungi Kami</div>
                                <a href="tel:081374179930" class="font-bold hover:text-yellow-400 transition-colors">0813-7417-9930</a>
                            </div>
                        </li>
                        <li class="flex items-center gap-4 text-blue-100/90 text-sm">
                            <div class="w-10 h-10 rounded-full bg-blue-800 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            </div>
                            <div>
                                <div class="text-xs text-blue-300 mb-0.5">Email Pengaduan</div>
                                <a href="mailto:Analishukumriau@gmail.com" class="font-bold hover:text-yellow-400 transition-colors">Analishukumriau@gmail.com</a>
                            </div>
                        </li>
                    </ul>
                    
                    <div class="mt-8 flex items-center gap-3">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/share/1CL3svLPfY/" target="_blank" rel="noopener" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#192750] transition-colors text-white" title="Facebook Kemenkum Riau">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <!-- X/Twitter -->
                        <!-- <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#192750] transition-colors text-white">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a> -->
                        <!-- Instagram -->
                        <a href="https://www.instagram.com/kemenkumriau?igsh=MTRqYnFkbnQ5OWRpMg==&igsi=MTRqYnFkbnQ5OWRpMg==" target="_blank" rel="noopener" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#192750] transition-colors text-white" title="Instagram Kemenkum Riau">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <!-- YouTube -->
                        <!-- <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#192750] transition-colors text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z" clip-rule="evenodd" />
                            </svg>
                        </a> -->
                        <!-- RSS -->
                        <!-- <a href="#" class="text-white hover:text-yellow-400 transition-colors ml-1">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4 11a9 9 0 0 1 9 9h3c0-6.627-5.373-12-12-12v3zm0 4a5 5 0 0 1 5 5h3c0-4.418-3.582-8-8-8v3zm2.5 7a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                            </svg>
                        </a> -->
                    </div>
                </div>

                <!-- Map Section -->
                <div class="lg:col-span-8">
                    <h4 class="font-bold text-white text-base mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        Lokasi Kantor
                    </h4>
                    <div class="bg-blue-800/50 p-2 rounded-2xl border border-blue-800">
                        <div class="w-full h-64 sm:h-80 rounded-xl overflow-hidden bg-blue-900 relative">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.5826483470028!2d101.4478346!3d0.5210424!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5ac1b73791a1b%3A0xef96772586252a40!2sMinistry%20of%20Law%20and%20Human%20Rights!5e1!3m2!1sen!2sid!4v1776957611911!5m2!1sen!2sid" 
                                style="border:0; width: 100%; height: 100%;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                    <div class="mt-4 text-blue-100/70 text-sm flex items-start gap-3 bg-blue-900/30 p-4 rounded-xl border border-blue-800/50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0 mt-0.5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        <span>Jl. Jend. Sudirman No.233, Sumahilang, Kec. Pekanbaru Kota, Kota Pekanbaru, Riau 28111</span>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs font-semibold text-blue-200/60">
                <div>
                    &copy; {{ date('Y') }} PASIH - Kementerian Hukum Riau. 
                </div>
                <div>
                    Dikembangkan bersama Politeknik Caltex Riau.
                </div>
            </div>
        </div>
    </footer>
@endsection
