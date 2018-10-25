<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if(!$request->has('s')) 
        {
            return redirect('home');
        }

        $searchstr = $request->s;

        return view('search', [
            'searchstr' => $searchstr
        ]);
    }
}
