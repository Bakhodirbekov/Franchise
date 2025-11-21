<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FranchiseImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'franchise_id',
        'path',
        'alt',
        'order',
    ];

    protected $attributes = [
        'order' => 0,
        'alt' => '',
    ];

    public function franchise()
    {
        return $this->belongsTo(Franchise::class);
    }

    // Accessor for full image URL
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }

    // Scope for ordered images
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}