<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WineRegion extends Model
{
    protected $fillable = [
        'name'
    ];

    public function wines()
    {
        return $this->hasMany(Wine::class);
    }
}
