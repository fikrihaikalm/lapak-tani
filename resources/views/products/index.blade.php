@extends('layouts.app')

@section('title', 'Produk - Katalog Pertanian')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Produk Pertanian Lokal</h1>
            <p class="text-lg text-gray-600">Temukan produk pertanian segar langsung dari petani lokal</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products as $product)
            <div class="card hover:shadow-lg transition duration-200">
                <div class="aspect-w-16 aspect-h-9">
                    <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://via.placeholder.com/40' }}"
                         alt="{{ $product->name }}" 
                         class="w-full h-48 object-cover">
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-2">{{ Str::limit($product->description, 100) }}</p>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-2xl font-bold text-hijau-600">{{ $product->formatted_price }}</span>
                        <span class="text-sm text-gray-500">Stok: {{ $product->stock }}</span>
                    </div>
                    <div class="text-sm text-gray-500 mb-4">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                            {{ $product->user->name }}
                        </div>
                        <div class="flex items-center mt-1">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                            {{ $product->created_at->format('d M Y') }}
                        </div>
                    </div>
                    <button class="w-full btn-primary">
                        Hubungi Petani
                    </button>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m13-8l-4 4m0 0l-4-4m4 4V3"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Produk</h3>
                <p class="text-gray-600">Produk pertanian akan ditampilkan di sini.</p>
            </div>
            @endforelse
        </div>
        
        @if($products->hasPages())
        <div class="mt-12">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>
@endsection