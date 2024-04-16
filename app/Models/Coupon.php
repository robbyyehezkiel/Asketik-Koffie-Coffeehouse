<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'max_uses',
        'used_count',
        'expiry_date',
    ];

    protected $casts = [
        'expiry_date' => 'datetime',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
