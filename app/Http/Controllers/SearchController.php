<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Reqest $request)
    {
        if(!$request->has('s')) 
        {
            return redirect('home');
        }

        
    }
}
