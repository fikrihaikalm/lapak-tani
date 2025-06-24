@extends('layouts.app')

@section('title', 'Keranjang Belanja - Lapak Tani')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Keranjang Belanja</h1>
        <p class="text-gray-600 mt-2">Kelola produk yang akan Anda beli</p>
    </div>

    <div class="space-y-6">
    @if($cartItems->count() > 0)
        @foreach($cartItems as $petaniId => $items)
            @php $petani = $items->first()->product->user; @endphp
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <img src="{{ $petani->avatar_url }}" alt="{{ $petani->name }}" class="w-10 h-10 rounded-full">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $petani->name }}</h3>
                                @if($petani->farm_name)
                                    <p class="text-sm text-gray-500">{{ $petani->farm_name }}</p>
                                @endif
                            </div>
                        </div>
                        @if($petani->is_verified)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="bi bi-patch-check-fill mr-1"></i>
                                Terverifikasi
                            </span>
                        @endif
                    </div>
                </div>

                <div class="p-6">
                    <div class="space-y-4">
                        @foreach($items as $item)
                            <div class="flex items-center space-x-4 py-4 border-b border-gray-100 last:border-b-0">
                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-lg">
                                
                                <div class="flex-1">
                                    <h4 class="text-lg font-medium text-gray-900">{{ $item->product->name }}</h4>
                                    <p class="text-sm text-gray-500">{{ Str::limit($item->product->description, 100) }}</p>
                                    <div class="flex items-center space-x-4 mt-2">
                                        <span class="text-lg font-semibold text-hijau-600">{{ $item->product->formatted_price }}</span>
                                        @if($item->product->is_organic)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Organik
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <div class="flex items-center border border-gray-300 rounded-lg">
                                        <button type="button" class="p-2 hover:bg-gray-50" onclick="CartManager.updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})">
                                            <i class="bi bi-dash"></i>
                                        </button>
                                        <input type="number" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                               class="w-16 text-center border-0 focus:ring-0"
                                               onchange="CartManager.updateQuantity({{ $item->id }}, this.value)">
                                        <button type="button" class="p-2 hover:bg-gray-50" onclick="CartManager.updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                    
                                    <div class="text-right">
                                        <p class="text-lg font-semibold text-gray-900" id="subtotal-{{ $item->id }}">{{ $item->formatted_subtotal }}</p>
                                        <p class="text-sm text-gray-500">Stok: {{ $item->product->stock }}</p>
                                    </div>

                                    <button type="button" class="text-red-600 hover:text-red-700 p-2" onclick="CartManager.removeFromCart({{ $item->id }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Checkout Section for this Petani -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-lg font-semibold text-gray-900">Subtotal</span>
                            <span class="text-xl font-bold text-hijau-600">
                                Rp {{ number_format($items->sum('subtotal'), 0, ',', '.') }}
                            </span>
                        </div>
                        
                        <form action="{{ route('konsumen.orders.checkout') }}" method="POST" data-ajax="true" class="space-y-4">
                            @csrf
                            <input type="hidden" name="petani_id" value="{{ $petaniId }}">
                            
                            <div>
                                <label for="shipping_address_{{ $petaniId }}" class="block text-sm font-medium text-gray-700 mb-2">Alamat Pengiriman</label>
                                <textarea name="shipping_address" id="shipping_address_{{ $petaniId }}" rows="3" required
                                          class="form-textarea" 
                                          placeholder="Masukkan alamat lengkap untuk pengiriman">{{ auth()->user()->address }}</textarea>
                            </div>
                            
                            <div>
                                <label for="phone_{{ $petaniId }}" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                <input type="text" name="phone" id="phone_{{ $petaniId }}" required
                                       class="form-input" 
                                       value="{{ auth()->user()->phone }}"
                                       placeholder="Nomor telepon untuk konfirmasi">
                            </div>
                            
                            <div>
                                <label for="notes_{{ $petaniId }}" class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                                <textarea name="notes" id="notes_{{ $petaniId }}" rows="2"
                                          class="form-textarea" 
                                          placeholder="Catatan khusus untuk petani"></textarea>
                            </div>
                            
                            <button type="submit" class="w-full btn-primary">
                                Checkout Pesanan dari {{ $petani->name }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <i class="bi bi-cart text-6xl text-gray-400 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Keranjang Kosong</h3>
            <p class="text-gray-500 mb-6">Belum ada produk di keranjang Anda</p>
            <a href="{{ route('products') }}" class="btn-primary">
                Mulai Belanja
            </a>
        </div>
    @endif
    </div>
</div>


@endsection
