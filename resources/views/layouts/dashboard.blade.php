<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Dashboard - Katalog Pertanian')</title>
    
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">


    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">

    <!-- Font Awesome as backup -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Mobile menu overlay -->
        <div id="mobile-menu-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>

        <!-- Sidebar -->
        <div id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <span class="text-lg font-bold text-hijau-600">Dashboard</span>
                    </div>
                    <!-- Close button for mobile -->
                    <button id="close-sidebar" class="lg:hidden text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            <nav class="mt-6">
                @if(auth()->user()->isPetani())
                    <a href="{{ route('petani.dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-hijau-50 hover:text-hijau-600 transition duration-200 {{ request()->routeIs('petani.dashboard') ? 'bg-hijau-50 text-hijau-600 border-r-2 border-hijau-600' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('petani.products.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-hijau-50 hover:text-hijau-600 transition duration-200 {{ request()->routeIs('petani.products*') ? 'bg-hijau-50 text-hijau-600 border-r-2 border-hijau-600' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2L3 7v11a1 1 0 001 1h12a1 1 0 001-1V7l-7-5zM9 18v-6h2v6H9z" clip-rule="evenodd"/>
                        </svg>
                        Produk Saya
                    </a>
                    <a href="{{ route('petani.education.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-hijau-50 hover:text-hijau-600 transition duration-200 {{ request()->routeIs('petani.education*') ? 'bg-hijau-50 text-hijau-600 border-r-2 border-hijau-600' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Edukasi Saya
                    </a>
                    <a href="{{ route('petani.orders.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-hijau-50 hover:text-hijau-600 transition duration-200 {{ request()->routeIs('petani.orders*') ? 'bg-hijau-50 text-hijau-600 border-r-2 border-hijau-600' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Pesanan
                    </a>

                    <a href="{{ route('petani.financial.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-hijau-50 hover:text-hijau-600 transition duration-200 {{ request()->routeIs('petani.financial*') ? 'bg-hijau-50 text-hijau-600 border-r-2 border-hijau-600' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                        Keuangan
                    </a>
                @elseif(auth()->user()->isKonsumen())
                    <a href="{{ route('konsumen.dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-hijau-50 hover:text-hijau-600 transition duration-200 {{ request()->routeIs('konsumen.dashboard') ? 'bg-hijau-50 text-hijau-600 border-r-2 border-hijau-600' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('konsumen.cart.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-hijau-50 hover:text-hijau-600 transition duration-200 {{ request()->routeIs('konsumen.cart*') ? 'bg-hijau-50 text-hijau-600 border-r-2 border-hijau-600' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6"/>
                        </svg>
                        Keranjang
                    </a>
                    <a href="{{ route('konsumen.orders.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-hijau-50 hover:text-hijau-600 transition duration-200 {{ request()->routeIs('konsumen.orders*') ? 'bg-hijau-50 text-hijau-600 border-r-2 border-hijau-600' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Pesanan Saya
                    </a>
                    <a href="{{ route('konsumen.wishlist.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-hijau-50 hover:text-hijau-600 transition duration-200 {{ request()->routeIs('konsumen.wishlist*') ? 'bg-hijau-50 text-hijau-600 border-r-2 border-hijau-600' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        Wishlist
                    </a>
                @endif
            </nav>
            
            <div class="absolute bottom-0 w-64 p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-hijau-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-hijau-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ ucfirst(auth()->user()->user_type) }}</p>
                    </div>
                </div>
                
                <div class="space-y-2">
                    <a href="{{ route('home') }}" class="block text-sm text-gray-600 hover:text-hijau-600">
                        Kembali ke Beranda
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block text-sm text-gray-600 hover:text-red-600">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden lg:ml-0">
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-4 sm:px-6 py-4 flex items-center justify-between">
                    <!-- Mobile menu button -->
                    <button id="mobile-menu-button" class="lg:hidden text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <h1 class="text-xl sm:text-2xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>

                    <!-- User menu for mobile -->
                    <div class="lg:hidden">
                        <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">
                            <i class="bi bi-house text-xl"></i>
                        </a>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-auto p-4 sm:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>