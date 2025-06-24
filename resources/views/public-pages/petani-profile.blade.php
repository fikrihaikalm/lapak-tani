@extends('layouts.app')

@section('title', $user->name . ' - Petani - Lapak Tani')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Profile Header -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-6">
                <div class="flex items-start space-x-6">
                    <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full">
                    
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-2">
                            <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                            @if($user->is_verified)
                                <i class="bi bi-patch-check-fill text-green-500 text-xl" title="Petani Terverifikasi"></i>
                            @endif
                        </div>
                        
                        @if($user->farm_name)
                            <p class="text-lg text-gray-600 mb-2">{{ $user->farm_name }}</p>
                        @endif
                        
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Petani
                            </span>
                            @if($user->is_verified)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Terverifikasi
                                </span>
                            @endif
                        </div>
                        
                        @if($user->bio)
                            <p class="text-gray-700 mb-4">{{ $user->bio }}</p>
                        @endif
                        
                        <!-- Stats -->
                        <div class="flex items-center space-x-6 mb-4">
                            <div class="text-center">
                                <p class="text-xl font-bold text-gray-900">{{ $stats['products_count'] }}</p>
                                <p class="text-sm text-gray-500">Produk</p>
                            </div>
                            <div class="text-center">
                                <p class="text-xl font-bold text-gray-900">{{ $stats['orders_count'] }}</p>
                                <p class="text-sm text-gray-500">Pesanan</p>
                            </div>
                            <div class="text-center">
                                <p class="text-xl font-bold text-gray-900">{{ $stats['educations_count'] }}</p>
                                <p class="text-sm text-gray-500">Edukasi</p>
                            </div>
                        </div>
                        
                        <!-- Contact Info -->
                        @if($user->location)
                            <div class="flex items-center text-gray-600 mb-2">
                                <i class="bi bi-geo-alt mr-2"></i>
                                <span>{{ $user->location }}</span>
                            </div>
                        @endif
                        
                        @if($user->phone)
                            <div class="flex items-center text-gray-600">
                                <i class="bi bi-telephone mr-2"></i>
                                <span>{{ $user->phone }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Tabs -->
        <div class="bg-white rounded-lg shadow">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8 px-6">
                    <button onclick="showTab('products')" 
                            class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm active">
                        Produk
                    </button>
                    <button onclick="showTab('educations')" 
                            class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Edukasi
                    </button>
                </nav>
            </div>

            <!-- Products Tab -->
            <div id="products-tab" class="tab-content p-6">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <div class="bg-gray-50 rounded-lg overflow-hidden hover:shadow-md transition duration-200">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                                    <p class="text-hijau-600 font-bold text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-500 mb-2">Stok: {{ $product->stock }} {{ $product->unit }}</p>
                                    @if($product->is_organic)
                                        <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                            Organik
                                        </span>
                                    @endif
                                    
                                    @auth
                                        @if(auth()->user()->isKonsumen() && $product->stock > 0)
                                            <button type="button" class="w-full btn-primary mt-3" onclick="addToCart({{ $product->id }})">
                                                <i class="bi bi-cart mr-2"></i>
                                                Tambah ke Keranjang
                                            </button>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="block w-full text-center btn-primary mt-3">
                                            Login untuk Membeli
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($user->products()->count() > 6)
                        <div class="text-center mt-6">
                            <a href="{{ route('products') }}?petani={{ $user->slug }}" class="btn-secondary">
                                Lihat Semua Produk
                            </a>
                        </div>
                    @endif
                @else
                    <div class="text-center py-12">
                        <i class="bi bi-box text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-500">Belum ada produk yang ditampilkan</p>
                    </div>
                @endif
            </div>

            <!-- Educations Tab -->
            <div id="educations-tab" class="tab-content p-6 hidden">
                @if($educations->count() > 0)
                    <div class="space-y-6">
                        @foreach($educations as $education)
                            <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition duration-200">
                                <div class="flex items-start space-x-4">
                                    @if($education->featured_image)
                                        <img src="{{ asset('storage/' . $education->featured_image) }}" 
                                             alt="{{ $education->title }}" 
                                             class="w-20 h-20 object-cover rounded-lg">
                                    @endif
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $education->title }}</h3>
                                        @if($education->excerpt)
                                            <p class="text-gray-600 mb-3">{{ $education->excerpt }}</p>
                                        @endif
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center text-sm text-gray-500">
                                                <i class="bi bi-eye mr-1"></i>
                                                <span>{{ $education->views_count }} views</span>
                                                <span class="mx-2">•</span>
                                                <span>{{ $education->created_at->format('d M Y') }}</span>
                                            </div>
                                            <a href="{{ route('education.show', $education->slug) }}" class="btn-primary">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($user->educations()->count() > 3)
                        <div class="text-center mt-6">
                            <a href="{{ route('education') }}?petani={{ $user->slug }}" class="btn-secondary">
                                Lihat Semua Edukasi
                            </a>
                        </div>
                    @endif
                @else
                    <div class="text-center py-12">
                        <i class="bi bi-book text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-500">Belum ada konten edukasi yang ditampilkan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function showTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.add('hidden');
    });
    
    // Remove active class from all tab buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active', 'border-hijau-500', 'text-hijau-600');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab content
    document.getElementById(tabName + '-tab').classList.remove('hidden');
    
    // Add active class to selected tab button
    event.target.classList.add('active', 'border-hijau-500', 'text-hijau-600');
    event.target.classList.remove('border-transparent', 'text-gray-500');
}

// Add to cart function
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
            // Show success notification
            showNotification('Produk berhasil ditambahkan ke keranjang!', 'success');
        } else {
            showNotification(data.message || 'Gagal menambahkan produk ke keranjang', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan', 'error');
    });
}
</script>

<style>
.tab-button.active {
    border-color: #16a34a !important;
    color: #16a34a !important;
}
</style>
@endsection
