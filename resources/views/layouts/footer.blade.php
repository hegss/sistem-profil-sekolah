<!-- FOOTER -->
<footer class="bg-amber-900 text-slate-400 pt-12 sm:pt-16 pb-8 border-t border-slate-800">
    <div
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-10 pb-12 border-b border-white">

        <div class="space-y-4 sm:col-span-2 lg:col-span-1">
            <div class="flex items-center gap-3">
                <x-application-logo class="h-9 sm:h-10 w-auto" />
                <span class="font-bold text-white text-sm sm:text-base">SDN 12 Gedong Pagi</span>
            </div>
            <p class="text-xs text-white leading-relaxed">
                Mewujudkan generasi cerdas, berkarakter, berbudaya lingkungan, serta unggul dalam prestasi akademik dan
                non-akademik.
            </p>
        </div>

        <div>
            <h4 class="text-white text-xs font-bold uppercase tracking-wider mb-4">Navigasi Cepat</h4>
            <ul class="space-y-2.5 text-xs">
                <li><a href="{{ route('home') }}" class="text-white hover:text-gray-500 transition">Home</a></li>
                <li><a href="{{ route('school-profile') }}" class="text-white hover:text-gray-500 transition">Profil Sekolah</a></li>
                <li><a href="{{ route('extracurriculars') }}" class="text-white hover:text-gray-500 transition">Ekstrakurikuler</a></li>
                <li><a href="#berita" class="text-white hover:text-gray-500 transition">Berita Terkini</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-white text-xs font-bold uppercase tracking-wider mb-4">Layanan Layanan</h4>
            <ul class="space-y-2.5 text-xs">
                <li><a href="#" class="text-white hover:text-gray-500 transition">Penerimaan Siswa Baru (PPDB)</a></li>
                <li><a href="#" class="text-white hover:text-gray-500 transition">Pengajuan Dokumen</a></li>
                <li><a href="#" class="text-white hover:text-gray-500 transition">Layanan Pengaduan</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-white text-xs font-bold uppercase tracking-wider mb-4">Kontak Kami</h4>
            <ul class="space-y-3 text-xs">
                <li class="text-white">
                    <a href="https://maps.app.goo.gl/DGhHupUcWBQ4bzsv7" class="flex items-start gap-2.5 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 text-white shrink-0 mt-0.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        <span>Jl. Raya Condet, Gedong, Kec. Pasar Rebo, Jakarta Timur</span>
                    </a>
                </li>
                <li class="flex items-center gap-2.5 text-white">
                    <x-mail-icon class="size-5 text-white shrink-0" />
                    <span>sdn_gedong12pagi@yahoo.com</span>
                </li>
            </ul>
        </div>
    </div>

    <div
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-white text-xs text-center sm:text-left">
        <p>© {{ date('Y') }} SDN 12 Gedong Pagi Jakarta. All rights reserved.</p>
        <p>Designed with passion for education excellence.</p>
    </div>
</footer>
