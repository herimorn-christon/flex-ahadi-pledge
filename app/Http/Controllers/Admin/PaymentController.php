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
        $payments = Payment::orderBy('updated_at','DESC')->with('payer')->with('payment')->with('pledge')->get();
        $total=Payment::sum('amount');
        $highest=Payment::max('amount');
        $lowest=Payment::min('amount');
        $best=Payment::where('amount',$highest)->with('payer')->first();

        return response()->json(['payments' => $payments,
                                 'total'=>$total,
                                 'highest'=>$highest,
                                 'lowest'=>$lowest,
                                 'best'=>$best
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

        request()->validate(
            [
            'type_id' => 'required',
            'pledge_id' => 'required',
            'amount' => 'required',
            'receipt' => 'required',
            'user_id' => 'required',
            'verified'=>'1'
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
                $fail="Amount exceeds remaining amount";
                return response()->json(['fail' =>$fail ]);


            }else {
                Payment::create([
                    "type_id" => $request->type_id,
                    "user_id" => $request->user_id,
                    "amount" => $request->amount,
                    "receipt" => $request->receipt,
                    "pledge_id"=>$request->pledge_id,
                    "created_by"=> $request->user()->id,
                    "verified"=>$request->verified,
                ]);
    
              
                return response()->json(['status' => "success"]);
            }

            
        // request()->validate(
        //     [
        //     'type_id' => 'required|max:255',
        //     'user_id' => 'required',
        //     'pledge_id' => 'required',
        //     'amount' => 'required',
        //      ]
        //     );

        //     $payment = new Payment();
        //     $payment->type_id = $request->type_id;
        //     $payment->user_id = $request->user_id;
        //     $payment->amount = $request->amount;
        //     $payment->pledge_id=$request->pledge_id;
        //     $payment->user_id=$request->user_id;
        //     $payment->created_by= Auth::user()->id;
        //     $payment->save();

        //     // start of user notification
        //     $notification = new Notification();
        //     $notification->user_id= $request->user_id;
        //     $notification->created_by= Auth::user()->id;
        //     $notification->type='Member Pledge';
        //     $name=$request->amount;
        //     $notification->message='Your Payment of '.$name.' Tsh has been confirmed successfully.';
        //     $notification->save();
        //     return response()->json(['status' => "success"]);
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
            'amount' => 'required',
        ]);
  
        $payment = Payment::find($id);
        $payment->type_id = $request->type_id;
        $payment->user_id = $request->user_id;
        $payment->amount = $request->amount;
        $payment->pledge_id=$request->pledge_id;
        $payment->user_id=$request->user_id;
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
