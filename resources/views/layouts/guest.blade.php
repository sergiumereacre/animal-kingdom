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
    <body class="font-sans text-greenButtons antialiased bg-appBackground">
        <div class="min-h-screen flex flex-col justify-center items-center pt-6">
            <div class="lg:grid lg:grid-rows-1 lg:grid-cols-2 lg:gap-35">
                <div class="justify-center px-6">
                    <!-- The welcome message.-->
                    <div>
                        <p class="mt-4 font-thin text-4xl">Welcome to</p>
                        <p class="font-black text-5xl">Animal Kingdom</p>
                    </div>
                
                    <!-- Any content here.-->
                    <div class="w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden sm:rounded-lg">
                        {{ $slot }}
                    </div>
                </div>
                <!-- Application Logo-->
                <div class="hidden lg:inline">
                    <a>
                        <img class="w-500" src="{{ asset('img/logo.png')}}">
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
