<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'password',
        'user_type',
        'user_type_id',
        'phone',
        'address',
        'avatar',
        'bio',
        'farm_name',
        'rating',
        'total_reviews',
        'is_verified',
        'last_active_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_active_at' => 'datetime',
        'rating' => 'decimal:2',
        'is_verified' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    public function wishlistItems()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function financialRecords()
    {
        return $this->hasMany(FinancialRecord::class);
    }



    // User type methods
    public function isPetani()
    {
        return $this->user_type === 'petani';
    }

    public function isKonsumen()
    {
        return $this->user_type === 'konsumen';
    }

    // Helper methods
    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=16a34a&color=fff';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->slug)) {
                $user->slug = Str::slug($user->name);

                // Ensure uniqueness
                $originalSlug = $user->slug;
                $count = 1;
                while (static::where('slug', $user->slug)->exists()) {
                    $user->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });

        static::updating(function ($user) {
            if ($user->isDirty('name') && empty($user->slug)) {
                $user->slug = Str::slug($user->name);

                // Ensure uniqueness
                $originalSlug = $user->slug;
                $count = 1;
                while (static::where('slug', $user->slug)->where('id', '!=', $user->id)->exists()) {
                    $user->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    public function checkAndUpdateVerification()
    {
        if ($this->user_type === 'petani' && !$this->is_verified) {
            $completedOrders = $this->orders()->where('status', 'delivered')->count();

            if ($completedOrders >= 20) {
                $this->update(['is_verified' => true]);
                return true;
            }
        }

        return false;
    }

    public function hasPermission($permission)
    {
        return $this->userType && $this->userType->hasPermission($permission);
    }

    public function getFormattedRatingAttribute()
    {
        return number_format($this->rating, 1);
    }

    public function isFollowing(User $user)
    {
        return $this->following()->where('following_id', $user->id)->exists();
    }

    public function follow($userId)
    {
        if ($userId == $this->id) {
            return false; // Can't follow yourself
        }

        if (!$this->following()->where('following_id', $userId)->exists()) {
            $this->following()->attach($userId);
            return true;
        }

        return false;
    }

    public function unfollow($userId)
    {
        if ($this->following()->where('following_id', $userId)->exists()) {
            $this->following()->detach($userId);
            return true;
        }

        return false;
    }

    public function getFollowersCountAttribute()
    {
        return $this->followers()->count();
    }

    public function getFollowingCountAttribute()
    {
        return $this->following()->count();
    }
}