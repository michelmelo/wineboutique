<?php

namespace App\Http\Controllers;

use App\Wine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteWineController extends Controller
{
    public function favoriteWine(Wine $wine)
    {
        Auth::user()->favoriteWines()->attach($wine->id);
        return 'ok';
    }

    public function unFavoriteWine(Wine $wine)
    {
        Auth::user()->favoriteWines()->detach($wine->id);
        return 'ok';
    }
}
