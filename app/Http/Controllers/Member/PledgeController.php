<?php

namespace App\Http\Controllers\Member;

use App\Models\Pledge;
use App\Models\Payment;
use App\Models\Purpose;
use App\Models\PledgeType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
}
