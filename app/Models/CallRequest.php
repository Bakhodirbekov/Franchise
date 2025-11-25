<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'franchise_id',
        'franchise_name',
        'name',
        'phone',
        'call_time',
        'status',
        'admin_note'
    ];

    public function franchise()
    {
        return $this->belongsTo(Franchise::class);
    }
}