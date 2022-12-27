<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Pledge;
use App\Models\Jumuiya;
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
    // public function index()
    // {
    //     $users=User::where('role','member')->get();
    //     return view('admin.members.index',compact('users'));
    // }


        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = User::where('role','member')->get();
        return response()->json(['projects' => $projects]);
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
                'fname' =>'required|string|max:255',
                'fname' => 'required|string|max:255',
                'mname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'phone' =>'required|string|max:255',
                'jumuiya' => 'required',
                'date_of_birth' =>'required',
                'gender' => 'required',
                'email' => 'string|max:255',
                'password' =>'required|string|min:8',
             ]
            );

            $project = new User();
            // $project->name = $request->name;
            // $project->description = $request->description;
            // $project->save();
            $project->fname=$request->fname;
            $project->mname=$request->mname;
            $project->lname=$request->lname;
            $project->email=$request->email;
            $project->phone=$request->phone;
            $project->gender=$request->gender;
            $project->date_of_birth=$request->date_of_birth;
            $project->jumuiya=$request->jumuiya;
            $project->password= Hash::make($request->password);
            $project->save();
            return response()->json(['status' => "success"]);
    }


    //view single member
    // public function show($id)

    // {

    //     $user = User::where('id',$id)->get();
    //     $payments = Payment::where('user_id',$id)->get();
    //     $pledges= Pledge::where('user_id',$id)->get();
    //     $cards=CardMember::where('user_id',$id)->get();

  
    //     return view('admin.members.profile',compact('user','payments','pledges','cards'));

    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = User::find($id);
        return response()->json(['project' => $project]);
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

    // public function create(memberFormRequest $request)
    // {
    //     $data=$request->validated();
    //     $user =new User;
    //     $user->fname=$data['fname'];
    //     $user->mname=$data['mname'];
    //     $user->lname=$data['lname'];
    //     $user->email=$data['email'];
    //     $user->phone=$data['phone'];
    //     $user->gender=$data['gender'];
    //     $user->date_of_birth=$data['date_of_birth'];
    //     $user->jumuiya=$data['jumuiya'];
    //     $user->password= Hash::make($data['password']);
    //     $user->save();

    //     return redirect('admin/all-members')->with('status','Member was Registered Successfully');
    // }

        // delete Member function
        // public function destroy($id)
        // {
        //     $user=User::find($id);

        //     if($user){
        //         $user->delete();
        //         return redirect('admin/all-members')->with('status','Member was deleted Successfully');
        //     }
        //     else{
        //         return redirect('admin/all-members')->with('status','No Member ID was found !');
        //     }
        // }

            /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['status' => "success"]);
    }
}
