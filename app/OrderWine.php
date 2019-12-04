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
  
    public static function TotalPrice($orderWines) {
        $retVal = 0;
        foreach ($orderWines as $orderWine) {
            $retVal += $orderWine->price * $orderWine->quantity +
                $orderWine->shipping_price +
                ($orderWine->quantity-1) * $orderWine->additioinal_shipping_price;
        }
        return $retVal;
    }

    public static function TotalPrice2($orderWines) {
        $retVal = 0;
        foreach ($orderWines as $orderWines1) {
            foreach ($orderWines1 as $orderWine) {
                $retVal += $orderWine->price * $orderWine->quantity +
                    $orderWine->shipping_price +
                    ($orderWine->quantity - 1) * $orderWine->additioinal_shipping_price;
            }
        }
        return $retVal;
    public function winery()
    {
        return $this->belongsTo(Winery::class);
    }
}
