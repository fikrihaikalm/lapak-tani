@extends('layouts.app')

@section('title', 'Edukasi - Katalog Pertanian')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-hijau-600 to-hijau-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Konten Edukasi Pertanian</h1>
            <p class="text-xl text-hijau-100 max-w-3xl mx-auto mb-8">
                Pelajari tips, trik, dan pengetahuan pertanian dari para ahli dan petani berpengalaman
            </p>
        </div>
    </div>
</div>

<!-- Search & Filter Section -->
<div class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <form method="GET" class="flex flex-col md:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari artikel edukasi..."
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Sort -->
            <div class="md:w-48">
                <select name="sort" class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                    <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Unggulan</option>
                </select>
            </div>

            <!-- Filter Button -->
            <button type="submit" class="btn-primary whitespace-nowrap">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"/>
                </svg>
                Filter
            </button>
        </form>
    </div>
</div>

<!-- Education Content Section -->
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Results Info -->
        <div class="mb-8">
            <p class="text-gray-600">
                Menampilkan {{ $educations->count() }} dari {{ $educations->total() }} artikel
                @if(request('search'))
                    untuk "<strong>{{ request('search') }}</strong>"
                @endif
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($educations as $education)
            <article class="card hover:shadow-lg transition duration-200">
                <div class="aspect-w-16 aspect-h-9">
                    <img src="{{ $education->image_path ? asset('storage/' . $education->image_path) : 'https://via.placeholder.com/40' }}"
                         alt="{{ $education->title }}" 
                         class="w-full h-48 object-cover">
                </div>
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">{{ $education->title }}</h2>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $education->excerpt }}</p>
                    <div class="flex justify-between items-center mb-4">
                        <div class="text-sm text-gray-500">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                                {{ $education->user->name }}
                            </div>
                            <div class="flex items-center mt-1">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                                {{ $education->created_at->format('d M Y') }}
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('education.show', $education->slug) }}" class="btn-primary w-full text-center">
                        Baca Selengkapnya
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Konten Edukasi</h3>
                <p class="text-gray-600">Konten edukasi akan ditampilkan di sini.</p>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($educations->hasPages())
            <div class="mt-12">
                {{ $educations->links() }}
            </div>
        @endif
    </div>
</div>
@endsection