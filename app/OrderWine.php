<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderWine extends Model
{
    protected $fillable = [
        'order_id', 'wine_id', 'quantity', 'tracking', 'wine_name', 'price', 'shipping_price', 'additional_shipping_price', 'delivery', 'status'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function wine()
    {
        return $this->belongsTo(Wine::class);
    }

    public function winery()
    {
        return $this->belongsTo(Winery::class);
    }
}
