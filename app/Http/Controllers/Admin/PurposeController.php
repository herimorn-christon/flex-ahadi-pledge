<?php

namespace App\Http\Controllers\Admin;

use App\Models\Purpose;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\purposesFormRequest;

class PurposeController extends Controller
{

            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purposes = Purpose::orderBy('updated_at','DESC')->get();
        return response()->json(['purposes' => $purposes]);
    }
    // saving purpose  function
    public function save(purposesFormRequest $request)
    {
        $data=$request->validated();
        $purpose =new Purpose;
        $purpose->title=$data['title'];
        $purpose->description=$data['description'];
        $purpose->start_date=$data['start_date'];
        $purpose->end_date=$data['end_date'];
        $purpose->status= $request->status == true ? '1':'0';
        $purpose->created_by= Auth::user()->id;
        $purpose->save();

        return redirect('admin/all-pledges')->with('status','Purpose was Added Successfully');
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
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
             ]
            );

            $purpose = new Purpose();
            $purpose->title=$request->title;
            $purpose->description=$request->description;
            $purpose->start_date=$request->start_date;
            $purpose->end_date=$request->end_date;
            $purpose->status= $request->status == true ? '1':'0';
            $purpose->created_by= Auth::user()->id;
            $purpose->save();

            return response()->json(['status' => "success"]);
    }
        // delete  purpose  function
        public function destroy($id)
        {
            $purpose=Purpose::find($id);
    
            if($purpose){
                $purpose->delete();
                return redirect('admin/all-pledges')->with('status','Purpose was deleted Successfully');
            }
            else{
                return redirect('admin/all-pledges')->with('status','No Purpose ID was found !');
            }
        }


      //edit purpose page 
        public function edit($id)
        {
            $purpose=Purpose::find($id);
            return view('admin.pledges.edit-purpose',compact('purpose'));
        }

            // saving purpose  function
        public function update(purposesFormRequest $request,$id)
        {
            $data=$request->validated();
            $purpose =Purpose::find($id);
            $purpose->title=$data['title'];
            $purpose->description=$data['description'];
            $purpose->start_date=$data['start_date'];
            $purpose->end_date=$data['end_date'];
            $purpose->status= $request->status == true ? '1':'0';
            $purpose->created_by= Auth::user()->id;
            $purpose->save();

            return redirect('admin/all-pledges')->with('status','Purpose was Updated Successfully');
        }

}
