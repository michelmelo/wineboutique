<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        "name",
        "street",
        "note",
        "latitude",
        "longitude"
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function wineries()
    {
        return $this->hasMany(Winery::class);
    }
}
