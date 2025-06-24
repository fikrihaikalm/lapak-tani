<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'petani_id',
        'total_amount',
        'status',
        'shipping_address',
        'phone',
        'notes',
        'confirmed_at',
        'shipped_at',
        'delivered_at',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'confirmed_at' => 'datetime',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function petani()
    {
        return $this->belongsTo(User::class, 'petani_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }



    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    public function getWhatsappMessageAttribute()
    {
        $message = "🛒 *PESANAN BARU DARI LAPAK TANI*\n\n";
        $message .= "📋 *Detail Pesanan:*\n";
        $message .= "• Nomor Pesanan: {$this->order_number}\n";
        $message .= "• Tanggal: " . $this->created_at->format('d M Y H:i') . "\n\n";

        $message .= "👤 *Data Pembeli:*\n";
        $message .= "• Nama: {$this->user->name}\n";
        $message .= "• Telepon: {$this->phone}\n";
        $message .= "• Alamat: {$this->shipping_address}\n\n";

        $message .= "🛍️ *Produk yang Dipesan:*\n";
        foreach ($this->items as $item) {
            $message .= "• {$item->product_name}\n";
            $message .= "  Qty: {$item->quantity} x Rp " . number_format($item->product_price, 0, ',', '.') . "\n";
            $message .= "  Subtotal: Rp " . number_format($item->subtotal, 0, ',', '.') . "\n\n";
        }

        $message .= "💰 *Total Pembayaran: Rp " . number_format($this->total_amount, 0, ',', '.') . "*\n\n";

        if ($this->notes) {
            $message .= "📝 *Catatan:*\n{$this->notes}\n\n";
        }

        $message .= "✅ Silakan konfirmasi pesanan ini dan diskusikan metode pembayaran serta pengiriman.\n\n";
        $message .= "Terima kasih! 🙏";

        return $message;
    }



    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'confirmed' => 'bg-blue-100 text-blue-800',
            'processing' => 'bg-purple-100 text-purple-800',
            'shipped' => 'bg-indigo-100 text-indigo-800',
            'delivered' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Dikonfirmasi',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'delivered' => 'Diterima',
            'cancelled' => 'Dibatalkan',
        ];

        return $labels[$this->status] ?? 'Unknown';
    }

    public static function generateOrderNumber()
    {
        $prefix = 'LT';
        $date = now()->format('Ymd');
        $random = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        
        return $prefix . $date . $random;
    }
}
