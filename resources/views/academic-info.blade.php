<x-app-layout>

    <!-- HEADER SECTION -->
    <section class="pt-8 pb-12 sm:pb-16 bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3" data-aos="fade-up">
            <span class="text-xs sm:text-sm font-bold text-[#70282C] dark:text-rose-400 uppercase tracking-widest block">
                LAYANAN PENDIDIKAN
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 dark:text-white tracking-tight">
                Informasi Akademik & PPDB
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Panduan kurikulum, kalender akademik, tata cara pendaftaran siswa baru, dan berkas informasi penting SDN Gedong 12.
            </p>
        </div>
    </section>

    <!-- SECTION KURIKULUM & PENGUMUMAN -->
    <section class="py-12 sm:py-20 bg-slate-50/50 dark:bg-slate-900/50 min-h-[60vh]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 sm:space-y-16">

            <!-- 1. CARD HIGHLIGHT KURIKULUM & KALENDER -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8" data-aos="fade-up">

                <!-- Kurikulum Card -->
                <div class="bg-[#F4EBE8] dark:bg-slate-800 p-6 sm:p-8 rounded-[2.5rem] border border-rose-100/60 dark:border-slate-700/60 space-y-4 shadow-sm">
                    <div class="size-12 rounded-2xl bg-[#70282C] text-white flex items-center justify-center shadow-md">
                        <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div>
                        <h2 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white">Kurikulum Merdeka</h2>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mt-2 leading-relaxed">
                            SDN Gedong 12 menerapkan Kurikulum Merdeka yang berfokus pada pengembangan karakter Profil Pelajar Pancasila, pembelajaran intrakurikuler yang beragam, serta penguatan literasi dan numerasi peserta didik.
                        </p>
                    </div>
                </div>

                <!-- Jam Belajar Card -->
                <div class="bg-[#F4EBE8] dark:bg-slate-800 p-6 sm:p-8 rounded-[2.5rem] border border-rose-100/60 dark:border-slate-700/60 space-y-4 shadow-sm">
                    <div class="size-12 rounded-2xl bg-[#70282C] text-white flex items-center justify-center shadow-md">
                        <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white">Waktu Pembelajaran</h2>
                        <div class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mt-2 space-y-1">
                            <p><strong>Senin – Kamis:</strong> 06.30 – 12.10 WIB</p>
                            <p><strong>Jumat:</strong> 06.30 – 11.30 WIB (Kegiatan Imtaq & Senam)</p>
                            <p><strong>Sabtu:</strong> Kegiatan Ekstrakurikuler Wajib/Pilihan</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- 2. GRID PENGUMUMAN AKADEMIK & PPDB -->
            <div class="space-y-6">
                <div class="flex items-center justify-between" data-aos="fade-up">
                    <div>
                        <span class="text-xs font-bold text-[#70282C] dark:text-rose-400 uppercase tracking-widest block">BERKAS & EDARAN</span>
                        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white mt-1">Pengumuman Akademik Terbaru</h2>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($academicInfos as $item)
                        <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between space-y-4 group" data-aos="fade-up">
                            <div class="space-y-3">
                                <span class="bg-rose-50 dark:bg-slate-700 text-[#70282C] dark:text-rose-300 font-bold text-[10px] px-3 py-1 rounded-full inline-block">
                                    {{ isset($item->publish_date) ? $item->publish_date->format('d M Y') : 'Informasi' }}
                                </span>
                                <h3 class="font-black text-slate-900 dark:text-white text-base group-hover:text-[#70282C] transition line-clamp-2">
                                    {{ $item->title }}
                                </h3>
                                <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-3 leading-relaxed">
                                    {{ strip_tags($item->description ?? 'Informasi edaran resmi dari pihak manajemen SDN Gedong 12.') }}
                                </p>
                            </div>

                            <div class="pt-3 border-t border-slate-100 dark:border-slate-700/60">
                                <a href="#" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#70282C] dark:text-rose-400 hover:opacity-80">
                                    <span>Lihat Detail Pengumuman</span>
                                    <svg class="size-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center text-slate-400 text-xs italic">
                            Belum ada pengumuman akademik dipublikasikan.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
