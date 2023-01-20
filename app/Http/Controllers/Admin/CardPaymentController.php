<?php

namespace App\Http\Controllers\Admin;

use App\Models\CardMember;
use App\Models\CardPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToArray;

class CardPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        $cards = CardMember::where('user_id', $user_id)->with('card')->get();
        return response()->json(['cards' => $cards]);
    }


    public function payments(Request $request) {

        $card_id = $request->card_id;

        $payments = CardPayment::with('card')->get()->toArray();


        $filtered = array_filter($payments, function($payment) use($card_id) {
            return $payment['card']['card_no'] == $card_id;
        });


        return response()->json(['payments' => $filtered]);

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
