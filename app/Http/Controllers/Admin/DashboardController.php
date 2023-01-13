<?php

namespace App\Http\Controllers\Admin;

use App\Models\Card;
use App\Models\User;
use App\Models\Pledge;
use App\Models\Jumuiya;
use App\Models\Payment;
use App\Models\CardPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    //
    public function index()
    {   
        
       // Function for number convertion
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
        $num=CardPayment::whereYear('created_at', date('Y'))->sum('amount');
        $cards=thousandsCurrencyFormat($num);
        $pledges=thousandsCurrencyFormat(Pledge::whereYear('created_at', date('Y'))->sum('amount'));
        $payments=thousandsCurrencyFormat(Payment::whereYear('created_at', date('Y'))->sum('amount'));
        $members=thousandsCurrencyFormat(User::where('role','member')->count());
        $male=thousandsCurrencyFormat(User::where('role','member')->where('gender','male')->count());
        $female=thousandsCurrencyFormat(User::where('role','member')->where('gender','female')->count());
        $communities=thousandsCurrencyFormat(Jumuiya::count());
        $contributions=thousandsCurrencyFormat(Payment::sum('amount')+CardPayment::sum('amount'));
        $total_pledges=thousandsCurrencyFormat(Pledge::count());
        $total_cards=thousandsCurrencyFormat(Card::count());

   
        //   for users chart js
        $users = User::select(\DB::raw("COUNT(*) as count"))
        ->whereYear('created_at', date('Y'))
        ->where('role','member')
        ->groupBy(\DB::raw("Month(created_at)"))
        ->pluck('count');
    // for payments chart js
        $payrate = Payment::select(\DB::raw("SUM(amount) as count"))
        ->whereYear('created_at', date('Y'))
        ->groupBy(\DB::raw("Day(created_at)"))
        ->pluck('count');
        return view('admin.dashboard',
        compact('pledges',
                'members',
                'payments',
                'users',
                'payrate',
                'cards',
                'communities',
                'contributions',
                'total_pledges',
                'total_cards',
                'male',
                'female'
            ));

    }


 
}
