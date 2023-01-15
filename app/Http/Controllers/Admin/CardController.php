<?php

namespace App\Http\Controllers\Admin;

use App\Models\Card;
use App\Models\CardMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\cardFormRequest;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Card::orderBy('updated_at','DESC')
                     ->where('status','')
                     ->get();
        $total_cards=Card::count();
        $assigned=CardMember::count();
        $active=CardMember::where('status','')->count();
        $inactive=CardMember::where('status','1')->count();
        $total_payments=CardPayment::sum('amount');
        return response()->json(['cards' => $cards,'total_cards'=>$total_cards ]);
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
            'card_no' => 'required|max:255',
             ]
            );

           
            $card =new Card();
            $card->card_no=$request->card_no;
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
        $card = Card::find($id);
        return response()->json(['card' => $card]);
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
            'card_no' => 'required|max:255',
        ]);
  
        $card = Card::find($id);
        $card->card_no=$request->card_no;
        $card->save();
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
        Card::destroy($id);
        return response()->json(['status' => "success"]);
    }
}
