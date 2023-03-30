<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class addAnnouncementController extends Controller
{
    //impliment logic on the add anouncement
    public function addAnouncement(Request $request){
         $anouncement=new Announcement();
         $anouncement->title=$request->title;
         $anouncement->body=$request->body;
         $anouncement->attachment=$request->attachment;
         $anouncement->save();
         return redirect()->back();
    }
}
