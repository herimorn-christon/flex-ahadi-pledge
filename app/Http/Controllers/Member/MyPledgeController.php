<?php

namespace App\Http\Controllers\Member;

use App\Models\Pledge;
use App\Models\Purpose;
use App\Models\PledgeType;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyPledgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types=PledgeType::all();
        $user=Auth::user()->id;
        $types=PledgeType::all();
        $purposes=Purpose::all();
        // $pledges=Pledge::where('user_id',$user)->get();
        $pledges = Pledge::where('user_id',$user)->orderBy('updated_at','DESC')->with('user')->with('type')->with('purpose')->get();
        return response()->json(['purposes' => $purposes,'pledges' => $pledges]);
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
            $pledge->user_id=Auth::user()->id;
            $pledge->status='0';
            $pledge->created_by= Auth::user()->id;
            $pledge->save();

            // saving user notification
            $notification = new Notification();
            $notification->user_id=Auth::user()->id;
            $notification->created_by= Auth::user()->id;
            $notification->type='Ahadi mpya !';
            $name=$request->name;
            $date=$request->deadline;
            $notification->message='Habari,Umefanikiwa ahadi mpya inayoitwa '.$name.'. Ahadi hii inatakiwa kutimizwa mpaka tarehe'.$date.'.';
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
