@extends('layouts.dashboard')

@section('title', 'Edit Edukasi - Admin')
@section('page-title', 'Edit Konten Edukasi')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Edit Konten Edukasi</h3>
            <p class="text-sm text-gray-600 mt-1">Perbarui konten edukasi</p>
        </div>
        
        <form action="{{ route('admin.education.update') }}" method="POST" enctype="multipart/form-data" data-ajax="true" class="p-6 space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
                <input type="text" id="title" name="title" required 
                       class="form-input" 
                       value="{{ $education->title }}"
                       placeholder="Masukkan judul konten edukasi">
            </div>
            
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Unggah Gambar</label>
                <input type="file" id="image" name="image" 
                    class="form-input" accept="image/*">
                <p class="text-sm text-gray-500 mt-1">Opsional. Unggah gambar untuk konten edukasi (jpeg, png, jpg, max 2MB).</p>
            </div>
            
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten</label>
                <textarea id="content" name="content" rows="12" required 
                          class="form-textarea" 
                          placeholder="Tulis konten edukasi yang informatif dan menginspirasi...">{{ $education->content }}</textarea>
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('admin.education.index') }}" class="btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn-primary">
                    Perbarui Konten
                </button>
            </div>
        </form>
    </div>
</div>
@endsection