@extends('layouts.app')

@section('title', 'Edukasi - Katalog Pertanian')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Konten Edukasi Pertanian</h1>
            <p class="text-lg text-gray-600">Pelajari tips, trik, dan pengetahuan pertanian dari para ahli</p>
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
                    <a href="{{ route('education.show', $education->id) }}" class="btn-primary w-full text-center">
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
        
        @if($educations->hasPages())
        <div class="mt-12">
            {{ $educations->links() }}
        </div>
        @endif
    </div>
</div>
@endsection