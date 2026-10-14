<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SDN 12 Gedong Pagi - Sekolah Unggulan' }}</title>

    <!-- Tailwind CSS & Alpine.js -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AOS (Animate On Scroll) Library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="overflow-x-hidden bg-slate-50 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white" x-data="{ mobileMenuOpen: false }">

    <!-- NAVBAR -->
    @include('layouts.navigation')

    <!-- KONTEN UTAMA -->
    <main class="pt-20 sm:pt-24">
        {{ $slot }}
    </main>

    <!-- FOOTER -->
    @include('layouts.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                once: true,
                easing: 'ease-in-out'
            });
        });
    </script>
</body>
</html>
