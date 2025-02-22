<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>

        <link rel="stylesheet" href="/build/assets/app-C5aJUsMy.css">

        @vite(['resources/css/app.css','resources/js/app.js'])

        <script >
            const menuBtn = document.getElementById('menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            });
        </script>
       @livewireStyles
       @filamentStyles
    </head>
    <body class="min-h-screen bg-gray-100">

  <header  x-data="{ open: false }" class="py-4 bg-white shadow-md">
    <div class="flex items-center justify-between max-w-6xl px-6 mx-auto">
        <h1 class="text-2xl font-bold text-blue-600"><a href="/" wire:navigate>Diabète Prédiction</a></h1>
        <button @click="open = !open" id="menu-btn" class="text-gray-700 md:hidden focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                </path>
            </svg>
        </button>
        <nav class="hidden md:flex">
            <ul class="flex space-x-6 font-semibold text-gray-700">
                <li><a href="#" class="hover:text-blue-600">Évaluer son risque</a></li>
                <li><a href="#" class="hover:text-blue-600">Recommandations</a></li>
                <li><a href="#" class="hover:text-blue-600">Les bonnes pratiques</a></li>
                <li><a href="#" class="hover:text-blue-600">Les centres</a></li>
            </ul>
        </nav>
    </div>
    <!-- Menu mobile avec animation -->
    <nav x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-y-4"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-4" id="mobile-menu"
        class="mt-2 bg-white shadow-md md:hidden">
        <ul class="flex flex-col p-4 font-semibold text-gray-700">
            <li class="py-2 border-b"><a href="#" class="hover:text-blue-600">Évaluer son risque</a></li>
            <li class="py-2 border-b"><a href="#" class="hover:text-blue-600">Recommandations</a></li>
            <li class="py-2 border-b"><a href="#" class="hover:text-blue-600">Les bonnes pratiques</a></li>
            <li class="py-2"><a href="#" class="hover:text-blue-600">Les centres</a></li>
        </ul>
    </nav>
</header>


        <main class="m-2">
            {{ $slot }}
        </main>


        @stack('modals')

        @livewire('notifications')
        @filamentScripts

    @livewireScriptConfig





    </body>
</html>



