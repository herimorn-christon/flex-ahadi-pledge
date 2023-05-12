<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminProfileStores extends Controller
{
    //
    public function adminProfilesStores(Request $request){
       $id=Auth::user()->id;
       $data=User::find($id);
       $data->fname=$request->fname;
       $data->mname=$request->mname;
       $data->lname=$request->lname;
       $data->email=$request->email;
       $data->date_of_birth=$request->date_of_birth;
       $data->martial_status=$request->martial_status;
       $data->marriage_type=$request->marriage_type;
       $data->marriage_date=$request->marriage_date;
       $data->partner_name=$request->partner_name;
       $data->occupation=$request->occupation;
       $data->proffession=$request->proffession;
       $data->baptized=$request->baptized;
       $data->baptization_date=$request->baptization_date;
       $data->kipaimara=$request->kipaimara;
       $data->kipaimara_date=$request->kipaimara_date;
      if($request->file('profile_picture')){
        //write something
        $file=$request->file('profile_picture');
        @unlink(public_path('uploads/user/'.$data->profile_picture));
        $fileName=date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('uploads/user/'),$fileName);
        $data->profile_picture=$fileName;

      }
      $data->save();
      $notification=array(
        'message'=>'Admin Profile Updated SuccessFully',
        'alert-type'=>'success'
     );
      return redirect()->back()->with($notification);
    }
}
