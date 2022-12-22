<?php

namespace App\Http\Controllers\Member;

use App\Models\Pledge;
use App\Models\Payment;
use App\Models\Purpose;
use App\Models\PledgeType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Member\pledgesFormRequest;

class PledgeController extends Controller
{
    // for index function
    public function index()
    {
        $types=PledgeType::all();
        $user=Auth::user()->id;
        $types=PledgeType::all();
        $purposes=Purpose::all();
        $pledges=Pledge::where('user_id',$user)->get();
        return view('member.pledges.index',compact('types','pledges','purposes'));
    }

        // saving pledge  function
        public function save(pledgesFormRequest $request)
        {
            $data=$request->validated();
            $pledge =new Pledge;
            $pledge->name=$data['name'];
            $pledge->amount=$data['amount'];
            $pledge->description=$data['description'];
            $pledge->deadline=$data['deadline'];
            $pledge->type_id=$data['type_id'];
            $pledge->purpose_id=$data['purpose_id'];
            $pledge->user_id=Auth::user()->id;
            $pledge->status= $request->status == true ? '1':'0';
            $pledge->created_by= Auth::user()->id;
            $pledge->save();
    
            return redirect('member/my-pledges')->with('status','Pledge was Added Successfully');
        }
}
