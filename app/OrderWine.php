<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderWine extends Model
{
    protected $fillable = [
        'order_id', 'wine_id', 'quantity', 'tracking', 'wine_name', 'price', 'shipping_price', 'additional_shipping_price'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function wine()
    {
        return $this->belongsTo(Wine::class);
    }
}
