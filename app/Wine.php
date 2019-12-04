<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Conner\Tagging\Taggable;
use Event;
use Illuminate\Support\Facades\DB;

class Wine extends Model
{

    use Sluggable, FullTextSearch, Taggable, SoftDeletes;

    protected $fillable = [
        'name', 'price', 'photo', 'quantity', 'description', 'who_made_it', 'when_was_it_made', 'capacity', 'unit_id', 'average_rating', 'wine_region_id'
    ];

    protected $searchable = [
        'name',
        'description'
    ];

    public function capacityUnit()
    {
        return $this->belongsTo(CapacityUnit::class,'unit_id','id');
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

    public function wine_orders()
    {
        return $this->hasMany(OrderWine::class);
    }

    public function getPhotoLink()
    {
        return $this->photo;
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
                'includeTrashed' => true,
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

    /*
     * Similar wines are defined as in same price range AND same varietal.
     */
    public function similarWines() {
        if($this->price<50) {
            $minPrice = 0;
            $maxPrice = 50;
        } elseif ($this->price<100) {
            $minPrice = 50;
            $maxPrice = 100;
        } else {
            $minPrice = 100;
            $maxPrice = DB::table('wines')->select(DB::raw('max(wines.price) as max_price'))->get()[0]->max_price+0.01;
        }

        return DB::table('wines')
            ->leftJoin('orders', 'wines.id', '=', 'orders.id')
            ->leftJoin('wine_ratings', 'wines.id', '=', 'wine_ratings.wine_id')
            ->select(DB::raw('wines.*, COUNT(orders.id) as orders_count, AVG(coalesce(wine_ratings.rating,0)) as avg_rating'))
            ->where([
                ['wines.price','>=', $minPrice],
                ['wines.price','<', $maxPrice],
                ['wines.varietal_id', '=', $this->varietal_id],
                ['wines.id', '<>', $this->id]
            ])
            ->groupBy('wines.id')
            ->paginate(4);
    }
}
