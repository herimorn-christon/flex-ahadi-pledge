<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class editUserProfile extends Controller
{
    //
    public function index($id){
        return view("member.profile.editUserProfile",compact('id'));
    }
    public function updateProfile(Request $request,$id){
        $fname=$request->username;
        $lname=$request->lname;
        $jumuiya=$request->jumuiya;
        $phone=$request->phone;
        //then updates
           $user=User::find($id);
         $user->fname=$request->fName;
         $user->lname=$request->lname;
         $user->jumuiya=$request->jumuiya;
         $user->phone=$request->phone;
         $user->save();
         return redirect("member/my-profile");
         
    }
}
