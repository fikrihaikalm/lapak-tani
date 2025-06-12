<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    // Tambahkan baris ini:
    protected $table = 'educations';

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'image_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getExcerptAttribute()
    {
        return substr($this->content, 0, 150) . '...';
    }
}
