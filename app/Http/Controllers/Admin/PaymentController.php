<?php

namespace App\Http\Controllers\Admin;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\paymentFormRequest;
use App\Http\Requests\Admin\paymentsFormRequest;

class PaymentController extends Controller
{

    // for index function
    // public function index()
    // {
    //     $types=PaymentType::all();
    //     $payments=Payment::all();
    //     return view('admin.payments.index',compact('types','payments'));
    // }

     /**
     * Display a listing of the payments.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purposes = Payment::orderBy('updated_at','DESC')->with('payer')->with('payment')->with('purpose')->get();
        return response()->json(['purposes' => $purposes]);
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
            'type_id' => 'required|max:255',
            'user_id' => 'required',
            'pledge_id' => 'required',
            'amount' => 'required',
             ]
            );

            $payment = new Payment();
            $payment->type_id = $request->type_id;
            $payment->user_id = $request->user_id;
            $payment->amount = $request->amount;
            $payment->pledge_id=$request->pledge_id;
            $payment->user_id=$request->user_id;
            $payment->created_by= Auth::user()->id;
            $payment->save();

            // start of user notification
            $notification = new Notification();
            $notification->user_id= $request->user_id;
            $notification->created_by= Auth::user()->id;
            $notification->type='Member Pledge';
            $name=$request->amount;
            $notification->message='Your Payment of '.$name.' Tsh has been confirmed successfully.';
            $notification->save();
            return response()->json(['status' => "success"]);
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
        $purpose = Payment::with('payer')->with('payment')->with('purpose')->find($id);
        return response()->json(['purpose' => $purpose]);
    }
    // saving payment method function
    public function saveMethod(paymentFormRequest $request)
    {
        $data=$request->validated();
        $method =new PaymentType;
        $method->name=$data['name'];
        $method->save();

        return redirect('admin/all-payments')->with('status','Payment Method was Added Successfully');
    }

    // edit payment method page function
    public function editMethod($method_id)
    {
        $type=PaymentType::find($method_id);
        return view('admin.payments.edit',compact('type'));
    }
  // update payment method function
    public function updateMethod(paymentFormRequest $request,$method_id)
    {
        $data=$request->validated();
        $type =PaymentType::find($method_id);
        $type->name=$data['name'];
        // saving data
        $type->update();

        return redirect('admin/all-payments')->with('status','Payment method was Updated Successfully');
    }
// delete  payment method function
    public function destroyMethod($method_id)
    {
        $method=PaymentType::find($method_id);

        if($method){
            $method->delete();
            return redirect('admin/all-payments')->with('status','Payment method was deleted Successfully');
        }
        else{
            return redirect('admin/all-payments')->with('status','No Payment method ID was found !');
        }
    }

    // saving payment function
    public function save(paymentsFormRequest $request)
    {
        $data=$request->validated();
        $payment =new Payment;
        $payment->user_id=$data['user_id'];
        $payment->type_id=$data['type_id'];
        $payment->pledge_id=$data['pledge_id'];
        $payment->amount=$data['amount'];
        $payment->created_by= Auth::user()->id;
        $payment->save();

        return redirect('admin/all-payments')->with('status','Payment was Registered Successfully');
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
             ]
            );

            Payment::create([
                "type_id" => $request->type_id,
                "user_id" => $request->user()->id,
                "amount" => $request->amount,
                "pledge_id"=>$request->pledge_id,
                "created_by"=> $request->user()->id
            ]);

          
            return response()->json(['status' => "success"]);
    }



}
