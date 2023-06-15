<?php

namespace App\Http\Controllers\Member;

use App\Models\Card;
use App\Models\CardMember;
use App\Models\CardPayment;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user()->id;
        $members = CardMember::where('user_id',$user)->orderBy('updated_at','DESC')->with('user')->with('card')->get();
        $card=CardMember::where('user_id',$user)->orderBy('updated_at','DESC')->with('user')->with('card')->first();
        if($card)
        {
        $id=$card->id;
        $card_payments=CardPayment::where('card_member',$id)->sum('amount');
        }
        else
        {
        $card_payments="Null";
        }
       
        return response()->json([
                                'members' => $members,
                                'card'=>$card,
                                'card_payments'=>$card_payments
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
            request()->validate(
                [
                'user_id' => 'required'
                 ]
                );
                $user=Auth::User()->id;

                $card=CardMember::where('user_id',$user)->where('status','')->first();

                if ($card) {
                    return redirect('member/my-cards')->with('status','Sorry,You Already Have an Active Member Card!');
                }
                else{


                    $member =new CardMember();


                    $card = Card::where('status','')->orderBy('created_by')->first();
                    if ($card) {
                        $card->status=1;
                        $card->update();
                        $member->card_no=$card->id;
                        $member->user_id=$request->user_id;
                        $member->status= $request->status == true ? '1':'0';
                        $member->save(); # code...

                        return redirect('member/my-cards')->with('status','Congratulatioons,You have been assigned a Member Card!');
                    }
                
                    else{
                     
                        $notification = new Notification();
                        $notification->user_id=Auth::user()->id; //0=Admin notification
                        $notification->created_by= Auth::user()->id;
                        $notification->type='card';
                        $name=Auth::User()->fname.''.Auth::User()->lname;
                        $notification->message=$name.'needs to be created a Member Card !';
                        $notification->save();
                        return redirect('member/my-cards')->with('status','Please wait to be assigned a Member Card!');
                    }
                 
        
               
                }
           
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function apistore(Request $request)
        {

            
                $user=$request->user()->id;


                $card=CardMember::where('user_id',$user)->where('status','')->first();


                if ($card) {
                    return response()->json(['error' => "Sorry,You Already Have an Active Member Card!"], 500);

                }
                else{


                    $member = new CardMember();

                    


                    $card = Card::where('status','')->orderBy('created_by')->first();
                    if ($card) {
                        $card->status=1;
                        $card->update();
                        $member->card_no=$card->id;
                        $member->user_id=$request->user()->id;
                        $member->status= $request->status == true ? '1':'0';
                        $member->save(); # code...
                        return response()->json(['success' => "Congratulatioons,You have been assigned a Member Card!"]);

                    }
                
                    else{

                        $notification = new Notification();
                        $notification->user_id= 0; //0=Admin notification
                        $notification->created_by= $request->user()->id;
                        $notification->type='Card Request !';
                        $name=$request->User()->fname;
                        $notification->message= $name .' All Card Members have been assigned, you have to create new Card Members or Reassign existing ones!';
                        $notification->save();
        
                        return response()->json(['error' => "Please wait to be assigned a Member Card!"], 500);
                    }
                 
        
               
                }
           
        }

   
}
