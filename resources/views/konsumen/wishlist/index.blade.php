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
                                onclick="removeFromWishlist({{ $wishlistItem->id }})">
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                            </svg>
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
                            @if($product->rating > 0)
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span class="text-sm text-gray-600">{{ $product->formatted_rating }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Petani Info -->
                        <div class="flex items-center space-x-2 mb-4">
                            <img src="{{ $product->user->avatar_url }}" alt="{{ $product->user->name }}" class="w-6 h-6 rounded-full">
                            <span class="text-sm text-gray-600">{{ $product->user->name }}</span>
                            @if($product->user->is_verified)
                                <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
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
                                <button type="button" class="w-full btn-primary" onclick="addToCart({{ $product->id }})">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6"></path>
                                    </svg>
                                    Tambah ke Keranjang
                                </button>
                            @else
                                <button type="button" class="w-full bg-gray-300 text-gray-500 font-medium py-2 px-4 rounded-lg cursor-not-allowed" disabled>
                                    Stok Habis
                                </button>
                            @endif
                            
                            <button type="button" class="w-full btn-secondary" onclick="removeFromWishlist({{ $wishlistItem->id }})">
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
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Wishlist Kosong</h3>
            <p class="text-gray-500 mb-6">Belum ada produk di wishlist Anda</p>
            <a href="{{ route('products') }}" class="btn-primary">
                Jelajahi Produk
            </a>
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

function removeFromWishlist(wishlistId) {
    if (confirm('Hapus produk dari wishlist?')) {
        fetch(`/konsumen/wishlist/${wishlistId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus dari wishlist');
        });
    }
}
</script>
@endsection
