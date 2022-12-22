<?php

namespace App\Http\Controllers\Member;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    // for index function
    public function index()
    {
     
        $user=Auth::user()->id;
        $profile=User::where('id',$user)->get();
        return view('member.profile.index',compact('profile'));
    }
}
