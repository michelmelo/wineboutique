<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WineRating extends Model
{
    protected $fillable = [
        'rating'
    ];

    public function wine() {
        return $this->belongsTo(Wine::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function averageRating()
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
}
