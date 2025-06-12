@extends('layouts.app')

@section('title', 'Beranda - Lapak Tani')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-hijau-600 to-hijau-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Lapak Tani
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-hijau-100">
                Menghubungkan petani lokal dengan konsumen dan menginspirasi generasi muda untuk terjun ke dunia pertanian
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('products') }}" class="bg-white text-hijau-600 font-semibold py-3 px-8 rounded-lg hover:bg-gray-100 transition duration-200">
                    Jelajahi Produk
                </a>
                <a href="{{ route('education') }}" class="border-2 border-white text-white font-semibold py-3 px-8 rounded-lg hover:bg-white hover:text-hijau-600 transition duration-200">
                    Pelajari Pertanian
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Mengapa Memilih Kami?</h2>
            <p class="text-lg text-gray-600">Platform terpercaya untuk produk pertanian lokal berkualitas</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-hijau-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-hijau-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Produk Berkualitas</h3>
                <p class="text-gray-600">Produk pertanian segar langsung dari petani lokal terpercaya</p>
            </div>
            
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-coklat-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-coklat-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Mendukung Petani Lokal</h3>
                <p class="text-gray-600">Membantu petani lokal memasarkan produk mereka secara langsung</p>
            </div>
            
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-hijau-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-hijau-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.75 2.524z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Edukasi Pertanian</h3>
                <p class="text-gray-600">Menyediakan konten edukasi untuk menginspirasi generasi muda</p>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Produk Terbaru</h2>
                <p class="text-lg text-gray-600">Produk pertanian segar dari petani lokal</p>
            </div>
            <a href="{{ route('products') }}" class="btn-primary">
                Lihat Semua Produk
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
            <div class="card hover:shadow-lg transition duration-200">
                <div class="aspect-w-16 aspect-h-9">
                    <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://via.placeholder.com/40' }}"
                         alt="{{ $product->name }}" 
                         class="w-full h-48 object-cover">
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-2">{{ Str::limit($product->description, 100) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-hijau-600">{{ $product->formatted_price }}</span>
                        <span class="text-sm text-gray-500">Stok: {{ $product->stock }}</span>
                    </div>
                    <div class="mt-4 text-sm text-gray-500">
                        Oleh: {{ $product->user->name }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Education Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Konten Edukasi</h2>
                <p class="text-lg text-gray-600">Pelajari tips dan trik pertanian dari para ahli</p>
            </div>
            <a href="{{ route('education') }}" class="btn-secondary">
                Lihat Semua Edukasi
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($educations as $education)
            <article class="card hover:shadow-lg transition duration-200">
                <div class="aspect-w-16 aspect-h-9">
                    <img src="{{ $education->image_path ? asset('storage/' . $education->image_path) : 'https://via.placeholder.com/40' }}"
                         alt="{{ $education->title }}" 
                         class="w-full h-48 object-cover">
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $education->title }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $education->excerpt }}</p>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('education.show', $education->id) }}" class="text-hijau-600 hover:text-hijau-700 font-medium">
                            Baca Selengkapnya →
                        </a>
                        <span class="text-sm text-gray-500">{{ $education->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="mt-4 text-sm text-gray-500">
                        Oleh: {{ $education->user->name }}
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-black text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Bergabunglah dengan Komunitas Kami</h2>
        <p class="text-xl text-white mb-8">
            Daftar sekarang dan mulai jual produk pertanian Anda atau pelajari lebih lanjut tentang dunia pertanian
        </p>
        @guest
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="bg-hijau-600 hover:bg-hijau-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-200">
                Daftar Sebagai Petani
            </a>
            <a href="{{ route('login') }}" class="border-2 border-white text-white font-semibold py-3 px-8 rounded-lg hover:bg-white hover:text-black transition duration-200">
                Masuk ke Akun
            </a>
        </div>
        @endguest
    </div>
</section>
@endsection