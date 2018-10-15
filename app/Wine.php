<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wine extends Model
{
    protected $fillable = [
        'name', 'price', 'photo'
    ];

    public function winery()
    {
        return $this->belongsTo(Winery::class);
    }

    public function varietal()
    {
        return $this->belongsTo(Varietal::class);
    }

    public function getPhotoLink()
    {
        return str_replace('public', '/storage', $this->photo);
    }
}
