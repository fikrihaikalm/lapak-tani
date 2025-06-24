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
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
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
                                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                            </div>
                            @if($farmer->farm_name)
                                <p class="text-sm text-gray-600">{{ $farmer->farm_name }}</p>
                            @endif
                            @if($farmer->rating > 0)
                                <div class="flex items-center mt-1">
                                    <div class="flex items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $farmer->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="text-sm text-gray-600 ml-1">{{ $farmer->formatted_rating }}</span>
                                </div>
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
                                <button type="button" class="btn-secondary" onclick="toggleFollow({{ $farmer->id }}, this)">
                                    {{ auth()->user()->isFollowing($farmer) ? 'Unfollow' : 'Follow' }}
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
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

<script>
function toggleFollow(userId, button) {
    @auth
        fetch('/follow', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ user_id: userId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                button.textContent = data.action === 'followed' ? 'Unfollow' : 'Follow';
            }
        });
    @else
        window.location.href = '{{ route("login") }}';
    @endauth
}
</script>
@endsection
