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
                    <i class="bi bi-cart text-2xl text-hijau-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">E-Commerce Terintegrasi</h3>
                <p class="text-gray-600">Sistem belanja online lengkap dengan keranjang, wishlist, dan tracking pesanan</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="bg-purple-100 rounded-lg w-12 h-12 flex items-center justify-center mb-4">
                    <i class="bi bi-book text-2xl text-purple-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Konten Edukasi</h3>
                <p class="text-gray-600">Artikel dan video pembelajaran tentang teknik pertanian modern</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="bg-blue-100 rounded-lg w-12 h-12 flex items-center justify-center mb-4">
                    <i class="bi bi-chat-dots text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Social Network</h3>
                <p class="text-gray-600">Berbagi pengalaman, tips, dan membangun komunitas pertanian</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="bg-green-100 rounded-lg w-12 h-12 flex items-center justify-center mb-4">
                    <i class="bi bi-currency-dollar text-xl text-green-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Manajemen Keuangan</h3>
                <p class="text-gray-600">Tools untuk mencatat pemasukan, pengeluaran, dan analisis keuntungan</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="bg-yellow-100 rounded-lg w-12 h-12 flex items-center justify-center mb-4">
                    <i class="bi bi-shield-check text-2xl text-yellow-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Verifikasi Petani</h3>
                <p class="text-gray-600">Sistem verifikasi untuk memastikan kualitas dan kepercayaan</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="bg-red-100 rounded-lg w-12 h-12 flex items-center justify-center mb-4">
                    <i class="bi bi-heart-fill text-red-600 text-2xl"></i>
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
