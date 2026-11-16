<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SDN Gedong 12') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-100 dark:bg-slate-900">
        <div class="min-h-screen flex flex-col sm:justify-center items-center p-4 sm:p-6 lg:p-8">

            <!-- Combined 2-Column Card Wrapper -->
            <div class="w-full max-w-5xl bg-white dark:bg-slate-800 rounded-[2.5rem] shadow-2xl overflow-hidden border border-slate-200/80 dark:border-slate-700 grid grid-cols-1 lg:grid-cols-12 min-h-[580px]">

                <!-- SISI KIRI: Banner Gambar (5/12 Width) -->
                <div class="lg:col-span-5 relative hidden lg:block bg-slate-900 overflow-hidden">
                    <img src="{{ asset('images/login-image-1.jpg') }}"
                         alt="SDN Gedong 12 Banner"
                         class="w-full h-full object-cover object-center opacity-90 hover:scale-105 transition-transform duration-700">

                    <div class="absolute inset-0 bg-gradient-to-t from-[#70282C]/85 via-[#70282C]/30 to-transparent flex flex-col justify-end p-8 text-white space-y-2">
                        <span class="text-[11px] font-extrabold uppercase tracking-widest bg-white/20 backdrop-blur-md px-3 py-1 rounded-full w-fit">
                            Sistem Informasi Sekolah
                        </span>
                        <h2 class="text-2xl font-black leading-tight">SDN Gedong 12</h2>
                        <p class="text-xs text-slate-200 leading-relaxed">
                            Portal Akademik & Panel Manajemen Berita, Fasilitas, dan Aktivitas Siswa.
                        </p>
                    </div>
                </div>

                <!-- SISI KANAN: Tempat Form Login ($slot) (7/12 Width) -->
                <div class="lg:col-span-7 p-8 sm:p-12 flex flex-col justify-center bg-white dark:bg-slate-800">
                    <div class="max-w-md w-full mx-auto">
                        {{ $slot }}
                    </div>
                </div>

            </div>

        </div>
    </body>
</html>
