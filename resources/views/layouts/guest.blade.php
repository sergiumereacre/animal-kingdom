<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Animal Kingdom') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-greenButtons antialiased bg-appBackground">
    <div class="min-h-screen flex flex-col justify-center items-center pt-6">
        <div class="lg:flex lg:flex-row lg:items-center">
            <div class="justify-center px-6">
                <!-- The welcome message.-->
                <div class="flex flex-col items-center justify-center">
                    <p class="mt-4 font-thin text-4xl lg:text-6xl text-center">Welcome to</p>
                    <p class="font-black text-5xl lg:text-6xl text-center">Animal Kingdom</p>
                </div>

                <!-- Any content here.-->
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>
            <!-- Application Logo-->
            <div class="hidden lg:inline-flex lg:items-center">
                <a>
                    <img class="w-500" src="{{ asset('img/logo.png') }}">
                </a>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    function limitTextArea(element, maxChars) {
        var max_chars = maxChars;

        if (element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }

        // console.log('Hi');
    }

    function limit(element) {
        var max_chars = 100;

        if (element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }
        console.log('Hi');

    }
</script>
