<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Dashboard - Katalog Pertanian')</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <div class="p-6">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-hijau-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-gray-900">Dashboard</span>
                </div>
            </div>
            
            <nav class="mt-6">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-hijau-50 hover:text-hijau-600 transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-hijau-50 text-hijau-600 border-r-2 border-hijau-600' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-hijau-50 hover:text-hijau-600 transition duration-200 {{ request()->routeIs('admin.products*') ? 'bg-hijau-50 text-hijau-600 border-r-2 border-hijau-600' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2L3 7v11a1 1 0 001 1h12a1 1 0 001-1V7l-7-5zM9 18v-6h2v6H9z" clip-rule="evenodd"/>
                        </svg>
                        Kelola Produk
                    </a>
                    <a href="{{ route('admin.education.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-hijau-50 hover:text-hijau-600 transition duration-200 {{ request()->routeIs('admin.education*') ? 'bg-hijau-50 text-hijau-600 border-r-2 border-hijau-600' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Kelola Edukasi
                    </a>
                @else
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
                        <p class="text-xs text-gray-500">{{ ucfirst(auth()->user()->role) }}</p>
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
        <div class="flex-1 overflow-auto">
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-6 py-4">
                    <h1 class="text-2xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                </div>
            </header>
            
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>