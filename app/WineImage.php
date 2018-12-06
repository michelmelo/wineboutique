<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class WineImage extends Model
{
    use Sluggable;

    protected $fillable = [
        'source'
    ];

    public function wine()
    {
        return $this->belongsTo(Wine::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }

    public function getNameAttribute() 
    {
        return $this->wine ? $this->wine->name : 'temp';
    }
}