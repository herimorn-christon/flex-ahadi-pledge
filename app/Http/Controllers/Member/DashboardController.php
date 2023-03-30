<?php

namespace App\Http\Controllers\Member;

use App\Models\Event;
use App\Models\Pledge;
use App\Models\Payment;
use App\Models\CardMember;
use App\Models\CardPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
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
        $user=Auth::user()->id;
        $pledges= Pledge::whereYear('created_at', date('Y'))->where('user_id',$user)->sum('amount');
        $total_amount=thousandsCurrencyFormat($pledges);
        $payments=Payment::where('user_id',$user)->whereYear('created_at', date('Y'))->where('verified',1)->sum('amount');
        $payment_total=Payment::where('user_id',$user)->whereYear('created_at', date('Y'))->sum('amount');
        //the unverified payments 
        $pledges_no=Pledge::whereYear('created_at', date('Y'))->where('user_id',$user)->count();
        $mypledges=Pledge::whereYear('created_at', date('Y'))
                            ->orderby('created_at','Desc')
                           ->where('user_id',$user)
                           ->get();
        $total_pledges= Pledge::whereYear('created_at', date('Y'))->where('user_id',$user)->count();
        $cash_pledges= Pledge::whereYear('created_at', date('Y'))->where('user_id',$user)->where('type_id',2)->count();
        $object_pledges= Pledge::whereYear('created_at', date('Y'))->where('user_id',$user)->where('type_id',1)->count();
        $card=CardMember::where('user_id',$user)->whereYear('created_at', date('Y'))->where('status','')->first();
        
        if($card){
            $cardpayments=CardPayment::where('card_member',$card->id)->sum('amount');
            $total_cardp=thousandsCurrencyFormat(CardPayment::where('card_member',$card->id)->sum('amount'));
           // For Payment Statistics
        $payrate = Payment::select(\DB::raw("SUM(amount) as count"))
        ->whereYear('created_at', date('Y'))
        ->where('user_id',$user)
        ->groupBy(\DB::raw("Day(created_at)"))
        ->pluck('count');
        $events = Event::all();
        if($pledges>$payments){

            $number=$payments/$pledges*100; //progress formular
            $progress=number_format((float)$number, 2, '.', '');//Reducing the number of decimal points to progress 
            // formular for remaining amount
            $remaining= thousandsCurrencyFormat($pledges-$payments);

            if(request()->ajax()){
                $start = (!empty($_GET["event_start"])) ? ($_GET["event_start"]) : ('');
                $end = (!empty($_GET["event_end"])) ? ($_GET["event_end"]) : ('');
               $events = Event::whereDate('event_start', '>=', $start)->whereDate('event_end',   '<=', $end)
                       ->get(['id','event_name','event_start', 'event_end']);
               return response()->json($events);
               }

            return view('member.dashboard',
            compact(
                'total_amount',
                'total_cardp',
                'payments',
                'remaining',
                'pledges_no',
                'progress',
                'mypledges',
                'payrate',
                'cardpayments',
                'events',
                'total_pledges',
                'cash_pledges',
                'object_pledges',
                'payment_total',
                

            ));
        }
        else{
            $remaining=0;
            if($pledges == $payments)
            {
                $progress=100;
            }
            else
            {
                $progress=0;
            }
           


               return view('member.dashboard',
               compact(
                'total_amount',
                   'pledges',
                   'payments',
                   'remaining',
                   'pledges_no',
                   'progress',
                   'mypledges',
                   'payment_total',
                   'payrate',
                   'cardpayments',
                   'events',
                   'total_pledges',
                   'cash_pledges',
                   'object_pledges'
                   
               ));
        }
        }
        else{

            $cardpayments=0;
 // For Payment Statistics
 $payrate = Payment::select(\DB::raw("SUM(amount) as count"))
 ->whereYear('created_at', date('Y'))
 ->where('user_id',$user)
 ->groupBy(\DB::raw("Day(created_at)"))
 ->pluck('count');
 $events = Event::all();
 if($pledges>$payments){

     $number=$payments/$pledges*100; //progress formular
     $progress=number_format((float)$number, 2, '.', '');//Reducing the number of decimal points to progress 
     // formular for remaining amount
     $remaining=$pledges-$payments;

     return view('member.dashboard',
     compact(
        'total_amount',
         'pledges',
         'payments',
         'remaining',
         'pledges_no',
         'progress',
         'mypledges',
         'payrate',
         'cardpayments',
         'payment_total',
         'events',
         'total_pledges',
         'cash_pledges',
         'object_pledges'
        

     ));
 }
 else{
     $remaining=0;
     if($pledges == $payments)
     {
         $progress=100;
     }
     else
     {
         $progress=0;
     }

     if(request()->ajax()){
         $start = (!empty($_GET["event_start"])) ? ($_GET["event_start"]) : ('');
         $end = (!empty($_GET["event_end"])) ? ($_GET["event_end"]) : ('');
        $events = Event::whereDate('event_start', '>=', $start)->whereDate('event_end',   '<=', $end)
                ->get(['id','event_name','event_start', 'event_end']);
        return response()->json($events);
        }

        return view('member.dashboard',
        compact(
            'total_amount',
            'pledges',
            'payments',
            'remaining',
            'pledges_no',
            'progress',
            'mypledges',
            'payrate',
            'cardpayments',
            'events',
            'total_pledges',
            'cash_pledges',
            'payment_total',
            'object_pledges'
        ));
 }
        }
   
       
 

    }


      public function create()
      {
          return view('events.create');
      }
      
      public function store(Request $request)
      {
          Event::create($request->all());
          return redirect()->route('member.dashboard');
      }
}
