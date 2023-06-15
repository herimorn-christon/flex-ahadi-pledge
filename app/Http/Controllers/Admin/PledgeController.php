<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pledge;
use App\Models\Purpose;
use App\Models\PledgeType;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\pledgeFormRequest;
use App\Http\Requests\Admin\pledgesFormRequest;
use App\Models\Reminder;

class PledgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $new_user=Auth::user()->church_id;
        $pledges = Pledge::orderBy('updated_at','DESC')
        ->where('church_id',$new_user)
        ->where('type_id',9)
        ->with('user')->with('type')->with('purpose')->get();
        $pledges_object = Pledge::orderBy('updated_at','DESC')->
        where('church_id',$new_user)->
        where('type_id',1)
        ->with('user')->with('type')->with('purpose')->get();
        $total_pledges=Pledge::where('church_id',$new_user)->count();
        $unfullfilled=Pledge::where('status','')
                              ->where('church_id',$new_user)
                              ->count();
        $total_amount=Pledge::where('church_id',$new_user)->sum('amount');
        $object=Pledge::where('type_id','1')
                        ->where('church_id',$new_user)
                        ->count();
        $fullfilled=Pledge::where('status','1')
                            ->where('church_id',$new_user)
                            ->count();
        $best=Pledge::where('church_id',$new_user)->max('amount');
       

        //if the payments is received for a pledge 
        return response()->json([
                                'pledges' => $pledges,
                                'total_pledges'=>$total_pledges,
                                'unfullfilled'=>$unfullfilled,
                                'fullfilled'=>$fullfilled,
                                 'pledgesObject'=>$pledges_object,
                                'total_amount'=>$total_amount,
                                'object'=>$object,
                                'best'=>$best    
                            ]);
    }


    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //  dd($request->all());
    $new_user=Auth::user()->church_id;
      
        request()->validate(
            [
            'names' => 'required|max:255',
            'descriptions' => 'required',
            'deadlines' => 'required',
            'user_ids' => 'required',
            'type_ids' => 'required',
            'purpose_ids' => 'required',
             ]
            );
       

            $pledge = new Pledge();
            $pledge->name = $request->names;
            $pledge->description = $request->descriptions;
            $pledge->amount = $request->amounts;
            $pledge->deadline=$request->deadlines;
            $pledge->type_id=$request->type_ids;
            $pledge->purpose_id=$request->purpose_ids;
            $pledge->user_id=$request->user_ids;
            $pledge->object_name=$request->object_names;
            $pledge->object_quantity=$request->object_quantitys;
            $pledge->object_cost=$request->object_costs*$request->object_quantitys;
            // $pledge->status= $request->statuss == true ? '1':'0';
            $pledge->church_id=$new_user;
            $pledge->created_by= Auth::user()->id;
            $pledge->save();
            // saving user notification
            $notification = new Notification();
            $notification->user_id= $request->user_ids;
            $notification->created_by= Auth::user()->id;
            $notification->type='Member Pledge';
            $name=$request->name;
            $notification->message='Hello,You have made a new pledge tited '.$name.'.';
            $notification->save();
            
            $notification=array(
                'message'=>' pledge registered successfully',
                'alert-type'=>'success'
             );
              return redirect()->back()->with($notification);
    }

    
        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pledge = Pledge::with('user')->with('type')->with('purpose')->find($id);
        $pledgeObjects = Pledge::with('user')
        ->where("type_id",1)
        ->with('type')->with('purpose')->find($id);
        return response()->json(['pledge' => $pledge,
    'pledgeObjects'=>$pledgeObjects]);
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required|max:255',
            // 'amount' => 'required',
            'description' => 'required',
            'deadline' => 'required',
            'user_id' => 'required',
            'type_id' => 'required',
            'purpose_id' => 'required'
        ]);
  
        $pledge = Pledge::find($id);
        $pledge->name = $request->name;
        $pledge->description = $request->description;
        $pledge->amount = $request->amount;
        $pledge->deadline=$request->deadline;
        $pledge->purpose_id=$request->purpose_id;
        $pledge->type_id=$request->type_id;
        $pledge->status= $request->status == true ? '1':'0';
        $pledge->user_id=$request->user_id;
        $pledge->object_name=$request->object_name;
        $pledge->object_quantity=$request->object_quantity;
        $pledge->object_cost=$request->object_quantity*$request->object_cost;
        $pledge->created_by= Auth::user()->id;
        $pledge->save();
        return response()->json(['status' => "success"]);
    }
   
    public function search(Request $request)
    {
    	$pledges = [];

        if($request->has('q')){
            $search = $request->q;
            $pledges =Pledge::select("id", "name")
            		->where('name', 'LIKE', "%$search%")
                    ->with('user')
                    ->where('status','')
            		->get();
        }else {
            $pledges =Pledge::where('status','')->with('user')->get();
        }
        return response()->json($pledges);
    }

  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pledge::destroy($id);
        return response()->json(['status' => "success"]);
    }


     /**
     * Display a listing of the resource by user.
     *
     * @return \Illuminate\Http\Response
     */
    public function users(Request $request)
    {
        $pledges = Pledge::orderBy('updated_at','DESC')->with('user')->with('type')->with('purpose')->where('user_id', $request->user()->id)->get();
        return response()->json(['pledges' => $pledges]);
    }


    public function apistore(Request $request){

        Pledge::create([
        "name" => $request['name'],
        "amount" => $request['amount'],
        "description" => $request['description'],
        "deadline" => $request['deadline'],
        "type_id" => $request['type_id'],
        "purpose_id" => $request['purpose_id'],
        "user_id" => $request->user()->id,
        "created_by" => $request->user()->id
        ]);

        return  response()->json(['success' => true]);

    }

    public function reminder(Request $request){

        $validated = $request->validate([
            "pledge_id" => 'required',
            "date" => 'required',
            ]);

        Reminder::create($validated);

        return  response()->json(['success' => true]);

    }

    //handling the getting the plede logic using simply the ajax call
    
}

