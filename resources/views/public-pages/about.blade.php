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
                            <i class="bi bi-check text-hijau-500 mt-1 mr-2 flex-shrink-0"></i>
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
                    <i class="bi bi-heart text-3xl text-hijau-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Kepedulian</h3>
                <p class="text-gray-600">
                    Kami peduli terhadap kesejahteraan petani dan kualitas produk yang sampai ke konsumen.
                </p>
            </div>
            
            <div class="text-center">
                <div class="bg-hijau-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-shield-check text-3xl text-hijau-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Kepercayaan</h3>
                <p class="text-gray-600">
                    Membangun kepercayaan melalui transparansi dan kualitas layanan yang konsisten.
                </p>
            </div>
            
            <div class="text-center">
                <div class="bg-hijau-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-lightbulb text-3xl text-hijau-600"></i>
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
                <img src="https://ui-avatars.com/api/?name=MF&background=16a34a&color=fff&size=128"
                     alt="Muhammad Fikri Haikal" class="w-24 h-24 rounded-full mx-auto mb-4">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Muhammad Fikri Haikal</h3>
                <p class="text-hijau-600 mb-3">Founder & CEO</p>
                <p class="text-gray-600 text-sm">
                    Berpengalaman 10+ tahun di bidang agritech dan passionate dalam memberdayakan petani Indonesia.
                </p>
            </div>
            
            <div class="bg-white rounded-lg shadow text-center p-6">
                <img src="https://ui-avatars.com/api/?name=AH&background=3b82f6&color=fff&size=128"
                     alt="Ahmad Hisyam Ramadhan" class="w-24 h-24 rounded-full mx-auto mb-4">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Ahmad Hisyam Ramadhan</h3>
                <p class="text-hijau-600 mb-3">CTO</p>
                <p class="text-gray-600 text-sm">
                    Expert dalam teknologi digital dan pengembangan platform e-commerce untuk sektor pertanian.
                </p>
            </div>
            
            <div class="bg-white rounded-lg shadow text-center p-6">
                <img src="https://ui-avatars.com/api/?name=RA&background=f59e0b&color=fff&size=128"
                     alt="Royhan Awwabi" class="w-24 h-24 rounded-full mx-auto mb-4">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Royhan Awwabi</h3>
                <p class="text-hijau-600 mb-3">Head of Operations</p>
                <p class="text-gray-600 text-sm">
                    Mengelola operasional harian dan memastikan kualitas layanan terbaik untuk semua pengguna platform.
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

<!-- Lokasi Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Lokasi Kami</h2>
            <p class="text-lg text-gray-600">Temukan kami di jantung wilayah pertanian Jawa Timur</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Kantor Pusat Lapak Tani</h3>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <i class="bi bi-geo-alt-fill text-hijau-600 text-xl mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-900">Alamat</p>
                            <p class="text-gray-600">Kampus Tegalboto, Jl. Kalimantan No.37<br>Krajan Timur, Sumbersari, Kec. Sumbersari<br>Kabupaten Jember, Jawa Timur 68121</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <i class="bi bi-telephone-fill text-hijau-600 text-xl mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-900">Telepon</p>
                            <p class="text-gray-600">+62 822 2974 0385</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <i class="bi bi-envelope-fill text-hijau-600 text-xl mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-900">Email</p>
                            <p class="text-gray-600">info@lapaktani.com</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-hijau-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="font-semibold text-gray-900">Jam Operasional</p>
                            <p class="text-gray-600">Senin - Jumat: 08:00 - 17:00<br>Sabtu: 08:00 - 12:00</p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-gray-200 rounded-lg overflow-hidden shadow-lg">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.8267!2d113.7168!3d-8.1660!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOMKwMDknNTcuNiJTIDExM8KwNDMnMDAuNyJF!5e0!3m2!1sen!2sid!4v1640000000000!5m2!1sen!2sid"
                        width="100%"
                        height="400"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <p class="text-sm text-gray-500 mt-2 text-center">
                    Koordinat: 8°09'57.6"S 113°43'00.7"E
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
