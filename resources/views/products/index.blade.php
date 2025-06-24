@extends('layouts.app')

@section('title', 'Produk - Katalog Pertanian')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-hijau-600 to-hijau-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Produk Pertanian Lokal</h1>
            <p class="text-xl text-hijau-100 max-w-3xl mx-auto mb-8">
                Temukan produk pertanian segar langsung dari petani lokal terpercaya
            </p>
        </div>
    </div>
</div>

<!-- Search & Filter Section -->
<div class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <form method="GET" class="flex flex-col md:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari produk..."
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Category Filter -->
            <div class="md:w-48">
                <select name="category" class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Sort -->
            <div class="md:w-48">
                <select name="sort" class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                </select>
            </div>

            <!-- Filter Button -->
            <button type="submit" class="btn-primary whitespace-nowrap">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"/>
                </svg>
                Filter
            </button>
        </form>
    </div>
</div>

<!-- Products Section -->
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Results Info -->
        <div class="mb-8">
            <p class="text-gray-600">
                Menampilkan {{ $products->count() }} dari {{ $products->total() }} produk
                @if(request('search'))
                    untuk "<strong>{{ request('search') }}</strong>"
                @endif
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products as $product)
            <div class="card hover:shadow-lg transition duration-200">
                <div class="relative">
                    <a href="{{ route('product.show', $product->slug) }}">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover hover:opacity-90 transition duration-200">
                    </a>

                    <!-- Wishlist Button for Konsumen -->
                    @auth
                        @if(auth()->user()->isKonsumen())
                            <button type="button" class="absolute top-3 right-3 p-2 bg-white rounded-full shadow-md hover:bg-gray-50"
                                    onclick="toggleWishlist({{ $product->id }}, this)">
                                <svg class="w-5 h-5 {{ $product->isInWishlist(auth()->id()) ? 'text-red-500' : 'text-gray-400' }}"
                                     fill="{{ $product->isInWishlist(auth()->id()) ? 'currentColor' : 'none' }}"
                                     stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        @endif
                    @endauth

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
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                            <span class="text-white font-semibold">Stok Habis</span>
                        </div>
                    @endif
                </div>

                <div class="p-6">
                    <a href="{{ route('product.show', $product->slug) }}" class="block">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 hover:text-hijau-600 transition duration-200">{{ $product->name }}</h3>
                        <p class="text-gray-600 mb-3 line-clamp-2">{{ Str::limit($product->description, 100) }}</p>
                    </a>

                    <!-- Price -->
                    <div class="mb-3">
                        <span class="text-xl font-bold text-hijau-600">{{ $product->formatted_price }}</span>
                        <span class="text-sm text-gray-500">/ {{ $product->unit }}</span>
                    </div>

                    <!-- Petani Info -->
                    <div class="flex items-center space-x-2 mb-3">
                        <img src="{{ $product->user->avatar_url }}" alt="{{ $product->user->name }}" class="w-6 h-6 rounded-full">
                        <span class="text-sm text-gray-600">{{ $product->user->name }}</span>
                        @if($product->user->is_verified)
                            <div class="flex items-center" title="Petani Terverifikasi - Telah menyelesaikan 20+ pesanan">
                                <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-xs text-green-600 ml-1">Terverifikasi</span>
                            </div>
                        @endif
                    </div>

                    <!-- Stock and Sales Info -->
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Stok: {{ $product->stock }}</span>
                        @if($product->total_sold > 0)
                            <span class="text-sm text-gray-500">{{ $product->total_sold }} terjual</span>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    @auth
                        @if(auth()->user()->isKonsumen())
                            @if($product->stock > 0)
                                <button type="button" class="w-full btn-primary mb-2" onclick="addToCart({{ $product->id }})">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6"></path>
                                    </svg>
                                    Tambah ke Keranjang
                                </button>
                            @else
                                <button type="button" class="w-full bg-gray-300 text-gray-500 font-medium py-2 px-4 rounded-lg cursor-not-allowed mb-2" disabled>
                                    Stok Habis
                                </button>
                            @endif
                            <a href="{{ route('social.profile', $product->user->slug ?: $product->user->id) }}" class="block w-full text-center btn-secondary">
                                Lihat Profil Petani
                            </a>
                        @else
                            <a href="{{ route('social.profile', $product->user->slug ?: $product->user->id) }}" class="block w-full text-center btn-primary">
                                Lihat Profil Petani
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="block w-full text-center btn-primary">
                            Login untuk Membeli
                        </a>
                    @endauth
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
        
        <!-- Pagination -->
        @if($products->hasPages())
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        @endif
    </div>
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
            // Update cart count in navigation
            const cartCount = document.querySelector('.absolute.-top-2.-right-2');
            if (cartCount) {
                cartCount.textContent = data.cart_count;
            }

            // Show success message
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

function toggleWishlist(productId, button) {
    fetch('/konsumen/wishlist/toggle', {
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
            const icon = button.querySelector('svg');
            if (data.action === 'added') {
                icon.classList.remove('text-gray-400');
                icon.classList.add('text-red-500');
                icon.setAttribute('fill', 'currentColor');
            } else {
                icon.classList.remove('text-red-500');
                icon.classList.add('text-gray-400');
                icon.setAttribute('fill', 'none');
            }

            // Show success message
            alert(data.message);
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengubah wishlist');
    });
}

// Load cart count on page load
document.addEventListener('DOMContentLoaded', function() {
    @auth
        @if(auth()->user()->isKonsumen())
            fetch('/konsumen/keranjang/count')
                .then(response => response.json())
                .then(data => {
                    const cartCount = document.getElementById('cart-count');
                    if (cartCount) {
                        cartCount.textContent = data.count;
                    }
                });
        @endif
    @endauth
});
</script>
@endsection