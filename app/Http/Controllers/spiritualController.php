<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class spiritualController extends Controller
{
    //
    public function index(){

        return view("admin.members.spiritual");
    }
    public function update(Request $request,$id){
        $request->validate([
            'baptism'=>['required'],
            'confirmation'=>['required'],
            'table_christ'=>['required'],
            'volontier'=>['required'],
        ]);
         $users=User::find($id);
           $users->can_volunteer=$request->volontier;
           $users->baptized=$request->baptism;
           $users->kipaimara_date=$request->confirmation;
           $users->kipaimara_date=$request->kipaimara_date;
           $users->sacramenti_meza_bwana=$request->table_christ;
           $users->baptization_date=$request->baptization_date;
           $users->save();
            session()->flash('message', "data saved successfully");
           return redirect()->back();
    }

}
