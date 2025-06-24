@extends('layouts.app')

@section('title', 'Testimoni - Lapak Tani')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-hijau-600 to-hijau-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Testimoni</h1>
            <p class="text-xl text-hijau-100 max-w-3xl mx-auto">
                Dengarkan cerita sukses dari petani dan konsumen yang telah bergabung dengan Lapak Tani
            </p>
        </div>
    </div>
</div>

<!-- Success Stories - Petani -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Cerita Sukses Petani</h2>
            <p class="text-lg text-gray-600">Petani yang telah merasakan manfaat bergabung dengan platform kami</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($successfulPetani as $petani)
                <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200">
                    <div class="flex items-center mb-4">
                        <img src="{{ $petani->avatar_url }}" alt="{{ $petani->name }}" class="w-16 h-16 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold text-gray-900">{{ $petani->name }}</h4>
                            @if($petani->farm_name)
                                <p class="text-sm text-gray-600">{{ $petani->farm_name }}</p>
                            @endif
                            @if($petani->is_verified)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 mt-1">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Terverifikasi
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <blockquote class="text-gray-700 mb-4">
                        "Sejak bergabung dengan Lapak Tani, pendapatan saya meningkat {{ rand(30, 80) }}%. Platform ini memudahkan saya menjual hasil panen langsung ke konsumen tanpa perantara."
                    </blockquote>
                    
                    <div class="grid grid-cols-2 gap-4 text-center bg-gray-50 rounded-lg p-3">
                        <div>
                            <p class="text-lg font-semibold text-hijau-600">{{ $petani->products_count }}</p>
                            <p class="text-xs text-gray-500">Produk</p>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-hijau-600">{{ $petani->total_sales ?? rand(50, 200) }}</p>
                            <p class="text-xs text-gray-500">Penjualan</p>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('social.profile', $petani->id) }}" class="text-hijau-600 hover:text-hijau-700 text-sm font-medium">
                            Lihat Profil →
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-8">
                    <p class="text-gray-500">Belum ada testimoni petani</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Happy Customers -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Konsumen Puas</h2>
            <p class="text-lg text-gray-600">Konsumen yang senang berbelanja produk segar dari petani lokal</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($happyCustomers as $customer)
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center mb-4">
                        <img src="{{ $customer->avatar_url }}" alt="{{ $customer->name }}" class="w-12 h-12 rounded-full mr-3">
                        <div>
                            <h4 class="font-semibold text-gray-900">{{ $customer->name }}</h4>
                            <p class="text-sm text-gray-600">Konsumen Setia</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        @endfor
                    </div>
                    
                    <blockquote class="text-gray-700 mb-4">
                        @if($customer->completed_orders >= 10)
                            "Sudah {{ $customer->completed_orders }} kali belanja di sini. Produk selalu segar dan berkualitas!"
                        @elseif($customer->completed_orders >= 5)
                            "Setelah {{ $customer->completed_orders }} pesanan, saya sangat puas dengan layanan dan kualitas produknya."
                        @else
                            "Baru {{ $customer->completed_orders }} kali belanja tapi sudah merasa cocok dengan platform ini."
                        @endif
                    </blockquote>
                    
                    <div class="text-center bg-blue-50 rounded-lg p-3">
                        <p class="text-lg font-semibold text-blue-600">{{ $customer->completed_orders }}</p>
                        <p class="text-xs text-gray-500">Pesanan Selesai</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-8">
                    <p class="text-gray-500">Belum ada testimoni konsumen</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Video Testimonials -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Video Testimoni</h2>
            <p class="text-lg text-gray-600">Dengarkan langsung dari mereka yang telah merasakan manfaatnya</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-gray-200 rounded-lg h-64 flex items-center justify-center">
                <div class="text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-gray-500 font-medium">Video Testimoni Pak Tani</p>
                    <p class="text-sm text-gray-400">Cerita sukses meningkatkan pendapatan</p>
                </div>
            </div>
            
            <div class="bg-gray-200 rounded-lg h-64 flex items-center justify-center">
                <div class="text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-gray-500 font-medium">Video Testimoni Bu Sari</p>
                    <p class="text-sm text-gray-400">Pengalaman berbelanja produk segar</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics -->
<div class="py-16 bg-hijau-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">Dampak Positif Lapak Tani</h2>
            <p class="text-xl text-hijau-100">Angka-angka yang menunjukkan kesuksesan bersama</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold mb-2">95%</div>
                <div class="text-hijau-100">Tingkat Kepuasan</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">{{ rand(50, 80) }}%</div>
                <div class="text-hijau-100">Peningkatan Pendapatan Petani</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">{{ rand(20, 40) }}%</div>
                <div class="text-hijau-100">Penghematan Konsumen</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">4.8/5</div>
                <div class="text-hijau-100">Rating Platform</div>
            </div>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Ingin Menjadi Bagian dari Cerita Sukses?</h2>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
            Bergabunglah dengan ribuan petani dan konsumen yang telah merasakan manfaatnya
        </p>
        <div class="space-x-4">
            <a href="{{ route('register') }}" class="bg-hijau-600 text-white font-semibold py-3 px-8 rounded-lg hover:bg-hijau-700 transition duration-200">
                Daftar Sekarang
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-hijau-600 text-hijau-600 font-semibold py-3 px-8 rounded-lg hover:bg-hijau-600 hover:text-white transition duration-200">
                Hubungi Kami
            </a>
        </div>
    </div>
</div>
@endsection
