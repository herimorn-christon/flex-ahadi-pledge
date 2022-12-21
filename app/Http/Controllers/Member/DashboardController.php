<?php

namespace App\Http\Controllers\Member;

use App\Models\Pledge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {

        $user=Auth::user()->id;
        $pledges=Pledge::where('user_id',$user)->count();

        return view('member.dashboard',compact('pledges'));

    }
}
