@extends('layouts.app')

@section('title', 'Blog - Lapak Tani')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-hijau-600 to-hijau-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Blog Lapak Tani</h1>
            <p class="text-xl text-hijau-100 max-w-3xl mx-auto">
                Artikel terbaru seputar pertanian, tips berkebun, dan cerita inspiratif dari komunitas kami
            </p>
        </div>
    </div>
</div>

<!-- Featured Article -->
@if($featuredPost)
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-hijau-100 text-hijau-800">
                Artikel Unggulan
            </span>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="md:flex">
                <div class="md:w-1/2">
                    <img src="{{ $featuredPost->image_url }}" alt="{{ $featuredPost->title }}" class="w-full h-64 md:h-full object-cover">
                </div>
                <div class="md:w-1/2 p-8">
                    <div class="flex items-center mb-4">
                        <img src="{{ $featuredPost->user->avatar_url }}" alt="{{ $featuredPost->user->name }}" class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <p class="font-medium text-gray-900">{{ $featuredPost->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $featuredPost->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $featuredPost->title }}</h2>
                    <p class="text-gray-600 mb-6">{{ $featuredPost->excerpt }}</p>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                {{ $featuredPost->views_count }} views
                            </span>
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $featuredPost->duration_minutes }} min read
                            </span>
                        </div>
                        
                        <a href="{{ route('education.show', $featuredPost->id) }}" class="btn-primary">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Categories Filter -->
<div class="bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('blog') }}" class="px-4 py-2 rounded-full {{ !request('category') ? 'bg-hijau-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }} transition duration-200">
                Semua Artikel
            </a>
            @foreach($categories as $category)
                <a href="{{ route('blog', ['category' => $category->id]) }}" 
                   class="px-4 py-2 rounded-full {{ request('category') == $category->id ? 'bg-hijau-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }} transition duration-200">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Blog Posts Grid -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
                <article class="bg-white rounded-lg shadow hover:shadow-lg transition duration-200">
                    <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-48 object-cover rounded-t-lg">
                    
                    <div class="p-6">
                        <!-- Category Badge -->
                        <div class="flex items-center justify-between mb-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" 
                                  style="background-color: {{ $post->category->color }}20; color: {{ $post->category->color }}">
                                {{ $post->category->name }}
                            </span>
                            @if($post->is_featured)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Unggulan
                                </span>
                            @endif
                        </div>
                        
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">
                            <a href="{{ route('education.show', $post->id) }}" class="hover:text-hijau-600 transition duration-200">
                                {{ $post->title }}
                            </a>
                        </h3>
                        
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $post->excerpt }}</p>
                        
                        <!-- Author & Meta -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="{{ $post->user->avatar_url }}" alt="{{ $post->user->name }}" class="w-8 h-8 rounded-full mr-2">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $post->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $post->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-3 text-xs text-gray-500">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    {{ $post->views_count }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    {{ $post->likes_count }}
                                </span>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Artikel</h3>
                    <p class="text-gray-500">Artikel akan segera hadir</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Newsletter Subscription -->
<div class="bg-hijau-600 text-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Dapatkan Artikel Terbaru</h2>
        <p class="text-xl text-hijau-100 mb-8">
            Berlangganan newsletter kami untuk mendapatkan tips pertanian dan artikel menarik lainnya
        </p>
        
        <form class="max-w-md mx-auto">
            <div class="flex">
                <input type="email" placeholder="Masukkan email Anda" 
                       class="flex-1 px-4 py-3 rounded-l-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-hijau-300">
                <button type="submit" class="bg-hijau-800 text-white px-6 py-3 rounded-r-lg hover:bg-hijau-900 transition duration-200">
                    Berlangganan
                </button>
            </div>
        </form>
        
        <p class="text-sm text-hijau-200 mt-4">
            Kami menghormati privasi Anda. Unsubscribe kapan saja.
        </p>
    </div>
</div>

<!-- Popular Tags -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Tag Populer</h2>
        </div>
        
        <div class="flex flex-wrap justify-center gap-3">
            @php
                $popularTags = ['Pertanian Organik', 'Hidroponik', 'Pupuk Kompos', 'Hama Tanaman', 'Irigasi', 'Bibit Unggul', 'Teknologi Pertanian', 'Panen Raya', 'Greenhouse', 'Sustainable Farming'];
            @endphp
            @foreach($popularTags as $tag)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white text-gray-700 hover:bg-hijau-100 hover:text-hijau-800 cursor-pointer transition duration-200">
                    #{{ $tag }}
                </span>
            @endforeach
        </div>
    </div>
</div>
@endsection
