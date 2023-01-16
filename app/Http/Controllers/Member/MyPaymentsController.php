<?php

namespace App\Http\Controllers\Member;

use App\Models\Pledge;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyPaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user()->id;
        $payments = Payment::where('user_id',$user)
                    ->orderBy('updated_at','DESC')
                    ->with('payer')
                    ->with('payment')
                    ->with('pledge')
                    ->get();
        $total_payments= Payment::where('user_id',$user)
                                    ->orderBy('updated_at','DESC')
                                    ->sum('amount');

        $pledges=Pledge::where('user_id',$user)->sum('amount');
        $remaining=$pledges-$total_payments;

        $highest=Payment::where('user_id',$user)
                        ->orderBy('updated_at','DESC')
                        ->max('amount');

        $lowest=Payment::where('user_id',$user)
                        ->orderBy('updated_at','DESC')
                        ->min('amount');
        return response()->json([
                                'payments' => $payments,
                                'total_payments'=>$total_payments,
                                'remaining'=>$remaining,
                                'highest'=>$highest,
                                'lowest'=>$lowest,
                                'pledges'=>$pledges
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
        $user=Auth::User()->id;
        $payment = Payment::where('user_id',$user)
                            ->where('id',$id)
                            ->with('payer')
                            ->with('payment')
                            ->with('pledge')
                            ->first();
        return response()->json(['payment' => $payment]);
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
    public function destroy($id)
    {
        //
    }
}
