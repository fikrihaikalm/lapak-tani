@extends('layouts.app')

@section('title', 'Tentang Kami - Lapak Tani')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-hijau-600 to-hijau-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Tentang Lapak Tani</h1>
            <p class="text-xl text-hijau-100 max-w-3xl mx-auto">
                Platform digital yang menghubungkan petani lokal dengan konsumen, 
                sekaligus menyediakan edukasi pertanian untuk generasi masa depan.
            </p>
        </div>
    </div>
</div>

<!-- Mission & Vision -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Visi & Misi Kami</h2>
                
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-hijau-600 mb-3">Visi</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Menjadi platform terdepan yang memberdayakan petani Indonesia dan 
                        menginspirasi generasi muda untuk mencintai dunia pertanian.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-xl font-semibold text-hijau-600 mb-3">Misi</h3>
                    <ul class="space-y-2 text-gray-700">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-hijau-500 mt-1 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Menghubungkan petani langsung dengan konsumen tanpa perantara
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-hijau-500 mt-1 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Menyediakan produk pertanian segar dan berkualitas
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-hijau-500 mt-1 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Memberikan edukasi pertanian yang mudah diakses
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-hijau-500 mt-1 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Membangun komunitas pertanian yang kuat dan berkelanjutan
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1500937386664-56d1dfef3854?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                     alt="Petani di sawah" class="rounded-lg shadow-lg">
                <div class="absolute inset-0 bg-hijau-600 bg-opacity-20 rounded-lg"></div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Dampak Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Bersama-sama membangun ekosistem pertanian yang lebih baik untuk Indonesia
            </p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="text-3xl font-bold text-hijau-600 mb-2">{{ number_format($stats['total_petani']) }}+</div>
                    <div class="text-gray-600">Petani Bergabung</div>
                </div>
            </div>
            
            <div class="text-center">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="text-3xl font-bold text-hijau-600 mb-2">{{ number_format($stats['total_konsumen']) }}+</div>
                    <div class="text-gray-600">Konsumen Aktif</div>
                </div>
            </div>
            
            <div class="text-center">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="text-3xl font-bold text-hijau-600 mb-2">{{ number_format($stats['total_products']) }}+</div>
                    <div class="text-gray-600">Produk Tersedia</div>
                </div>
            </div>
            
            <div class="text-center">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="text-3xl font-bold text-hijau-600 mb-2">{{ number_format($stats['total_orders']) }}+</div>
                    <div class="text-gray-600">Transaksi Berhasil</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Values -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Nilai-Nilai Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Prinsip-prinsip yang menjadi fondasi dalam setiap langkah perjalanan kami
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="bg-hijau-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-hijau-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Kepedulian</h3>
                <p class="text-gray-600">
                    Kami peduli terhadap kesejahteraan petani dan kualitas produk yang sampai ke konsumen.
                </p>
            </div>
            
            <div class="text-center">
                <div class="bg-hijau-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-hijau-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Kepercayaan</h3>
                <p class="text-gray-600">
                    Membangun kepercayaan melalui transparansi dan kualitas layanan yang konsisten.
                </p>
            </div>
            
            <div class="text-center">
                <div class="bg-hijau-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-hijau-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Inovasi</h3>
                <p class="text-gray-600">
                    Terus berinovasi untuk memberikan solusi terbaik bagi ekosistem pertanian Indonesia.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Team -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Tim Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Orang-orang berdedikasi yang bekerja keras untuk mewujudkan visi Lapak Tani
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow text-center p-6">
                <img src="https://ui-avatars.com/api/?name=Ahmad+Rizki&background=16a34a&color=fff&size=128" 
                     alt="Ahmad Rizki" class="w-24 h-24 rounded-full mx-auto mb-4">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Ahmad Rizki</h3>
                <p class="text-hijau-600 mb-3">Founder & CEO</p>
                <p class="text-gray-600 text-sm">
                    Berpengalaman 10+ tahun di bidang agritech dan passionate dalam memberdayakan petani Indonesia.
                </p>
            </div>
            
            <div class="bg-white rounded-lg shadow text-center p-6">
                <img src="https://ui-avatars.com/api/?name=Sari+Dewi&background=16a34a&color=fff&size=128" 
                     alt="Sari Dewi" class="w-24 h-24 rounded-full mx-auto mb-4">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Sari Dewi</h3>
                <p class="text-hijau-600 mb-3">Head of Operations</p>
                <p class="text-gray-600 text-sm">
                    Ahli dalam manajemen rantai pasok dan memastikan kualitas produk dari petani ke konsumen.
                </p>
            </div>
            
            <div class="bg-white rounded-lg shadow text-center p-6">
                <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=16a34a&color=fff&size=128" 
                     alt="Budi Santoso" class="w-24 h-24 rounded-full mx-auto mb-4">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Budi Santoso</h3>
                <p class="text-hijau-600 mb-3">Head of Technology</p>
                <p class="text-gray-600 text-sm">
                    Software engineer berpengalaman yang membangun platform teknologi untuk mendukung petani.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="bg-hijau-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Bergabunglah dengan Komunitas Kami</h2>
        <p class="text-xl text-hijau-100 mb-8 max-w-2xl mx-auto">
            Mari bersama-sama membangun masa depan pertanian Indonesia yang lebih baik
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
