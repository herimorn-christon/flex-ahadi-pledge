<?php

namespace App\Http\Controllers;

use App\Models\Pledge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Select2SearchController extends Controller
{
    //
    public function selectSearch(Request $request)

    {

    	$movies = [];


        if($request->has('q')){

            $search = $request->q;

            $movies =Community::select("id", "name")

            		->where('name', 'LIKE', "%$search%")

            		->get();
                    

        }

        return response()->json($movies);

    }
}
