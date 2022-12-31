<?php

namespace App\Http\Controllers\Admin;

use App\Models\Card;
use App\Models\CardMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardMemberController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = CardMember::orderBy('updated_at','DESC')->with('user')->with('card')->get();
        return response()->json(['members' => $members]);
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
            'card_no' => 'required',
            'user_id' => 'required',
             ]
            );

           
            $member =new CardMember();
            $member->card_no=$request->card_no;
            $card_no=$request->card_no;
            $card = Card::find($card_no);
            $card->status=1;
            $card->update();

            $member->user_id=$request->user_id;
            $member->status= $request->status == true ? '1':'0';
            $member->save();

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
        $member = CardMember::find($id);
        return response()->json(['member' => $member]);
    }
  

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CardMember::destroy($id);
        return response()->json(['status' => "success"]);
    }
}
