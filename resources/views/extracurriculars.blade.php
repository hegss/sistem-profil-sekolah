<x-app-layout>
    <!-- HEADER SECTION -->
    <section class="pt-8 pb-12 sm:pb-16 bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3" data-aos="fade-up">
            <span class="text-xs sm:text-sm font-bold text-[#70282C] dark:text-rose-400 uppercase tracking-widest block">
                KEGIATAN SISWA
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 dark:text-white tracking-tight">
                Ekstrakurikuler SDN Gedong 12
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Wadah pengembangan bakat, minat, kreativitas, serta pembentukan karakter siswa di luar kegiatan akademis harian.
            </p>
        </div>
    </section>

    <!-- GRID CARDS EKSTRAKURIKULER -->
    <section class="py-12 sm:py-20 bg-slate-50/50 dark:bg-slate-900/50 min-h-[60vh]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                @forelse ($extracurriculars as $ekskul)
                    @php
                        // Mempersiapkan array foto slider per ekstrakurikuler
                        $galleryImages = [];

                        // 1. Cek jika ada relasi photos
                        if (isset($ekskul->photos) && $ekskul->photos->isNotEmpty()) {
                            foreach ($ekskul->photos as $p) {
                                $path = $p->photos;
                                if ($path) $galleryImages[] = asset('storage/' . $path);
                            }
                        }

                        // 2. Cek foto tunggal jika ada di atribut model
                        if (empty($galleryImages)) {
                            $singleFoto = $ekskul->photos;
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

                            <!-- Carousel Dots Controls -->
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

                        <!-- Info Nama, Jadwal, Pembina & Mentor -->
                        <div class="space-y-2">
                            <div>
                                <h3 class="text-lg sm:text-xl font-black text-slate-900 dark:text-white">
                                    {{ $ekskul->name ?? $ekskul->nama_ekskul }}
                                </h3>
                                <p class="text-xs sm:text-sm font-bold text-[#70282C] dark:text-rose-400 mt-0.5">
                                    {{ $ekskul->schedule ?? $ekskul->jadwal ?? 'Jadwal belum diatur' }}
                                </p>
                            </div>

                            <!-- Detail Pembina, Mentor & Telepon -->
                            @php
                                $mentorName = $ekskul->mentor_name ?? null;
                                $phone = $ekskul->mentor_phone ?? $ekskul->pembina_phone ?? $ekskul->no_telp ?? null;

                                $cleanPhone = $phone ? preg_replace('/[^0-9]/', '', $phone) : null;
                                if ($cleanPhone && str_starts_with($cleanPhone, '0')) {
                                    $cleanPhone = '62' . substr($cleanPhone, 1);
                                }
                            @endphp

                            @if($mentorName || $phone)
                                <div class="pt-2.5 border-t border-slate-200/60 dark:border-slate-700/60 flex flex-col items-center gap-1.5 text-xs">

                                    <!-- Pembina / Mentor -->
                                    <div class="flex flex-wrap items-center justify-center gap-x-2 gap-y-0.5 text-slate-600 dark:text-slate-300">

                                        @if($mentorName)
                                            <span class="inline-flex items-center gap-1 font-medium">
                                                <span class="text-slate-300 dark:text-slate-600">•</span>
                                                <span>Mentor: <strong class="text-slate-900 dark:text-white">{{ $mentorName }}</strong></span>
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Tombol WhatsApp / Telepon -->
                                    @if($phone && $cleanPhone)
                                        <a href="https://wa.me/{{ $cleanPhone }}?text=Halo,%20saya%20ingin%20bertanya%20mengenai%20ekstrakurikuler%20{{ urlencode($ekskul->name ?? $ekskul->nama_ekskul) }}"
                                           target="_blank"
                                           class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 hover:bg-emerald-100 font-semibold text-[11px] border border-emerald-200/60 dark:border-emerald-800/50 transition">
                                            <svg class="size-3.5 fill-current" viewBox="0 0 24 24">
                                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                                            </svg>
                                            <span>{{ $phone }}</span>
                                        </a>
                                    @endif

                                </div>
                            @endif

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
