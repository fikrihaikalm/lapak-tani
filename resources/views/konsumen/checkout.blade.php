@extends('layouts.app')

@section('title', 'Checkout - Lapak Tani')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
        <p class="text-gray-600 mt-2">Lengkapi informasi pengiriman untuk menyelesaikan pesanan</p>
    </div>

    <form id="checkout-form" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        
        <!-- Delivery Information -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pengiriman</h2>
                
                <div class="space-y-4">
                    <div>
                        <label for="delivery_address" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat Lengkap *
                        </label>
                        <textarea id="delivery_address" 
                                  name="delivery_address" 
                                  rows="4" 
                                  required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500"
                                  placeholder="Masukkan alamat lengkap untuk pengiriman..."></textarea>
                    </div>
                    
                    <div>
                        <label for="delivery_notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Catatan Tambahan
                        </label>
                        <textarea id="delivery_notes" 
                                  name="delivery_notes" 
                                  rows="2"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500"
                                  placeholder="Catatan khusus untuk petani (opsional)..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Order Summary by Petani -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h2>
                
                @foreach($groupedItems as $petaniId => $items)
                    @php $petani = $items->first()->product->user; @endphp
                    <div class="mb-6 last:mb-0 p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-medium text-gray-900 mb-3">
                            📦 Pesanan dari {{ $petani->name }}
                            @if($petani->farm_name)
                                <span class="text-sm text-gray-500">({{ $petani->farm_name }})</span>
                            @endif
                        </h3>
                        
                        <div class="space-y-3">
                            @foreach($items as $item)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <img src="{{ $item->product->image_url }}" 
                                             alt="{{ $item->product->name }}" 
                                             class="w-12 h-12 object-cover rounded-lg">
                                        <div>
                                            <h4 class="font-medium text-gray-900">{{ $item->product->name }}</h4>
                                            <p class="text-sm text-gray-500">{{ $item->quantity }} {{ $item->product->unit }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium text-gray-900">
                                            Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            @ Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-3 pt-3 border-t border-gray-200">
                            <div class="flex justify-between font-medium text-gray-900">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($items->sum(function($item) { return $item->product->price * $item->quantity; }), 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <!-- Order Total -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-24">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Total Pembayaran</h2>
                
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-medium">Rp {{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }), 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Ongkos Kirim</span>
                        <span class="font-medium text-hijau-600">Gratis</span>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="flex justify-between text-lg font-semibold">
                        <span>Total</span>
                        <span class="text-hijau-600">Rp {{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }), 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <div class="mt-6 space-y-3">
                    <button type="submit" 
                            id="checkout-btn"
                            class="w-full bg-hijau-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-hijau-700 transition duration-200">
                        <span id="checkout-text">Pesan via WhatsApp</span>
                        <span id="checkout-loading" class="hidden">
                            <i class="bi bi-arrow-clockwise animate-spin mr-2"></i>
                            Memproses...
                        </span>
                    </button>
                    
                    <a href="{{ route('konsumen.cart.index') }}" 
                       class="block w-full text-center text-hijau-600 hover:text-hijau-700 font-medium py-2">
                        Kembali ke Keranjang
                    </a>
                </div>
                
                <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                    <div class="flex items-start space-x-2">
                        <i class="bi bi-info-circle text-blue-600 mt-0.5"></i>
                        <div class="text-sm text-blue-800">
                            <p class="font-medium mb-1">Cara Pemesanan:</p>
                            <ol class="list-decimal list-inside space-y-1 text-xs">
                                <li>Klik "Pesan via WhatsApp"</li>
                                <li>Anda akan diarahkan ke WhatsApp petani</li>
                                <li>Konfirmasi pesanan dengan petani</li>
                                <li>Lakukan pembayaran sesuai kesepakatan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Success Modal -->
<div id="success-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-md w-full p-6">
        <div class="text-center">
            <div class="w-16 h-16 bg-hijau-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-check-circle-fill text-hijau-600 text-3xl"></i>
            </div>
            
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Pesanan Berhasil Dibuat!</h3>
            <p class="text-gray-600 mb-6">Silakan lanjutkan ke WhatsApp untuk konfirmasi dengan petani.</p>
            
            <div id="whatsapp-links" class="space-y-3 mb-6">
                <!-- WhatsApp links will be inserted here -->
            </div>
            
            <button onclick="closeModal()" 
                    class="w-full bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition duration-200">
                Tutup
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/checkout.js') }}"></script>
@endpush
@endsection
