<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CapacityUnit extends Model
{
    protected $fillable = [
        'name'
    ];

    public function wine()
    {
        return $this->hasMany(Wine::class);
    }

    public function wineCapacity()
    {
        return $this->belongsTo(WineCapacity::class);
    }
}
