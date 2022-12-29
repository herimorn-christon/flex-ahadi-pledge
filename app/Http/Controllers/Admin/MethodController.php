<?php

namespace App\Http\Controllers\Admin;

use App\Models\PaymentType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MethodController extends Controller
{
    
            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $methods = PaymentType::orderBy('updated_at','DESC')->get();
        return response()->json(['methods' => $methods]);
    }
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(
            [
            'name' => 'required|max:255',
             ]
            );

            $method = new PaymentType();
            $method->name=$request->name;
            $method->save();

            return response()->json(['status' => "success"]);
    }

}
