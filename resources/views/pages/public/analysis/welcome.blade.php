@extends('layouts.public')

@section('title', 'PASIH - Home Page')
@section('public_body_class', 'welcome-page-v2 bg-[#f8fafc]')

@section('content')
    <!-- Hero Section -->
    <section id="beranda" class="relative bg-white pt-16 pb-20 lg:pt-24 lg:pb-28 overflow-hidden border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8 items-center">
                <!-- Text Content -->
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 border border-blue-100">
                        <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                        <span class="text-xs font-bold text-blue-900 tracking-wide uppercase">Inovasi Harmonisasi Hukum</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-blue-900 tracking-tight leading-[1.1]">
                        Hasil Analisis &amp; Evaluasi <span class="text-yellow-500">Hukum</span> Peraturan Daerah
                    </h1>

                    <p class="text-lg text-slate-600 leading-relaxed font-medium max-w-lg">
                        Menyediakan hasil analisis dan evaluasi hukum peraturan daerah oleh Kementerian Hukum Riau yang dapat diakses serta dimanfaatkan oleh masyarakat, termasuk untuk keperluan akademik dan penelitian
                    </p>

                    <div class="pt-4 flex flex-wrap items-center gap-4">
                        <a href="{{ route('public.analysis.index') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white font-bold text-base shadow-lg shadow-yellow-500/30 transition-all">
                            Lihat Hasil Analisis
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="https://riau.kemenkum.go.id/" target="_blank" class="inline-flex items-center justify-center px-8 py-4 rounded-xl bg-white border-2 border-slate-200 text-blue-900 font-bold text-base hover:border-blue-900 transition-all">
                            Website Kemenkumham Riau
                        </a>
                    </div>
                </div>

                <!-- Image / Graphics Content -->
                <div class="relative">
                    <!-- Placeholder for the main hero image (building/people shaking hands) -->
                    <div class="relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-200 shadow-2xl">
                        <!-- We use a gradient placeholder if no image is available yet -->
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/10 to-blue-900/40 mix-blend-multiply"></div>
                        <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Hero Image" class="w-full h-full object-cover" />
                    </div>

                    <!-- Floating Stat Card 1 -->
                    <div class="absolute -bottom-6 -left-6 bg-blue-900 text-white p-6 rounded-2xl shadow-xl max-w-[200px] border border-blue-800">
                        <div class="text-3xl font-black text-yellow-500 mb-1">500+</div>
                        <div class="text-sm font-semibold text-blue-100">Berkas Fasilitasi Selesai</div>
                    </div>

                    <!-- Floating Stat Card 2 -->
                    <div class="absolute -top-6 -right-6 bg-white text-blue-900 p-5 rounded-2xl shadow-xl border border-slate-100 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-2xl font-black">12</div>
                            <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Kab/Kota</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services / Layanan Section -->
    <section id="tentang" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-yellow-500 font-bold text-sm tracking-widest uppercase block mb-2">Layanan Kami</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-blue-900">Layanan Yang Sesuai Kebutuhan Anda</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow border border-slate-100 group">
                    <div class="h-48 overflow-hidden relative bg-blue-900">
                        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Service 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-blue-900/40 group-hover:bg-blue-900/20 transition-colors"></div>
                    </div>
                    <div class="p-8 relative">
                        <div class="w-14 h-14 bg-yellow-500 text-white rounded-xl flex items-center justify-center absolute -top-7 right-8 shadow-lg shadow-yellow-500/40">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-blue-900 mb-3 pr-10">Penerimaan Dokumen</h3>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6">
                            Sistem penerimaan dan pemberkasan secara digital untuk rancangan peraturan daerah yang terpusat dan aman.
                        </p>
                        <a href="#alur" class="text-yellow-500 font-semibold text-sm uppercase tracking-wide inline-flex items-center hover:text-yellow-600">
                            Pelajari <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow border border-slate-100 group">
                    <div class="h-48 overflow-hidden relative bg-blue-900">
                        <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Service 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-blue-900/40 group-hover:bg-blue-900/20 transition-colors"></div>
                    </div>
                    <div class="p-8 relative">
                        <div class="w-14 h-14 bg-yellow-500 text-white rounded-xl flex items-center justify-center absolute -top-7 right-8 shadow-lg shadow-yellow-500/40">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-blue-900 mb-3 pr-10">Harmonisasi &amp; Analisis</h3>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6">
                            Pemeriksaan mendalam dan sinkronisasi peraturan oleh tim ahli hukum dan analis untuk menjamin kualitas hukum.
                        </p>
                        <a href="#alur" class="text-yellow-500 font-semibold text-sm uppercase tracking-wide inline-flex items-center hover:text-yellow-600">
                            Pelajari <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow border border-slate-100 group">
                    <div class="h-48 overflow-hidden relative bg-blue-900">
                        <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Service 3" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-blue-900/40 group-hover:bg-blue-900/20 transition-colors"></div>
                    </div>
                    <div class="p-8 relative">
                        <div class="w-14 h-14 bg-yellow-500 text-white rounded-xl flex items-center justify-center absolute -top-7 right-8 shadow-lg shadow-yellow-500/40">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-blue-900 mb-3 pr-10">Penerbitan Surat Hasil</h3>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6">
                            Penelaahan komprehensif oleh Biro Hukum Provinsi dan penerbitan Surat Hasil Fasilitasi resmi secara tuntas.
                        </p>
                        <a href="#alur" class="text-yellow-500 font-semibold text-sm uppercase tracking-wide inline-flex items-center hover:text-yellow-600">
                            Pelajari <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Section (Crafting Excellence) -->
    <section class="py-20 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1 relative">
                    <div class="relative rounded-3xl overflow-hidden aspect-[4/3]">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Tim PASIH" class="w-full h-full object-cover">
                    </div>
                    <!-- Small overlaid box -->
                    <div class="absolute -bottom-8 -right-8 bg-blue-900 p-8 rounded-2xl max-w-xs shadow-2xl hidden md:block">
                        <h4 class="text-yellow-500 font-black text-xl mb-2">Misi Kami</h4>
                        <p class="text-white text-sm leading-relaxed font-medium">Memastikan setiap produk hukum daerah sesuai dengan nilai konstitusi dan peraturan perundang-undangan.</p>
                    </div>
                </div>
                
                <div class="order-1 lg:order-2 space-y-6">
                    <span class="text-yellow-500 font-bold text-sm tracking-widest uppercase">Tentang Kami</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-blue-900 leading-tight">Mewujudkan Produk Hukum Daerah Yang Berkualitas</h2>
                    <p class="text-slate-600 text-lg leading-relaxed">
                        Kami berkomitmen untuk memberikan pendampingan yang transparan dan akuntabel dalam proses pembentukan peraturan daerah di setiap wilayah Provinsi Riau.
                    </p>
                    <ul class="space-y-4 pt-4">
                        <li class="flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-yellow-100 flex items-center justify-center shrink-0 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-slate-700 font-medium">Tim Ahli &amp; Analis Hukum Profesional</span>
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
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-lg bg-blue-900 text-white font-semibold text-sm hover:bg-blue-800 transition-colors">
                            Mulai Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Steps (Cara Kerja) Section -->
    <section id="alur" class="py-20 bg-slate-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div class="max-w-2xl">
                    <span class="text-yellow-500 font-bold text-sm tracking-widest uppercase block mb-2">Tahapan Sistem</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-blue-900">Bagaimana Kami Menyelesaikannya</h2>
                </div>
                <a href="{{ route('public.analysis.index') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold text-sm transition-colors whitespace-nowrap">
                    Lihat Arsip Produk Hukum
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="relative">
                    <div class="text-6xl font-black text-slate-200 mb-4 tracking-tighter">01</div>
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-md mb-6 border border-slate-100 text-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                    </div>
                    <h4 class="text-lg font-bold text-blue-900 mb-2">Input Dokumen</h4>
                    <p class="text-sm text-slate-600 leading-relaxed font-medium">Tim Kanwil/Pemda mengunggah Draft Rancangan Peraturan &amp; Analisa Konsepsi ke dalam sistem.</p>
                </div>

                <!-- Step 2 -->
                <div class="relative lg:mt-8">
                    <div class="text-6xl font-black text-slate-200 mb-4 tracking-tighter">02</div>
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-md mb-6 border border-slate-100 text-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" /></svg>
                    </div>
                    <h4 class="text-lg font-bold text-blue-900 mb-2">Pemeriksaan</h4>
                    <p class="text-sm text-slate-600 leading-relaxed font-medium">Analisis pasal sandingan dan rapat harmonisasi oleh tim spesialis hukum.</p>
                </div>

                <!-- Step 3 -->
                <div class="relative">
                    <div class="text-6xl font-black text-slate-200 mb-4 tracking-tighter">03</div>
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-md mb-6 border border-slate-100 text-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <h4 class="text-lg font-bold text-blue-900 mb-2">Fasilitasi Setda</h4>
                    <p class="text-sm text-slate-600 leading-relaxed font-medium">Penelaahan komprehensif oleh Biro Hukum Provinsi dan penyesuaian akhir draf.</p>
                </div>

                <!-- Step 4 -->
                <div class="relative lg:mt-8">
                    <div class="text-6xl font-black text-slate-200 mb-4 tracking-tighter">04</div>
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-md mb-6 border border-slate-100 text-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h4 class="text-lg font-bold text-blue-900 mb-2">Selesai</h4>
                    <p class="text-sm text-slate-600 leading-relaxed font-medium">Penerbitan Surat Hasil Fasilitasi resmi &amp; pengarsipan digital terintegrasi di PASIH.</p>
                </div>
            </div>
        </div>
    </section>

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
                            <img src="{{ asset('images/loginlogo2.png') }}" alt="Logo PASIH" class="w-full h-full object-contain p-1" />
                        </div>
                        <div>
                            <span class="font-extrabold text-xl text-white tracking-wide">PASIH</span>
                            <div class="text-[10px] text-blue-300 font-bold tracking-wider uppercase mt-0.5">Kemenkumham Riau</div>
                        </div>
                    </div>
                    <p class="text-blue-100/80 text-sm leading-relaxed mb-8">
                        Sistem Informasi terpadu untuk Harmonisasi dan Fasilitasi Rancangan Peraturan Daerah dan Kepala Daerah secara komprehensif, cepat, dan tuntas.
                    </p>
                    
                    <h4 class="font-bold text-white text-base mb-4">Punya Pertanyaan?</h4>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-4 text-blue-100/90 text-sm">
                            <div class="w-10 h-10 rounded-full bg-blue-800 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            </div>
                            <div>
                                <div class="text-xs text-blue-300 mb-0.5">Hubungi Kami</div>
                                <div class="font-bold">0811-6904-422</div>
                            </div>
                        </li>
                        <li class="flex items-center gap-4 text-blue-100/90 text-sm">
                            <div class="w-10 h-10 rounded-full bg-blue-800 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            </div>
                            <div>
                                <div class="text-xs text-blue-300 mb-0.5">Email Pengaduan</div>
                                <div class="font-bold">humaskumriau@gmail.com</div>
                            </div>
                        </li>
                    </ul>
                    
                    <div class="mt-8 flex items-center gap-3">
                        <!-- Facebook -->
                        <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#192750] transition-colors text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <!-- X/Twitter -->
                        <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#192750] transition-colors text-white">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>
                        <!-- Instagram -->
                        <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#192750] transition-colors text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <!-- YouTube -->
                        <a href="#" class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center hover:bg-white hover:text-[#192750] transition-colors text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <!-- RSS -->
                        <a href="#" class="text-white hover:text-yellow-400 transition-colors ml-1">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4 11a9 9 0 0 1 9 9h3c0-6.627-5.373-12-12-12v3zm0 4a5 5 0 0 1 5 5h3c0-4.418-3.582-8-8-8v3zm2.5 7a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                            </svg>
                        </a>
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
