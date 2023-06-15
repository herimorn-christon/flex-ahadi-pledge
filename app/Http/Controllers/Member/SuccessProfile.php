<?php

namespace App\Http\Controllers\Member;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuccessProfile extends Controller
{
    //
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
            $data->gender=$request->gender;
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
             'message'=>' profile Updated SuccessFully',
             'alert-type'=>'success'
          );
           return redirect()->back()->with($notification);
         }
}
