<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Register - Lapak Tani')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-hijau-50 to-coklat-50">
    <main class="min-h-screen lg:h-screen lg:overflow-hidden py-4 lg:py-8">
        <!-- Konten Form Register -->
        <div class="w-full flex items-center justify-center px-4 sm:px-6 lg:px-8 h-full">
            <div class="w-full max-w-3xl lg:max-w-3xl">
                @yield('content')
            </div>
        </div>
    </main>
</body>
</html>
