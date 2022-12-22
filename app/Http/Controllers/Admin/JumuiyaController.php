<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Jumuiya;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\jumuiyaFormRequest;

class JumuiyaController extends Controller
{
    // for index function
    public function index()
    {
        $communities=Jumuiya::all();
        return view('admin.jumuiya.index',compact('communities'));
    }

    // saving function
    public function save(jumuiyaFormRequest $request)
    {
        $data=$request->validated();
        $jumuiya =new Jumuiya;
        $jumuiya->name=$data['name'];
        $jumuiya->location=$data['location'];
        $jumuiya->abbreviation=$data['abbreviation'];
        $jumuiya->save();

        return redirect('admin/all-communities')->with('status','Community Added Successfully');
    }


    // edit page function
    public function edit($jumuiya_id)
    {
        $community=Jumuiya::find($jumuiya_id);
        return view('admin.jumuiya.edit',compact('community'));
    }
    // update Community function
    public function update(jumuiyaFormRequest $request,$jumuiya_id)
    {
        $data=$request->validated();
        $jumuiya =Jumuiya::find($jumuiya_id);
        $jumuiya->name=$data['name'];
        $jumuiya->location=$data['location'];
        $jumuiya->abbreviation=$data['abbreviation'];
        // saving data
        $jumuiya->update();

        return redirect('admin/all-communities')->with('status','Community is Updated Successfully');
    }


    // show single community details
    public function show($id)

    {

        $community = Jumuiya::where('id',$id)->get();
        $members = User::where('jumuiya',$id)->where('role','member')->get();
  

        return view('admin.jumuiya.detail',compact('community','members'));
    }
        // delete Community function
        public function destroy($jumuiya_id)
        {
            $jumuiya=Jumuiya::find($jumuiya_id);

            if($jumuiya){
                $jumuiya->delete();
                return redirect('admin/all-communities')->with('status','Community was deleted Successfully');
            }
            else{
                return redirect('admin/all-communities')->with('status','No Community ID was found !');
            }
        }
}
