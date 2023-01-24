<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pledge;
use App\Models\Payment;
use App\Models\Purpose;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $purposes = Purpose::orderBy('updated_at','DESC')
                                    ->get();
        $total_purposes=Purpose::count();
        $accomplished_purposes=Purpose::where('status','1')
                                        ->count();
        $inaccomplished_purposes=Purpose::where('status','')
                                         ->count();
        return response()->json([
            'purposes' => $purposes,
            'total_purposes'=>$total_purposes,
            'accomplished_purposes'=>$accomplished_purposes,
            'inaccomplished_purposes'=>$inaccomplished_purposes,
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
            'title' => 'required|max:255',
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
            $purpose->created_by= Auth::user()->id;
            $purpose->save();
            
            // start of user notification
            $notification = new Notification();
            $notification->user_id= 0;
            $notification->created_by= Auth::user()->id;
            $notification->type='Lengo Jipya La Ahadi';
            $name=$request->title;
            $description=$request->description;
            $notification->message='Habari, kuna lengo jipya limeongeza na linaitwa '.$name.', unakaribishwa kuweka ahadi yako kwenye lengo hili.';
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
        $purpose = Purpose::find($id);
        $pledges = Pledge::where('purpose_id',$id)->orderBy('updated_at','DESC')->with('user')->with('type')->with('purpose')->get();
        $payments = Payment::where('pledge_id',$id)->orderBy('updated_at','DESC')->with('payer')->with('payment')->get();
      
        return response()->json([
                                'purpose' => $purpose,
                                'pledges' => $pledges,
                                'payments' => $payments
                            ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Purpose::destroy($id);
        return response()->json(['status' => "success"]);
    }


      //edit purpose page 
        public function edit($id)
        {
            $purpose=Purpose::find($id);
            return view('admin.pledges.edit-purpose',compact('purpose'));
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
            'title' => 'required|max:255',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
  
        $purpose = Purpose::find($id);
        $purpose->title=$request->title;
        $purpose->description=$request->description;
        $purpose->start_date=$request->start_date;
        $purpose->end_date=$request->end_date;
        $purpose->created_by= Auth::user()->id;
        $purpose->save();

     
        return response()->json(['status' => "success"]);
    }


    public function search(Request $request)
    {
    	$members = [];

        if($request->has('q')){
            $search = $request->q;
            $purposes =Purpose::select("id", "title")
            		->where('title', 'LIKE', "%$search%")
            		->get();
        }else {
            $purposes =Purpose::all();
        }
        return response()->json($purposes);
    }

}
