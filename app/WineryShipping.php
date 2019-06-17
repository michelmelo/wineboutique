<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WineryShipping extends Model
{
    protected $fillable = [
        'winery_id', 'ship_from', 'ship_to', 'days_from', 'days_to', 'price', 'additional'
    ];

    public function winery()
    {
        return $this->belongsTo(Winery::class);
    }
}
