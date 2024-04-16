<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payments;

class Order extends Model
{
    protected $fillable = [
        'customer_name', 'customer_phone', 'note', 'subtotal', 'discount', 'total',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
