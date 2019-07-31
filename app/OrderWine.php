<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderWine extends Model
{
    protected $fillable = [
        'order_id', 'wine_id', 'quantity'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
