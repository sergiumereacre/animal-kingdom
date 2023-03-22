<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Animal Kingdom</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div class="bg-appBackground flex flex-col items-center justify-center py-10 min-h-screen">
        <div class="flex flex-col items-center justify-center p-10 z-10">
            <div class="text-5xl font-medium md:text-6xl text-center">
                <p>Welcome to</p>
            </div>
            <div class="flex items-center justify-center text-center text-6xl font-bold text-greenButtons md:text-7xl">
                <h1>Animal Kingdom</h1>
            </div>
        </div>
        <!-- Login and Singup Buttons changes to Dashboard if Authenticated -->
        @if (Route::has('login'))
            <div class="flex flex-row items-center justify-center gap-3 z-10">
                @auth
                    <a href="{{ route('home') }}">
                        <x-primary-button>
                            {{ __('Home') }}
                        </x-primary-button>
                    </a>
                @else
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">
                            <x-secondary-button class="flex gap-1">
                                <span class="material-symbols-rounded">
                                    design_services
                                </span>
                                {{ __('Sign Up') }}
                            </x-secondary-button>
                        </a>
                    @endif
                    <a href="{{ route('login') }}">
                        <x-primary-button class="flex gap-1">
                            <span class="material-symbols-rounded">
                                login
                            </span>
                            {{ __('Log In') }}
                        </x-primary-button>
                    </a>
                @endauth
            </div>
        @endif
        <img class="w-500 h-500 absolute opacity-20 z-0" src="{{ asset('img/logo.png') }}" alt="Company Logo" />
    </div>
</body>

</html>
