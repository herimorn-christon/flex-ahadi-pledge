<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Jumuiya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\jumuiyaFormRequest;

class JumuiyaController extends Controller
{

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communities = Jumuiya::orderBy('updated_at','DESC')
                                ->get();
        $total_communities=Jumuiya::count();

        $largest_community = User::select('id', 'jumuiya', DB::raw('MIN(total_member) as large_community'))
        ->where('role','member')
        ->groupBy('jumuiya')
        ->with('community')
        ->count();
        // $largest_community=89900;
        return response()
                ->json([
                    'communities' => $communities,
                    'total_communities'=>$total_communities,
                    'largest_community'=>$largest_community
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
            'abbreviation' => 'required',
            'location' => 'required',
             ]
            );

            $communities = new Jumuiya();
            $communities->name = $request->name;
            $communities->abbreviation = $request->abbreviation;
            $communities->location = $request->location;
            $communities->save();
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
        $community = Jumuiya::find($id);
        $members = User::where('jumuiya',$id)->where('role','member')->get();
        return response()->json(['community' => $community,'members' => $members]);
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
            'location' => 'required',
            'abbreviation' => 'required',
        ]);
  
        $community = Jumuiya::find($id);
        $community->name = $request->name;
        $community->abbreviation = $request->abbreviation;
        $community->location = $request->location;
        $community->save();

        return response()->json(['status' => "success"]);
    }

    // show single community details
    public function view($id)

    {

        $community = Jumuiya::where('id',$id)->get();
        $members = User::where('jumuiya',$id)->where('role','member')->with('community')->get();
  

        return view('admin.jumuiya.detail',compact('community','members'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jumuiya::destroy($id);
        return response()->json(['status' => "success"]);
    }


    
    public function search(Request $request)
    {
    	$jumuiyas = [];

        if($request->has('q')){
            $search = $request->q;
            $jumuiyas =Jumuiya::select("id", "name")
            		->where('name', 'LIKE', "%$search%")
            		->get();
        }else {
            $jumuiyas =Jumuiya::all();
        }
        return response()->json($jumuiyas);
    }
}
