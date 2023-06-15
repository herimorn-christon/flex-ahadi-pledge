<?php

namespace App\Http\Controllers\Member;

use App\Models\Pledge;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class MyPaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user()->id;
        $new_user=Auth::user()->church_id;
        // $payments = Payment::where('user_id',$user)
                     
        //             ->orderBy('updated_at','DESC')
        //             ->with('payer')
        //             ->with('payment')
                     
        //             ->with('pledge')
        //             ->whereHas('pledge', function ($query) {
        //                 $query->where('type_id', 9);
        //             })
        //             ->get();
    $payments = Payment::where('user_id', $user)
    ->where('church_id',$new_user)
    ->where('is_active',1)
    ->with('payer')
    ->with('payment')
    ->with('pledge')
    ->whereHas('pledge', function ($query) {
        $query->where('type_id', 9);
    })
    ->get();
    $paymentsObject = Payment::where('user_id',$user)
                    ->where('is_active',1)
                    ->where('church_id',$new_user)
                    ->orderBy('updated_at','DESC')
                    ->with('payer')
                    ->with('payment')
                    ->with('pledge')
                    ->whereHas('pledge', function ($query) {
                        $query->where('type_id', 1);
                    })
                    ->get();           
        $total_payments= Payment::where('user_id',$user)
                                  ->where('church_id',$new_user)
                                    ->orderBy('updated_at','DESC')
                                    ->sum('amount');

        $pledges=Pledge::where('user_id',$user)
        ->where('church_id',$new_user)->sum('amount');
        $remaining=$pledges-$total_payments;

        $highest=Payment::where('user_id',$user)
                      ->where('church_id',$new_user)
                        ->orderBy('updated_at','DESC')
                        ->max('amount');

        $lowest=Payment::where('user_id',$user)
                       ->where('church_id',$new_user)
                        ->orderBy('updated_at','DESC')
                        ->min('amount');
        return response()->json([
                                'payments' => $payments,
                                'total_payments'=>$total_payments,
                                'remaining'=>$remaining,
                                'highest'=>$highest,
                                'lowest'=>$lowest,
                                'pledges'=>$pledges,
                                'paymentsObject'=>$paymentsObject,
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
        
       
          if($request->pledge_types==='money'){
        
            request()->validate(
                [
                'type_id' => 'required',
                'pledge_id' => 'required',
                'amount' => 'required',
                'receipt' => 'required',
                // 'verified'=>'1'
                 ]
                );
                  
            
                $pledge = Pledge::find($request->pledge_id);
    
                $pledgePayments = Payment::where('pledge_id', $request->pledge_id)->get()->toArray();
                $pledgePayments_sum = Payment::where('pledge_id', $request->pledge_id)->where('money_transaction', '>', 0)
                ->min('money_transaction');
                
    
                $totalPaid = array_reduce($pledgePayments, 
                function ($acc, $element)
                    {
                        return $acc + (int) $element['amount'];
                    }
                , 0);
    
                $reqAmount = (int) $request->amount;
                $pledgeAmount = (int) $pledge->amount;
    
                $remainigAmount = $pledgeAmount - $totalPaid;
                $pledgePaymentsAmount = Payment::where('pledge_id', $request->pledge_id)->sum('amount');
             
                
    
                if($reqAmount > $remainigAmount  ){
                
                      $new_user=Auth::user()->church_id;
                       $exceed_amount= $request->amount-$pledge->amount;
                        $payment = new Payment();
                        $payment->exceed_money=$exceed_amount;
                        $payment->money_transaction=$remainigAmount;
                        $payment->type_id = $request->type_id;
                        $payment->user_id = Auth::user()->id;
                        $payment->amount =$remainigAmount;
                        $payment->pledge_id=$request->pledge_id;
                        $payment->user_id=Auth::user()->id;
                        $payment->receipt=$request->receipt;
                        $payment->church_id=$new_user;
                            // $payment->object_cost=$request->object_cost;
                            // $payment->object_quantity=$request->object_quantity;
                        $payment->verified=0;
                            
                        $payment->created_by= Auth::user()->id;
                        $payment->save();
                    //handle the notification without storing in the database
              $notification=array(
                        'message'=>'the amount paid exceed the pledge amount',
                        'alert-type'=>'success'
                     );
                      return redirect()->back()->with($notification);
                    // $fail="Amount exceeds remaining amount";
                    // return response()->json(['fail' =>$fail ]);
    
    
                }else if($reqAmount < $remainigAmount) {
                    //selecting the sum of the money payment

                $money_transaction_sum=$pledgeAmount-$pledgePaymentsAmount;
                $new_user=Auth::user()->church_id;
                // dd($money_transaction_sum,$pledgePayments_sum);
                if($pledgePayments_sum==0){
                    // dd("waooo");
                    $payment = new Payment();
                    $payment->money_transaction=$pledgeAmount-$request->amount;
                    $payment->type_id = $request->type_id;
                    $payment->user_id = Auth::user()->id;
                   $payment->amount = $request->amount;
                   $payment->pledge_id=$request->pledge_id;
                   $payment->user_id=Auth::user()->id;
                   $payment->receipt=$request->receipt;
                   $payment->church_id=$new_user;
                // $payment->object_cost=$request->object_cost;
                // $payment->object_quantity=$request->object_quantity;
                $payment->verified=0;
                
                $payment->created_by= Auth::user()->id;
                $payment->save();
                $notification=array(
                    'message'=>'the payment succeeed',
                    'alert-type'=>'success'
                 );
                  return redirect()->back()->with($notification);
                }else{
                    
                    // dd($pledgePayments_sum);
                    $payment = new Payment();
                    $payment->money_transaction=$money_transaction_sum-$request->amount;
                    $payment->type_id = $request->type_id;
                    $payment->user_id = Auth::user()->id;
                   $payment->amount = $request->amount;
                   $payment->pledge_id=$request->pledge_id;
                   $payment->user_id=Auth::user()->id;
                   $payment->receipt=$request->receipt;
                // $payment->object_cost=$request->object_cost;
                // $payment->object_quantity=$request->object_quantity;
                $payment->verified=0;
                $payment->church_id=$new_user;
                
                $payment->created_by= Auth::user()->id;
                $payment->save();
                
                $notification=array(
                    'message'=>'payment saved successfully',
                    'alert-type'=>'success'
                 );
                  return redirect()->back()->with($notification);
                }
              
           
                
                
                
             
        
                  
                $notification=array(
                    'message'=>'payment saved successfylly',
                    'alert-type'=>'success'
                 );
                  return redirect()->back()->with($notification);



                    
                }
                      
                $notification=array(
                    'message'=>'payment saved successfylly',
                    'alert-type'=>'success'
                 );
                  return redirect()->back()->with($notification);
                   

          }else{
            //selecting the object cost of the pledge 
            $pledgePayments_sumObject = Payment::where('pledge_id', $request->pledge_id)->where('object_transaction', '>', 0)
                    ->min('object_transaction');
            $pledgeObject = Pledge::find($request->pledge_id);
            //working on the conversion
            $total_pledge_object_cost=$pledgeObject->object_cost;
            $total_pledge_quantity=$pledgeObject->object_quantity;
            $object_cost_conversion=$pledgeObject->object_cost/$pledgeObject->object_quantity;
             $object_quantity_conversion=$request->object_cost/$object_cost_conversion;
            // $quantity_in_conversion=$total_pledge_object_cost/$total_object_cost_intered;
            // dd($object_cost_conversion,$object_quantity_conversion,$total_pledge_object_cost,$total_pledge_quantity);
            $pledgeObjectTotal = Pledge::where('id',$request->pledge_id)->sum('object_quantity');
            $object_transaction=$pledgePayments_sumObject-$request->object_quantity;
            
            $total_stuffs=$request->object_quantity+$object_quantity_conversion;
        

            // $pledgePaymentObjectQuantity = Payment::where('pledge_id', $request->pledge_id)->sum('object_quantity');
            $pledgePaymentObjectQuantity = Payment::where('pledge_id', $request->pledge_id)->sum('total_Paid_object');
             $payment_object_input=$total_stuffs;
            //   dd($pledgePaymentObjectQuantity,$pledgeObject->object_quantity);
            $remaining_quantity=$pledgeObject->object_quantity-$pledgePaymentObjectQuantity;
            // dd($payment_object_input,$total_stuffs,$remaining_quantity);
            // dd($total_stuffs);
            if ($payment_object_input >$remaining_quantity) {
                   //redirecting with the notification
                   $new_user=Auth::user()->church_id;
                   $notification=array(
                    'message'=>'the amount inserted exceed the pledge amount',
                    'alert-type'=>'success'
                 );
                  return redirect()->back()->with($notification);

            } else if($payment_object_input <= $remaining_quantity) {
                // dd($pledgeObjectTotal);
                
                $new_user=Auth::user()->church_id;
                //selecting the object cost of the pledge 
                 if($pledgePayments_sumObject==0){
                    $payment = new Payment();
                    $payment->type_id = $request->type_id;
                    $payment->user_id = Auth::user()->id;;
                    $payment->pledge_id = $request->pledge_id;
                    // $payment->user_id = $user->id;
                    $payment->receipt = $request->receipt;
                    $payment->object_cost = $request->object_cost;
                    $payment->object_quantity = $request->object_quantity;
                    $payment->verified = 0;
                    $payment->object_quantity_conversion=$object_quantity_conversion;
                    $payment->total_Paid_object=$total_stuffs;
                    $payment->object_transaction=$pledgeObjectTotal-$total_stuffs;
                    $payment->created_by = Auth::user()->id;
                    $payment->church_id=$new_user;
                    $payment->save();
                    $notification=array(
                        'message'=>'payment succeed',
                        'alert-type'=>'success'
                     );
                      return redirect()->back()->with($notification);
                 }else{
                    $payment = new Payment();
                    $payment->type_id = $request->type_id;
                    $payment->user_id = Auth::user()->id;;
                    $payment->pledge_id = $request->pledge_id;
                    // $payment->user_id = $user->id;
                    $payment->total_Paid_object=$total_stuffs;
                    $payment->receipt = $request->receipt;
                    $payment->object_cost = $request->object_cost;
                    $payment->object_quantity = $request->object_quantity;
                    $payment->verified = 0;
                    $payment->object_transaction=$pledgePayments_sumObject-$total_stuffs;
                    $payment->created_by = Auth::user()->id;
                    $payment->object_quantity_conversion=$object_quantity_conversion;
                    $payment->church_id=$new_user;
                    $payment->save();
                    $notification=array(
                        'message'=>'payment done successfully',
                        'alert-type'=>'success'
                     );

                 }
      
            }
         

          }
       
            
          
            
        
   
               
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $ids=$id;
        $user=Auth::User()->id;
        
        $payment = Payment::where('user_id',$user)
                            ->where('id',$id)
                            ->with('payer')
                            ->with('payment')
                            ->with('pledge')
                            ->first();
// $payment_object_prev = Payment::where('user_id',$user)->
//                              where('id', '<', $id)
//                             ->with('payer')
//                             ->with('payment')
//                             ->with('pledge')
//                             ->whereHas('pledge', function ($query) {
//                                 $query->whereNotNull('type_id')
//                                     ->where('type_id', '=', '1');
//                             })
//                             ->first();

        $payment_sum= Payment::where('user_id',$user)
                            ->where('id',$id)
                            ->with('payer')
                            ->with('payment')
                            ->with('pledge')
                            ->sum('object_quantity');
        return response()->json(['payment' => $payment,
    'payment_sum'=>$payment_sum]);
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
        //
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
