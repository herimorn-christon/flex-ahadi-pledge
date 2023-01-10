<?php

namespace App\Http\Controllers\Admin;

use App\Models\Announcement;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::orderBy('updated_at','DESC')->get();
        return response()->json(['announcements' => $announcements]);
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
            'body' => 'required',
            'attachment' => 'required',
             ]
            );

            $announcement = new Announcement();
            $announcement->title=$request->title;
            $announcement->body=$request->body;
            $announcement->file="asavsd";
            $announcement->created_by= Auth::user()->id;
            $announcement->save();
            
            // start of user notification
            $notification = new Notification();
            $notification->user_id= 0;
            $notification->created_by= Auth::user()->id;
            $notification->type='Lengo Jipya La Ahadi';
            $name=$request->title;
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
