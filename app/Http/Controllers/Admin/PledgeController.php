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
        $pledges = Pledge::orderBy('updated_at','DESC')->with('user')->with('type')->with('purpose')->get();
        $total_pledges=Pledge::count();
        $unfullfilled=Pledge::where('status','')
                              ->count();
        $total_amount=Pledge::sum('amount');
        $object=Pledge::where('type_id','1')
                        ->count();
        $fullfilled=Pledge::where('status','1')
                            ->count();
        $best=Pledge::max('amount');
        return response()->json([
                                'pledges' => $pledges,
                                'total_pledges'=>$total_pledges,
                                'unfullfilled'=>$unfullfilled,
                                'fullfilled'=>$fullfilled,
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
        request()->validate(
            [
            'name' => 'required|max:255',
            'amount' => 'required',
            'description' => 'required',
            'deadline' => 'required',
            'user_id' => 'required',
            'type_id' => 'required',
            'purpose_id' => 'required',
             ]
            );

            $pledge = new Pledge();
            $pledge->name = $request->name;
            $pledge->description = $request->description;
            $pledge->amount = $request->amount;
            $pledge->deadline=$request->deadline;
            $pledge->type_id=$request->type_id;
            $pledge->purpose_id=$request->purpose_id;
            $pledge->user_id=$request->user_id;
            $pledge->status= $request->status == true ? '1':'0';
            $pledge->created_by= Auth::user()->id;
            $pledge->save();

            // saving user notification
            $notification = new Notification();
            $notification->user_id= $request->user_id;
            $notification->created_by= Auth::user()->id;
            $notification->type='Member Pledge';
            $name=$request->name;
            $notification->message='Hello,You have made a new pledge tited '.$name.'.';
            $notification->save();
            
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
        $pledge = Pledge::with('user')->with('type')->with('purpose')->find($id);
        return response()->json(['pledge' => $pledge]);
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
            'amount' => 'required',
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
        $pledge->created_by= Auth::user()->id;
        $pledge->save();
        return response()->json(['status' => "success"]);
    }

    // saving pledge type function
    public function saveType(pledgeFormRequest $request)
    {
        $data=$request->validated();
        $type =new PledgeType;
        $type->title=$data['title'];
        $type->save();

        return redirect('admin/all-pledges')->with('status','Pledge Type was Added Successfully');
    }

    // edit pledge type page function
    public function editType($jumuiya_id)
    {
        $type=PledgeType::find($jumuiya_id);
        return view('admin.pledges.edit',compact('type'));
    }

    // update pledge type function
    public function updateType(pledgeFormRequest $request,$type_id)
    {
        $data=$request->validated();
        $type =PledgeType::find($type_id);
        $type->title=$data['title'];
        // saving data
        $type->update();

        return redirect('admin/all-pledges')->with('status','Pledge type was Updated Successfully');
    }
// delete  pledge type function
public function destroyType($type)
{
    $jumuiya=PledgeType::find($type);

    if($type){
        $jumuiya->delete();
        return redirect('admin/all-pledges')->with('status','Pledge type was deleted Successfully');
    }
    else{
        return redirect('admin/all-pledges')->with('status','No Community ID was found !');
    }
}

  
     // edit pledge page function
        public function edit($pledge_id)
        {
            $types=PledgeType::all();
            $pledge=Pledge::find($pledge_id);
            return view('admin.pledges.edit-pledge',compact('pledge','types'));
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
}
