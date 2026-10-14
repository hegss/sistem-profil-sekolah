<x-app-layout>
    <!-- 1. HERO SECTION JUMBOTRON FULL SCREEN -->
    <section class="relative h-screen w-full overflow-hidden bg-slate-900 -mt-20 sm:-mt-24" x-data="{
        activeSlide: 0,
        images: {{ json_encode($heroImages) }},
        next() { if (this.images.length) this.activeSlide = (this.activeSlide + 1) % this.images.length },
        prev() { if (this.images.length) this.activeSlide = (this.activeSlide - 1 + this.images.length) % this.images.length }
    }"
        x-init="if (images.length > 1) setInterval(() => next(), 5000)">

        <!-- Background Slider / Carousel dengan Animasi Out Halus -->
        <template x-for="(img, idx) in images" :key="idx">
            <div x-show="activeSlide === idx" x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95" class="absolute inset-0 z-0">

                <!-- Image Background Full Screen -->
                <img :src="img" class="w-full h-full object-cover">

                <!-- Dark Overlay / Gradient halus agar teks mudah dibaca -->
                <div class="absolute inset-0 bg-gradient-to-r from-slate-950/85 via-slate-900/60 to-slate-900/40"></div>
            </div>
        </template>

        <!-- Konten Jumbotron di Tengah Layar -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
            <div class="max-w-2xl space-y-5 sm:space-y-6 pt-12" data-aos="fade-up">

                <!-- Tagline Badge -->
                <span
                    class="inline-block px-4 py-1.5 rounded-full bg-rose-500/20 border border-rose-400/30 text-rose-200 text-xs font-bold tracking-wide backdrop-blur-md">
                    Selamat Datang di
                </span>

                <!-- Main Title Large -->
                <h1
                    class="text-4xl sm:text-6xl lg:text-7xl font-black text-white tracking-tight leading-none drop-shadow-md">
                    SDN GEDONG 12
                </h1>

                <!-- Subtitle -->
                <h2 class="text-xl sm:text-2xl font-bold text-rose-300 drop-shadow">
                    Berprestasi, Berkarakter, Berbudaya
                </h2>

                <!-- Deskripsi Singkat -->
                <p class="text-xs sm:text-sm text-slate-200 leading-relaxed max-w-xl drop-shadow-sm">
                    Kami berkomitmen untuk memberikan pendidikan berkualitas guna membentuk generasi yang cerdas,
                    berakhlak mulia, dan berbudaya.
                </p>

                <!-- CTA Buttons -->
                <div class="pt-2 flex flex-wrap items-center gap-4">
                    <a href="#lokasi"
                        class="inline-flex flex-col justify-center px-6 py-3.5 rounded-2xl bg-[#70282C] hover:bg-[#581f23] text-white shadow-xl shadow-rose-900/40 transition-all duration-300 transform hover:-translate-y-0.5 group">
                        <span class="text-xs sm:text-sm font-bold tracking-wide">Lihat Lokasi Sekolah</span>
                        <span class="text-[10px] text-rose-200/90 font-normal">Jl. Raya Condet, Kec. Kramat Jati,
                            Jakarta Timur</span>
                    </a>

                    <a href="{{ route('school-profile') }}"
                        class="px-6 py-3.5 rounded-2xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs sm:text-sm border border-white/20 backdrop-blur-md transition-all duration-300">
                        Jelajahi Profil
                    </a>
                </div>

            </div>
        </div>

        <!-- Indicator Dots Slider (Bottom Center) -->
        <template x-if="images.length > 1">
            <div class="absolute bottom-8 inset-x-0 z-20 flex justify-center items-center gap-2">
                <button @click="prev()" class="text-white/70 hover:text-white transition p-1">
                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <div class="flex items-center gap-2 px-2">
                    <template x-for="(img, idx) in images" :key="idx">
                        <button @click="activeSlide = idx" class="h-2 rounded-full transition-all duration-500"
                            :class="activeSlide === idx ? 'w-8 bg-rose-500' : 'w-2 bg-white/40 hover:bg-white/70'"></button>
                    </template>
                </div>

                <button @click="next()" class="text-white/70 hover:text-white transition p-1">
                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </template>

        <!-- Scroll Down Indicator Arrow -->
        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 z-20 text-white/50 animate-bounce">
            <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7-7-7" />
            </svg>
        </div>

    </section>

    <!-- 2. RINGKASAN JUMLAH DATA STATISTIK (Tambahan Konten) -->
    <section class="py-10 bg-white dark:bg-slate-900 border-y border-slate-100 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6" data-aos="zoom-in">

                <!-- Card Siswa -->
                <div
                    class="p-6 rounded-3xl bg-[#F4EBE8] dark:bg-slate-800/80 border border-rose-100/50 dark:border-slate-700 flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider block">Siswa
                            Aktif</span>
                        <span
                            class="text-3xl font-black text-[#70282C] dark:text-rose-400 mt-1 block">{{ number_format($totalStudents) }}</span>
                    </div>
                    <div class="size-12 rounded-2xl bg-[#70282C] text-white flex items-center justify-center shadow-md">
                        <x-students-icon class="size-6" />
                    </div>
                </div>

                <!-- Card Guru -->
                <div
                    class="p-6 rounded-3xl bg-[#F4EBE8] dark:bg-slate-800/80 border border-rose-100/50 dark:border-slate-700 flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider block">Guru &
                            Staff</span>
                        <span
                            class="text-3xl font-black text-[#70282C] dark:text-rose-400 mt-1 block">{{ $totalTeachers }}</span>
                    </div>
                    <div class="size-12 rounded-2xl bg-[#70282C] text-white flex items-center justify-center shadow-md">
                        <x-teachers-icon class="size-6" />
                    </div>
                </div>

                <!-- Card Ekskul -->
                <div
                    class="p-6 rounded-3xl bg-[#F4EBE8] dark:bg-slate-800/80 border border-rose-100/50 dark:border-slate-700 flex items-center justify-between">
                    <div>
                        <span
                            class="text-xs font-semibold text-slate-500 uppercase tracking-wider block">Ekstrakurikuler</span>
                        <span
                            class="text-3xl font-black text-[#70282C] dark:text-rose-400 mt-1 block">{{ $totalEkskul }}</span>
                    </div>
                    <div class="size-12 rounded-2xl bg-[#70282C] text-white flex items-center justify-center shadow-md">
                        <x-activities-icon class="size-6" />
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 3. SAMBUTAN KEPALA SEKOLAH (Persis seperti Gambar 2) -->
    <section id="profil" class="py-16 sm:py-24 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">

                <!-- Foto Kepala Sekolah (Sisi Kiri dengan Frame Rounded) -->
                <div class="lg:col-span-5 text-center" data-aos="fade-right">
                    <div
                        class="relative bg-[#F4EBE8] dark:bg-slate-800 p-3 sm:p-4 rounded-[2.5rem] shadow-sm border border-rose-100/60 dark:border-slate-700/60 inline-block w-full">
                        <div class="h-[350px] sm:h-[420px] rounded-3xl overflow-hidden bg-slate-200">
                            @if ($activeGreeting && isset($activeGreeting->teacher->photo) && $activeGreeting->teacher->photo)
                                <img src="{{ asset('storage/' . $activeGreeting->teacher->photo) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=800"
                                    class="w-full h-full object-cover">
                            @endif
                        </div>
                    </div>

                    <!-- Nama & Jabatan -->
                    <div class="mt-4 space-y-0.5">
                        <h3 class="text-xl font-black text-slate-900 dark:text-white">
                            {{ $activeGreeting->teacher->name ?? 'Nama Kepala Sekolah' }}
                        </h3>
                        <p class="text-xs font-semibold text-[#70282C] dark:text-rose-400">
                            {{ $activeGreeting->teacher->position ?? 'Kepala Sekolah' }}
                        </p>
                    </div>
                </div>

                <!-- Card Teks Sambutan (Sisi Kanan dengan Quote Icon Maroon) -->
                <div class="lg:col-span-7" data-aos="fade-left">
                    <div
                        class="bg-white dark:bg-slate-800/80 rounded-3xl p-6 sm:p-10 border border-slate-100 dark:border-slate-700 shadow-xl shadow-slate-100/50 relative">

                        <!-- Top Quote Icon -->
                        <div class="text-[#70282C] text-5xl font-serif font-black leading-none mb-4">
                            “
                        </div>

                        <!-- Isi Teks Sambutan -->
                        <div
                            class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed space-y-4 font-normal">
                            @if ($activeGreeting)
                                {!! nl2br(e($activeGreeting->greeting_text)) !!}
                            @else
                                <p>Assalamu'alaikum warahmatullahi wabarakatuh.</p>
                                <p>Selamat datang di website resmi SDN Gedong 12. Website ini dihadirkan sebagai media
                                    informasi dan komunikasi bagi seluruh warga sekolah serta masyarakat.</p>
                                <p>Kami berkomitmen untuk memberikan pendidikan yang berkualitas dengan mengembangkan
                                    potensi peserta didik agar menjadi generasi yang berprestasi, berkarakter, dan
                                    berbudaya.</p>
                                <p>Mari bersama-sama menciptakan lingkungan pendidikan yang aman, nyaman, dan
                                    menyenangkan bagi seluruh peserta didik.</p>
                                <p>Wassalamu'alaikum warahmatullahi wabarakatuh.</p>
                            @endif
                        </div>

                        <!-- Bottom Quote Icon -->
                        <div class="text-[#70282C] text-5xl font-serif font-black leading-none text-right mt-4">
                            ”
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- 4. SECTION BERITA (Slide Card Slider) -->
    <section id="berita" class="py-16 sm:py-20 bg-slate-50/60 dark:bg-slate-900/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="flex items-end justify-between gap-4" data-aos="fade-up">
                <div>
                    <span class="text-xs font-bold text-[#70282C] uppercase tracking-wider block">Informasi
                        Terbaru</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white mt-1">Prestasi & Informasi
                        Lainnya</h2>
                </div>
                <a href="#berita" class="text-xs font-bold text-[#70282C] hover:underline hidden sm:block">Lihat Semua
                    Informasi →</a>
            </div>

            <!-- News Slider Container (Alpine.js) -->
            <div x-data="{
                currentSlide: 0,
                totalCards: {{ $latestInfos->count() }},
                get maxSlide() { return Math.max(0, this.totalCards - 1) }
            }">

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($latestInfos as $item)
                        <div class="bg-white dark:bg-slate-800 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 dark:border-slate-700 flex flex-col group"
                            data-aos="fade-up">

                            <!-- Foto Berita -->
                            <div class="h-48 overflow-hidden relative bg-slate-100">
                                @if ($item->photo)
                                    <img src="{{ asset('storage/' . $item->photo) }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center text-slate-400 text-xs italic">
                                        No Image</div>
                                @endif
                            </div>

                            <!-- Detail Content -->
                            <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                                <div class="space-y-2">
                                    <h3
                                        class="font-bold text-sm sm:text-base text-slate-900 dark:text-white line-clamp-2 group-hover:text-[#70282C] transition">
                                        {{ $item->title }}
                                    </h3>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-3 leading-relaxed">
                                        {{ strip_tags($item->description) }}
                                    </p>
                                </div>

                                <a href="#"
                                    class="inline-flex items-center gap-1.5 text-xs font-bold text-[#70282C] hover:opacity-80 pt-1">
                                    <span>Baca Selengkapnya</span>
                                    <svg class="size-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>

                        </div>
                    @empty
                        <div class="col-span-1 sm:col-span-3 text-center py-12 text-slate-400 text-xs">Belum ada informasi
                            dipublikasikan.</div>
                    @endforelse
                </div>

            </div>

        </div>
    </section>

    <!-- 5. SECTION KEGIATAN (Slide Card Slider) -->
    <section id="berita" class="py-16 sm:py-20 bg-slate-50/60 dark:bg-slate-900/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="flex items-end justify-between gap-4" data-aos="fade-up">
                <div>
                    <span class="text-xs font-bold text-[#70282C] uppercase tracking-wider block">Kegiatan</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white mt-1">Ekstrakurikuler & Kegiatan Sekolah
                    </h2>
                </div>
                <a href="#berita" class="text-xs font-bold text-[#70282C] hover:underline hidden sm:block">Lihat Semua
                    Kegiatan →</a>
            </div>

            <!-- Kegiatan Slider Container (Alpine.js) -->
            <div x-data="{
                currentSlide: 0,
                totalCards: {{ $activeExtracurricular->count() }},
                get maxSlide() { return Math.max(0, this.totalCards - 1) }
            }">

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($activeExtracurricular as $item)
                        <div class="bg-white dark:bg-slate-800 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 dark:border-slate-700 flex flex-col group"
                            data-aos="fade-up">

                            <!-- Foto Berita -->
                            <div class="h-48 overflow-hidden relative bg-slate-100">
                                @if ($item->logo)
                                    <img src="{{ asset('storage/' . $item->logo) }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center text-slate-400 text-xs italic">
                                        No Image</div>
                                @endif
                                <span
                                    class="absolute top-3 left-3 bg-[#70282C] text-white font-bold text-[10px] px-3 py-1 rounded-full shadow-sm">
                                    {{ $item->schedule }}
                                </span>
                            </div>

                            <!-- Detail Content -->
                            <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                                <div class="space-y-2">
                                    <h3
                                        class="font-bold text-sm sm:text-base text-slate-900 dark:text-white line-clamp-2 group-hover:text-[#70282C] transition">
                                        {{ $item->name }}
                                    </h3>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-3 leading-relaxed">
                                        {{ strip_tags($item->description) }}
                                    </p>
                                </div>

                                <a href="#"
                                    class="inline-flex items-center gap-1.5 text-xs font-bold text-[#70282C] hover:opacity-80 pt-1">
                                    <span>Lihat Selengkapnya</span>
                                    <svg class="size-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>

                        </div>
                    @empty
                        <div class="col-span-1 sm:col-span-3 text-center py-12 text-slate-400 text-xs">Belum ada kegiatan
                            ekstrakurikuler.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- 6. GOOGLE MAPS EMBED SECTION -->
    <section id="lokasi" class="py-16 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6" data-aos="fade-up">
            <div>
                <span class="text-xs font-bold text-[#70282C] uppercase tracking-wider block">Lokasi Sekolah</span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white mt-1">Peta Petunjuk Arah</h2>
            </div>

            <div
                class="rounded-3xl overflow-hidden shadow-lg border border-slate-100 dark:border-slate-800 h-[350px] sm:h-[420px]">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.811520625357!2d106.858414!3d-6.288506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f29828ec4b9d%3A0x8bbba9d287ef2282!2sSDN%20Gedong%2012%20Pagi!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                    class="w-full h-full border-0" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

</x-app-layout>
