@extends('layouts.app')

@section('title', $education->title . ' - Edukasi Pertanian')

@section('content')
<div class="bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li><a href="{{ route('home') }}" class="hover:text-hijau-600">Beranda</a></li>
                <li><span>/</span></li>
                <li><a href="{{ route('education') }}" class="hover:text-hijau-600">Edukasi</a></li>
                <li><span>/</span></li>
                <li class="text-gray-900">{{ $education->title }}</li>
            </ol>
        </nav>
        
        <!-- Article Header -->
        <header class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $education->title }}</h1>
            <div class="flex items-center space-x-4 text-gray-600">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ $education->user->name }}</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ $education->created_at->format('d F Y') }}</span>
                </div>
            </div>
        </header>
        
        <!-- Featured Image -->
        @if($education->image_url)
        <div class="mb-8">
            <img src="{{ $education->image_url }}" 
                 alt="{{ $education->title }}" 
                 class="w-full h-64 md:h-96 object-cover rounded-lg shadow-lg">
        </div>
        @endif
        
        <!-- Article Content -->
        <div class="prose prose-lg max-w-none">
            <div class="text-gray-700 leading-relaxed">
                {!! nl2br(e($education->content)) !!}
            </div>
        </div>
        
        <!-- Back Button -->
        <div class="mt-12 pt-8 border-t border-gray-200">
            <a href="{{ route('education') }}" class="inline-flex items-center text-hijau-600 hover:text-hijau-700 font-medium">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                Kembali ke Edukasi
            </a>
        </div>
    </div>
</div>
@endsection
