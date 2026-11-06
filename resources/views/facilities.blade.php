<x-app-layout>

    <!-- HEADER SECTION -->
    <section class="pt-8 bg-slate-50/50 dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3" data-aos="fade-up">
            <span class="text-xs sm:text-sm font-bold text-[#70282C] dark:text-rose-400 uppercase tracking-widest block">
                SARANA & PRASARANA
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 dark:text-white tracking-tight">
                Fasilitas SDN Gedong 12
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Sarana penunjang kegiatan belajar mengajar yang aman, nyaman, dan modern untuk mendukung potensi siswa secara optimal.
            </p>
        </div>
    </section>

    <!-- GRID CARDS FASILITAS -->
    <section class="py-12 sm:py-20 bg-slate-50/50 dark:bg-slate-900/50 min-h-[60vh]" x-data="{ detailModalOpen: false, selectedFacility: null }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                @forelse ($facilities as $facility)
                    @php
                        $foto = $facility->photos->first()?->photos; // Ambil foto pertama dari relasi photos
                        $fotoPath = $foto ? asset('storage/' . $foto) : 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=800';
                    @endphp

                    <!-- Card Item Fasilitas -->
                    <div class="space-y-4 group flex flex-col justify-between" data-aos="fade-up">

                        <!-- Outer Frame Card (#F4EBE8) -->
                        <div class="relative bg-[#F4EBE8] dark:bg-slate-800 p-3 sm:p-4 rounded-[2.5rem] border border-rose-100/60 dark:border-slate-700/60 shadow-sm transition duration-300 group-hover:shadow-md">

                            <!-- Inner Frame Image -->
                            <div class="relative h-[240px] sm:h-[280px] rounded-3xl overflow-hidden bg-slate-200">
                                <img src="{{ $fotoPath }}"
                                     alt="{{ $facility->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                                @if($facility->lokasi)
                                    <span class="absolute top-4 left-4 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md text-slate-800 dark:text-white font-bold text-[10px] px-3 py-1.5 rounded-full shadow-sm border border-slate-100 dark:border-slate-800 flex items-center gap-1">
                                        <svg class="size-3 text-[#70282C] dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        <span>{{ $facility->location }}</span>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <!-- Info Nama & Deskripsi Fasilitas -->
                        <div class="space-y-2 px-2 text-center">
                            <h3 class="text-lg sm:text-xl font-black text-slate-900 dark:text-white group-hover:text-[#70282C] dark:group-hover:text-rose-400 transition">
                                {{ $facility->name }}
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 line-clamp-2 leading-relaxed">
                                {{ strip_tags($facility->description) }}
                            </p>

                            <div class="pt-2">
                                <button @click="selectedFacility = {{ json_encode($facility) }}; selectedFacility.fotoUrl = '{{ $fotoPath }}'; detailModalOpen = true"
                                        type="button"
                                        class="inline-flex items-center gap-1 text-xs font-bold text-[#70282C] dark:text-rose-400 hover:underline">
                                    <span>Detail Fasilitas</span>
                                    <svg class="size-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </button>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-slate-400 text-xs sm:text-sm italic">
                        Belum ada informasi fasilitas yang ditambahkan.
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($facilities->hasPages())
                <div class="pt-4">
                    {{ $facilities->links() }}
                </div>
            @endif

        </div>

        <!-- MODAL DETAIL FASILITAS -->
        <div x-show="detailModalOpen"
             x-transition
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
             x-cloak>
            <div @click.away="detailModalOpen = false" class="bg-white dark:bg-slate-800 rounded-3xl max-w-lg w-full p-6 space-y-5 border border-slate-100 dark:border-slate-700 shadow-2xl">
                <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-700 pb-3">
                    <h3 class="font-black text-slate-900 dark:text-white text-base" x-text="selectedFacility?.nama_fasilitas"></h3>
                    <button @click="detailModalOpen = false" class="text-slate-400 hover:text-slate-600">✕</button>
                </div>

                <template x-if="selectedFacility">
                    <div class="space-y-4 text-xs">
                        <!-- Frame Gambar Modal -->
                        <div class="h-56 rounded-2xl overflow-hidden bg-slate-100">
                            <img :src="selectedFacility.fotoUrl" class="w-full h-full object-cover">
                        </div>

                        <div class="flex items-center justify-between bg-[#F4EBE8] dark:bg-slate-700/50 p-3 rounded-2xl text-slate-700 dark:text-slate-200">
                            <span class="font-bold">Lokasi / Area:</span>
                            <span class="font-semibold text-[#70282C] dark:text-rose-400" x-text="selectedFacility.location || 'Lingkungan Sekolah'"></span>
                        </div>

                        <div>
                            <span class="text-slate-400 block text-[10px] mb-1">Deskripsi Lengkap:</span>
                            <p class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-700 text-slate-700 dark:text-slate-200 leading-relaxed whitespace-pre-line text-justify" x-text="selectedFacility.description"></p>
                        </div>
                    </div>
                </template>

                <div class="pt-2 flex justify-end">
                    <button @click="detailModalOpen = false" class="px-5 py-2 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold text-xs hover:bg-slate-200">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
