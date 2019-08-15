<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Winery extends Model
{
    use Sluggable, FullTextSearch;

    protected $fillable = [
        "name"
    ];

    protected $searchable = [
        'name',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function regions()
    {
        return $this->belongsToMany(Region::class);
    }

    public function wines()
    {
        return $this->hasMany(Wine::class);
    }

    public function winery_payment()
    {
        return $this->hasOne(WineryPayment::class);
    }

    public function winery_shippings()
    {
        return $this->hasMany(WineryShipping::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function rated()
    {
        return (bool)WineryRating::where('user_id', Auth::id())
            ->where('winery_id', $this->id)
            ->first();
    }

    public function rating()
    {
        if ($this->rated()) {
            return WineryRating::where('user_id', Auth::id())
                ->where('winery_id', $this->id)
                ->first()->rating;
        } else {
            $rating = WineryRating::where('winery_id', $this->id)
                ->avg('rating');
            return $rating ? $rating : 0;
        }
    }

    public function rate($rating)
    {
        if ($this->rated()) {
            WineryRating::where('user_id', Auth::id())
                ->where('winery_id', $this->id)
                ->update(['rating' => $rating]);
        } else {
            Auth::user()->wineriesRating()->attach($this->id, ['rating' => $rating]);
        }
    }

    public function ratingCount()
    {
        return WineryRating::where('winery_id', $this->id)->count();
    }
}
