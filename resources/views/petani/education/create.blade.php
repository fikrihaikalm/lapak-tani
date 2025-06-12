@extends('layouts.dashboard')

@section('title', 'Buat Konten Edukasi - Petani')
@section('page-title', 'Buat Konten Edukasi')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Buat Konten Edukasi Baru</h3>
            <p class="text-sm text-gray-600 mt-1">Bagikan pengalaman dan pengetahuan pertanian Anda</p>
        </div>
        
        <form action="{{ route('petani.education.store') }}" method="POST" data-ajax="true" class="p-6 space-y-6">
            @csrf
            
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
                <input type="text" id="title" name="title" required 
                       class="form-input" 
                       placeholder="Contoh: Tips Menanam Padi Organik">
            </div>
            
            <div>
                <label for="image_url" class="block text-sm font-medium text-gray-700 mb-2">URL Gambar</label>
                <input type="url" id="image_url" name="image_url" 
                       class="form-input" 
                       placeholder="https://example.com/image.jpg">
                <p class="text-sm text-gray-500 mt-1">Opsional. Masukkan URL gambar untuk konten edukasi.</p>
            </div>
            
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten</label>
                <textarea id="content" name="content" rows="12" required 
                          class="form-textarea" 
                          placeholder="Bagikan pengalaman, tips, dan pengetahuan pertanian Anda..."></textarea>
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('petani.education.index') }}" class="btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn-primary">
                    Publikasikan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection