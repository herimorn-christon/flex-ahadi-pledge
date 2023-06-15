<?php

namespace App\Http\Controllers\Admin;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'moreFields.*.title' => 'required',
            'moreFields.*.description' => 'required',
            'moreFields.*.date' => 'required',
        ]);
     
        foreach ($request->moreFields as $key => $value) {
            Todo::create($value);
        }
     
        return back()->with('success', 'Todos Has Been Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteTodos(Request $request,$id)
    {
        $delete_todos=Todo::find($id)->delete();
        //adding the tostr notification
        $notification=array(
            'message'=>' data deleted SuccessFully',
            'alert-type'=>'success'
         );
          return redirect()->back()->with($notification);
    }
}
