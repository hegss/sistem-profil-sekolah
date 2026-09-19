<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/navigation.css', 'resources/js/navigation.js'])
</head>

<body class="font-sans antialiased">
    <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.sidebar')

        <!-- Notifikasi Alert -->
        @include('components.alert')

        <!-- Page Content -->
        <main class="flex-1 flex flex-col h-screen transition-all duration-300 overflow-y-hidden">
            @include('layouts.header-admin')

            {{ $slot }}
        </main>

        <!-- Script Source CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        @stack('scripts')
    </div>
</body>

</html>
