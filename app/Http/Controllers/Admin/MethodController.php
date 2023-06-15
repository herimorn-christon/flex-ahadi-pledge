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

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $method = PaymentType::find($id);
        return response()->json(['method' => $method]);
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
            'name' => 'required|max:255',
        ]);
  
        $method = PaymentType::find($id);
        $method->name=$request->name;
        $method->save();
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
        PaymentType::destroy($id);
        return response()->json(['status' => "success"]);
    }
    public function togglePayment(Request $request, $id)
    {
        $payment = PaymentType::findOrFail($id);
        $payment->is_active = !$payment->is_active;
        $payment->save();

        return response()->json(['message' => 'payment status changed successfully']);
    }

    public function search(Request $request)
    {
    	$methods = [];

        if($request->has('q')){
            $search = $request->q;
            $methods =PaymentType::select("id", "name")
            		->where('name', 'LIKE', "%$search%")
            		->get();
        }else {
            $methods =PaymentType::all();
        }
        return response()->json($methods);
    }

}
