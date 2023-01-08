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
        $pledges=thousandsCurrencyFormat(Pledge::whereYear('created_at', date('Y'))->where('user_id',$user)->sum('amount'));
        $payments=Payment::where('user_id',$user)->whereYear('created_at', date('Y'))->sum('amount');
        $pledges_no=Pledge::whereYear('created_at', date('Y'))->where('user_id',$user)->count();
        $mypledges=Pledge::whereYear('created_at', date('Y'))
                            ->orderby('created_at','Desc')
                           ->where('user_id',$user)
                           ->get();

        // For Payment Statistics
        $payrate =thousandsCurrencyFormat( Payment::select(\DB::raw("SUM(amount) as count"))
        ->whereYear('created_at', date('Y'))
        ->where('user_id',$user)
        ->groupBy(\DB::raw("Day(created_at)"))
        ->pluck('count'));

        if($pledges>$payments){

            $number=$payments/$pledges*100; //progress formular
            $progress=number_format((float)$number, 2, '.', '');//Reducing the number of decimal points to progress 
            // formular for remaining amount
            $remaining=$pledges-$payments;

            

            return view('member.dashboard',compact('pledges','payments','remaining','pledges_no','progress','mypledges','payrate'));
        }
        else{
            $remaining=0;
            $progress=100;
            return view('member.dashboard',compact('pledges','payments','remaining','pledges_no','progress','mypledges','payrate'));
        }
 

    }

    function thousandsCurrencyFormat($num) {

        if($num>1000) {
      
              $x = round($num);
              $x_number_format = number_format($x);
              $x_array = explode(',', $x_number_format);
              $x_parts = array('k', 'm', 'b', 't');
              $x_count_parts = count($x_array) - 1;
              $x_display = $x;
              $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
              $x_display .= $x_parts[$x_count_parts - 1];
      
              return $x_display;
      
        }
      
        return $num;
      }
}
