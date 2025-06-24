@extends('layouts.dashboard')

@section('title', 'Dashboard Petani - Lapak Tani')
@section('page-title', 'Dashboard Petani')

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-hijau-600 to-hijau-700 rounded-lg p-6 text-white">
        <h1 class="text-2xl font-bold mb-2">Selamat datang, {{ auth()->user()->name }}!</h1>
        @if(auth()->user()->farm_name)
            <p class="text-hijau-100 mb-2">{{ auth()->user()->farm_name }}</p>
        @endif
        <p class="text-hijau-100">Kelola produk dan bagikan pengetahuan pertanian Anda</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-hijau-100 text-hijau-600">
                    <i class="fas fa-box text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Produk Saya</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_products'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-shopping-cart text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Pesanan</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_orders'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-dollar-sign text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Pendapatan Bulan Ini</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['monthly_income'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-book text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Konten Edukasi</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_educations'] }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('petani.products.create') }}" class="flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                <div class="p-2 bg-hijau-100 rounded-lg mb-3">
                    <i class="fas fa-plus-circle text-xl text-hijau-600"></i>
                </div>
                <h4 class="text-sm font-medium text-gray-900 text-center">Tambah Produk</h4>
            </a>

            <a href="{{ route('petani.education.create') }}" class="flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                <div class="p-2 bg-purple-100 rounded-lg mb-3">
                    <i class="fas fa-book text-xl text-purple-600"></i>
                </div>
                <h4 class="text-sm font-medium text-gray-900 text-center">Buat Edukasi</h4>
            </a>

            <a href="{{ route('petani.financial.create') }}" class="flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                <div class="p-2 bg-green-100 rounded-lg mb-3">
                    <i class="fas fa-dollar-sign text-xl text-green-600"></i>
                </div>
                <h4 class="text-sm font-medium text-gray-900 text-center">Catat Keuangan</h4>
            </a>

            <a href="{{ route('social.feed') }}" class="flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                <div class="p-2 bg-blue-100 rounded-lg mb-3">
                    <i class="fas fa-comments text-xl text-blue-600"></i>
                </div>
                <h4 class="text-sm font-medium text-gray-900 text-center">Buat Post</h4>
            </a>
        </div>
    </div>
    
    <!-- Recent Content -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Products -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Produk Terbaru</h3>
                <a href="{{ route('petani.products.index') }}" class="text-sm text-hijau-600 hover:text-hijau-700">
                    Lihat Semua
                </a>
            </div>
            <div class="p-6">
                @forelse($recentProducts as $product)
                <div class="flex items-center space-x-4 {{ !$loop->last ? 'mb-4 pb-4 border-b border-gray-100' : '' }}">
                    <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://via.placeholder.com/40' }}"
                         alt="{{ $product->name }}" 
                         class="w-12 h-12 rounded-lg object-cover">
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-gray-900">{{ $product->name }}</h4>
                        <p class="text-sm text-gray-500">Stok: {{ $product->stock }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-hijau-600">{{ $product->formatted_price }}</p>
                        <p class="text-xs text-gray-500">{{ $product->created_at->format('d M') }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="fas fa-box text-5xl text-gray-400 mb-4"></i>
                    <p class="text-gray-500 text-sm">Belum ada produk</p>
                    <a href="{{ route('petani.products.create') }}" class="text-hijau-600 hover:text-hijau-700 text-sm font-medium">
                        Tambah produk pertama
                    </a>
                </div>
                @endforelse
            </div>
        </div>
        
        <!-- Recent Education -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Konten Edukasi Terbaru</h3>
                <a href="{{ route('petani.education.index') }}" class="text-sm text-hijau-600 hover:text-hijau-700">
                    Lihat Semua
                </a>
            </div>
            <div class="p-6">
                @forelse($recentEducations as $education)
                <div class="flex items-center space-x-4 {{ !$loop->last ? 'mb-4 pb-4 border-b border-gray-100' : '' }}">
                    <img src="{{ $education->image_path ? asset('storage/' . $education->image_path) : 'https://via.placeholder.com/40' }}"
                         alt="{{ $education->title }}" 
                         class="w-12 h-12 rounded-lg object-cover">
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-gray-900">{{ Str::limit($education->title, 40) }}</h4>
                        <p class="text-xs text-gray-500">{{ $education->created_at->format('d M') }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="fas fa-book text-5xl text-gray-400 mb-4"></i>
                    <p class="text-gray-500 text-sm">Belum ada konten edukasi</p>
                    <a href="{{ route('petani.education.create') }}" class="text-hijau-600 hover:text-hijau-700 text-sm font-medium">
                        Buat konten pertama
                    </a>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection