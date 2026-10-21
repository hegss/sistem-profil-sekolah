<x-app-layout>
    <section class="pt-8 pb-20 bg-slate-50/50 dark:bg-slate-900/50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8" data-aos="fade-up">
            
            <!-- Breadcrumb Navigation -->
            <nav class="flex items-center gap-2 text-xs text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-[#70282C]">Beranda</a>
                <span>/</span>
                <a href="{{ route('home-news.index') }}" class="hover:text-[#70282C]">Berita</a>
                <span>/</span>
                <span class="text-slate-900 dark:text-white font-semibold truncate">{{ $news->title }}</span>
            </nav>

            <!-- Header Berita -->
            <div class="space-y-3">
                <span class="inline-block px-3 py-1 rounded-full bg-rose-100 dark:bg-slate-800 text-[#70282C] dark:text-rose-400 text-xs font-bold">
                    {{ isset($news->publish_date) ? $news->publish_date->format('d F Y') : 'Berita Sekolah' }}
                </span>
                <h1 class="text-2xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight leading-tight">
                    {{ $news->title }}
                </h1>
            </div>

            <!-- Banner Utama Berita -->
            @if($news->photo)
                <div class="rounded-3xl overflow-hidden shadow-lg h-[280px] sm:h-[420px] bg-slate-200">
                    <img src="{{ asset('storage/' . $news->photo) }}" class="w-full h-full object-cover">
                </div>
            @endif

            <!-- Isi Lengkap Berita -->
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-10 border border-slate-100 dark:border-slate-700 shadow-sm space-y-4 text-xs sm:text-sm text-slate-700 dark:text-slate-200 leading-relaxed text-justify">
                {!! nl2br(e($news->description)) !!}
            </div>

            <!-- Tombol Kembali -->
            <div class="pt-4">
                <a href="{{ route('home-news.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-[#70282C] dark:text-rose-400 hover:underline">
                    ← Kembali ke Daftar Berita
                </a>
            </div>

        </div>
    </section>

</x-app-layout>