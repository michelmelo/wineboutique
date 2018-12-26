<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WineShipping extends Model
{
    protected $fillable = [
        'location', 'from', 'to', 'day_week', 'destination', 'price', 'additional', 'free'
    ];

    public function wine()
    {
        return $this->belongsTo(Wine::class);
    }
}
