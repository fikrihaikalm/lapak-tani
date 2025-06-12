<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Register - Lapak Tani')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white h-screen overflow-hidden">
    <main class="flex h-full">
        <!-- KIRI: Konten Form Login/Register -->
        <div class="w-full md:w-1/2 flex items-center justify-center px-6 bg-white">
            <div class="w-full max-w-md">
                @yield('content')
            </div>
        </div>

        <!-- KANAN: Gambar -->
        <div class="hidden md:block w-1/2 bg-cover bg-center" style="background-image: url('{{ asset('storage/login.png') }}');">
        </div>
    </main>
</body>
</html>
