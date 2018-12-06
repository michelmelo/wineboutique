<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Varietal;
use App\Tag;
use App\Wine;

class AddNewWineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('add-new-wine', [
            'varietals' => Varietal::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-new-wine', [
            'wines' => Wine::all(),
            'varietals' => Varietal::all(),
            'tags' => Tag::all(),
            'regions' => Region::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add_new_wine= new \App\Wine;
        $add_new_wine->name=$request->get('name');
        $add_new_wine->photo=$request->get('photo');
        $add_new_wine->price=$request->get('price');
        $add_new_wine->winery_id=$request->get('winery');
        $add_new_wine->varietal_id=$request->get('varietal');
        $add_new_wine->quantity=$request->get('quantity');
        $add_new_wine->wine_region_id=$request->get('wine_region');
        $add_new_wine->description=$request->get('description');
        $add_new_wine->region_id=$request->get('region');
        $add_new_wine->save();

        return redirect('/')->withInfo('Wine created successfully');
    }

}
