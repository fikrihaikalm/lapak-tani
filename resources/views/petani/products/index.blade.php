@extends('layouts.dashboard')

@section('title', 'Produk Saya - Petani')
@section('page-title', 'Produk Saya')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">Produk Saya</h3>
            <p class="text-sm text-gray-600 mt-1">Kelola produk pertanian Anda</p>
        </div>
        <a href="{{ route('petani.products.create') }}" class="btn-primary">
            Tambah Produk
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($products as $product)
                <tr>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://via.placeholder.com/40' }}"
                                 alt="{{ $product->name }}" 
                                 class="w-10 h-10 rounded-lg object-cover">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($product->description, 50) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-hijau-600">{{ $product->formatted_price }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $product->stock }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $product->created_at->format('d M Y') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('petani.products.edit', $product->id) }}" 
                           class="text-blue-600 hover:text-blue-900">
                            Edit
                        </a>
                        <button data-delete="{{ route('petani.products.destroy', $product->id) }}" 
                                class="text-red-600 hover:text-red-900">
                            Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <i class="bi bi-box text-5xl text-gray-400 mb-4"></i>
                        <h3 class="text-sm font-medium text-gray-900 mb-1">Belum Ada Produk</h3>
                        <p class="text-sm text-gray-500 mb-4">Mulai dengan menambahkan produk pertanian pertama Anda.</p>
                        <a href="{{ route('petani.products.create') }}" class="btn-primary">
                            Tambah Produk Pertama
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($products->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection