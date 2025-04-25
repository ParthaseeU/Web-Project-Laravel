<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'School Website')</title>
    <meta name="description" content="@yield('meta')">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')
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
