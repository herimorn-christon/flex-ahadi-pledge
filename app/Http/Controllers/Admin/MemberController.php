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


    // search community 
     public function autocomplete(Request $request)
    {        
        $data = Jumuiya::select("name")
                ->where("name","LIKE","%{$request->str}%")
                ->get('query');   
        return response()->json($data);
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
            $member->fname=$request->fname;
            $member->mname=$request->mname;
            $member->lname=$request->lname;
            $member->email=$request->email;
            $member->phone=$request->phone;
            $member->gender=$request->gender;
            $member->date_of_birth=$request->date_of_birth;
            $member->jumuiya=$request->jumuiya;
            $member->status= $request->status == true ? '1':'0';
            $member->password= Hash::make($request->password);
            $member->save();
            return response()->json(['status' => "success"]);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = User::with('community')->find($id);
        $payments = Payment::where('user_id',$id)->with('payment')->with('pledge')->get();
        $pledges= Pledge::where('user_id',$id)->with('type')->with('purpose')->get();
        $cards=CardMember::where('user_id',$id)->with('user')->with('card')->get();
        return response()->json(['member' => $member,'payments' =>$payments,'pledges'=>$pledges,'cards'=>$cards]);
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
