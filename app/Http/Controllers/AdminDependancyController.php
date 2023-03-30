<?php

namespace App\Http\Controllers;

use App\Models\dependant;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDependancyController extends Controller
{
    public function index(){
     //lets takes and grap all the user with the all dependancy
     $users=User::paginate(5);
     return view("admin.dependacy.adminDependancy",compact('users'));
    }
    public function show($id){
         $users=dependant::where("users_id",$id)->get();
         return view("admin.dependacy.adminShow",compact('users'));
    }
}
