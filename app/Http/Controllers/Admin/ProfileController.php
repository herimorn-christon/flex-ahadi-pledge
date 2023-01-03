<?php

namespace App\Http\Controllers\Admin;

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
        $member=User::where('id',$user)->with('community')->get();
        // return view('admin.profile.index',compact('profile'));
        return response()->json(['member' => $member]);
    }


      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $user=Auth::user()->id;
        $member = User::where('id',$user)->get();
        return response()->json(['member' => $member]);
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'fname' => 'required|max:255',
            'mname' => 'required|max:255',
            'lname' => 'required|max:255',
            'email' => 'required',
            'phone' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'jumuiya' => 'required',
        ]);
  
        $member = User::find($id);
        $member->fname=$request->fname;
        $member->mname=$request->mname;
        $member->lname=$request->lname;
        $member->email=$request->email;
        $member->phone=$request->phone;
        $member->gender=$request->gender;
        $member->date_of_birth=$request->date_of_birth;
        $member->jumuiya=$request->jumuiya;
        $member->save();
        return response()->json(['status' => "success"]);
    }

}
