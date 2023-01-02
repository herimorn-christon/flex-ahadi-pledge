<?php

namespace App\Http\Controllers\Admin;

use App\Models\CardMember;
use App\Models\CardPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CardPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = CardPayment::orderBy('updated_at','DESC')->with('user')->with('card')->get();
        return response()->json(['payments' => $payments]);
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
            'card_member' => 'required',
            'card_amount' => 'required',
             ]
            );

           
            $card =new CardPayment();
            $card->card_member=$request->card_member;
            $card->amount=$request->card_amount;
            $card->created_by= Auth::user()->id;
            $card->save();

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
        $card = CardMember::with('user')->with('card')->find($id);  
        $cid=$card->id;   
        $payment=CardPayment::where('card_member',$cid)->get();
        return response()->json(['payment' => $payment,'card'=>$card]);
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
        // CardPayment::destroy($id);
        $card=CardPayment::where('id',$id)->first();
        $card->delete();
        return response()->json(['status' => "success"]);
    }
}
