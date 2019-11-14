<?php

namespace App\Http\Controllers;

use App\Wine;
use App\Winery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class SearchController extends Controller
{
    protected function fullTextWildcards($term)
    {
        // removing symbols used by MySQL
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);

        foreach($words as $key => $word) {
            /*
             * applying + operator (required word) only big words
             * because smaller ones are not indexed by mysql
             */
            if(strlen($word) >= 3) {
                $words[$key] = '+' . $word . '*';
            }
        }

        $searchTerm = implode( ' ', $words);

        return $searchTerm;
    }

    public function search(Request $request)
    {
        if(!$request->has('s')) 
        {
            return redirect('home');
        }

        $searchstr = $request->s;
        $offset = 0;
        $limit = 4;

        if($request->has('page_offset')&&$request->has('page_limit')) {
            $offset = $request->get('page_offset');
            $limit = $request->get('page_limit');
        }

        $results = Wine::leftJoin('orders', 'wines.id', '=', 'orders.id')
            ->select(DB::raw('wines.*, count(orders.id) as orders_count, \'wines\' as type'))
            ->where('name', 'like', '%' . $searchstr . '%')
            ->groupBy('wines.id')
            ->skip($offset)
            ->take($limit)
            ->get();

        foreach ($results as $result) {
            if(Auth::user()){
                 $result->favorited = $result->favorited();
            }

            $result->rating = $result->rating();
        }

        return $request->ajax() ? ['wines' => $results] : view('search', [
            'searchstr' => $searchstr,
            'results' => $results,
            'winery_results' => Winery::where("name", "like", "%" . $searchstr . "%")->get()
        ]);
    }
}
