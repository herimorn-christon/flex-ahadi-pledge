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
    // for index function
    public function index()
    {
        $types=PledgeType::all();
        $pledges=Pledge::all();
        $purposes=Purpose::all();
        return view('admin.pledges.index',compact('types','pledges','purposes'));
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
}
