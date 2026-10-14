<x-app-layout>

    <!-- HEADER SECTION -->
    <section class="pt-8 pb-12 sm:pb-16 bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3" data-aos="fade-up">
            <span class="text-xs sm:text-sm font-bold text-[#70282C] dark:text-rose-400 uppercase tracking-widest block">
                AKTIVITAS SEKOLAH
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 dark:text-white tracking-tight">
                Kegiatan SDN Gedong 12
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Rangkaian agenda, peringatan hari besar, upacara, karya wisata, serta berbagai aktivitas edukatif warga sekolah.
            </p>
        </div>
    </section>

    <!-- GRID CARDS EKSTRAKURIKULER (Persis Gambar Rujukan) -->
    <section class="py-12 sm:py-20 bg-slate-50/50 dark:bg-slate-900/50 min-h-[60vh]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                @forelse ($events as $event)
                    @php
                        // Mempersiapkan array foto slider per ekstrakurikuler
                        $galleryImages = [];

                        // 1. Cek jika ada relasi photos
                        if (isset($event->photos) && $event->photos->isNotEmpty()) {
                            foreach ($event->photos as $p) {
                                $path = $p->foto_path ?? $p->foto ?? $p->path;
                                if ($path) $galleryImages[] = asset('storage/' . $path);
                            }
                        }

                        // 2. Cek foto tunggal jika ada di atribut model
                        if (empty($galleryImages)) {
                            $singleFoto = $event->foto ?? $event->foto_ekskul ?? $event->image;
                            if ($singleFoto) {
                                $galleryImages[] = asset('storage/' . $singleFoto);
                            }
                        }

                        // 3. Fallback gambar placeholder jika belum ada foto
                        if (empty($galleryImages)) {
                            $galleryImages = [
                                'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=800',
                                'https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=800'
                            ];
                        }
                    @endphp

                    <!-- Card Item Ekstrakurikuler -->
                    <div class="space-y-4 text-center group" data-aos="fade-up">

                        <!-- Outer Frame Card (#F4EBE8) -->
                        <div class="relative bg-[#F4EBE8] dark:bg-slate-800 p-3 sm:p-4 rounded-[2.5rem] border border-rose-100/60 dark:border-slate-700/60 shadow-sm"
                             x-data="{
                                 activeSlide: 0,
                                 images: {{ json_encode($galleryImages) }},
                                 next() { if(this.images.length) this.activeSlide = (this.activeSlide + 1) % this.images.length },
                                 prev() { if(this.images.length) this.activeSlide = (this.activeSlide - 1 + this.images.length) % this.images.length }
                             }"
                             x-init="if(images.length > 1) setInterval(() => next(), 6000)">

                            <!-- Inner Frame Image Container -->
                            <div class="relative h-[280px] sm:h-[340px] rounded-3xl overflow-hidden bg-slate-200">
                                <template x-for="(img, idx) in images" :key="idx">
                                    <img :src="img"
                                         x-on:error="$event.target.src = 'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=800'"
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

                            <!-- Carousel Dots Controls (Persis Posisi Kanan Bawah Gambar) -->
                            <template x-if="images.length > 1">
                                <div class="absolute bottom-6 right-6 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md px-3 py-1.5 rounded-full shadow-md flex items-center gap-2 border border-slate-100 dark:border-slate-800 z-10">
                                    <button @click="prev()" type="button" class="text-slate-600 dark:text-slate-300 hover:text-[#70282C] transition p-0.5 focus:outline-none">
                                        <svg class="size-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </button>

                                    <div class="flex items-center gap-1.5 px-1">
                                        <template x-for="(img, idx) in images" :key="idx">
                                            <button @click="activeSlide = idx"
                                                    type="button"
                                                    class="h-2 rounded-full transition-all duration-300 focus:outline-none"
                                                    :class="activeSlide === idx ? 'w-5 bg-[#70282C]' : 'w-2 bg-slate-300 dark:bg-slate-600 hover:bg-slate-400'"></button>
                                        </template>
                                    </div>

                                    <button @click="next()" type="button" class="text-slate-600 dark:text-slate-300 hover:text-[#70282C] transition p-0.5 focus:outline-none">
                                        <svg class="size-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </div>
                            </template>

                        </div>

                        <!-- Info Nama & Jadwal (Persis Gambar Rujukan) -->
                        <div class="space-y-1">
                            <h3 class="text-lg sm:text-xl font-black text-slate-900 dark:text-white">
                                {{ $event->name }}
                            </h3>
                            <p class="text-xs sm:text-sm font-bold text-[#70282C] dark:text-rose-400">
                                {{ $event->schedule }}
                            </p>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-slate-400 text-xs sm:text-sm italic">
                        Belum ada data kegiatan ekstrakurikuler yang terdaftar.
                    </div>
                @endforelse
            </div>

        </div>
    </section>

</x-app-layout>
