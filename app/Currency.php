<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        "name",
        "acronym",
        "symbol"
    ];

    public function wineries()
    {
        return $this->hasMany(Winery::class);
    }
}
