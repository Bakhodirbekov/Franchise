<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    // Auto-generate slug when creating category
    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = $category->generateUniqueSlug($category->name);
            }
        });

        static::updating(function ($category) {
            // Regenerate slug only if name changed
            if ($category->isDirty('name')) {
                $category->slug = $category->generateUniqueSlug($category->name);
            }
        });
    }

    // Generate unique slug
    public function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        // Check for existing slugs, excluding current record if updating
        while (static::where('slug', $slug)
            ->when($this->exists, function ($query) {
                return $query->where('id', '!=', $this->id);
            })
            ->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function franchises()
    {
        return $this->hasMany(Franchise::class);
    }

    // Accessor for franchise count
    public function getFranchisesCountAttribute()
    {
        return $this->franchises()->where('status', 'published')->count();
    }
}
