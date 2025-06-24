@extends('layouts.app')

@section('title', 'Profil Saya - Lapak Tani')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Profile Header -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-6">
                <div class="flex items-start space-x-6">
                    <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full">
                    
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="flex items-center space-x-3 mb-2">
                                    <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                                    @if($user->is_verified)
                                        <i class="bi bi-patch-check-fill text-green-500 text-xl"></i>
                                    @endif
                                </div>
                                
                                @if($user->farm_name)
                                    <p class="text-lg text-gray-600 mb-2">{{ $user->farm_name }}</p>
                                @endif
                                
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->isPetani() ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ $user->isPetani() ? 'Petani' : 'Konsumen' }}
                                    </span>
                                </div>
                                
                                @if($user->bio)
                                    <p class="text-gray-700 mb-4">{{ $user->bio }}</p>
                                @endif
                            </div>
                            
                            <a href="{{ route('profile.edit') }}" class="btn-primary">
                                <i class="bi bi-pencil mr-2"></i>
                                Edit Profil
                            </a>
                        </div>
                        
                        <!-- Stats -->
                        <div class="flex items-center space-x-6 mb-4">
                            <div class="text-center">
                                <p class="text-xl font-bold text-gray-900">{{ $stats['products_count'] }}</p>
                                <p class="text-sm text-gray-500">Produk</p>
                            </div>
                            <div class="text-center">
                                <p class="text-xl font-bold text-gray-900">{{ $stats['orders_count'] }}</p>
                                <p class="text-sm text-gray-500">{{ $user->isPetani() ? 'Pesanan Masuk' : 'Pesanan Saya' }}</p>
                            </div>
                            @if($user->isPetani())
                                <div class="text-center">
                                    <p class="text-xl font-bold text-gray-900">{{ $stats['educations_count'] }}</p>
                                    <p class="text-sm text-gray-500">Edukasi</p>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Contact Info -->
                        @if($user->location)
                            <div class="flex items-center text-gray-600 mb-2">
                                <i class="bi bi-geo-alt mr-2"></i>
                                <span>{{ $user->location }}</span>
                            </div>
                        @endif
                        
                        @if($user->phone)
                            <div class="flex items-center text-gray-600">
                                <i class="bi bi-telephone mr-2"></i>
                                <span>{{ $user->phone }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>



        <!-- Content Tabs -->
        <div class="bg-white rounded-lg shadow">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8 px-6">
                    <button onclick="showTab('products')" 
                            class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm active">
                        {{ $user->isPetani() ? 'Produk Saya' : 'Aktivitas' }}
                    </button>
                    @if($user->isPetani())
                        <button onclick="showTab('educations')" 
                                class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Edukasi
                        </button>
                    @endif
                </nav>
            </div>

            <!-- Products/Activity Tab -->
            <div id="products-tab" class="tab-content p-6">
                @if($user->isPetani())
                    @if($user->products->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($user->products->take(6) as $product)
                                <div class="bg-gray-50 rounded-lg overflow-hidden hover:shadow-md transition duration-200">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                    <div class="p-4">
                                        <h3 class="font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                                        <p class="text-hijau-600 font-bold text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                        <p class="text-sm text-gray-500">Stok: {{ $product->stock }} {{ $product->unit }}</p>
                                        @if($product->is_organic)
                                            <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full mt-2">
                                                Organik
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($user->products->count() > 6)
                            <div class="text-center mt-6">
                                <a href="{{ route('petani.products.index') }}" class="btn-secondary">
                                    Lihat Semua Produk
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-12">
                            <i class="bi bi-box text-4xl text-gray-400 mb-4"></i>
                            <p class="text-gray-500 mb-4">Belum ada produk yang ditampilkan</p>
                            <a href="{{ route('petani.products.create') }}" class="btn-primary">
                                Tambah Produk Pertama
                            </a>
                        </div>
                    @endif
                @else
                    <div class="text-center py-12">
                        <i class="bi bi-activity text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-500 mb-4">Aktivitas terbaru akan ditampilkan di sini</p>
                        <a href="{{ route('products') }}" class="btn-primary">
                            Mulai Berbelanja
                        </a>
                    </div>
                @endif
            </div>

            <!-- Educations Tab -->
            @if($user->isPetani())
                <div id="educations-tab" class="tab-content p-6 hidden">
                    @if($user->educations->count() > 0)
                        <div class="space-y-6">
                            @foreach($user->educations->take(5) as $education)
                                <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition duration-200">
                                    <div class="flex items-start space-x-4">
                                        @if($education->featured_image)
                                            <img src="{{ asset('storage/' . $education->featured_image) }}" 
                                                 alt="{{ $education->title }}" 
                                                 class="w-20 h-20 object-cover rounded-lg">
                                        @endif
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $education->title }}</h3>
                                            @if($education->excerpt)
                                                <p class="text-gray-600 mb-3">{{ $education->excerpt }}</p>
                                            @endif
                                            <div class="flex items-center text-sm text-gray-500">
                                                <i class="bi bi-eye mr-1"></i>
                                                <span>{{ $education->views_count }} views</span>
                                                <span class="mx-2">•</span>
                                                <span>{{ $education->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($user->educations->count() > 5)
                            <div class="text-center mt-6">
                                <a href="{{ route('petani.education.index') }}" class="btn-secondary">
                                    Lihat Semua Edukasi
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-12">
                            <i class="bi bi-book text-4xl text-gray-400 mb-4"></i>
                            <p class="text-gray-500 mb-4">Belum ada konten edukasi yang ditampilkan</p>
                            <a href="{{ route('petani.education.create') }}" class="btn-primary">
                                Buat Konten Edukasi
                            </a>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function showTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.add('hidden');
    });
    
    // Remove active class from all tab buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active', 'border-hijau-500', 'text-hijau-600');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab content
    document.getElementById(tabName + '-tab').classList.remove('hidden');
    
    // Add active class to selected tab button
    event.target.classList.add('active', 'border-hijau-500', 'text-hijau-600');
    event.target.classList.remove('border-transparent', 'text-gray-500');
}
</script>

<style>
.tab-button.active {
    border-color: #16a34a !important;
    color: #16a34a !important;
}
</style>
@endsection
