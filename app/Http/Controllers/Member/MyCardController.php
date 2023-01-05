<?php

namespace App\Http\Controllers\Member;

use App\Models\CardMember;
use App\Models\CardPayment;
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
        return response()->json(['members' => $members]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
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
        $card = CardMember::with('user')->with('card')->find($id);  
        $cid=$card->id;   
        $payment=CardPayment::where('card_member',$cid)->get();
        return response()->json(['payment' => $payment,'card'=>$card]);
    }

   
}
