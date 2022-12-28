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

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = User::where('role','member')->orderBy('updated_at','DESC')->with('community')->get();
        return response()->json(['members' => $members]);
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
                'fname' => 'required|max:255',
                'mname' => 'required|max:255',
                'lname' => 'required|max:255',
                'email' => 'required',
                'phone' => 'required',
                'date_of_birth' => 'required',
                'password' => 'required',
                'gender' => 'required',
                'jumuiya' => 'required',
                
             ]
            );

            $member = new User();
            // $project->name = $request->name;
            // $project->description = $request->description;
            // $project->save();
            $member->fname=$request->fname;
            $member->mname=$request->mname;
            $member->lname=$request->lname;
            $member->email=$request->email;
            $member->phone=$request->phone;
            $member->gender=$request->gender;
            $member->date_of_birth=$request->date_of_birth;
            $member->jumuiya=$request->jumuiya;
            $member->password= Hash::make($request->password);
            $member->save();
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
        $member = User::with('community')->find($id);
        return response()->json(['member' => $member]);
    }

    // edit details function
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.members.edit',compact('user'));
    }

    
    // update
    // public function update(updateMemberFormRequest $request,$id)
    // {
    //     $data=$request->validated();
    //     $user =User::find($id);
    //     $user->fname=$data['fname'];
    //     $user->mname=$data['mname'];
    //     $user->lname=$data['lname'];
    //     $user->email=$data['email'];
    //     $user->phone=$data['phone'];
    //     $user->gender=$data['gender'];
    //     $user->date_of_birth=$data['date_of_birth'];
    //     $user->jumuiya=$data['jumuiya'];
    //     $user->status= $request->status == true ? '1':'0';
        
    //     $user->save();
       
    //     return redirect('admin/all-members')->with('status','Member was Updated Successfully');
      
    // }

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
            'status' => 'boolean',
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
        $member->status= $request->status == true ? '1':'0';
        $member->save();
        return response()->json(['status' => "success"]);
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
