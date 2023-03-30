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
use App\Models\dependant;

class MemberController extends Controller
{

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // fetching all members query
        $members = User::where('role','member')
                        ->orderBy('updated_at','DESC')
                        ->with('community')
                        ->get();
        // fetching total members query
        $total_members=User::where('role','member')
                            ->count();
        // fetching total active members
        $active_members=User::where('role','member')
                            ->where('status','')
                            ->count();
        // fetching total inactive members
        $inactive_members=User::where('role','member')
                                ->where('status','1')
                                ->count();
        $male_members=User::where('role','member')
                            ->where('gender','male')
                            ->count();
        $female_members=User::where('role','member')
                             ->where('gender','female')
                             ->count();

        return response()->json(
            [
                'members' => $members,
                'total_members'=>$total_members,
                'active_members'=>$active_members,
                'inactive_members'=>$inactive_members,
                'male_members'=>$male_members,
                'female_members'=>$female_members
            ]);
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
        $pledges= Pledge::where('user_id',$id)
                        ->with('type')
                        ->with('purpose')
                        ->get();
        $cards=CardMember::where('user_id',$id)->with('user')->with('card')->get();
        $dependants=dependant::where('users_id',$id)->get();
        //dd($dependants);
        //return $id;
        return response()->json(['member' => $member,'payments' =>$payments,'pledges'=>$pledges,'cards'=>$cards,
       'dependants'=>$dependants]);
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


    public function search(Request $request)
    {
    	$members = [];

        if($request->has('q')){
            $search = $request->q;
            $members =User::select("id", "fname", "mname", "lname")
            		->where('fname', 'LIKE', "%$search%")
                    ->orwhere('mname', 'LIKE', "%$search%")
                    ->orwhere('lname', 'LIKE', "%$search%")
                    ->where('role','member')
            		->get();
        }else {
            $members =User::all()->where('role','member');
        }
        return response()->json($members);
    }
    public function storeValue(Request $request){
      $id=$request->update_id;
        //return $id;
       $user=User::find($id);
       $user->marriage_date=$request->mdate;
          $user->deacon_name=$request->dname;
          $user->deacon_phone=$request->dphone;
          $user->baptization_date=$request->bdate;
          $user->kipaimara_date=$request->cdate;
          $user->fellowship_name=$request->fename;
          $user->partner_name=$request->pname;
          $user->proffession=$request->proffesion;
          $user->save();
          return response()->json([
            'success'=>'spiritualservices are updated'

        ],201);

    }
   
}
