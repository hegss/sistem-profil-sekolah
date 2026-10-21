<x-app-layout>
    <!-- 1. SECTION SEJARAH SEKOLAH -->
    <section id="sejarah" class="py-14 sm:py-22 bg-slate-50/60 dark:bg-slate-900/40 border-t border-slate-100 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">

                <!-- Foto Slider Sejarah Statis (Sisi Kiri - 3 Foto Carousel Rounded) -->
                <div class="lg:col-span-5" data-aos="fade-right">
                    <div class="relative bg-[#F4EBE8] dark:bg-slate-800 p-2.5 sm:p-3.5 rounded-[2.5rem] shadow-sm border border-rose-100/60 dark:border-slate-700/60"
                        x-data="{
                            activeSlide: 0,
                            images: [
                                '{{ asset('images/sejarah-1.jpg') }}',
                                '{{ asset('images/sejarah-2.jpg') }}',
                                '{{ asset('images/sejarah-3.jpg') }}'
                            ],
                            next() { this.activeSlide = (this.activeSlide + 1) % this.images.length },
                            prev() { this.activeSlide = (this.activeSlide - 1 + this.images.length) % this.images.length }
                        }"
                        x-init="setInterval(() => next(), 5000)">

                        <!-- Frame Slider Gambar Statis -->
                        <div class="relative h-[300px] sm:h-[400px] rounded-3xl overflow-hidden bg-slate-200">
                            <template x-for="(img, idx) in images" :key="idx">
                                <img :src="img"
                                    x-on:error="$event.target.src = 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=1200'"
                                    x-show="activeSlide === idx"
                                    x-transition:enter="transition ease-out duration-700"
                                    x-transition:enter-start="opacity-0 scale-105"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-500"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    class="absolute inset-0 w-full h-full object-cover">
                            </template>
                        </div>

                        <!-- Indikator Dots Controls -->
                        <div class="absolute bottom-5 right-5 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md px-3 py-1.5 rounded-full shadow-md flex items-center gap-2 border border-slate-100 dark:border-slate-800 z-10">
                            <button @click="prev()" class="text-slate-600 dark:text-slate-300 hover:text-[#70282C] transition p-0.5 focus:outline-none">
                                <svg class="size-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                            </button>

                            <div class="flex items-center gap-1.5 px-1">
                                <template x-for="(img, idx) in images" :key="idx">
                                    <button @click="activeSlide = idx"
                                            class="h-2 rounded-full transition-all duration-300 focus:outline-none"
                                            :class="activeSlide === idx ? 'w-5 bg-[#70282C]' : 'w-2 bg-slate-300 dark:bg-slate-600 hover:bg-slate-400'"></button>
                                </template>
                            </div>

                            <button @click="next()" class="text-slate-600 dark:text-slate-300 hover:text-[#70282C] transition p-0.5 focus:outline-none">
                                <svg class="size-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>

                    </div>
                </div>

                <!-- Teks Narasi Sejarah Statis (Sisi Kanan) -->
                <div class="lg:col-span-7 space-y-4 sm:space-y-6" data-aos="fade-left">
                    <div>
                        <span class="text-xs sm:text-sm font-bold text-[#70282C] dark:text-rose-400 uppercase tracking-widest block">
                            KILAS BALIK
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-black text-slate-900 dark:text-white mt-1">
                            Sejarah SDN Gedong 12
                        </h2>
                    </div>

                    <div class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed space-y-4 text-justify">
                        <p>
                            SDN Gedong 12 Pagi merupakan sekolah dasar negeri yang terletak di Jl. Raya Condet, Kelurahan GEDONG, Kecamatan PASAR REBO,
                            Kota JAKARTA TIMUR, Provinsi DKI JAKARTA. Sekolah ini memiliki luas tanah 7.857 meter persegi dan beroperasi dengan waktu
                            penyelenggaraan sehari penuh selama 5 hari. SDN Gedong 12 Pagi memiliki reputasi yang baik, terbukti dengan akreditasi A yang
                            diraih pada tanggal 27 November 2017 dengan nomor sertifikat 255/BAP-SM/DKI/2017. Sekolah ini juga dilengkapi dengan akses
                            internet dan menggunakan listrik PLN.
                        </p>
                        <p>
                            Sekolah ini di bawah naungan Pemerintah Daerah dan memiliki nomor SK Pendirian 1929 TAHUN 2013 yang diterbitkan pada tanggal 13-12-1984.
                            Nomor SK Operasional sekolah ini adalah 1929 TAHUN 2013 yang diterbitkan pada tanggal 01-01-1986.
                        </p>
                        <p>
                            SDN Gedong 12 Pagi memiliki komitmen untuk memberikan pendidikan berkualitas kepada para siswanya. Hal ini dibuktikan dengan
                            fasilitas yang memadai, tenaga pengajar yang profesional, dan program pembelajaran yang inovatif. Sekolah ini juga terbuka untuk
                            menerima siswa baru dengan berbagai latar belakang.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. SECTION VISI DAN MISI (Persis Gambar 10) -->
    <section class="pt-8 pb-16 sm:pb-24 bg-white dark:bg-slate-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 text-center" data-aos="fade-up">

            <!-- Category Title Maroon -->
            <span class="text-xs sm:text-sm font-bold text-[#70282C] dark:text-rose-400 uppercase tracking-widest block">
                VISI DAN MISI
            </span>

            <!-- Main Headline -->
            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 dark:text-white tracking-tight leading-tight max-w-3xl mx-auto">
                Pendidikan Generasi Berkualitas
            </h1>

            <!-- Teks Visi Misi Statis -->
            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed max-w-4xl mx-auto text-justify sm:text-center">
                SDN Gedong 12 memiliki visi untuk mewujudkan peserta didik yang berprestasi, berkarakter, berbudaya, berakhlak mulia, serta mampu menghadapi perkembangan zaman. Untuk mewujudkan visi tersebut, sekolah berkomitmen meningkatkan kualitas pembelajaran, menanamkan nilai-nilai karakter, mengembangkan potensi peserta didik dalam bidang akademik maupun nonakademik, menciptakan lingkungan sekolah yang aman, nyaman, bersih, dan berbudaya, serta meningkatkan kerja sama antara sekolah, orang tua, dan masyarakat.
            </p>
        </div>
    </section>

    <!-- 3. SECTION PIMPINAN SEKOLAH (Persis Gambar 11) -->
    <section class="py-16 bg-slate-50/50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-800">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 text-center" data-aos="fade-up">

            <div>
                <span class="text-xs sm:text-sm font-bold text-[#70282C] dark:text-rose-400 uppercase tracking-widest block">
                    PIMPINAN SEKOLAH
                </span>
                <h2 class="text-2xl sm:text-4xl font-black text-slate-900 dark:text-white mt-1">
                    Kepala Sekolah dan Wakil
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">

                <!-- Card Kepala Sekolah -->
                <div class="space-y-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="bg-[#F4EBE8] dark:bg-slate-800 p-3 sm:p-4 rounded-[2.5rem] border border-rose-100/60 dark:border-slate-700/60 shadow-sm">
                        <div class="h-[320px] sm:h-[400px] rounded-3xl overflow-hidden bg-slate-200">
                            @if ($headmaster && $headmaster->photo)
                                <img src="{{ asset('storage/' . $headmaster->photo) }}" class="w-full h-full object-cover">
                            @else
                                <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=800" class="w-full h-full object-cover">
                            @endif
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg sm:text-xl font-black text-slate-900 dark:text-white">
                            {{ $headmaster->name ?? 'Kepala Sekolah' }}
                        </h3>
                        <p class="text-xs font-bold text-[#70282C] dark:text-rose-400">
                            {{ $headmaster->position ?? 'Kepala Sekolah' }}
                        </p>
                    </div>
                </div>

                <!-- Card Wakil Kepala Sekolah -->
                <div class="space-y-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="bg-[#F4EBE8] dark:bg-slate-800 p-3 sm:p-4 rounded-[2.5rem] border border-rose-100/60 dark:border-slate-700/60 shadow-sm">
                        <div class="h-[320px] sm:h-[400px] rounded-3xl overflow-hidden bg-slate-200">
                            @if ($viceheadmaster && $viceheadmaster->photo)
                                <img src="{{ asset('storage/' . $viceheadmaster->photo) }}" class="w-full h-full object-cover">
                            @else
                                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=800" class="w-full h-full object-cover">
                            @endif
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg sm:text-xl font-black text-slate-900 dark:text-white">
                            {{ $viceheadmaster->name ?? 'Wakil Kepala Sekolah' }}
                        </h3>
                        <p class="text-xs font-bold text-[#70282C] dark:text-rose-400">
                            {{ $viceheadmaster->position ?? 'Wakil Kepala Sekolah' }}
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- 4. SECTION TENAGA PENDIDIK / GURU (Persis Gambar 12) -->
    <section class="py-16 sm:py-24 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 text-center" data-aos="fade-up">

            <div>
                <span class="text-xs sm:text-sm font-bold text-[#70282C] dark:text-rose-400 uppercase tracking-widest block">
                    TENAGA PENDIDIK
                </span>
                <h2 class="text-2xl sm:text-4xl font-black text-slate-900 dark:text-white mt-1">
                    Tenaga Pendidik SDN Gedong 12
                </h2>
            </div>

            <!-- Grid Guru 6 Kolom di Desktop (Sesuai Layout Gambar 12) -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 sm:gap-6">
                @forelse ($teachers as $teacher)
                    <div class="space-y-3 group" data-aos="fade-up">
                        <div class="bg-[#F4EBE8] dark:bg-slate-800 p-2 sm:p-3 rounded-[2rem] border border-rose-100/60 dark:border-slate-700/60 shadow-sm transition-transform duration-300 group-hover:-translate-y-1">
                            <div class="h-[180px] sm:h-[220px] rounded-2xl overflow-hidden bg-slate-200">
                                @if ($teacher->photo)
                                    <img src="{{ asset('storage/' . $teacher->photo) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-400 font-bold text-xs">
                                        {{ strtoupper(substr($teacher->name, 0, 2)) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div>
                            <h4 class="text-xs sm:text-sm font-black text-slate-900 dark:text-white line-clamp-1">
                                {{ $teacher->name }}
                            </h4>
                            <p class="text-[10px] sm:text-xs font-semibold text-[#70282C] dark:text-rose-400 line-clamp-1">
                                {{ $teacher->position ?? 'Guru Kelas' }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-slate-400 text-xs italic">
                        Belum ada data guru yang terdaftar.
                    </div>
                @endforelse
            </div>

        </div>
    </section>

</x-app-layout>
