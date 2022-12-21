<?php

namespace App\Http\Controllers\Member;

use App\Models\Payment;
use App\Models\Purpose;
use App\Models\PledgeType;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // for index function
    public function index()
    {
        $types=PaymentType::all();
        $user=Auth::user()->id;
        $purposes=Purpose::where('status','')->get();
        $payments=Payment::where('user_id',$user)->get();
        return view('member.payments.index',compact('types','payments','purposes'));
    }
}
