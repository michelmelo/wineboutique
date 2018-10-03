<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        "name",
        "latitude",
        "longitude"
    ];

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function wineries()
    {
        return $this->hasMany(Winery::class);
    }
}
