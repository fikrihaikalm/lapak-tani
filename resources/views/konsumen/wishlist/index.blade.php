@extends('layouts.app')

@section('title', 'Wishlist - Lapak Tani')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Wishlist Saya</h1>
        <p class="text-gray-600 mt-2">Produk yang Anda simpan untuk dibeli nanti</p>
    </div>

    <div class="space-y-6">
    @if($wishlistItems->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($wishlistItems as $wishlistItem)
                @php $product = $wishlistItem->product; @endphp
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-200">
                    <div class="relative">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-t-lg">
                        
                        <!-- Wishlist Button -->
                        <button type="button" class="absolute top-3 right-3 p-2 bg-white rounded-full shadow-md hover:bg-gray-50"
                                onclick="WishlistManager.remove({{ $product->id }})">
                            <i class="bi bi-heart-fill text-red-500"></i>
                        </button>

                        <!-- Badges -->
                        <div class="absolute top-3 left-3 space-y-1">
                            @if($product->is_organic)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Organik
                                </span>
                            @endif
                            @if($product->is_featured)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Unggulan
                                </span>
                            @endif
                        </div>

                        <!-- Stock Status -->
                        @if($product->stock <= 0)
                            <div class="absolute inset-0 bg-black bg-opacity-50 rounded-t-lg flex items-center justify-center">
                                <span class="text-white font-semibold">Stok Habis</span>
                            </div>
                        @endif
                    </div>

                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ Str::limit($product->description, 100) }}</p>
                        
                        <!-- Price and Rating -->
                        <div class="flex justify-between items-center mb-3">
                            <div>
                                <span class="text-xl font-bold text-hijau-600">{{ $product->formatted_price }}</span>
                                <span class="text-sm text-gray-500">/ {{ $product->unit }}</span>
                            </div>

                        </div>

                        <!-- Petani Info -->
                        <div class="flex items-center space-x-2 mb-4">
                            <img src="{{ $product->user->avatar_url }}" alt="{{ $product->user->name }}" class="w-6 h-6 rounded-full">
                            <span class="text-sm text-gray-600">{{ $product->user->name }}</span>
                            @if($product->user->is_verified)
                                <i class="bi bi-patch-check-fill text-green-500"></i>
                            @endif
                        </div>

                        <!-- Stock Info -->
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-gray-500">Stok: {{ $product->stock }}</span>
                            @if($product->total_sold > 0)
                                <span class="text-sm text-gray-500">{{ $product->total_sold }} terjual</span>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="space-y-2">
                            @if($product->stock > 0)
                                <button type="button" class="w-full btn-primary" onclick="CartManager.addToCart({{ $product->id }}, 1)">
                                    <i class="bi bi-cart mr-2"></i>
                                    Tambah ke Keranjang
                                </button>
                            @else
                                <button type="button" class="w-full bg-gray-300 text-gray-500 font-medium py-2 px-4 rounded-lg cursor-not-allowed" disabled>
                                    Stok Habis
                                </button>
                            @endif

                            <button type="button" class="w-full btn-secondary" onclick="WishlistManager.remove({{ $product->id }})">
                                Hapus dari Wishlist
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($wishlistItems->hasPages())
            <div class="bg-white rounded-lg shadow p-6">
                {{ $wishlistItems->links() }}
            </div>
        @endif
    @else
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <i class="bi bi-heart text-6xl text-gray-400 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Wishlist Kosong</h3>
            <p class="text-gray-500 mb-6">Belum ada produk di wishlist Anda</p>
            <a href="{{ route('products') }}" class="btn-primary">
                Jelajahi Produk
            </a>
        </div>
    @endif
    </div>
</div>

{{-- JavaScript functionality handled by external files: cart.js and wishlist.js --}}
@endsection
