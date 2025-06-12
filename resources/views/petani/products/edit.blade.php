@extends('layouts.dashboard')

@section('title', 'Edit Produk - Petani')
@section('page-title', 'Edit Produk')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Edit Produk</h3>
            <p class="text-sm text-gray-600 mt-1">Perbarui informasi produk Anda</p>
        </div>
        
        <form action="{{ route('petani.products.update', $product->id) }}" method="POST" data-ajax="true" class="p-6 space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                <input type="text" id="name" name="name" required 
                       class="form-input" 
                       value="{{ $product->name }}"
                       placeholder="Contoh: Beras Organik Premium">
            </div>
            
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea id="description" name="description" rows="4" required 
                          class="form-textarea" 
                          placeholder="Jelaskan produk Anda secara detail...">{{ $product->description }}</textarea>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp)</label>
                    <input type="number" id="price" name="price" required min="0" step="100"
                           class="form-input" 
                           value="{{ $product->price }}"
                           placeholder="15000">
                </div>
                
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                    <input type="number" id="stock" name="stock" required min="0"
                           class="form-input" 
                           value="{{ $product->stock }}"
                           placeholder="100">
                </div>
            </div>
            
            <div>
                <label for="image_url" class="block text-sm font-medium text-gray-700 mb-2">URL Gambar</label>
                <input type="url" id="image_url" name="image_url" 
                       class="form-input" 
                       value="{{ $product->image_url }}"
                       placeholder="https://example.com/image.jpg">
                <p class="text-sm text-gray-500 mt-1">Opsional. Masukkan URL gambar produk Anda.</p>
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('petani.products.index') }}" class="btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn-primary">
                    Perbarui Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection