<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'category_id',
        'price',
        'stock',
        'unit',
        'weight',
        'is_organic',
        'is_featured',

        'total_sold',
        'image_path',
        'additional_images',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'weight' => 'decimal:2',

        'is_organic' => 'boolean',
        'is_featured' => 'boolean',
        'additional_images' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }



    public function wishlistItems()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }



    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : asset('no-image.avif');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);

                // Ensure uniqueness
                $originalSlug = $product->slug;
                $count = 1;
                while (static::where('slug', $product->slug)->exists()) {
                    $product->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('name') && empty($product->slug)) {
                $product->slug = Str::slug($product->name);

                // Ensure uniqueness
                $originalSlug = $product->slug;
                $count = 1;
                while (static::where('slug', $product->slug)->where('id', '!=', $product->id)->exists()) {
                    $product->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getAdditionalImageUrlsAttribute()
    {
        if (!$this->additional_images) {
            return [];
        }

        return array_map(function($image) {
            return asset('storage/' . $image);
        }, $this->additional_images);
    }

    public function isInWishlist($userId)
    {
        return $this->wishlistItems()->where('user_id', $userId)->exists();
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrganic($query)
    {
        return $query->where('is_organic', true);
    }

    public function scopeAvailable($query)
    {
        return $query->where('stock', '>', 0);
    }
}