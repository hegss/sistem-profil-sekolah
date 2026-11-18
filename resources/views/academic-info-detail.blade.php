<x-app-layout>
    <section class="pt-8 pb-20 bg-slate-50/50 dark:bg-slate-900/50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8" data-aos="fade-up">

            <!-- Breadcrumb Navigation -->
            <nav class="flex items-center gap-2 text-xs text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-[#70282C]">Beranda</a>
                <span>/</span>
                <a href="{{ route('academic-infos') }}" class="hover:text-[#70282C]">Info Akademik</a>
                <span>/</span>
                <span class="text-slate-900 dark:text-white font-semibold truncate">{{ $infos->title }}</span>
            </nav>

            <!-- Header Berita -->
            <div class="space-y-3">
                <span
                    class="inline-block px-3 py-1 rounded-full bg-rose-100 dark:bg-slate-800 text-[#70282C] dark:text-rose-400 text-xs font-bold">
                    {{ isset($infos->publish_date) ? $infos->publish_date : 'Berita Sekolah' }}
                </span>
                <h1 class="text-2xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight leading-tight">
                    {{ $infos->title }}
                </h1>
            </div>

            <!-- Banner Utama Berita -->
            @if ($infos->photo)
                <div class="rounded-3xl overflow-hidden shadow-lg h-[280px] sm:h-[420px] bg-slate-200">
                    <img src="{{ Storage::url($infos->photo) }}" class="w-full h-full object-cover">
                </div>
            @endif

            <!-- Isi Lengkap Berita -->
            <div
                class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-10 border border-slate-100 dark:border-slate-700 shadow-sm space-y-4 text-xs sm:text-sm text-slate-700 dark:text-slate-200 leading-relaxed text-justify">
                {!! nl2br(e($infos->description)) !!}

                <a href="{{ $infos->info_link }}" target="_blank" rel="noopener noreferrer"
                    class="mt-4 text-rose-500 hover:text-rose-700 dark:text-rose-400 dark:hover:text-rose-300 font-bold text-sm flex items-center gap-1">
                    Telurusi
                    <svg class="size-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>

            <!-- Tombol Kembali -->
            <div class="pt-4">
                <a href="{{ route('academic-infos') }}"
                    class="inline-flex items-center gap-2 text-xs font-bold text-[#70282C] dark:text-rose-400 hover:underline">
                    ← Kembali ke Daftar Berita
                </a>
            </div>

        </div>
    </section>

</x-app-layout>
