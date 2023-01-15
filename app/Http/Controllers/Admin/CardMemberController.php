<?php

namespace App\Http\Controllers\Admin;

use App\Models\Card;
use App\Models\CardMember;
use App\Models\CardPayment;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $total_cards=Card::count();
        $assigned=CardMember::count();
        $active=CardMember::where('status','')->count();
        $inactive=CardMember::where('status','1')->count();
        $total_payments=CardPayment::sum('amount');
        return response()->json(['members' => $members,'total_cards'=>$total_cards,'assigned'=>$assigned,'active'=>$active,'inactive'=>$inactive,'total_payments'=>$total_payments   ]);
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
            // $member->status='0';
            $member->save();

            $notification = new Notification();
            $notification->user_id= $request->user_id;
            $notification->created_by= Auth::user()->id;
            $notification->type='New Card !';
            $name=$request->card_no.' /'.$request->user_id;
            $notification->message='Habari,Umetengenezewa kadi mpya yenye namba : '.$name.'. Hakikisha unaitumia hiyo kadi tu.';
            $notification->save();

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
        $member = CardMember::find($id);
        $card_no=$member->card_no;
        $card = Card::find($card_no);
        $card->status=0;
        $card->update();
        CardMember::destroy($id);
        return response()->json(['status' => "success"]);
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
            'card_No' => 'required',
            'user_Id' => 'required'
        ]);
  
        $member = CardMember::where('id',$id)->first();
        $member->user_id=$request->user_Id;
        $member->card_no=$request->card_No;
        $member->status= $request->card_status;
        $member->save();
        
        return response()->json(['status' => "success"]);
    }
}
