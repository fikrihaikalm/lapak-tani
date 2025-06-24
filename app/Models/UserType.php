<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'permissions',
        'color',
        'icon',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'permissions' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'user_type_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($userType) {
            if (empty($userType->slug)) {
                $userType->slug = Str::slug($userType->name);

                // Ensure uniqueness
                $originalSlug = $userType->slug;
                $count = 1;
                while (static::where('slug', $userType->slug)->exists()) {
                    $userType->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });

        static::updating(function ($userType) {
            if ($userType->isDirty('name') && empty($userType->slug)) {
                $userType->slug = Str::slug($userType->name);

                // Ensure uniqueness
                $originalSlug = $userType->slug;
                $count = 1;
                while (static::where('slug', $userType->slug)->where('id', '!=', $userType->id)->exists()) {
                    $userType->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function hasPermission($permission)
    {
        return in_array($permission, $this->permissions ?? []);
    }
}
