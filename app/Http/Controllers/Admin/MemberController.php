<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    // for index function
    public function index()
    {
        $users=User::all()->where('role','member');
        return view('admin.members.index',compact('users'));
    }

    //view single member
    public function show($id)

    {

        $user = User::find($id);

  

        return response()->json($user);

    }

    // edit details function
    public function edit($id)
    {
        $product = User::find($id);
        return response()->json($product);
    }
    // update
    public function update($id)
    {
        $userData = User::find($id);
        $userData->status = request('status');
        $userData->fname = request('fname');
        $userData->mname = request('mname');
        $userData->lname = request('lname');
        $userData->date_of_birth = request('date_of_birth');
        $userData->gender = request('gender');    
        $userData->jumuiya = request('jumuiya');
        $userData->email = request('email');
        $userData->phone = request('phone');
        
        $userData->save();
       
        return json_encode(array('statusCode'=>200));
      
    }
}
