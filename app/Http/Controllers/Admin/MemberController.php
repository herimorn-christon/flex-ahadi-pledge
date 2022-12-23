<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Pledge;
use App\Models\Payment;
use App\Models\CardMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\memberFormRequest;

class MemberController extends Controller
{
    // for index function
    public function index()
    {
        $users=User::where('role','member')->get();
        return view('admin.members.index',compact('users'));
    }

    //view single member
    public function show($id)

    {

        $user = User::where('id',$id)->get();
        $payments = Payment::where('user_id',$id)->get();
        $pledges= Pledge::where('user_id',$id)->get();
        $cards=CardMember::where('user_id',$id)->get();

  
        return view('admin.members.profile',compact('user','payments','pledges','cards'));

    }

    // edit details function
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.members.edit',compact('user'));
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

    public function create(memberFormRequest $request)
    {
        $data=$request->validated();
        $user =new User;
        $user->fname=$data['fname'];
        $user->mname=$data['mname'];
        $user->lname=$data['lname'];
        $user->email=$data['email'];
        $user->phone=$data['phone'];
        $user->gender=$data['gender'];
        $user->date_of_birth=$data['date_of_birth'];
        $user->jumuiya=$data['jumuiya'];
        $user->password= Hash::make($data['password']);
        $user->save();

        return redirect('admin/all-members')->with('status','Member was Registered Successfully');
    }

        // delete Member function
        public function destroy($id)
        {
            $user=User::find($id);

            if($user){
                $user->delete();
                return redirect('admin/all-members')->with('status','Member was deleted Successfully');
            }
            else{
                return redirect('admin/all-members')->with('status','No Member ID was found !');
            }
        }
}
