<?php

namespace App\Http\Controllers\Admin;

use App\Models\Announcement;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use illuminate\Support\Str;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $new_user=Auth::user()->church_id;
        $announcements = Announcement::where('church_id',$new_user)->orderBy('updated_at','DESC')->get();
        $total_announcements=Announcement::where('church_id',$new_user)->count();
        return response()->json(['announcements' => $announcements,'total_announcements'=>$total_announcements]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        //dd($new_user);
        $new_user = Auth::user()->church_id;
        request()->validate(
            [
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable',
             ]
            );

            $announcement = new Announcement();
            $announcement->title=$request->title;
            $announcement->body=$request->body;
            $announcement->church_id=$new_user;
            if($request->hasfile('image')){
                $file=$request->file('image');
                $filename=time().'.'.$file->getClientOriginalExtension();
                $file->move('uploads/announcement/', $filename);
                $announcement->attachment=$filename;
            }
            
            $announcement->save();
            
            // start of user notification
            $notification = new Notification();
            $notification->user_id= 0;
            $notification->created_by= Auth::user()->id;
            $notification->type='Lengo Jipya La Ahadi';
            $name=$request->title;
            $notification->message='Habari, kuna Tangazo jipya limetolewa kuhusu '.$name.', tafadhari lipitie.';
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
        $announcement = Announcement::find($id);
        return response()->json(['announcement' => $announcement]);
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
            'body' => 'required',
            'image' => 'nullable',
        ]);
  
        $announcement =Announcement::find($id);
        $announcement->title=$request->title;
        $announcement->body=$request->body;
        
        if($request->hasfile('image')){
            $destination= 'uploads/announcements/'.$announcement->attachment;
          if(File::exists($destination)){
              File::delete($destination);
          }
           $file=$request->file('image');
           $filename=time().'.'.$file->getClientOriginalExtension();
           $file->move('uploads/announcements/', $filename);
           $announcement->attachment=$filename;
       }
        
        $announcement->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Announcement::destroy($id);
        return response()->json(['status' => "success"]);
    }
}
