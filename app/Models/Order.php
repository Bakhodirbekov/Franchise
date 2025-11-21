<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'franchise_id',
        'amount',
        'currency',
        'status',
        'payment_meta',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_meta' => 'array',
    ];

    protected $attributes = [
        'status' => 'pending',
        'currency' => 'USD',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function franchise()
    {
        return $this->belongsTo(Franchise::class);
    }

    // Scope for pending orders
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope for paid orders
    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    // Scope for failed orders
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    // Scope for refunded orders
    public function scopeRefunded($query)
    {
        return $query->where('status', 'refunded');
    }

    // Check if order is pending
    public function getIsPendingAttribute()
    {
        return $this->status === 'pending';
    }

    // Check if order is paid
    public function getIsPaidAttribute()
    {
        return $this->status === 'paid';
    }
}