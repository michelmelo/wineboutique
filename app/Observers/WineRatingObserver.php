<?php

namespace App\Observers;

use App\WineRating;
use Illuminate\Support\Facades\Log;

class WineRatingObserver
{
    public function created(WineRating $wineRating)
    {
        $wineRating->wine->calculateAverageRating();
    }

    public function updated(WineRating $wineRating)
    {
        $wineRating->wine->calculateAverageRating();
    }

    public function deleted(WineRating $wineRating)
    {
        $wineRating->wine->calculateAverageRating();
    }
}
