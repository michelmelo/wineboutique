<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Varietal extends Model
{
    protected $fillable = [
        'name'
    ];

    public function wines()
    {
        return $this->hasMany(Wine::class);
    }
}
