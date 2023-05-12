<?php

namespace App\Http\Controllers;

use App\Models\dependant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class memberDependantController extends Controller
{
    public function index(){
        //finding all users
        //$dependants=User::find($id)->dependant;
        //can use dependants to find the user
        
        return view("admin.members.depandant");
    }
    protected function weka(Request $request){
        
    
           
        $request->validate([
            'users_dependant'=>'required',
            'dependant_name'=>'required',
            'relationship'=>'required',
            'birth_date'=>'required',
        ]
        
        );
         dependant::create([
           'fullName'=>$request->dependant_name,
           'relationship'=>$request->relationship,
           'users_id'=>$request->users_dependant,
            'birth_date'=>$request->birth_date,
         ]);
         return response()->json([
            'success'=>'dependant saved successfully'

        ],201);
         
         
    }
    public function edit($id){
        //lets take the value to edit
          $dependant=dependant::find($id);
          
        return view("admin.members.depandantEdit",compact('dependant'));
    }
    public function update(Request $request ,$id){

        $request->validate([
            'fullName'=>['required'],
            'birth_date'=>['required'],
            'relationship'=>['required'],
        ]);
        
               $dependants=dependant::find($id);
               $dependants->fullName=$request->fullName;
               $dependants->birth_date=$request->birth_date;
               $dependants->relationship=$request->relationship;
               $dependants->save();
               $notification=array(
                'message'=>'dependant is updated successfully',
                'alert-type'=>'success'
             );
              return redirect()->route('myprofile')->with($notification);
              
        

    }
    public function destroy($id){
         $dependants=dependant::find($id);
         $dependants->delete();
         $notification=array(
            'message'=>'woow !!dependants is recycled successfully',
            'alert-type'=>'success'
         );
          return redirect()->route('myprofile')->with($notification);
          

    }
    public function trash(){
        $dependants=dependant::onlyTrashed()->get();

        return view("admin.members.trash",compact('dependants'));
    }
    public function restore($id){
        $dependants=dependant::onlyTrashed()->find($id);
        $dependants->restore();
        //finding the user 
        $notification=array(
            'message'=>'the member is successfully restored',
            'alert-type'=>'success'
         );
          return redirect()->route('myprofile')->with($notification);
          
    }
    public function forceDelete($id){
        $dependants=dependant::onlyTrashed()->find($id);
        $dependants->forceDelete();
        //finding the user id
        return Redirect()->back()->with('msg2', 'dependant has been successfully deleted');
        
    }
}
