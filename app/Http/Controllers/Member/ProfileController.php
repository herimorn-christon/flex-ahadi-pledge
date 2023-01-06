<?php

namespace App\Http\Controllers\Member;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    // for index function
    public function index()
    {
     
        $user=Auth::user()->id;
        $profile=User::where('id',$user)->get();
        return view('member.profile.index',compact('profile'));
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
             'current_password' => 'required',
             'new_password' => 'required|confirmed'
              ]
             );
             $user=Auth::User()->id;
             $existing=Hash::make(Auth::User()->password);
             $current=  $request->user_id;
           
             if(!Hash::check($request->current_password, auth()->user()->password)){
                return back()->with("status", "Old Password Doesn't match!");
            }


            #Update the new Password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            return back()->with("status", "Password changed successfully!");
                
            }
 
}
