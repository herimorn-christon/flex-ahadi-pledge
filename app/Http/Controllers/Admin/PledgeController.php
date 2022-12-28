<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pledge;
use App\Models\Purpose;
use App\Models\PledgeType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\pledgeFormRequest;
use App\Http\Requests\Admin\pledgesFormRequest;

class PledgeController extends Controller
{
            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purposes = Pledge::orderBy('updated_at','DESC')->with('user')->with('type')->with('purpose')->get();
        return response()->json(['purposes' => $purposes]);
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

    // saving pledge  function
    public function save(pledgesFormRequest $request)
    {
        $data=$request->validated();
        $pledge =new Pledge;
        $pledge->name=$data['name'];
        $pledge->amount=$data['amount'];
        $pledge->description=$data['description'];
        $pledge->deadline=$data['deadline'];
        $pledge->type_id=$data['type_id'];
        $pledge->purpose_id=$data['purpose_id'];
        $pledge->user_id=$data['user_id'];
        $pledge->status= $request->status == true ? '1':'0';
        $pledge->created_by= Auth::user()->id;
        $pledge->save();

        return redirect('admin/all-pledges')->with('status','Pledge was Added Successfully');
    }

     // edit pledge page function
        public function edit($pledge_id)
        {
            $types=PledgeType::all();
            $pledge=Pledge::find($pledge_id);
            return view('admin.pledges.edit-pledge',compact('pledge','types'));
        }
    // update pledge function
    public function update(pledgesFormRequest $request,$type_id)
    {
        $data=$request->validated();
        $pledge =Pledge::find($type_id);
        $pledge->name=$data['name'];
        $pledge->amount=$data['amount'];
        $pledge->description=$data['description'];
        $pledge->deadline=$data['deadline'];
        $pledge->type_id=$data['type_id'];
        $pledge->status= $request->status == true ? '1':'0';
        $pledge->created_by= Auth::user()->id;
        // saving data
        $pledge->update();

        return redirect('admin/all-pledges')->with('status','Pledge was Updated Successfully');
    }


    // delete  pledge  function
    public function destroy($id)
    {
        $pledge=Pledge::find($id);

        if($pledge){
            $pledge->delete();
            return redirect('admin/all-pledges')->with('status','Pledge was deleted Successfully');
        }
        else{
            return redirect('admin/all-pledges')->with('status','No Pledge ID was found !');
        }
    }
}
