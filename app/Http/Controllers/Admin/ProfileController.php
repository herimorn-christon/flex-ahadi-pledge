<?php

namespace App\Http\Controllers\Admin;

// use file;
use App\Models\User;
use illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // for index function
    public function index()
    {
     
        $user=Auth::user()->id;
        $member=User::where('id',$user)->with('community')->get();
        return response()->json(['member' => $member]);
    }


      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $user=Auth::user()->id;
        $member = User::where('id',$user)->get();
        return response()->json(['member' => $member]);
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'fname' => 'required|max:255',
            'mname' => 'required|max:255',
            'lname' => 'required|max:255',
            'email' => 'required',
            'phone' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'jumuiya' => 'required',
        ]);
  
        $member = User::find($id);
        $member->fname=$request->fname;
        $member->mname=$request->mname;
        $member->lname=$request->lname;
        $member->email=$request->email;
        $member->phone=$request->phone;
        $member->gender=$request->gender;
        $member->date_of_birth=$request->date_of_birth;
        $member->jumuiya=$request->jumuiya;
        $member->save();
        return response()->json(['status' => "success"]);
    }


    // For updating profile image
       // update function
       public function updateImg(Request $request)
       {

        request()->validate([
            'image' => 'required'
        ]);
           $user=Auth::user()->id;
        
           $member=User::find($user);
           if($request->hasfile('image')){
   
               $destination= 'uploads/user/'. Auth::User()->profile_picture;
               if(File::exists($destination)){
                $img=$member->profile_picture;
                if($img!="user.png"){

                    File::delete($destination);
                }
               }
               $file=$request->file('image');
               $filename=time().'.'.$file->getClientOriginalExtension();
               $file->move('uploads/user/', $filename);
               $member->profile_picture=$filename;
           }
           // saving data
           $member->update();
   
           return redirect('admin/my-profile')->with('status', 'Image Has been uploaded');
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
             'current_password' => 'required',
             'new_password' => 'required|confirmed'
              ]
             );
             $user=Auth::User()->id;
             $existing=Hash::make(Auth::User()->password);
             $current=  $request->user_id;
           
             if(!Hash::check($request->current_password, auth()->user()->password)){
                return back()->with("status", "Old Password Doesn't match!");
            }


            #Update the new Password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            return back()->with("status", "Password changed successfully!");
                
            }

}
