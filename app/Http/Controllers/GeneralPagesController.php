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

}
