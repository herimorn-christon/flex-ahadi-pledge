<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\paymentFormRequest;

class PaymentController extends Controller
{

    // for index function
    public function index()
    {
        $types=PaymentMethod::all();
        return view('admin.payments.index',compact('types'));
    }
    // saving payment method function
    public function saveMethod(paymentFormRequest $request)
    {
        $data=$request->validated();
        $type =new PaymentMethod;
        $type->title=$data['name'];
        $type->save();

        return redirect('admin/all-payments')->with('status','Payment Method was Added Successfully');
    }
}
