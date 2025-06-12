@extends('layouts.dashboard')

@section('title', 'Dashboard Petani')
@section('page-title', 'Dashboard Petani')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-hijau-100 text-hijau-600">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2L3 7v11a1 1 0 001 1h12a1 1 0 001-1V7l-7-5zM9 18v-6h2v6H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Produk Saya</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalProducts }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-coklat-100 text-coklat-600">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Konten Edukasi</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalEducations }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('petani.products.create') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                <div class="p-2 bg-hijau-100 rounded-lg">
                    <svg class="w-6 h-6 text-hijau-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-sm font-medium text-gray-900">Tambah Produk</h4>
                    <p class="text-sm text-gray-500">Tambahkan produk pertanian baru</p>
                </div>
            </a>
            
            <a href="{{ route('petani.education.create') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                <div class="p-2 bg-coklat-100 rounded-lg">
                    <svg class="w-6 h-6 text-coklat-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-sm font-medium text-gray-900">Buat Konten Edukasi</h4>
                    <p class="text-sm text-gray-500">Bagikan pengalaman dan tips bertani</p>
                </div>
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
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m13-8l-4 4m0 0l-4-4m4 4V3"/>
                    </svg>
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
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
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