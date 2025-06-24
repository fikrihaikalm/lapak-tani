@extends('layouts.dashboard')

@section('title', 'Tambah Produk - Petani')
@section('page-title', 'Tambah Produk Baru')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Tambah Produk Baru</h3>
            <p class="text-sm text-gray-600 mt-1">Tambahkan produk pertanian Anda untuk dijual</p>
        </div>
        
        <form action="{{ route('petani.products.store') }}" method="POST" enctype="multipart/form-data" data-ajax="true" class="p-6 space-y-6">
            @csrf
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                <input type="text" id="name" name="name" required 
                       class="form-input" 
                       placeholder="Contoh: Beras Organik Premium">
            </div>
            
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea id="description" name="description" rows="4" required
                          class="form-textarea"
                          placeholder="Jelaskan produk Anda secara detail..."></textarea>
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select id="category_id" name="category_id" class="form-select">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->icon }} {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp)</label>
                    <input type="number" id="price" name="price" required min="0" step="100"
                           class="form-input"
                           placeholder="15000">
                </div>

                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                    <input type="number" id="stock" name="stock" required min="0"
                           class="form-input"
                           placeholder="100">
                </div>

                <div>
                    <label for="unit" class="block text-sm font-medium text-gray-700 mb-2">Satuan</label>
                    <select id="unit" name="unit" class="form-select">
                        <option value="kg">Kilogram (kg)</option>
                        <option value="gram">Gram (g)</option>
                        <option value="pcs">Pieces (pcs)</option>
                        <option value="pack">Paket (pack)</option>
                        <option value="liter">Liter (L)</option>
                        <option value="ml">Mililiter (ml)</option>
                        <option value="ikat">Ikat</option>
                        <option value="buah">Buah</option>
                    </select>
                </div>
            </div>
            
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Unggah Gambar</label>
                <input type="file" id="image" name="image"
                    class="form-input" accept="image/*" onchange="previewImage(this)">
                <p class="text-sm text-gray-500 mt-1">Unggah gambar produk (jpeg, png, jpg, max 2MB).</p>

                <!-- Image Preview -->
                <div id="image-preview" class="mt-4 hidden">
                    <img id="preview-img" src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                    <button type="button" onclick="removePreview()" class="mt-2 text-sm text-red-600 hover:text-red-800">
                        Hapus Gambar
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="weight" class="block text-sm font-medium text-gray-700 mb-2">Berat (kg)</label>
                    <input type="number" id="weight" name="weight" min="0" step="0.1"
                           class="form-input"
                           placeholder="1.0">
                    <p class="text-sm text-gray-500 mt-1">Opsional. Berat per unit produk</p>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="is_organic" name="is_organic" value="1" class="rounded border-gray-300 text-hijau-600 shadow-sm focus:border-hijau-300 focus:ring focus:ring-hijau-200 focus:ring-opacity-50">
                    <label for="is_organic" class="ml-2 block text-sm text-gray-900">
                        Produk Organik
                    </label>
                </div>
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('petani.products.index') }}" class="btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn-primary">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function removePreview() {
    const input = document.getElementById('image');
    const preview = document.getElementById('image-preview');

    input.value = '';
    preview.classList.add('hidden');
}
</script>
@endsection