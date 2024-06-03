<?php
// app/Models/Payment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['order_id', 'bank_select', 'card_number' ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
