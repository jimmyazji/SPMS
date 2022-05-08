<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{!! asset('images/favicon.ico') !!}" />
    <title>{{ config('app.name', 'PMS') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body
    class="font-sans antialiased scrollbar-thin scrollbar-track-transparent scrollbar-thumb-gray-800 text-gray-800">
    <div class="min-h-screen bg-gray-200">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-6xl mx-auto h-24 py-6 flex justify-between items-center">
                {{ $header }}
            </div>
        </header>

        <!-- Page Content -->
        <main x-data="{ showmain: false }" x-init="() => {
                setTimeout(() => showmain = true, 500);
            }" x-show="showmain" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90">
            {{ $slot }}
        </main>
    </div>
</body>
<x-footer />

</html>