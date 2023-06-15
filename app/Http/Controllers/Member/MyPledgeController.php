<?php

namespace App\Http\Controllers\Member;

use App\Models\Pledge;
use App\Models\Payment;
use App\Models\Purpose;
use App\Models\PledgeType;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyPledgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $new_user=Auth::user()->church_id;
        // ->where('church_id',$new_user)
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
        $types=PledgeType::all();
        $user=Auth::user()->id;
        $types=PledgeType::all();
        $purposes=Purpose::where('church_id',$new_user)->get();
        $total_pledges=Pledge::where('user_id',$user)
                               ->where('church_id',$new_user)
                               ->count();
        $fullfilled=Pledge::where('user_id',$user)
                          ->where('church_id',$new_user)
                            ->where('status','1')
                            ->count();
        $unfullfilled=Pledge::where('user_id',$user)
        ->where('church_id',$new_user)
                              ->where('status','')
                              ->count();
        $money=thousandsCurrencyFormat(Pledge::where('user_id',$user)->where('church_id',$new_user)->sum('amount'));
        $object=Pledge::where('user_id',$user)->where('church_id',$new_user)->where('type_id','1')->count();


        $pledges = Pledge::where('user_id',$user)
                           ->where('type_id',9)
                           ->where('church_id',$new_user)
                           ->orderBy('updated_at','DESC')
                           ->with('user')
                           ->with('type')
                           ->with('purpose')
                           ->get();
        $objectPledges = Pledge::where('user_id',Auth::user()->id)
                           ->where('type_id',1)
                           ->where('church_id',$new_user)
                           ->orderBy('updated_at','DESC')
                           ->with('user')
                           ->with('type')
                           ->with('purpose')
                           ->get();
                        
                  return response()->json([
                                 'purposes' => $purposes,
                                 'total_pledges' => $total_pledges,
                                 'fullfilled' => $fullfilled,
                                 'unfullfilled' => $unfullfilled,
                                 'money' => $money,
                                 'object' => $object,
                                 'pledges' => $pledges,
                                 'objectPledges'=>$objectPledges,
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
        $new_user=Auth::user()->church_id;
         
        request()->validate(
            [
            'name' => 'required|max:255',
            // 'amount' => 'required',
            'description' => 'required',
            'deadline' => 'required',
            'type_id' => 'required',
            'purpose_id' => 'required',
             ]
            );

            $pledge = new Pledge();
            $pledge->name = $request->name;
            $pledge->description = $request->description;
            $pledge->amount = $request->amount;
            $pledge->deadline=$request->deadline;
            $pledge->type_id=$request->type_id;
            $pledge->purpose_id=$request->purpose_id;
            $pledge->purpose_id=$request->purpose_id;
            $pledge->object_name=$request->object_name;
            $pledge->object_quantity=$request->object_quantity;
            $pledge->object_cost=$request->object_cost*$request->object_quantity;
            $pledge->metrics=$request->metrics;
            $pledge->church_id=$new_user;
            $pledge->user_id=Auth::user()->id;
            $pledge->status='0';
    
            $pledge->created_by= Auth::user()->id;
            $pledge->save();

            // saving user notification
            $notification = new Notification();
            $notification->user_id=Auth::user()->id;
            $notification->created_by= Auth::user()->id;
            $notification->type='Ahadi mpya !';
            $name=$request->name;
            $date=$request->deadline;
            $notification->message='Habari,Umefanikiwa ahadi mpya inayoitwa '.$name.'. Ahadi hii inatakiwa kutimizwa mpaka tarehe'.$date.'.';
            $notification->save();
            
            return response()->json(['status' => "success"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pledge = Pledge::with('user')->with('type')->with('purpose')->find($id);
        $objectPledges = Pledge::where('type_id',1)->with('user')->with('type')->with('purpose')->find($id);
        //payments
        $payment_object_sum=Payment::where('pledge_id',$id)->sum('object_quantity');
        $pledge_value=Pledge::find($id);
        $payments=Payment::where('pledge_id',$id)->with('pledge')
        ->with('payer')
        ->with('payment')
        ->get();
        // $payments = Payment::where('user_id',$user)
        // ->orderBy('updated_at','DESC')
        // ->with('payer')
        // ->with('payment')
        // ->with('pledge')
        // ->whereHas('pledge', function ($query) {
        //     $query->where('type_id', 9);
        // })
        // ->get();
        $paymentsAmount=Payment::where('pledge_id',$id)->with('pledge')->sum('amount');
         
        return response()->json([
                                'pledge' => $pledge,
                                'payments'=>$payments,
                                'objectPledges'=>$objectPledges,
                                'paymentsAamount'=>$paymentsAmount,
                                'payment_object_sum'=>$payment_object_sum,
                                'pledge_value'=>$pledge_value,


                            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required|max:255',
            'amount' => 'required',
            'description' => 'required',
            'deadline' => 'required',
            'type_id' => 'required',
            'purpose_id' => 'required',
        ]);
  
        $pledge = Pledge::find($id);
        $pledge->name = $request->name;
        $pledge->description = $request->description;
        $pledge->amount = $request->amount;
        $pledge->deadline=$request->deadline;
        $pledge->purpose_id=$request->purpose_id;
        $pledge->type_id=$request->type_id;
        $pledge->status= $request->status == true ? '1':'0';
        $pledge->user_id=Auth::user()->id;
        $pledge->created_by= Auth::user()->id;
        $pledge->save();

        // saving user notification
        $notification = new Notification();
        $notification->user_id=Auth::user()->id;
        $notification->created_by= Auth::user()->id;
        $notification->type='Mabadilisho ya Ahadi !';
        $name=$request->name;
        $date=$request->deadline;
        $notification->message='Habari,kuna mabadiliko yametokea kwenye ahadi inayoitwa '.$name.'.';
        $notification->save();     
        return response()->json(['status' => "success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
