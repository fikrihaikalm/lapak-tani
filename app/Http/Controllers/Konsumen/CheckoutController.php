<?php

namespace App\Http\Controllers\Konsumen;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with(['product.user'])
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('konsumen.cart.index')
                ->with('error', 'Keranjang Anda kosong');
        }

        // Group by petani
        $groupedItems = $cartItems->groupBy('product.user_id');

        return view('konsumen.checkout', compact('cartItems', 'groupedItems'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'delivery_address' => 'required|string|max:500',
            'delivery_notes' => 'nullable|string|max:255',
        ]);

        $cartItems = Cart::with(['product.user'])
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang Anda kosong'
            ]);
        }

        try {
            DB::beginTransaction();

            // Group by petani
            $groupedItems = $cartItems->groupBy('product.user_id');
            $whatsappMessages = [];

            foreach ($groupedItems as $petaniId => $items) {
                $petani = $items->first()->product->user;
                $totalAmount = $items->sum(function($item) {
                    return $item->product->price * $item->quantity;
                });

                // Create order
                $order = Order::create([
                    'user_id' => auth()->id(),
                    'petani_id' => $petaniId,
                    'total_amount' => $totalAmount,
                    'status' => 'pending',
                    'delivery_address' => $request->delivery_address,
                    'delivery_notes' => $request->delivery_notes,
                ]);

                // Create order items
                foreach ($items as $cartItem) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $cartItem->product_id,
                        'quantity' => $cartItem->quantity,
                        'price' => $cartItem->product->price,
                    ]);

                    // Update product stock
                    $cartItem->product->decrement('stock', $cartItem->quantity);
                }

                // Generate WhatsApp message
                $message = $this->generateWhatsAppMessage($order, $items);
                $petaniPhone = $this->formatPhoneNumber($petani->phone ?? '081234567890');
                $whatsappUrl = "https://wa.me/{$petaniPhone}?text=" . urlencode($message);
                
                $whatsappMessages[] = [
                    'petani_name' => $petani->name,
                    'url' => $whatsappUrl,
                    'order_id' => $order->id
                ];
            }

            // Clear cart
            Cart::where('user_id', auth()->id())->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat',
                'whatsapp_messages' => $whatsappMessages
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    private function generateWhatsAppMessage($order, $items)
    {
        $message = "🌱 *PESANAN BARU - LAPAK TANI* 🌱\n\n";
        $message .= "Halo! Saya ingin memesan produk berikut:\n\n";
        $message .= "📋 *Detail Pesanan:*\n";
        $message .= "ID Pesanan: #{$order->id}\n";
        $message .= "Tanggal: " . $order->created_at->format('d/m/Y H:i') . "\n\n";
        
        $message .= "🛒 *Produk yang Dipesan:*\n";
        foreach ($items as $item) {
            $message .= "• {$item->product->name}\n";
            $message .= "  Jumlah: {$item->quantity} {$item->product->unit}\n";
            $message .= "  Harga: Rp " . number_format($item->product->price, 0, ',', '.') . "\n";
            $message .= "  Subtotal: Rp " . number_format($item->product->price * $item->quantity, 0, ',', '.') . "\n\n";
        }
        
        $message .= "💰 *Total Pembayaran: Rp " . number_format($order->total_amount, 0, ',', '.') . "*\n\n";
        
        $message .= "📍 *Alamat Pengiriman:*\n";
        $message .= $order->delivery_address . "\n\n";
        
        if ($order->delivery_notes) {
            $message .= "📝 *Catatan:*\n";
            $message .= $order->delivery_notes . "\n\n";
        }
        
        $message .= "👤 *Data Pemesan:*\n";
        $message .= "Nama: " . auth()->user()->name . "\n";
        $message .= "Email: " . auth()->user()->email . "\n\n";
        
        $message .= "Mohon konfirmasi ketersediaan produk dan estimasi pengiriman. Terima kasih! 🙏";
        
        return $message;
    }

    private function generateWhatsAppUrl($phone, $message)
    {
        // Clean phone number
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Convert to international format
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        } elseif (substr($phone, 0, 2) !== '62') {
            $phone = '62' . $phone;
        }
        
        $encodedMessage = urlencode($message);
        
        return "https://wa.me/{$phone}?text={$encodedMessage}";
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
