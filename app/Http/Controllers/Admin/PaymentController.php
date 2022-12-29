<?php

namespace App\Http\Controllers\Admin;
use App\Models\Payment;
use App\Models\PaymentType;
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

    public function destroy($payment_id)
    {
        $method=Payment::find($payment_id);

        if($method){
            $method->delete();
            return redirect('admin/all-payments')->with('status','Payment was deleted Successfully');
        }
        else{
            return redirect('admin/all-payments')->with('status','No Payment method ID was found !');
        }
    }

}
