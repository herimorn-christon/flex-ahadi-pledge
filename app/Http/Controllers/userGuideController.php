<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userGuideController extends Controller
{
    public function index(){
        return view("admin.members.membersUserGuide");
    }
    public function downloadLogic(){
        //handle something here
       // return "halooo";
       return response()->download(public_path("manual/userManual.pdf"));
    }
}
