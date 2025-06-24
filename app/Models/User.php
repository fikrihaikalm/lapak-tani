<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
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
        'location',
        'avatar',
        'bio',
        'farm_name',
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



    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function petaniOrders()
    {
        return $this->hasMany(Order::class, 'petani_id');
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    public function wishlistItems()
    {
        return $this->hasMany(Wishlist::class);
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
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }

        // Generate default avatar based on user type
        $backgroundColor = $this->user_type === 'petani' ? '16a34a' : '3b82f6';
        $initials = $this->getInitials();

        return 'https://ui-avatars.com/api/?name=' . urlencode($initials) . '&background=' . $backgroundColor . '&color=fff&size=128';
    }

    public function getInitials()
    {
        $words = explode(' ', trim($this->name));
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }
        return strtoupper(substr($this->name, 0, 2));
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




}