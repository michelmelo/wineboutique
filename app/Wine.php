<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Conner\Tagging\Taggable;
use Event;

class Wine extends Model
{

    use Sluggable, FullTextSearch, Taggable;

    protected $fillable = [
        'name', 'price', 'photo', 'quantity', 'description', 'who_made_it', 'when_was_it_made', 'capacity', 'unit_id', 'average_rating'
    ];

    protected $searchable = [
        'name',
        'description'
    ];

    public function wineShippings()
    {
        return $this->hasMany(WineShipping::class);
    }

    public function capacityUnit()
    {
        return $this->belongsTo(CapacityUnit::class);
    }

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
        return '/images/wine/' . $this->slug;
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

    public function favorited()
    {
        return (bool) FavoriteWine::where('user_id', Auth::id())
            ->where('wine_id', $this->id)
            ->first();
    }

    public function rated()
    {
        return (bool) WineRating::where('user_id', Auth::id())
            ->where('wine_id', $this->id)
            ->first();
    }

    public function rating()
    {
        if($this->rated()) {
            return WineRating::where('user_id', Auth::id())
                ->where('wine_id', $this->id)
                ->first()->rating;
        } else {
            $rating = WineRating::where('wine_id', $this->id)
                ->avg('rating');
            return $rating?$rating:0;
        }
    }

    public function rate($rating)
    {
        if($this->rated()) {
            $wineRating = WineRating::where('user_id', Auth::id())->where('wine_id', $this->id)->first();
            $wineRating->rating = $rating;
            $wineRating->save();
        } else {
            $wineRating = new WineRating;
            $wineRating->rating = $rating;
            $wineRating->wine()->associate($this);
            $wineRating->user()->associate(Auth::user());
            $wineRating->save();
        }
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function wineImages()
    {
        return $this->hasMany(WineImage::class);
    }

    public function calculateAverageRating()
    {
        $averageRating = WineRating::where('wine_id', $this->id)->avg('rating');
        $this->average_rating = $averageRating;

        $this->save();
    }
    
}
