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
        <div class="login-image relative rounded-3xl overflow-hidden col-span-3 shadow-lg shadow-gray-500/50">
            <div class="login-slider w-full h-full overflow-hidden cursor-pointer">
                <div class="login-slider-list w-full h-full flex">
                    <div class="login-slide min-w-full w-full h-full flex-shrink-0">
                        <img src="{{ asset('images/login-image-1.jpg') }}" alt="SDN Gedong 12" class="w-full h-full object-cover block">
                    </div>

                    <div class="login-slide min-w-full w-full h-full flex-shrink-0">
                        <img src="{{ asset('images/login-image-2.jpg') }}" alt="SDN Gedong 12" class="w-full h-full object-cover block">
                    </div>
                </div>
            </div>

            <div class="login-slider-dot absolute flex justify-center gap-3 bottom-5 left-1/2 transform -translate-x-0.5 z-10">
                <span class="login-dot active-login-dot rounded-full cursor-pointer"></span>
                <span class="login-dot rounded-full cursor-pointer"></span>
            </div>
        </div>

        <div class="h-[90vh] col-span-2 flex flex-col items-center justify-center rounded-3xl shadow-lg shadow-gray-500/50 dark:bg-gray-800 backdrop-blur-sm">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div
                class="relative w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
