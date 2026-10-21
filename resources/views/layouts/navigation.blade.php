<!-- FLOATING NAVBAR WITH SCROLL DETECTION -->
<header class="fixed top-4 inset-x-0 z-50 px-4 sm:px-6 lg:px-8"
        x-data="{
            scrolled: false,
            mobileMenuOpen: false
        }"
        @scroll.window="scrolled = (window.pageYOffset > 20)"
        x-init="scrolled = (window.pageYOffset > 20)">

    <div class="max-w-7xl mx-auto rounded-2xl sm:rounded-3xl transition-all duration-300"
         :class="scrolled
            ? 'bg-white/95 dark:bg-slate-900/95 backdrop-blur-md shadow-lg border border-slate-100/80 dark:border-slate-800'
            : 'bg-transparent border border-transparent shadow-none'">

        <div class="px-5 sm:px-7 h-16 sm:h-20 flex items-center justify-between gap-4">

            <!-- Logo & Title Sekolah (Sisi Kiri) -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
                <x-application-logo class="size-10 sm:size-11 object-contain group-hover:scale-105 transition-transform" />
                <div>
                    <span class="block font-bold text-base sm:text-lg transition-colors duration-300 leading-tight"
                          :class="scrolled ? 'text-slate-900 dark:text-white' : 'text-slate-900 dark:text-white drop-shadow-sm'">
                        SDN Gedong 12
                    </span>
                    <span class="block text-[10px] sm:text-xs transition-colors duration-300"
                          :class="scrolled ? 'text-slate-500 dark:text-slate-400' : 'text-slate-600 dark:text-slate-300'">
                        Pasar Rebo, Jakarta Timur
                    </span>
                </div>
            </a>

            <!-- Desktop Menu (Sisi Kanan) -->
            <nav class="hidden lg:flex items-center gap-6 xl:gap-8 text-xs sm:text-sm font-medium transition-colors duration-300"
                 :class="scrolled ? 'text-slate-700 dark:text-slate-200' : 'text-slate-800 dark:text-slate-100'">

                <!-- 1. Beranda -->
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-rose-900 dark:text-rose-400 font-bold' : 'hover:text-rose-900 dark:hover:text-rose-400' }} hover:opacity-80 transition">
                    Beranda
                </a>

                <!-- 2. Profil -->
                <a href="{{ route('school-profile') }}" class="{{ request()->routeIs('school-profile') ? 'text-rose-900 dark:text-rose-400 font-bold' : 'hover:text-rose-900 dark:hover:text-rose-400' }} hover:opacity-80 transition">
                    Profil
                </a>

                <!-- 3. Dropdown Kegiatan -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center gap-1 {{ request()->routeIs('extracurriculars', 'events') ? 'text-rose-900 dark:text-rose-400 font-bold' : 'hover:text-rose-900 dark:hover:text-rose-400' }} transition py-2 focus:outline-none">
                        <span>Kegiatan</span>
                        <svg class="size-3.5 transition-transform duration-200" :class="open ? 'rotate-180 text-rose-900' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-cloak
                         class="absolute top-full left-0 w-52 bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 py-2 z-50">
                        <a href="{{ route('extracurriculars') }}" class="block px-4 py-2 {{ request()->routeIs('extracurriculars') ? 'bg-slate-50 dark:bg-slate-700/50 text-rose-900 dark:text-rose-400' : 'hover:bg-slate-50 dark:hover:bg-slate-700/50 text-slate-900 dark:text-white hover:text-rose-900 hover:dark:text-rose-400' }} text-xs">Ekstrakurikuler</a>
                        <a href="{{ route('events') }}" class="block px-4 py-2 {{ request()->routeIs('events') ? 'bg-slate-50 dark:bg-slate-700/50 text-rose-900 dark:text-rose-400' : 'hover:bg-slate-50 dark:hover:bg-slate-700/50 text-slate-900 dark:text-white hover:text-rose-900 hover:dark:text-rose-400' }} text-xs">Kegiatan Sekolah</a>
                    </div>
                </div>

                <!-- 4. Dropdown Informasi -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center gap-1 {{ request()->routeIs('academic-infos', 'home-news.*') ? 'text-rose-900 dark:text-rose-400 font-bold' : 'hover:text-rose-900 dark:hover:text-rose-400' }} transition py-2 focus:outline-none">
                        <span>Informasi</span>
                        <svg class="size-3.5 transition-transform duration-200" :class="open ? 'rotate-180 text-rose-900' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-cloak
                         class="absolute top-full left-0 w-52 bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 py-2 z-50">
                        <a href="{{ route('academic-infos') }}" class="block px-4 py-2 {{ request()->routeIs('academic-infos') ? 'bg-slate-50 dark:bg-slate-700/50 text-rose-900 dark:text-rose-400' : 'hover:bg-slate-50 dark:hover:bg-slate-700/50 text-slate-900 dark:text-white hover:text-rose-900 hover:dark:text-rose-400' }} text-xs">Informasi Akademik</a>
                        <a href="{{ route('home-news.index') }}" class="block px-4 py-2 {{ request()->routeIs('home-news.*') ? 'bg-slate-50 dark:bg-slate-700/50 text-rose-900 dark:text-rose-400' : 'hover:bg-slate-50 dark:hover:bg-slate-700/50 text-slate-900 dark:text-white hover:text-rose-900 hover:dark:text-rose-400' }} text-xs">Berita & Pengumuman</a>
                    </div>
                </div>

                <!-- 5. Kontak -->
                <a href="#kontak" class="hover:text-rose-900 dark:hover:text-rose-400 transition">
                    Kontak
                </a>

            </nav>

            <!-- Mobile Hamburger Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100/50 dark:hover:bg-slate-800/50 focus:outline-none">
                <svg x-show="!mobileMenuOpen" class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileMenuOpen" class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

        </div>

        <!-- Mobile Menu Drawer (Dilengkapi background solid saat menu dibuka) -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             @click.away="mobileMenuOpen = false"
             class="lg:hidden px-5 pb-6 pt-2 border-t border-slate-100 dark:border-slate-800 space-y-2 text-xs font-medium bg-white/95 dark:bg-slate-900/95 rounded-b-2xl"
             x-cloak>

            <a href="{{ route('home') }}" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-xl {{ request()->routeIs('home') ? 'text-rose-900 font-bold bg-rose-50 dark:bg-slate-800' : 'text-slate-700 dark:text-slate-200 hover:bg-slate-50' }}">Beranda</a>
            <a href="{{ route('school-profile') }}" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-xl {{ request()->routeIs('school-profile') ? 'text-rose-900 font-bold bg-rose-50 dark:bg-slate-800' : 'text-slate-700 dark:text-slate-200 hover:bg-slate-50' }}">Profil</a>

            <!-- Mobile Accordion Kegiatan -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-50">
                    <span>Kegiatan</span>
                    <svg class="size-3.5 transition-transform" :class="open ? 'rotate-180 text-rose-900' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" class="pl-6 pt-1 space-y-1" x-cloak>
                    <a href="{{ route('extracurriculars') }}" @click="mobileMenuOpen = false" class="block py-1.5 text-slate-500 hover:text-rose-900">Ekstrakurikuler</a>
                    <a href="{{ route('events') }}" @click="mobileMenuOpen = false" class="block py-1.5 text-slate-500 hover:text-rose-900">Kegiatan Sekolah</a>
                </div>
            </div>

            <!-- Mobile Accordion Informasi -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-50">
                    <span>Informasi</span>
                    <svg class="size-3.5 transition-transform" :class="open ? 'rotate-180 text-rose-900' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" class="pl-6 pt-1 space-y-1" x-cloak>
                    <a href="{{ route('academic-infos') }}" @click="mobileMenuOpen = false" class="block py-1.5 text-slate-500 hover:text-rose-900">Informasi Akademik</a>
                    <a href="{{ route('home-news.index') }}" @click="mobileMenuOpen = false" class="block py-1.5 text-slate-500 hover:text-rose-900">Berita & Pengumuman</a>
                </div>
            </div>

            <a href="#kontak" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-50">Kontak</a>
        </div>
    </div>
</header>
