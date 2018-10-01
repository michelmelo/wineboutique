<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        "name",
        "code"
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
