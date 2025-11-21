<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'franchise_id',
        'user_id',
        'name',
        'email',
        'phone',
        'message',
        'status',
        'admin_note',
    ];

    protected $attributes = [
        'status' => 'new',
    ];

    public function franchise()
    {
        return $this->belongsTo(Franchise::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope for new inquiries
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    // Scope for contacted inquiries
    public function scopeContacted($query)
    {
        return $query->where('status', 'contacted');
    }

    // Scope for closed inquiries
    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

    // Check if inquiry is new
    public function getIsNewAttribute()
    {
        return $this->status === 'new';
    }

    // Check if inquiry is contacted
    public function getIsContactedAttribute()
    {
        return $this->status === 'contacted';
    }

    // Check if inquiry is closed
    public function getIsClosedAttribute()
    {
        return $this->status === 'closed';
    }
}