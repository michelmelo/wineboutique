<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id', 'payment_id', 'address_id', 'status'
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
