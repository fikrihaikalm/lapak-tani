@extends('layouts.app')

@section('title', 'Pesanan Saya - Lapak Tani')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Pesanan Saya</h1>
        <p class="text-gray-600 mt-2">Kelola dan pantau status pesanan Anda</p>
    </div>

    <div class="space-y-6">
    @forelse($orders as $order)
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">#{{ $order->order_number }}</h3>
                        <div class="flex items-center space-x-4 mt-1">
                            <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $order->status_badge }}">
                                {{ $order->status_label }}
                            </span>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xl font-bold text-hijau-600">{{ $order->formatted_total }}</p>
                        @if($order->payment)
                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $order->payment->status_badge }}">
                                {{ $order->payment->status_label }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="p-6">
                <!-- Petani Info -->
                <div class="flex items-center space-x-3 mb-4">
                    <img src="{{ $order->petani->avatar_url }}" alt="{{ $order->petani->name }}" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="font-medium text-gray-900">{{ $order->petani->name }}</p>
                        @if($order->petani->farm_name)
                            <p class="text-sm text-gray-500">{{ $order->petani->farm_name }}</p>
                        @endif
                    </div>
                    @if($order->petani->is_verified)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="bi bi-patch-check-fill mr-1"></i>
                            Terverifikasi
                        </span>
                    @endif
                </div>

                <!-- Order Items -->
                <div class="space-y-3 mb-4">
                    @foreach($order->items as $item)
                        <div class="flex items-center space-x-4 py-3 border border-gray-100 rounded-lg px-4">
                            <img src="{{ $item->product->image_url ?? asset('no-image.avif') }}" alt="{{ $item->product_name }}" class="w-12 h-12 object-cover rounded">
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-900">{{ $item->product_name }}</h4>
                                <p class="text-sm text-gray-500">{{ $item->quantity }} x {{ $item->formatted_price }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-gray-900">{{ $item->formatted_subtotal }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Shipping Info -->
                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                    <h4 class="font-medium text-gray-900 mb-2">Informasi Pengiriman</h4>
                    <p class="text-sm text-gray-600">{{ $order->shipping_address }}</p>
                    <p class="text-sm text-gray-600">Telepon: {{ $order->phone }}</p>
                    @if($order->notes)
                        <p class="text-sm text-gray-600 mt-2"><strong>Catatan:</strong> {{ $order->notes }}</p>
                    @endif
                </div>

                <!-- Order Timeline -->
                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                    <h4 class="font-medium text-gray-900 mb-3">Status Pesanan</h4>
                    <div class="space-y-2">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Pesanan Dibuat</p>
                                <p class="text-xs text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        
                        @if($order->confirmed_at)
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Pesanan Dikonfirmasi</p>
                                    <p class="text-xs text-gray-500">{{ $order->confirmed_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        @endif
                        
                        @if($order->shipped_at)
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Pesanan Dikirim</p>
                                    <p class="text-xs text-gray-500">{{ $order->shipped_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        @endif
                        
                        @if($order->delivered_at)
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Pesanan Diterima</p>
                                    <p class="text-xs text-gray-500">{{ $order->delivered_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-between items-center">
                    <a href="{{ route('konsumen.orders.show', $order->id) }}" class="btn-secondary">
                        Lihat Detail
                    </a>
                    
                    <div class="space-x-2">
                        @if($order->status === 'pending')
                            <button type="button" class="btn-danger" onclick="cancelOrder({{ $order->id }})">
                                Batalkan Pesanan
                            </button>
                        @endif
                        

                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <i class="bi bi-bag text-6xl text-gray-400 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Pesanan</h3>
            <p class="text-gray-500 mb-6">Anda belum memiliki pesanan apapun</p>
            <a href="{{ route('products') }}" class="btn-primary">
                Mulai Belanja
            </a>
        </div>
    @endforelse

    <!-- Pagination -->
    @if($orders->hasPages())
        <div class="bg-white rounded-lg shadow p-6">
            {{ $orders->links() }}
        </div>
    @endif
    </div>
</div>

<script>
function cancelOrder(orderId) {
    if (confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')) {
        fetch(`/konsumen/pesanan/${orderId}/batal`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showSuccess('Pesanan berhasil dibatalkan');
                setTimeout(() => location.reload(), 1500);
            } else {
                showError(data.message || 'Terjadi kesalahan saat membatalkan pesanan');
            }
        });
    }
}
</script>
@endsection
