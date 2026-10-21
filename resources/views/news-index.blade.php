<x-app-layout>
    
    <!-- HEADER SECTION -->
    <section class="pt-8 pb-12 sm:pb-16 bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4" data-aos="fade-up">
            <span class="text-xs sm:text-sm font-bold text-[#70282C] dark:text-rose-400 uppercase tracking-widest block">
                KABAR SEKOLAH
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 dark:text-white tracking-tight">
                Berita & Artikel Terkini
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Informasi seputar prestasi, artikel edukatif, kegiatan siswa, serta pengumuman resmi warga SDN Gedong 12.
            </p>

            <!-- Form Pencarian Berita -->
            <form action="{{ route('home-news.index') }}" method="GET" class="max-w-md mx-auto pt-2">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari judul berita atau pengumuman..." 
                           class="w-full pl-4 pr-10 py-2.5 rounded-lg text-xs bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-[#70282C] dark:focus:border-rose-400 text-slate-800 dark:text-white">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-[#70282C]">
                        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- GRID DAFTAR BERITA -->
    <section class="py-12 sm:py-20 bg-slate-50/50 dark:bg-slate-900/50 min-h-[60vh]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($allNews as $news)
                    <div class="bg-white dark:bg-slate-800 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 dark:border-slate-700 flex flex-col group" data-aos="fade-up">
                        
                        <!-- Gambar Berita -->
                        <div class="h-48 overflow-hidden relative bg-slate-100 dark:bg-slate-700">
                            @if($news->photo)
                                <img src="{{ asset('storage/' . $news->photo) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400 text-xs italic">No Image</div>
                            @endif
                            <span class="absolute top-3 left-3 bg-[#70282C] text-white font-bold text-[10px] px-3 py-1 rounded-full shadow-sm">
                                {{ isset($news->publish_date) ? $news->publish_date->format('d M Y') : 'Pengumuman' }}
                            </span>
                        </div>

                        <!-- Isi Konten Singkat -->
                        <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                            <div class="space-y-2">
                                <h3 class="font-bold text-sm sm:text-base text-slate-900 dark:text-white line-clamp-2 group-hover:text-[#70282C] dark:group-hover:text-rose-400 transition">
                                    {{ $news->title }}
                                </h3>
                                <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-3 leading-relaxed">
                                    {{ strip_tags($news->description) }}
                                </p>
                            </div>

                            <div class="pt-2 border-t border-slate-100 dark:border-slate-700/60">
                                <a href="{{ route('home-news.detail', $news->id) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#70282C] dark:text-rose-400 hover:opacity-80">
                                    <span>Baca Selengkapnya</span>
                                    <svg class="size-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-slate-400 text-xs sm:text-sm italic">
                        Tidak ada berita atau artikel yang ditemukan.
                    </div>
                @endforelse
            </div>

            <!-- Pagination Links -->
            <div class="pt-4">
                {{ $allNews->links() }}
            </div>

        </div>
    </section>

</x-app-layout>