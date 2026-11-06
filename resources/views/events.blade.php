<x-app-layout>

    <!-- HEADER SECTION -->
    <section class="pt-8 pb-0 sm:pt-12 bg-slate-50/50 dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3" data-aos="fade-up">
            <span class="text-xs sm:text-sm font-bold text-[#70282C] dark:text-rose-400 uppercase tracking-widest block">
                AKTIVITAS SEKOLAH
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 dark:text-white tracking-tight">
                Kegiatan SDN Gedong 12
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Rangkaian agenda, peringatan hari besar, upacara, karya wisata, serta berbagai aktivitas edukatif warga
                sekolah.
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
                                $path = $p->photos;
                                if ($path) {
                                    $galleryImages[] = asset('storage/' . $path);
                                }
                            }
                        }

                        // 2. Cek foto tunggal jika ada di atribut model
                        if (empty($galleryImages)) {
                            $singleFoto = $event->foto ?? ($event->foto_ekskul ?? $event->image);
                            if ($singleFoto) {
                                $galleryImages[] = asset('storage/' . $singleFoto);
                            }
                        }

                        // 3. Fallback gambar placeholder jika belum ada foto
                        if (empty($galleryImages)) {
                            $galleryImages = [
                                'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=800',
                                'https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=800',
                            ];
                        }
                    @endphp

                    <!-- Card Item Acara Sekolah -->
                    <div class="w-[300px] sm:w-[340px] shrink-0 snap-start space-y-4 text-center group"
                        data-aos="fade-up">

                        <!-- Outer Frame Card (#F4EBE8) -->
                        <div class="relative bg-[#F4EBE8] dark:bg-slate-800 p-3 sm:p-4 rounded-[2.5rem] border border-rose-100/60 dark:border-slate-700/60 shadow-sm"
                            x-data="{
                                cardSlide: 0,
                                imgs: @js($galleryImages),
                                nextImg() { if (this.imgs.length) this.cardSlide = (this.cardSlide + 1) % this.imgs.length },
                                prevImg() { if (this.imgs.length) this.cardSlide = (this.cardSlide - 1 + this.imgs.length) % this.imgs.length }
                            }" x-init="if (imgs.length > 1) setInterval(() => nextImg(), 5000)">

                            <!-- Inner Frame Image -->
                            <div class="relative h-[260px] sm:h-[300px] rounded-3xl overflow-hidden bg-slate-200">
                                <template x-for="(img, idx) in imgs" :key="idx">
                                    <img :src="img"
                                        x-on:error="$event.target.src = 'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=800'"
                                        x-show="cardSlide === idx" x-transition:enter="transition ease-out duration-700"
                                        x-transition:enter-start="opacity-0 scale-105"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-500"
                                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                        class="absolute inset-0 w-full h-full object-cover">
                                </template>
                            </div>

                            <!-- Carousel Dots Controls di Gambar Card -->
                            <div x-show="imgs.length > 1"
                                class="absolute bottom-6 right-6 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md px-3 py-1.5 rounded-full shadow-md flex items-center gap-2 border border-slate-100 dark:border-slate-800 z-10">
                                <button @click="prevImg()" type="button"
                                    class="text-slate-600 dark:text-slate-300 hover:text-[#70282C] transition p-0.5 focus:outline-none">
                                    <svg class="size-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>

                                <div class="flex items-center gap-1.5 px-1">
                                    <template x-for="(img, idx) in imgs" :key="idx">
                                        <button @click="cardSlide = idx" type="button"
                                            class="h-2 rounded-full transition-all duration-300 focus:outline-none"
                                            :class="cardSlide === idx ? 'w-5 bg-[#70282C]' :
                                                'w-2 bg-slate-300 dark:bg-slate-600 hover:bg-slate-400'"></button>
                                    </template>
                                </div>

                                <button @click="nextImg()" type="button"
                                    class="text-slate-600 dark:text-slate-300 hover:text-[#70282C] transition p-0.5 focus:outline-none">
                                    <svg class="size-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>

                        </div>

                        <!-- Info Acara Sekolah dengan Fitur Expand Deskripsi -->
                        <div class="space-y-2" x-data="{ expanded: false }">
                            <div>
                                <h3 class="text-lg sm:text-xl font-black text-slate-900 dark:text-white line-clamp-1">
                                    {{ $event->name }}
                                </h3>
                                <p
                                    class="text-xs sm:text-sm font-bold text-[#70282C] dark:text-rose-400 mt-0.5 line-clamp-1">
                                    {{ $event->schedule ?? 'Jadwal belum diatur' }}
                                </p>
                            </div>
                            <div>
                                <!-- Teks Deskripsi (Terpotong 3 Baris Secara Default, Lengkap Saat Diganti State expanded) -->
                                <p class="text-xs sm:text-sm text-justify text-slate-600 dark:text-slate-300 transition-all duration-300 leading-relaxed"
                                    :class="expanded ? '' : 'line-clamp-3'">
                                    {{ $event->description }}
                                </p>

                                <!-- Tombol Expand / Toggle Panah Bawah/Atas -->
                                @if (strlen($event->description ?? '') > 100)
                                    <button @click="expanded = !expanded" type="button"
                                        class="mt-2 inline-flex items-center gap-1 text-xs font-bold text-[#70282C] dark:text-rose-400 hover:underline focus:outline-none">
                                        <span x-text="expanded ? 'Sembunyikan' : 'Selengkapnya'"></span>
                                        <svg class="size-3.5 transition-transform duration-300"
                                            :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
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
