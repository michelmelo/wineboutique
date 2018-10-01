<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        "name",
        "code"
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
