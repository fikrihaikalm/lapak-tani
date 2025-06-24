@extends('layouts.app')

@section('title', 'Cara Kerja - Lapak Tani')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-hijau-600 to-hijau-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Cara Kerja Lapak Tani</h1>
            <p class="text-xl text-hijau-100 max-w-3xl mx-auto">
                Pelajari bagaimana platform kami menghubungkan petani dengan konsumen
            </p>
        </div>
    </div>
</div>

<!-- For Consumers -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Untuk Konsumen</h2>
            <p class="text-lg text-gray-600">Langkah mudah berbelanja produk segar dari petani lokal</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-bold text-blue-600">1</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Daftar Akun</h3>
                <p class="text-gray-600">Buat akun sebagai konsumen dengan mudah dan gratis</p>
            </div>
            
            <div class="text-center">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-bold text-blue-600">2</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Jelajahi Produk</h3>
                <p class="text-gray-600">Temukan berbagai produk segar dari petani terverifikasi</p>
            </div>
            
            <div class="text-center">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-bold text-blue-600">3</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Pesan & Bayar</h3>
                <p class="text-gray-600">Tambahkan ke keranjang dan lakukan pembayaran yang aman</p>
            </div>
            
            <div class="text-center">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-bold text-blue-600">4</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Terima Produk</h3>
                <p class="text-gray-600">Produk segar dikirim langsung ke alamat Anda</p>
            </div>
        </div>
    </div>
</div>

<!-- For Farmers -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Untuk Petani</h2>
            <p class="text-lg text-gray-600">Mulai jual produk Anda dan raih keuntungan maksimal</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-bold text-green-600">1</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Daftar Sebagai Petani</h3>
                <p class="text-gray-600">Buat akun petani dan lengkapi profil kebun Anda</p>
            </div>
            
            <div class="text-center">
                <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-bold text-green-600">2</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Upload Produk</h3>
                <p class="text-gray-600">Tambahkan foto dan deskripsi produk pertanian Anda</p>
            </div>
            
            <div class="text-center">
                <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-bold text-green-600">3</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Terima Pesanan</h3>
                <p class="text-gray-600">Kelola pesanan masuk dan konfirmasi ketersediaan</p>
            </div>
            
            <div class="text-center">
                <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-bold text-green-600">4</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Kirim & Terima Bayaran</h3>
                <p class="text-gray-600">Kirim produk dan terima pembayaran langsung</p>
            </div>
        </div>
    </div>
</div>

<!-- Features -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
            <p class="text-lg text-gray-600">Berbagai fitur yang memudahkan transaksi dan pembelajaran</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="bg-hijau-100 rounded-lg w-12 h-12 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-hijau-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">E-Commerce Terintegrasi</h3>
                <p class="text-gray-600">Sistem belanja online lengkap dengan keranjang, wishlist, dan tracking pesanan</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="bg-purple-100 rounded-lg w-12 h-12 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Konten Edukasi</h3>
                <p class="text-gray-600">Artikel dan video pembelajaran tentang teknik pertanian modern</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="bg-blue-100 rounded-lg w-12 h-12 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Social Network</h3>
                <p class="text-gray-600">Berbagi pengalaman, tips, dan membangun komunitas pertanian</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="bg-green-100 rounded-lg w-12 h-12 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Manajemen Keuangan</h3>
                <p class="text-gray-600">Tools untuk mencatat pemasukan, pengeluaran, dan analisis keuntungan</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="bg-yellow-100 rounded-lg w-12 h-12 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Verifikasi Petani</h3>
                <p class="text-gray-600">Sistem verifikasi untuk memastikan kualitas dan kepercayaan</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="bg-red-100 rounded-lg w-12 h-12 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Rating & Review</h3>
                <p class="text-gray-600">Sistem penilaian untuk menjaga kualitas produk dan layanan</p>
            </div>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="bg-hijau-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Siap Memulai?</h2>
        <p class="text-xl text-hijau-100 mb-8 max-w-2xl mx-auto">
            Bergabunglah dengan ribuan petani dan konsumen yang sudah merasakan manfaatnya
        </p>
        <div class="space-x-4">
            <a href="{{ route('register') }}" class="bg-white text-hijau-600 font-semibold py-3 px-8 rounded-lg hover:bg-gray-100 transition duration-200">
                Daftar Sekarang
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-white text-white font-semibold py-3 px-8 rounded-lg hover:bg-white hover:text-hijau-600 transition duration-200">
                Hubungi Kami
            </a>
        </div>
    </div>
</div>
@endsection
