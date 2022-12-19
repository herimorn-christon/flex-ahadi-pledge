<?php

namespace App\Http\Controllers\Admin;

use App\Models\PledgeType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\pledgeFormRequest;

class PledgeController extends Controller
{
    // for index function
    public function index()
    {
        $types=PledgeType::all();
        return view('admin.pledges.index',compact('types'));
    }


    // saving pldege type function
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

    // update Community function
    public function updateType(pledgeFormRequest $request,$type_id)
    {
        $data=$request->validated();
        $type =PledgeType::find($type_id);
        $type->title=$data['title'];
        // saving data
        $type->update();

        return redirect('admin/all-pledges')->with('status','Pledge type was Updated Successfully');
    }

}
