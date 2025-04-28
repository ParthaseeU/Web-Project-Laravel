<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'School Website')</title>
    <meta name="description" content="@yield('meta')">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
</head>

<body class="antialiased bg-gray-100">
    <x-navbar :page="$page ?? 'default'" />
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                @yield('content')
            </div>
        </div>
    </div>

    @vite(['resources/js/app.js'])
    @yield('scripts')
</body>

</html>
