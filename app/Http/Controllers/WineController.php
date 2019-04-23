<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Order;
use App\Region;
use App\Varietal;
use App\WineRegion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Wine;
use Illuminate\Support\Str;
use App\WineImage;
use Illuminate\Support\Facades\DB;

class WineController extends Controller
{
    public function store(Request $request)
    {
        /*$photoName = Str::uuid() . "." . $request->file('photo')->extension();
        $request->photo->storeAs('public/images/wines', $photoName);

        $wine = Auth::user()->winery->wines()->create([
            'photo' => $photoName
        ]);

        return $wine;*/
        // protected $fillable = [
        //        'name', 'price', 'photo', 'quantity', 'description', 'who_made_it', 'when_was_it_made', 'capacity', 'unit_id', 'average_rating'
        //    ];
//        file_put_contents('logs.txt', $_SESSION['HTTP_REFERER']);


        return Auth::user()->winery->wines()->create([
            'name' => empty($request->get('name')) ? null : $request->get('name'),
            'price' => empty($request->get('price')) ? null : $request->get('price'),
            'photo' => empty($request->file('photo')) ? null : $request->file('photo'),
            'quantity' => empty($request->get('quantity')) ? null : $request->get('quantity'),
            'description' => empty($request->get('description')) ? null : $request->get('description'),
            'who_made_it' => empty($request->get('who_made_it')) ? null : $request->get('who_made_it'),
            'when_was_it_made' => empty($request->get('when_was_it_made')) ? null : $request->get('when_was_it_made'),
            'capacity' => empty($request->get('capacity')) ? null : $request->get('capacity'),
            'unit_id' => empty($request->get('unit_id')) ? null : $request->get('unit_id'),
            'average_rating' => empty($request->get('average_rating')) ? null : $request->get('average_rating')
        ]);

    }

    public function update(Request $request, $id)
    {
        $wine = Wine::findOrFail($id);
        $wine->update($request->all());
        if($request->varietal_id) {
            $wine->varietal()->associate(Varietal::find($request->varietal_id));
        }
        if($request->region_id) {
            $wine->region()->associate(Region::find($request->region_id));
        }
        $wine->save();
    }

    public function delete($id)
    {
        $wine = Wine::findOrFail($id);
        $wine->delete();
    }

    public function clone($id)
    {
        $wine = Wine::findOrFail($id);
        $newWine = $wine->replicate();
        $newWine->save();
        return $newWine;
    }

    public function list(Request $request)
    {
        $wines = Wine::query();

        $varietals = Varietal::all();
        $regions = Region::all();

        $filter = $request->all();

        if(array_key_exists('varietal', $filter)) {
            $wines = $wines->whereIn('varietal_id', $filter['varietal']);
        }

        if(array_key_exists('region', $filter)) {
            $wines = $wines->whereIn('region_id', $filter['region']);
        }

        if(array_key_exists('price', $filter)) {
            $prices = $filter['price'];
            $wines = $wines->where(function($q) use ($prices) {
                $useOr = false;
                if(in_array(1, $prices)) {
                    $q->whereBetween('price', [1, 50]);
                    $useOr = true;
                }

                if(in_array(2, $prices)) {
                    $useOr?$q->orWhereBetween('price', [51, 100]):$q->whereBetween('price', [51, 100]);
                    $useOr = true;
                }

                if(in_array(3, $prices)) {
                    $useOr?$q->orWhere('price', '>', 100):$q->where('price', '>', 100);
                }
            });
        }

        $wines = $wines
            ->leftJoin('orders', 'wines.id', '=', 'orders.id')
            ->select(DB::raw('wines.*, count(orders.id) as orders_count'))
            ->groupBy('wines.id')
            ->paginate(8);

        return view('wines', [
            'wines' => $wines,
            'varietals' => $varietals,
            'regions' => $regions,
            'filter' => $filter
        ]);
    }

    public function show(Wine $wine)
    {
        return view('wines-single', [
            'wine' => $wine,
            'orders_count' =>  DB::table('orders')
                ->selectRaw('COUNT(id) as cnt')
                ->where('id','=',$wine->id)
                ->get()[0]
        ]);
    }

    public function varietals()
    {
        return Varietal::all();
    }

    public function topRated(Request $request)
    {
        $wines = Wine::orderBy('average_rating', 'desc');
        $varietals = Varietal::all();
        $regions = Region::all();

        $filter = $request->all();

        if(array_key_exists('varietal', $filter)) {
            $wines = $wines->whereIn('varietal_id', $filter['varietal']);
        }

        if(array_key_exists('region', $filter)) {
            $wines = $wines->whereIn('region_id', $filter['region']);
        }

        if(array_key_exists('price', $filter)) {
            $prices = $filter['price'];
            $wines = $wines->where(function($q) use ($prices) {
                $useOr = false;
                if(in_array(1, $prices)) {
                    $q->whereBetween('price', [1, 50]);
                    $useOr = true;
                }

                if(in_array(2, $prices)) {
                    $useOr?$q->orWhereBetween('price', [51, 100]):$q->whereBetween('price', [51, 100]);
                    $useOr = true;
                }

                if(in_array(3, $prices)) {
                    $useOr?$q->orWhere('price', '>', 100):$q->where('price', '>', 100);
                }
            });
        }

        $wines = $wines->paginate(8);

        return view('wines', [
            'wines' => $wines,
            'varietals' => $varietals,
            'regions' => $regions,
            'filter' => $filter
        ]);
    }
}
