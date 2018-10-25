<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Wine extends Model
{
    use Sluggable;

    protected $fillable = [
        'name', 'price', 'photo', 'quantity', 'description'
    ];

    public function winery()
    {
        return $this->belongsTo(Winery::class);
    }

    public function varietal()
    {
        return $this->belongsTo(Varietal::class);
    }

    public function wineRegion()
    {
        return $this->belongsTo(WineRegion::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function getPhotoLink()
    {
        return '/storage/images/wines/' . $this->photo;
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

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
