<?php
// app/Models/Animal.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type', // atau 'category'
        'breed',
        'description',
        'gender',
        'age',
        'status',
        'image_path',
        'location',
        'color',
        'category'
    ];

    // Scope untuk hewan yang tersedia untuk adopsi
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('type', $category)
                    ->orWhere('category', $category);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Relationships
    public function fosters()
    {
        return $this->hasMany(Foster::class);
    }

    public function adoptions()
    {
        return $this->hasMany(Adoption::class, 'animal_id');
    }

    // Accessor untuk image
    public function getImageAttribute()
    {
        return $this->image_path;
    }
}
