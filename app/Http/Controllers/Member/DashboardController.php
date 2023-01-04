<?php

namespace App\Http\Controllers\Member;

use App\Models\Pledge;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    //
    public function index()
    {

        $user=Auth::user()->id;
        $pledges=Pledge::whereYear('created_at', date('Y'))->where('user_id',$user)->sum('amount');
        $payments=Payment::where('user_id',$user)->whereYear('created_at', date('Y'))->sum('amount');
        $pledges_no=Pledge::whereYear('created_at', date('Y'))->where('user_id',$user)->count();
        $mypledges=Pledge::whereYear('created_at', date('Y'))
                           ->where('user_id',$user)
                           ->get();

        // For Payment Statistics
        $payrate = Payment::select(\DB::raw("SUM(amount) as count"))
        ->whereYear('created_at', date('Y'))
        ->where('user_id',$user)
        ->groupBy(\DB::raw("Day(created_at)"))
        ->pluck('count');

        if($pledges>$payments){

            $number=$payments/$pledges*100; //progress formular

            $progress=number_format((float)$number, 2, '.', '');
            // formular for remaining amount
            $remaining=$pledges-$payments;

            

            return view('member.dashboard',compact('pledges','payments','remaining','pledges_no','progress','mypledges','payrate'));
        }
        else{
            $remaining=0;
            $progress=0;
            return view('member.dashboard',compact('pledges','payments','remaining','pledges_no','progress','mypledges','payrate'));
        }
 

    }
}
