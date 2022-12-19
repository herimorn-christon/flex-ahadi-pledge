<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PaymentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\paymentFormRequest;

class PaymentController extends Controller
{

    // for index function
    public function index()
    {
        $types=PaymentType::all();
        return view('admin.payments.index',compact('types'));
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
}
