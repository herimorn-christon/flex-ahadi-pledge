<?php

namespace App\Http\Controllers;

use App\Models\dependant;
use Illuminate\Http\Request;

class adminAddDependantController extends Controller
{
    public function store(Request $request){
        //return $request->all();
        
        $request->validate([
            'users_dependant'=>'required',
            'dependant_name'=>'required',
            'relationship'=>'required',
            'birth_date'=>'required',
        ]
        
        );
         dependant::create([
           'fullName'=>$request->dependant_name,
           'relationship'=>$request->relationship,
           'users_id'=>$request->users_dependant,
            'birth_date'=>$request->birth_date,
         ]);
         return response()->json([
            'success'=>'dependant saved successfully'

        ],201);
       
 

    }
}
