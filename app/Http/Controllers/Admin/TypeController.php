<?php

namespace App\Http\Controllers\Admin;

use App\Models\PledgeType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = PledgeType::orderBy('updated_at','DESC')->get();
        return response()->json(['types' => $types ]);
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
            'title' => 'required|max:255',
             ]
            );

            $type = new PledgeType();
            $type->title=$request->title;
            $type->save();

            return response()->json(['status' => "success"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = PledgeType::find($id);
        return response()->json(['method' => $type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'title' => 'required|max:255',
        ]);
  
        $type = PledgeType::find($id);
        $type->title=$request->title;
        $type->save();
        return response()->json(['status' => "success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PledgeType::destroy($id);
        return response()->json(['status' => "success"]);
    }
}
