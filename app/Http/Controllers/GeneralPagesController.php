<?php

namespace App\Http\Controllers;

use App\Wine;
use Illuminate\Http\Request;

class GeneralPagesController extends Controller
{
    public function new_arrivals()
    {
        return view('new-arrivals', [
            'wines' => Wine::orderBy('created_at', 'desc')->limit(10)->get()
        ]);
    }

    public function hot_sellers()
    {
        return view('hot-sellers', [
            'wines' => Wine::limit(10)->get()
        ]);
    }

}
