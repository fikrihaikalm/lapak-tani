<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Katalog Pertanian Lokal')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <!-- <div class="w-8 h-8 bg-hijau-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                            </svg>
                            <img src="{{ asset('logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                        </div> -->
                        <span class="text-xl font-bold text-gray-900">Lapak Tani</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-hijau-600 font-medium transition duration-200 {{ request()->routeIs('home') ? 'text-hijau-600' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('products') }}" class="text-gray-700 hover:text-hijau-600 font-medium transition duration-200 {{ request()->routeIs('products') ? 'text-hijau-600' : '' }}">
                        Produk
                    </a>
                    <a href="{{ route('education') }}" class="text-gray-700 hover:text-hijau-600 font-medium transition duration-200 {{ request()->routeIs('education*') ? 'text-hijau-600' : '' }}">
                        Edukasi
                    </a>
                </div>

                <!-- Auth Links -->
                <div class="flex items-center space-x-4">
                    @auth
                        <div class="relative group">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-hijau-600 font-medium">
                                <div class="w-8 h-8 bg-hijau-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-hijau-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span>{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="py-2">
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-hijau-600">
                                            Dashboard Admin
                                        </a>
                                    @else
                                        <a href="{{ route('petani.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-hijau-600">
                                            Dashboard Petani
                                        </a>
                                    @endif
                                    <hr class="my-2">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-red-600">
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-hijau-600 font-medium">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <!-- <div class="w-8 h-8 bg-hijau-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                            </svg>
                        </div> -->
                        <span class="text-xl font-bold">Lapak Tani</span>
                    </div>
                    <p class="text-white mb-4">
                        Platform yang menghubungkan petani lokal dengan konsumen, serta memberikan edukasi mengenai dunia pertanian untuk generasi muda.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Menu</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-white hover:text-white transition duration-200">Beranda</a></li>
                        <li><a href="{{ route('products') }}" class="text-white hover:text-white transition duration-200">Produk</a></li>
                        <li><a href="{{ route('education') }}" class="text-white hover:text-white transition duration-200">Edukasi</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-white">
                        <li>Email: gatau@gmail.com</li>
                        <li>Telepon: 08123456789</li>
                        <li>Alamat: Jember, Indonesia</li>
                    </ul>
                </div>
            </div>
            
            <hr class="border-hijau-700 my-8">
            
            <div class="text-center text-white">
                <p>&copy;{{ date('Y') }} Lapak Tani</p>
            </div>
        </div>
    </footer>
</body>
</html>