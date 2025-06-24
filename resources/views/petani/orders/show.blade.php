@extends('layouts.dashboard')

@section('title', 'Detail Pesanan - Lapak Tani')
@section('page-title', 'Detail Pesanan #' . $order->order_number)

@section('content')
<div class="space-y-6">
    <!-- Back Button -->
    <div class="flex items-center justify-between">
        <a href="{{ route('petani.orders.index') }}" class="flex items-center text-gray-600 hover:text-gray-900">
            <i class="bi bi-arrow-left mr-2"></i>
            Kembali ke Daftar Pesanan
        </a>
        <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full {{ $order->status_badge }}">
            {{ $order->status_label }}
        </span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Items -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Produk yang Dipesan</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                                <div class="flex-shrink-0">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" 
                                             alt="{{ $item->product_name }}"
                                             class="w-16 h-16 object-cover rounded-lg">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-lg font-medium text-gray-900">{{ $item->product_name }}</h4>
                                    <p class="text-gray-600">
                                        {{ $item->quantity }} x Rp {{ number_format($item->product_price, 0, ',', '.') }}
                                    </p>
                                    @if($item->product)
                                        <p class="text-sm text-gray-500">Stok saat ini: {{ $item->product->stock }}</p>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-semibold text-gray-900">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Status Management -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Kelola Status Pesanan</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @if($order->status === 'pending')
                            <button onclick="updateStatus('confirmed')" 
                                    class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">
                                Konfirmasi Pesanan
                            </button>
                        @endif

                        @if(in_array($order->status, ['confirmed', 'processing']))
                            <button onclick="updateStatus('processing')" 
                                    class="bg-yellow-600 text-white py-2 px-4 rounded-lg hover:bg-yellow-700 transition duration-200">
                                Sedang Diproses
                            </button>
                            <button onclick="updateStatus('shipped')" 
                                    class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-200">
                                Kirim Pesanan
                            </button>
                        @endif

                        @if($order->status === 'shipped')
                            <button onclick="updateStatus('delivered')" 
                                    class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition duration-200">
                                Pesanan Sampai
                            </button>
                        @endif

                        @if(!in_array($order->status, ['delivered', 'cancelled']))
                            <button onclick="updateStatus('cancelled')" 
                                    class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition duration-200">
                                Batalkan Pesanan
                            </button>
                        @endif
                    </div>

                    <div class="mt-6 space-y-3">
                        <button onclick="sendWhatsAppMessage()"
                                class="w-full bg-green-600 text-white py-3 px-6 rounded-lg hover:bg-green-700 transition duration-200 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                            </svg>
                            Kirim Pesan WhatsApp ke Pembeli
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Order Summary -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Ringkasan Pesanan</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Nomor Pesanan</span>
                        <span class="font-medium">#{{ $order->order_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tanggal Pesanan</span>
                        <span class="font-medium">{{ $order->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Pesanan</span>
                        <span class="text-lg font-bold text-hijau-600">{{ $order->formatted_total }}</span>
                    </div>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Informasi Pembeli</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="flex-shrink-0">
                            @if($order->user->avatar)
                                <img src="{{ asset('storage/' . $order->user->avatar) }}" 
                                     alt="{{ $order->user->name }}"
                                     class="w-12 h-12 rounded-full object-cover">
                            @else
                                <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                                    <span class="text-gray-600 font-medium">
                                        {{ substr($order->user->name, 0, 1) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="text-lg font-medium text-gray-900">{{ $order->user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $order->user->email }}</p>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Nomor Telepon:</p>
                            <p class="text-sm text-gray-600">{{ $order->phone }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Alamat Pengiriman:</p>
                            <p class="text-sm text-gray-600">{{ $order->shipping_address }}</p>
                        </div>
                        @if($order->notes)
                        <div>
                            <p class="text-sm font-medium text-gray-900">Catatan:</p>
                            <p class="text-sm text-gray-600">{{ $order->notes }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div id="status-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Update Status Pesanan</h3>
            <form id="status-form">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Informasi Tambahan (Opsional)</label>
                    <textarea id="status_info" name="status_info" rows="4" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500"
                              placeholder="Tambahkan informasi untuk pembeli..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeStatusModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-hijau-600 text-white rounded-lg hover:bg-hijau-700">
                        Update & Kirim Notifikasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentStatus = null;
let lastWhatsAppUrl = null;

function updateStatus(status) {
    currentStatus = status;
    document.getElementById('status-modal').classList.remove('hidden');
}

function closeStatusModal() {
    document.getElementById('status-modal').classList.add('hidden');
    currentStatus = null;
}

function sendWhatsAppMessage() {
    // Use last generated URL if available, otherwise generate default message
    if (lastWhatsAppUrl) {
        console.log('Using last WhatsApp URL:', lastWhatsAppUrl);
        const popup = window.open(lastWhatsAppUrl, '_blank');

        // Check if popup was blocked
        if (!popup || popup.closed || typeof popup.closed == 'undefined') {
            alert('Pop-up diblokir! Silakan izinkan pop-up untuk situs ini atau copy link WhatsApp:\n\n' + lastWhatsAppUrl);
        }
        return;
    }

    // Fallback to default message
    let customerPhone = '{{ preg_replace("/[^0-9]/", "", $order->phone) }}';

    // Format phone number correctly
    if (customerPhone.startsWith('0')) {
        customerPhone = '62' + customerPhone.substring(1);
    } else if (!customerPhone.startsWith('62')) {
        customerPhone = '62' + customerPhone;
    }

    const message = encodeURIComponent(`{{ $order->whatsapp_message }}`);
    const whatsappUrl = `https://wa.me/${customerPhone}?text=${message}`;
    console.log('Using fallback WhatsApp URL:', whatsappUrl);

    const popup = window.open(whatsappUrl, '_blank');

    // Check if popup was blocked
    if (!popup || popup.closed || typeof popup.closed == 'undefined') {
        alert('Pop-up diblokir! Silakan izinkan pop-up untuk situs ini atau copy link WhatsApp:\n\n' + whatsappUrl);
    }
}

function copyWhatsAppUrl() {
    if (!lastWhatsAppUrl) {
        alert('Belum ada URL WhatsApp! Silakan update status pesanan terlebih dahulu.');
        return;
    }

    navigator.clipboard.writeText(lastWhatsAppUrl).then(function() {
        alert('Link WhatsApp berhasil di-copy! Paste di browser untuk membuka WhatsApp.');
    }).catch(function(err) {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = lastWhatsAppUrl;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        alert('Link WhatsApp berhasil di-copy! Paste di browser untuk membuka WhatsApp.');
    });
}

document.getElementById('status-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const statusInfo = document.getElementById('status_info').value;
    const submitButton = this.querySelector('button[type="submit"]');
    const originalText = submitButton.textContent;
    
    submitButton.disabled = true;
    submitButton.textContent = 'Memproses...';
    
    fetch(`{{ route('petani.orders.updateStatus', $order->id) }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            status: currentStatus,
            payment_info: statusInfo
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Response data:', data); // Debug log

        if (data.success) {
            showSuccess(data.message);

            // Save WhatsApp URL for manual use
            if (data.whatsapp_url) {
                lastWhatsAppUrl = data.whatsapp_url;
                console.log('Opening WhatsApp URL:', data.whatsapp_url); // Debug log

                // Update status display
                document.getElementById('whatsapp-status').textContent = 'Status: URL WhatsApp siap!';

                // Show confirmation before opening WhatsApp
                if (confirm('Status berhasil diperbarui! Buka WhatsApp untuk mengirim notifikasi ke pembeli?')) {
                    window.open(data.whatsapp_url, '_blank');
                }
            } else {
                console.log('No WhatsApp URL in response'); // Debug log
                document.getElementById('whatsapp-status').textContent = 'Status: Error - Tidak ada URL WhatsApp!';
                alert('Status berhasil diperbarui, tapi tidak ada URL WhatsApp!');
            }

            // Reload page
            setTimeout(() => location.reload(), 2000);
        } else {
            showError(data.message || 'Terjadi kesalahan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showError('Terjadi kesalahan saat mengupdate status');
    })
    .finally(() => {
        submitButton.disabled = false;
        submitButton.textContent = originalText;
        closeStatusModal();
    });
});
</script>
@endsection
