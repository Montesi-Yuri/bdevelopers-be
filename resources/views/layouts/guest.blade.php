<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BDevelopers') }}</title>

        <!-- Fonts -->

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>
        <main class = "bg-slate-300 dark:bg-slate-900 h-screen">
        <main class="bg-zinc-50 dark:bg-zinc-900 w-full overflow-auto text-black dark:text-white">
            @include('partials.headerGuest')
            <div class="w-1/2 mx-auto mt-10 px-4">
                @yield('main-content')
            </div>
        </main>
        <script src="node_modules\flowbite\dist\flowbite.min.js"></script>
    </body>
</html>
