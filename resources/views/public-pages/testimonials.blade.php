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

<!-- Static Testimonials -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Testimoni Pengguna</h2>
            <p class="text-lg text-gray-600">Cerita nyata dari petani dan konsumen yang telah merasakan manfaat Lapak Tani</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
                <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200 hover:shadow-xl transition duration-300">
                    <div class="flex items-center mb-4">
                        <img src="{{ $testimonial['avatar'] }}" alt="{{ $testimonial['name'] }}" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h3 class="font-semibold text-gray-900">{{ $testimonial['name'] }}</h3>
                            <p class="text-sm text-hijau-600 font-medium">{{ $testimonial['role'] }}</p>
                            <p class="text-xs text-gray-500">📍 {{ $testimonial['location'] }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="flex text-yellow-400 mb-3">
                            @for($i = 0; $i < $testimonial['rating']; $i++)
                                <i class="bi bi-star-fill"></i>
                            @endfor
                        </div>

                        <p class="text-gray-700 italic leading-relaxed">"{{ $testimonial['message'] }}"</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-16">
            <div class="bg-hijau-50 rounded-lg p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Bergabunglah dengan Komunitas Lapak Tani</h3>
                <p class="text-gray-600 mb-6">Rasakan pengalaman berbelanja langsung dari petani atau mulai jual hasil panen Anda</p>
                <div class="space-x-4">
                    <a href="{{ route('register') }}" class="btn-primary">
                        Daftar Sekarang
                    </a>
                    <a href="{{ route('products') }}" class="btn-secondary">
                        Lihat Produk
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
