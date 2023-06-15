<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class addAnnouncementController extends Controller
{

    //impliment logic on the add anouncement
    public function addAnouncement(Request $request){
        $new_user=Auth::user()->church_id;
       // dd($new_user);
         $anouncement=new Announcement();
         $anouncement->title=$request->title;
         $anouncement->body=$request->body;
         $anouncement->attachment=$request->attachment;
         $anouncement->church_id=$new_user;
         $anouncement->save();
         return redirect()->back();
    }
}
