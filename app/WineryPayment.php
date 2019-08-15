<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WineryPayment extends Model
{

    protected $fillable = [
        "merchant_id", "external_merchant_id", "infinicept_application_id"
    ];

    public function winery()
    {
        return $this->belongsTo(Winery::class);
    }
}
