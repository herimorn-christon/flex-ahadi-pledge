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
use App\Http\Requests\Admin\updateMemberFormRequest;

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
    public function update(updateMemberFormRequest $request,$id)
    {
        $data=$request->validated();
        $user =User::find($id);
        $user->fname=$data['fname'];
        $user->mname=$data['mname'];
        $user->lname=$data['lname'];
        $user->email=$data['email'];
        $user->phone=$data['phone'];
        $user->gender=$data['gender'];
        $user->date_of_birth=$data['date_of_birth'];
        $user->jumuiya=$data['jumuiya'];
        $user->status= $request->status == true ? '1':'0';
        
        $user->save();
       
        return redirect('admin/all-members')->with('status','Member was Updated Successfully');
      
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
