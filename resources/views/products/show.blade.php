@extends('layouts.app')

@section('title', $product->name . ' - Lapak Tani')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-hijau-600">Beranda</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <a href="{{ route('products') }}" class="ml-1 text-gray-700 hover:text-hijau-600 md:ml-2">Produk</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ml-1 text-gray-500 md:ml-2">{{ $product->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
        <!-- Product Images -->
        <div class="space-y-4">
            <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif
            </div>
        </div>

        <!-- Product Info -->
        <div class="space-y-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                <div class="flex items-center space-x-4 mb-4">
                    @if($product->is_organic)
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Organik</span>
                    @endif
                    @if($product->is_featured)
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Unggulan</span>
                    @endif
                </div>
                <p class="text-3xl font-bold text-hijau-600 mb-4">{{ $product->formatted_price }}</p>
                <p class="text-gray-600 mb-6">{{ $product->description }}</p>
            </div>

            <!-- Product Details -->
            <div class="border-t border-gray-200 pt-6">
                <dl class="grid grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Stok</dt>
                        <dd class="text-sm text-gray-900">{{ $product->stock }} {{ $product->unit }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Berat</dt>
                        <dd class="text-sm text-gray-900">{{ $product->weight }} gram</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                        <dd class="text-sm text-gray-900">{{ $product->category->name ?? 'Tidak ada kategori' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Terjual</dt>
                        <dd class="text-sm text-gray-900">{{ $product->total_sold }} {{ $product->unit }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Farmer Info -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Petani</h3>
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        @if($product->user->avatar)
                            <img src="{{ asset('storage/' . $product->user->avatar) }}" 
                                 alt="{{ $product->user->name }}"
                                 class="w-12 h-12 rounded-full object-cover">
                        @else
                            <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                                <span class="text-gray-600 font-medium">{{ substr($product->user->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <p class="text-lg font-medium text-gray-900">{{ $product->user->name }}</p>
                        @if($product->user->farm_name)
                            <p class="text-sm text-gray-600">{{ $product->user->farm_name }}</p>
                        @endif
                        @if($product->user->location)
                            <p class="text-sm text-gray-500">📍 {{ $product->user->location }}</p>
                        @endif
                    </div>
                    <div>
                        <a href="{{ route('social.profile', $product->user->slug ?: $product->user->id) }}"
                           class="text-hijau-600 hover:text-hijau-700 text-sm font-medium">
                            Lihat Profil
                        </a>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            @auth
                @if(auth()->user()->isKonsumen())
                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex space-x-4">
                            <button onclick="addToWishlist({{ $product->id }})" 
                                    class="flex-1 bg-gray-100 text-gray-700 py-3 px-6 rounded-lg hover:bg-gray-200 transition duration-200 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                Wishlist
                            </button>
                            <button onclick="addToCart({{ $product->id }})" 
                                    class="flex-1 bg-hijau-600 text-white py-3 px-6 rounded-lg hover:bg-hijau-700 transition duration-200 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6m0 0h15M17 21a2 2 0 100-4 2 2 0 000 4zM9 21a2 2 0 100-4 2 2 0 000 4z"/>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                @endif
            @else
                <div class="border-t border-gray-200 pt-6">
                    <p class="text-center text-gray-600 mb-4">Silakan login untuk membeli produk ini</p>
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}" class="flex-1 bg-hijau-600 text-white py-3 px-6 rounded-lg hover:bg-hijau-700 transition duration-200 text-center">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="flex-1 bg-gray-100 text-gray-700 py-3 px-6 rounded-lg hover:bg-gray-200 transition duration-200 text-center">
                            Daftar
                        </a>
                    </div>
                </div>
            @endauth
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="border-t border-gray-200 pt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Produk Serupa</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-200">
                        <a href="{{ route('product.show', $relatedProduct->slug) }}">
                            <div class="aspect-square bg-gray-100 rounded-t-lg overflow-hidden">
                                @if($relatedProduct->image)
                                    <img src="{{ asset('storage/' . $relatedProduct->image) }}" 
                                         alt="{{ $relatedProduct->name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $relatedProduct->name }}</h3>
                                <p class="text-hijau-600 font-bold">{{ $relatedProduct->formatted_price }}</p>
                                <p class="text-sm text-gray-500 mt-1">{{ $relatedProduct->user->name }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<script>
function addToCart(productId) {
    fetch('/konsumen/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: 1
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showSuccess(data.message);
        } else {
            showError(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showError('Terjadi kesalahan saat menambahkan ke keranjang');
    });
}

function addToWishlist(productId) {
    fetch('/konsumen/wishlist/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: productId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showSuccess(data.message);
        } else {
            showError(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showError('Terjadi kesalahan saat menambahkan ke wishlist');
    });
}
</script>
@endsection
