<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Education extends Model
{
    use HasFactory;

    // Tambahkan baris ini:
    protected $table = 'educations';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'is_featured',
        'views_count',
        'image_path',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'views_count' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Removed complex relationships - simplified system

    public function getExcerptAttribute()
    {
        return substr($this->content, 0, 150) . '...';
    }

    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : asset('no-image.avif');
    }

    // Removed complex attributes - simplified system

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($education) {
            if (empty($education->slug)) {
                $education->slug = Str::slug($education->title);

                // Ensure uniqueness
                $originalSlug = $education->slug;
                $count = 1;
                while (static::where('slug', $education->slug)->exists()) {
                    $education->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });

        static::updating(function ($education) {
            if ($education->isDirty('title') && empty($education->slug)) {
                $education->slug = Str::slug($education->title);

                // Ensure uniqueness
                $originalSlug = $education->slug;
                $count = 1;
                while (static::where('slug', $education->slug)->where('id', '!=', $education->id)->exists()) {
                    $education->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
