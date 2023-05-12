<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class companySettingController extends Controller
{
    public function index(){
        //handling the data according to condition
        $companies=Company::first();
        //dd($companies);
         return view("admin.company.company",compact('companies'));
    }
    public function store(Request $request){
            $request->validate([
                'image'=>['image','requred'],
                 'email'=>['email','required'],
                 'postal_box'=>['required'],
                 'city'=>['required'],
                 'street'=>['required'],
                 'image'=>['required'],
                 'name'=>['required'],

            ]);
              //then insert into database with the images
            
              $fileName=time().'_'.$request->image->getClientOriginalName();
              $file_path=$request->image->storeAs("uploads",$fileName); 
              //store the data in the database
              $company=new Company();
              $company->name=$request->name;
              $company->email=$request->email;
              $company->postal_box=$request->postal_box;
              $company->logo= 'storage/'.$file_path;
              $company->city=$request->city;
              $company->town=$request->street;
              $company->save();
              return redirect()->back()->with('message',"details sents");

    }
    public function update(Request $request,$id){
            $fileName="";
          $company=Company::find($id);
          if($request->hasFile('image')){
            
          $fileName=time().'_'.$request->image->getClientOriginalName();
          $file_path=$request->image->storeAs("uploads",$fileName);
          $company->logo='storage/uploads/'.$fileName;
          }else{
            $fileName='storage/uploads/'.$company->logo;
          }
          
          $company->name=$request->name;
          $company->email=$request->email;
         $company->postal_box=$request->postal_box;
          $company->city=$request->city;
         $company->town=$request->street;
          //$company->logo='storage/uploads/'.$fileName;
          $company->save();
          return redirect()->back()->with('message',"details are updated successfully");
    }
}
