<?php

namespace App\Http\Controllers\Member;

use App\Models\Payment;
use App\Models\CardMember;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    // for index function
    public function index()
    {
        $types=PaymentType::all();
        $user=Auth::user()->id;
        $cards=CardMember::where('status','')->where('user_id',$user)->get();
        $payments=Payment::where('user_id',$user)->get();
        return view('member.cards.index',compact('types','payments','cards'));
    }
}
