<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        @vite('resources/css/app.css','resources/js/app.js')
        <link rel="stylesheet" href="/build/assets/app-Be_aLcIk.css">
       @livewireStyles
       @filamentStyles
    </head>
    <body class="min-h-screen bg-gray-200">

        <main class="m-2">
            {{ $slot }}
        </main>


        @stack('modals')

        @livewire('notifications')
        @filamentScripts

        @livewireScripts

        <script src="/build/assets/app-D3Y-ymQv.js"></script>
    </body>
</html>
