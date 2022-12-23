<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CardController extends Controller
{
    // for index function
    public function index()
    {
        $types=PaymentType::all();
        $user=Auth::user()->id;
        $cards=Card::where('status','')->where('user_id',$user)->get();
        $payments=Payment::where('user_id',$user)->get();
        return view('member.cards.index',compact('types','payments','cards'));
    }
}
