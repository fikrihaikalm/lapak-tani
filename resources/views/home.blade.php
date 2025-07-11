@extends('layouts.app')

@section('title', 'Beranda - Lapak Tani')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-hijau-600 to-hijau-700 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-20"></div>
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1631116279964-70a0e168fce4?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 drop-shadow-lg">
                Lapak Tani
            </h1>
            <p class="text-xl md:text-2xl text-white mb-8 max-w-4xl mx-auto drop-shadow-md">
                Platform digital yang menghubungkan petani dengan konsumen,
                sekaligus menyediakan edukasi pertanian untuk generasi masa depan.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('products') }}" class="bg-white text-hijau-600 font-semibold py-4 px-8 rounded-lg hover:bg-gray-100 transition duration-200 shadow-lg">
                    Jelajahi Produk
                </a>
                <a href="{{ route('education') }}" class="border-2 border-white text-white font-semibold py-4 px-8 rounded-lg hover:bg-white hover:text-hijau-600 transition duration-200">
                    Pelajari Pertanian
                </a>
                <a href="{{ route('petani.directory') }}" class="bg-hijau-800 text-white font-semibold py-4 px-8 rounded-lg hover:bg-hijau-900 transition duration-200">
                    Temukan Petani
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold text-hijau-600 mb-2">{{ $stats['total_petani'] ?? 0 }}+</div>
                <div class="text-gray-600">Petani Terdaftar</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-hijau-600 mb-2">{{ $stats['total_products'] ?? 0 }}+</div>
                <div class="text-gray-600">Produk Tersedia</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-hijau-600 mb-2">{{ $stats['total_orders'] ?? 0 }}+</div>
                <div class="text-gray-600">Transaksi Berhasil</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-hijau-600 mb-2">{{ $stats['total_educations'] ?? 0 }}+</div>
                <div class="text-gray-600">Konten Edukasi</div>
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
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-hijau-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-check-circle text-3xl text-hijau-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Produk Berkualitas</h3>
                <p class="text-gray-600">Produk pertanian segar langsung dari petani lokal terpercaya</p>
            </div>

            <div class="text-center p-6">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-cart text-3xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belanja Mudah</h3>
                <p class="text-gray-600">Sistem e-commerce yang mudah dan aman untuk berbelanja</p>
            </div>

            <div class="text-center p-6">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-mortarboard text-3xl text-purple-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Edukasi Pertanian</h3>
                <p class="text-gray-600">Menyediakan konten edukasi untuk menginspirasi generasi muda</p>
            </div>

            <div class="text-center p-6">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-people text-3xl text-green-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Komunitas</h3>
                <p class="text-gray-600">Bergabung dengan komunitas petani dan konsumen yang saling mendukung</p>
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

<!-- Testimonials Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Apa Kata Mereka?</h2>
            <p class="text-lg text-gray-600">Testimoni dari petani dan konsumen yang telah bergabung</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center mb-4">
                    <img src="https://ui-avatars.com/api/?name=Pak+Tani&background=16a34a&color=fff&size=64" alt="Pak Tani" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <h4 class="font-semibold text-gray-900">Pak Tani Sukses</h4>
                        <p class="text-sm text-gray-600">Petani Sayuran</p>
                    </div>
                </div>
                <p class="text-gray-700 mb-4">"Platform ini sangat membantu saya menjual hasil panen langsung ke konsumen. Pendapatan meningkat drastis!"</p>
                <div class="flex items-center">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star-fill text-yellow-400"></i>
                    @endfor
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center mb-4">
                    <img src="https://ui-avatars.com/api/?name=Siti+Konsumen&background=3b82f6&color=fff&size=64" alt="Siti" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <h4 class="font-semibold text-gray-900">Siti Konsumen</h4>
                        <p class="text-sm text-gray-600">Ibu Rumah Tangga</p>
                    </div>
                </div>
                <p class="text-gray-700 mb-4">"Sayuran yang saya beli selalu segar dan berkualitas. Harga juga lebih terjangkau karena langsung dari petani."</p>
                <div class="flex items-center">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star-fill text-yellow-400"></i>
                    @endfor
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center mb-4">
                    <img src="https://ui-avatars.com/api/?name=Bu+Sari&background=16a34a&color=fff&size=64" alt="Bu Sari" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <h4 class="font-semibold text-gray-900">Bu Sari</h4>
                        <p class="text-sm text-gray-600">Petani Hidroponik</p>
                    </div>
                </div>
                <p class="text-gray-700 mb-4">"Konten edukasi di sini sangat membantu saya mengembangkan teknik hidroponik. Sekarang hasil panen lebih optimal!"</p>
                <div class="flex items-center">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star-fill text-yellow-400"></i>
                    @endfor
                </div>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('testimonials') }}" class="btn-secondary">
                Lihat Testimoni Lainnya
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
@guest
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
        <!-- @endguest -->
    </div>
</section>
@endguest

@endsection