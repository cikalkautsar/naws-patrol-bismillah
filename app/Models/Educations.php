<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Educations extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'category',
        'user_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($education) {
            if (!$education->slug) {
                $education->slug = Str::slug($education->title);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
