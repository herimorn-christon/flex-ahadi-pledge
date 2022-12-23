<?php

namespace App\Http\Controllers\Member;

use App\Models\Pledge;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {

        $user=Auth::user()->id;
        $pledges=Pledge::where('user_id',$user)->sum('amount');
        $payments=Payment::where('user_id',$user)->sum('amount');
        $pledges_no=Pledge::where('user_id',$user)->count();
        if($pledges>$payments){
            // formular for remaining amount
            $remaining=$pledges-$payments;

            return view('member.dashboard',compact('pledges','payments','remaining','pledges_no'));
        }
        else{
            $remaining=0;
            return view('member.dashboard',compact('pledges','payments','remaining','pledges_no'));
        }
 

    }
}
