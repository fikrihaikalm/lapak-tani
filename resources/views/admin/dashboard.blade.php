@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-hijau-100 text-hijau-600">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Petani</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalPetani }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-coklat-100 text-coklat-600">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2L3 7v11a1 1 0 001 1h12a1 1 0 001-1V7l-7-5zM9 18v-6h2v6H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Produk</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalProducts }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-hijau-100 text-hijau-600">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Edukasi</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalEducations }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Content -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Products -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Produk Terbaru</h3>
            </div>
            <div class="p-6">
                @forelse($recentProducts as $product)
                <div class="flex items-center space-x-4 {{ !$loop->last ? 'mb-4 pb-4 border-b border-gray-100' : '' }}">
                    <img src="{{ $product->image_url ?: 'https://images.pexels.com/photos/1656663/pexels-photo-1656663.jpeg' }}" 
                         alt="{{ $product->name }}" 
                         class="w-12 h-12 rounded-lg object-cover">
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-gray-900">{{ $product->name }}</h4>
                        <p class="text-sm text-gray-500">{{ $product->user->name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-hijau-600">{{ $product->formatted_price }}</p>
                        <p class="text-xs text-gray-500">{{ $product->created_at->format('d M') }}</p>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">Belum ada produk</p>
                @endforelse
            </div>
        </div>
        
        <!-- Recent Education -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Edukasi Terbaru</h3>
            </div>
            <div class="p-6">
                @forelse($recentEducations as $education)
                <div class="flex items-center space-x-4 {{ !$loop->last ? 'mb-4 pb-4 border-b border-gray-100' : '' }}">
                    <img src="{{ $education->image_url ?: 'https://images.pexels.com/photos/2132227/pexels-photo-2132227.jpeg' }}" 
                         alt="{{ $education->title }}" 
                         class="w-12 h-12 rounded-lg object-cover">
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-gray-900">{{ Str::limit($education->title, 40) }}</h4>
                        <p class="text-sm text-gray-500">{{ $education->user->name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">{{ $education->created_at->format('d M') }}</p>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">Belum ada konten edukasi</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection