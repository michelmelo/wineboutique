<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Wine extends Model
{

    use Sluggable, FullTextSearch;

    protected $fillable = [
        'name', 'price', 'photo', 'quantity', 'description'
    ];

    protected $searchable = [
        'name',
        'description'
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
            WineRating::where('user_id', Auth::id())
                ->where('wine_id', $this->id)
                ->update(['rating' => $rating]);
        } else {
            Auth::user()->winesRating()->attach($this->id, ['rating' => $rating]);
        }
    }
}
