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

    <!-- Page-specific CSS -->
    @yield('styles')
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex flex-col">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <!-- @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset -->

        <!-- Page Content -->
        <main class="main-content flex-grow">
            {{ $slot }}
        </main>

        <!-- フッターの追加 -->
        <footer class="bg-gray-200 text-center py-4 mt-8">
            <div class="container mx-auto">
                <p class="mt-2">
                    <a href="/login" class="text-blue-600 hover:underline">
                        オーガナイザー管理画面
                    </a>
                    |
                    <a href="/terms" class="text-blue-600 hover:underline">
                        利用規約
                    </a>
                </p>
                <p class="text-gray-600 text-sm">
                    © 2024 A-POP MAP. All rights reserved.
                </p>
            </div>
        </footer>
    </div>
</body>

</html>
