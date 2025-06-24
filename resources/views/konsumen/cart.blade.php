@extends('layouts.app')

@section('title', 'Keranjang Belanja - Lapak Tani')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Keranjang Belanja</h1>
        <p class="text-gray-600 mt-2">Kelola produk yang ingin Anda beli</p>
    </div>

    @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Produk dalam Keranjang</h2>
                    </div>
                    
                    <div class="divide-y divide-gray-200">
                        @foreach($cartItems as $item)
                            <div class="p-6 flex items-center space-x-4" data-cart-item="{{ $item->id }}">
                                <!-- Product Image -->
                                <div class="flex-shrink-0">
                                    <img src="{{ $item->product->image_url }}" 
                                         alt="{{ $item->product->name }}" 
                                         class="w-20 h-20 object-cover rounded-lg border border-gray-200">
                                </div>
                                
                                <!-- Product Info -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-medium text-gray-900 truncate">
                                        {{ $item->product->name }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Oleh {{ $item->product->user->name }}
                                    </p>
                                    <p class="text-lg font-semibold text-hijau-600 mt-2">
                                        Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                    </p>
                                </div>
                                
                                <!-- Quantity Controls -->
                                <div class="flex items-center space-x-3">
                                    <button type="button" 
                                            onclick="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})"
                                            class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition duration-200"
                                            {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                        </svg>
                                    </button>
                                    
                                    <span class="w-12 text-center font-medium text-gray-900">
                                        {{ $item->quantity }}
                                    </span>
                                    
                                    <button type="button" 
                                            onclick="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})"
                                            class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition duration-200"
                                            {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                    </button>
                                </div>
                                
                                <!-- Subtotal -->
                                <div class="text-right">
                                    <p class="text-lg font-semibold text-gray-900">
                                        Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                    </p>
                                    <button type="button" 
                                            onclick="removeFromCart({{ $item->id }})"
                                            class="text-sm text-red-600 hover:text-red-800 mt-2">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 sticky top-24">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h2>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal ({{ $cartItems->sum('quantity') }} item)</span>
                                <span class="font-medium">Rp {{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }), 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Ongkos Kirim</span>
                                <span class="font-medium">Gratis</span>
                            </div>
                            
                            <hr class="my-4">
                            
                            <div class="flex justify-between text-lg font-semibold">
                                <span>Total</span>
                                <span class="text-hijau-600">Rp {{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }), 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        <button type="button" 
                                onclick="proceedToCheckout()"
                                class="w-full mt-6 bg-hijau-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-hijau-700 transition duration-200">
                            Lanjut ke Checkout
                        </button>
                        
                        <a href="{{ route('products') }}" 
                           class="block w-full mt-3 text-center text-hijau-600 hover:text-hijau-700 font-medium">
                            Lanjut Belanja
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart -->
        <div class="text-center py-16">
            <div class="max-w-md mx-auto">
                <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9"/>
                    </svg>
                </div>
                
                <h2 class="text-2xl font-semibold text-gray-900 mb-4">Keranjang Kosong</h2>
                <p class="text-gray-600 mb-8">Belum ada produk dalam keranjang Anda. Mari mulai berbelanja!</p>
                
                <a href="{{ route('products') }}" 
                   class="inline-flex items-center px-6 py-3 bg-hijau-600 text-white font-semibold rounded-lg hover:bg-hijau-700 transition duration-200">
                    Mulai Belanja
                </a>
            </div>
        </div>
    @endif
</div>



<script>
function updateQuantity(cartItemId, newQuantity) {
    if (newQuantity < 1) return;
    
    fetch('/konsumen/cart/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            cart_item_id: cartItemId,
            quantity: newQuantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            showMessage('error', data.message || 'Gagal mengupdate quantity');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showMessage('error', 'Terjadi kesalahan');
    });
}

function removeFromCart(cartItemId) {
    if (!confirm('Yakin ingin menghapus produk ini dari keranjang?')) return;
    
    fetch('/konsumen/cart/remove', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            cart_item_id: cartItemId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.querySelector(`[data-cart-item="${cartItemId}"]`).remove();
            showMessage('success', 'Produk berhasil dihapus dari keranjang');
            
            // Reload if cart is empty
            setTimeout(() => location.reload(), 1000);
        } else {
            showMessage('error', data.message || 'Gagal menghapus produk');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showMessage('error', 'Terjadi kesalahan');
    });
}

function proceedToCheckout() {
    window.location.href = '/konsumen/checkout';
}

function showMessage(type, message) {
    if (type === 'success') {
        showSuccess(message);
    } else {
        showError(message);
    }
}
</script>
@endsection
