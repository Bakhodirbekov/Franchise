<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Franchise extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'short_description',
        'description',
        'investment_min',
        'investment_max',
        'royalty',
        'territory',
        'requirements',
        'status',
        'created_by',
    ];

    protected $casts = [
        'investment_min' => 'decimal:2',
        'investment_max' => 'decimal:2',
        'royalty' => 'decimal:2',
        'requirements' => 'array',
    ];

    // Auto-generate slug when creating franchise
    public static function boot()
    {
        parent::boot();

        static::creating(function ($franchise) {
            if (empty($franchise->slug)) {
                $franchise->slug = $franchise->generateUniqueSlug($franchise->title);
            }
        });

        static::updating(function ($franchise) {
            if ($franchise->isDirty('title') && empty($franchise->slug)) {
                $franchise->slug = $franchise->generateUniqueSlug($franchise->title);
            }
        });
    }

    // Generate unique slug
    public function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function images()
    {
        return $this->hasMany(FranchiseImage::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getMainImageAttribute()
    {
        return $this->images->first();
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Accessor for requirements
    public function getRequirementsAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? [];
        }
        
        return $value ?? [];
    }

    // Mutator for requirements
    public function setRequirementsAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['requirements'] = json_encode($value);
        } else {
            $this->attributes['requirements'] = $value;
        }
    }
}