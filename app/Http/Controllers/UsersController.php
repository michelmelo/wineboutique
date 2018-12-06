<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Wine;

class UsersController extends Controller
{
    public function myFavorites()
    {
        $myFavorites = Auth::user()->favoriteWines;

        return view('my_favorites', compact('myFavorites'));
    }
}
