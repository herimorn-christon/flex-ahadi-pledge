<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class PaymentRequest extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $prequests = Payment::where('verified', '0')->with('payer')
    ->with('payment')
    ->with('pledge')
    ->whereHas('pledge', function ($query) {
        $query->where('type_id', 1);
    })
    ->get();
    $myprequests = Payment::where('verified', '0')->with('payer')
    ->with('payment')
    ->with('pledge')
    ->whereHas('pledge', function ($query) {
        $query->where('type_id', 9);
    })
    ->get();

        return response()->json(['prequests' => $prequests,
    'myprequests'=>$myprequests]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purpose = Payment::with('payer')->with('payment')->with('pledge')->find($id);
        
        
        return response()->json(['purpose' => $purpose]);
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

        $roles = Auth::user()->roles;

        // Check if any of the roles has the "approval" permission
        $hasApprovalPermission = false;
        foreach ($roles as $role) {
            if ($role->hasPermissionTo('approval')) {
                $payment = Payment::find($id);
                $payment->verified= 1;
                $payment->save();
                return response()->json(['status' => "success"]);
            
            } else{
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
