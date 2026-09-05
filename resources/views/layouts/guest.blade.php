<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen p-6 grid grid-cols-5 gap-6 items-center bg-gray-100 dark:bg-gray-900">
        <div class="login-image col-span-3 shadow-lg shadow-gray-500/50">
            <div class="login-slider">
                <div class="login-slider-list">
                    <div class="login-slide">
                        <img src="{{ asset('images/login-image-1.jpg') }}" alt="SDN Gedong 12">
                    </div>

                    <div class="login-slide">
                        <img src="{{ asset('images/login-image-2.jpg') }}" alt="SDN Gedong 12">
                    </div>
                </div>
            </div>

            <div class="login-slider-dot">
                <span class="login-dot active-login-dot"></span>
                <span class="login-dot"></span>
            </div>
        </div>

        <div class="h-[80vh] col-span-2 flex flex-col items-center justify-center rounded-3xl shadow-lg shadow-gray-500/50 dark:bg-gray-300 backdrop-blur-sm">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div
                class="w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
