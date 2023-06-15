<?php

namespace App\Http\Controllers\Admin;
use App\Models\Pledge;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\paymentFormRequest;
use App\Http\Requests\Admin\paymentsFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
class PaymentController extends Controller
{

     /**
     * Display a listing of the payments.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $new_user=Auth::user()->church_id;
        $payments_object = Payment::orderBy('updated_at','DESC')->where('verified',1)
        ->where('church_id',$new_user)
        ->with('payer')->with('payment')->with('pledge')
        ->whereHas('pledge', function ($query) {
            $query->where('type_id', 1);
        })
        ->get();
        $payments = Payment::orderBy('updated_at','DESC')->where('verified',1)
        ->where('church_id',$new_user)
        ->with('payer')->with('payment')->with('pledge')
        ->whereHas('pledge', function ($query) {
            $query->where('type_id', 9);
        })
        ->get();
        $total=Payment::where('verified',1)->where('church_id',$new_user)->sum('amount');
        $highest=Payment::where('verified',1)->where('church_id',$new_user)->max('amount');
        $lowest=Payment::where('verified',1)->where('church_id',$new_user)->min('amount');
        $best=Payment::where('verified',1)->where('church_id',$new_user)->where('amount',$highest)->with('payer')->first();
        $users = User::where('church_id',$new_user)->get();
        $pledges = Pledge::where('church_id',$new_user)->get();


        return response()->json(['payments' => $payments,
                                 'total'=>$total,
                                 'highest'=>$highest,
                                 'lowest'=>$lowest,
                                 'best'=>$best,
                                 'users'=>$users,
                                 'pledges'=>$pledges,
                                 'payments_object'=>$payments_object,
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
            // 'type_id' => 'required',
            'pledge_id' => 'required',
            // 'amount' => 'required',
            'receipt' => 'required',
            'user_id' => 'required',
            'verified'=>'1'
             ]
            );

    
            $pledge = Pledge::where('church_id',$new_user)->find($request->pledge_id);
      

            $pledgePayments = Payment::where('pledge_id', $request->pledge_id)
            ->where('church_id',$new_user)->get()->toArray();

            $totalPaid = array_reduce($pledgePayments, 
            function ($acc, $element)
                {
                    return $acc + (int) $element['amount'];
                }
            , 0);

            $reqAmount = (int) $request->amount;
            $pledgeAmount = (int) $pledge->amount;

            $remainigAmount = $pledgeAmount - $totalPaid;

            if($reqAmount > $remainigAmount){
                $fail="Amount exceeds remaining amount";
                return response()->json(['fail' =>$fail ]);


            }else {
            $payment = new Payment();
            $payment->type_id = $request->type_id;
            $payment->user_id = $request->user_id;
            $payment->amount = $request->amount;
            $payment->pledge_id=$request->pledge_id;
            $payment->user_id=$request->user_id;
            $payment->receipt=$request->receipt;
            $payment->object_cost=$request->object_cost;
            $payment->object_quantity=$request->object_quantity;
            $payment->verified=1;
            $payment->church_id=$new_user;
            $payment->created_by= Auth::user()->id;
            $payment->save();
            
         
    
              
                return response()->json(['status' => "success"]);
            }

  
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
            'type_id' => 'required|max:255',
            'user_id' => 'required',
            'pledge_id' => 'required',

        ]);
           //lets finds the object costs
        $payment = Payment::find($id);
        $payment->type_id = $request->type_id;
        $payment->user_id = $request->user_id;
        $payment->amount = $request->amount;
        $payment->pledge_id=$request->pledge_id;
        $payment->user_id=$request->user_id;
        $payment->created_by= Auth::user()->id;
        $payment->object_cost=$request->object_cost;
        $payment->object_quantity=$request->object_quantity;
        $payment->created_by= Auth::user()->id;
        $payment->save();
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
        Payment::destroy($id);
        return response()->json(['status' => "success"]);
    }
    //toogle functionality
    public function toggle(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->is_active = !$payment->is_active;
        $payment->save();

        return response()->json(['message' => 'payment status changed successfully']);
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purpose = Payment::with('payer')->with('payment')->with('pledge')->find($id);
        return response()->json(['purpose' => $purpose]);
    }
 

     /**
     * Display a listing of the resource by user.
     *
     * @return \Illuminate\Http\Response
     */
    public function users(Request $request)
    {
        $payments = Payment::where('user_id', $request->user()->id)->get();
        return response()->json(['payments' => $payments]);
    }

    public function apistore(Request $request)
    {
        request()->validate(
            [
            'type_id' => 'required',
            'pledge_id' => 'required',
            'amount' => 'required',
            'receipt' => 'required'
             ]
            );

    
            $pledge = Pledge::find($request->pledge_id);

            $pledgePayments = Payment::where('pledge_id', $request->pledge_id)->get()->toArray();

            $totalPaid = array_reduce($pledgePayments, 
            function ($acc, $element)
                {
                    return $acc + (int) $element['amount'];
                }
            , 0);

            $reqAmount = (int) $request->amount;
            $pledgeAmount = (int) $pledge->amount;

            $remainigAmount = $pledgeAmount - $totalPaid;

            if($reqAmount > $remainigAmount){

                return response()->json(['error' => "Amount exceeds remaining amount"], 500);


            }else {
                Payment::create([
                    "type_id" => $request->type_id,
                    "user_id" => $request->user()->id,
                    "amount" => $request->amount,
                    "receipt" => $request->receipt,
                    "pledge_id"=>$request->pledge_id,
                    "created_by"=> $request->user()->id
                ]);
    
              
                return response()->json(['status' => "success"]);
            }

            
    }


    // auto fill member pledges
      // Fetch records
      public function getEmployees($departmentid=0){

    	// Fetch Employees by Departmentid
        $empData['data'] = Pledge::orderby("name","asc")
                    ->whereYear('created_at', date('Y'))
                    ->with('user')  
        			->where('user_id',$departmentid)
        			->get();
  
        return response()->json($empData);
     
    }


}
