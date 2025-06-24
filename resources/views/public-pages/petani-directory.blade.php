@extends('layouts.app')

@section('title', 'Direktori Petani - Lapak Tani')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-hijau-600 to-hijau-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Direktori Petani</h1>
            <p class="text-xl text-hijau-100 max-w-3xl mx-auto">
                Temukan petani lokal terpercaya dan produk segar berkualitas tinggi
            </p>
        </div>
    </div>
</div>

<!-- Search & Filter -->
<div class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <form method="GET" action="{{ route('petani.directory') }}" class="relative">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari petani atau nama kebun..."
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="bi bi-search text-gray-400"></i>
                    </div>
                </form>
            </div>
            <div class="flex gap-2">
                <form method="GET" action="{{ route('petani.directory') }}" class="flex gap-2">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <select name="location" onchange="this.form.submit()" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500">
                        <option value="">Semua Lokasi</option>
                        <option value="jakarta" {{ request('location') == 'jakarta' ? 'selected' : '' }}>Jakarta</option>
                        <option value="bogor" {{ request('location') == 'bogor' ? 'selected' : '' }}>Bogor</option>
                        <option value="bandung" {{ request('location') == 'bandung' ? 'selected' : '' }}>Bandung</option>
                        <option value="malang" {{ request('location') == 'malang' ? 'selected' : '' }}>Malang</option>
                    </select>
                    <select name="sort" onchange="this.form.submit()" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500">
                        <option value="">Urutkan</option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
                        <option value="products" {{ request('sort') == 'products' ? 'selected' : '' }}>Produk Terbanyak</option>
                        <option value="followers" {{ request('sort') == 'followers' ? 'selected' : '' }}>Followers Terbanyak</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Petani Grid -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($petani as $farmer)
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-200">
                <!-- Profile Header -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center space-x-4">
                        <img src="{{ $farmer->avatar_url }}" alt="{{ $farmer->name }}" class="w-16 h-16 rounded-full">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $farmer->name }}</h3>
                                @if($farmer->is_verified)
                                    <i class="bi bi-patch-check-fill text-green-500"></i>
                                @endif
                            </div>
                            @if($farmer->farm_name)
                                <p class="text-sm text-gray-600">{{ $farmer->farm_name }}</p>
                            @endif

                        </div>
                    </div>
                    
                    @if($farmer->bio)
                        <p class="text-gray-600 mt-3 text-sm">{{ Str::limit($farmer->bio, 100) }}</p>
                    @endif
                </div>

                <!-- Stats -->
                <div class="px-6 py-4 bg-gray-50">
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div>
                            <p class="text-lg font-semibold text-gray-900">{{ $farmer->products_count }}</p>
                            <p class="text-xs text-gray-500">Produk</p>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-gray-900">{{ $farmer->followers_count }}</p>
                            <p class="text-xs text-gray-500">Followers</p>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-gray-900">{{ $farmer->total_reviews ?? 0 }}</p>
                            <p class="text-xs text-gray-500">Review</p>
                        </div>
                    </div>
                </div>

                <!-- Sample Products -->
                @if($farmer->products->count() > 0)
                    <div class="p-6">
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Produk Unggulan</h4>
                        <div class="grid grid-cols-3 gap-2">
                            @foreach($farmer->products->take(3) as $product)
                                <div class="relative">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-16 object-cover rounded">
                                    <div class="absolute inset-0 bg-black bg-opacity-40 rounded flex items-center justify-center opacity-0 hover:opacity-100 transition duration-200">
                                        <p class="text-white text-xs font-medium text-center px-1">{{ Str::limit($product->name, 15) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Actions -->
                <div class="p-6 pt-0">
                    <div class="flex space-x-2">
                        <a href="{{ route('social.profile', $farmer->id) }}" class="flex-1 btn-primary text-center">
                            Lihat Profil
                        </a>
                        @auth
                            @if(auth()->user()->isKonsumen())
                                <button type="button" class="btn-secondary" onclick="SocialManager.toggleFollow({{ $farmer->id }}, this)">
                                    {{ auth()->user()->isFollowing($farmer) ? 'Unfollow' : 'Follow' }}
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <i class="bi bi-people text-6xl text-gray-400 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Petani</h3>
                <p class="text-gray-500">Belum ada petani yang terdaftar di platform ini</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($petani->hasPages())
        <div class="mt-12">
            {{ $petani->links() }}
        </div>
    @endif
</div>

<!-- CTA Section -->
<div class="bg-hijau-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Ingin Bergabung Sebagai Petani?</h2>
        <p class="text-xl text-hijau-100 mb-8 max-w-2xl mx-auto">
            Daftarkan diri Anda dan mulai jual produk pertanian langsung ke konsumen
        </p>
        <a href="{{ route('register') }}" class="bg-white text-hijau-600 font-semibold py-3 px-8 rounded-lg hover:bg-gray-100 transition duration-200">
            Daftar Sebagai Petani
        </a>
    </div>
</div>


@endsection
