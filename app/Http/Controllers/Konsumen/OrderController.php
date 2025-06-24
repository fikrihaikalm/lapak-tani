<?php

namespace App\Http\Controllers\Konsumen;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with(['petani', 'items.product'])
            ->latest()
            ->paginate(10);

        return view('konsumen.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('user_id', auth()->id())
            ->with(['petani', 'items.product'])
            ->findOrFail($id);

        return view('konsumen.orders.show', compact('order'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'petani_id' => 'required|exists:users,id',
            'shipping_address' => 'required|string',
            'phone' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $cartItems = Cart::where('user_id', auth()->id())
            ->whereHas('product', function($query) use ($request) {
                $query->where('user_id', $request->petani_id);
            })
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang kosong!'
            ]);
        }

        DB::beginTransaction();
        try {
            $totalAmount = $cartItems->sum('subtotal');

            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => auth()->id(),
                'petani_id' => $request->petani_id,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'phone' => $request->phone,
                'notes' => $request->notes,
            ]);

            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product_name' => $cartItem->product->name,
                    'product_price' => $cartItem->product->price,
                    'quantity' => $cartItem->quantity,
                    'subtotal' => $cartItem->subtotal,
                ]);

                // Update stock
                $cartItem->product->decrement('stock', $cartItem->quantity);
                $cartItem->product->increment('total_sold', $cartItem->quantity);
            }

            // Payment will be handled via WhatsApp (COD/Transfer)

            // Clear cart items for this petani
            Cart::where('user_id', auth()->id())
                ->whereHas('product', function($query) use ($request) {
                    $query->where('user_id', $request->petani_id);
                })
                ->delete();

            DB::commit();

            // Generate WhatsApp URL
            $petaniPhone = \App\Helpers\PhoneHelper::formatForWhatsApp($order->petani->phone ?? '082229740385');
            $whatsappUrl = "https://wa.me/{$petaniPhone}?text=" . urlencode($order->whatsapp_message);

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat!',
                'whatsapp_url' => $whatsappUrl,
                'redirect' => route('konsumen.orders.show', $order->id)
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membuat pesanan!'
            ]);
        }
    }

    public function cancel($id)
    {
        $order = Order::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->findOrFail($id);

        DB::beginTransaction();
        try {
            // Restore stock
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
                $item->product->decrement('total_sold', $item->quantity);
            }

            $order->update(['status' => 'cancelled']);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibatalkan!'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membatalkan pesanan!'
            ]);
        }
    }

    private function formatPhoneNumber($phone)
    {
        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Convert to international format
        if (substr($phone, 0, 1) === '0') {
            // Remove leading 0 and add 62
            $phone = '62' . substr($phone, 1);
        } elseif (substr($phone, 0, 2) !== '62') {
            // If doesn't start with 62, add it
            $phone = '62' . $phone;
        }

        return $phone;
    }


}
