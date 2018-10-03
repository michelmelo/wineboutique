<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        "name",
        "iso_code2",
        "iso_code3"
    ];

    public function regions()
    {
        return $this->hasMany(Region::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}
