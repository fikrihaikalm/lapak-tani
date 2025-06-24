<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('petani_id', auth()->id())
            ->with(['user', 'items.product'])
            ->latest()
            ->paginate(15);

        $stats = [
            'pending' => Order::where('petani_id', auth()->id())->where('status', 'pending')->count(),
            'confirmed' => Order::where('petani_id', auth()->id())->where('status', 'confirmed')->count(),
            'shipped' => Order::where('petani_id', auth()->id())->where('status', 'shipped')->count(),
            'delivered' => Order::where('petani_id', auth()->id())->where('status', 'delivered')->count(),
        ];

        return view('petani.orders.index', compact('orders', 'stats'));
    }

    public function show($id)
    {
        $order = Order::where('petani_id', auth()->id())
            ->with(['user', 'items.product'])
            ->findOrFail($id);

        return view('petani.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:confirmed,processing,shipped,delivered,cancelled',
            'payment_info' => 'nullable|string',
        ]);

        $order = Order::where('petani_id', auth()->id())->findOrFail($id);
        
        $order->update([
            'status' => $request->status,
            'confirmed_at' => $request->status === 'confirmed' ? now() : $order->confirmed_at,
            'shipped_at' => $request->status === 'shipped' ? now() : $order->shipped_at,
            'delivered_at' => $request->status === 'delivered' ? now() : $order->delivered_at,
        ]);

        // Check for verification if order is delivered
        if ($request->status === 'delivered') {
            $petani = auth()->user();
            $wasVerified = $petani->checkAndUpdateVerification();

            if ($wasVerified) {
                // Add verification message to WhatsApp
                $message .= "\n\n🎉 *SELAMAT!* 🎉\n";
                $message .= "Anda telah mencapai 20 penjualan berhasil dan sekarang *TERVERIFIKASI*!\n";
                $message .= "Badge verifikasi akan muncul di profil Anda. 🏆";
            }
        }

        // Generate WhatsApp message untuk update status
        $message = $this->generateStatusUpdateMessage($order, $request->payment_info);
        $customerPhone = $this->formatPhoneNumber($order->phone);
        $whatsappUrl = "https://wa.me/{$customerPhone}?text=" . urlencode($message);

        return response()->json([
            'success' => true,
            'message' => 'Status pesanan berhasil diperbarui!',
            'whatsapp_url' => $whatsappUrl,
            'status' => $order->status_label
        ]);
    }

    private function generateStatusUpdateMessage($order, $paymentInfo = null)
    {
        $message = "🌱 *UPDATE PESANAN - LAPAK TANI* 🌱\n\n";
        $message .= "Halo {$order->user->name}!\n\n";
        $message .= "📋 *Pesanan #{$order->order_number}*\n";
        $message .= "Status: *{$order->status_label}*\n\n";

        switch ($order->status) {
            case 'confirmed':
                $message .= "✅ *Pesanan Anda telah dikonfirmasi!*\n\n";
                if ($paymentInfo) {
                    $message .= "💳 *Informasi Pembayaran:*\n";
                    $message .= "{$paymentInfo}\n\n";
                }
                $message .= "Pesanan Anda sedang dipersiapkan. Kami akan menginformasikan ketika pesanan sudah dikirim.\n\n";
                break;
                
            case 'processing':
                $message .= "⚙️ *Pesanan sedang diproses*\n\n";
                $message .= "Pesanan Anda sedang dikemas dengan hati-hati. Mohon tunggu update selanjutnya.\n\n";
                break;
                
            case 'shipped':
                $message .= "🚚 *Pesanan telah dikirim!*\n\n";
                $message .= "Pesanan Anda sudah dalam perjalanan. Harap siapkan alamat penerima.\n\n";
                break;
                
            case 'delivered':
                $message .= "🎉 *Pesanan telah sampai!*\n\n";
                $message .= "Terima kasih telah berbelanja di Lapak Tani. Semoga produk kami memuaskan!\n\n";
                $message .= "Jangan lupa berikan ulasan untuk membantu petani lain. 😊\n\n";
                break;
                
            case 'cancelled':
                $message .= "❌ *Pesanan dibatalkan*\n\n";
                $message .= "Maaf, pesanan Anda harus dibatalkan. Silakan hubungi kami untuk informasi lebih lanjut.\n\n";
                break;
        }

        $message .= "📞 Jika ada pertanyaan, jangan ragu untuk menghubungi kami.\n\n";
        $message .= "Terima kasih! 🙏\n";
        $message .= "*{$order->petani->name}*";

        return $message;
    }

    private function formatPhoneNumber($phone)
    {
        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Convert to international format
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        } elseif (substr($phone, 0, 2) !== '62') {
            $phone = '62' . $phone;
        }
        
        return $phone;
    }
}
