<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{

    //index function
    public function index(){
        $setting=Setting::find(1);
        return view('admin.settings',compact('setting'));
    }


    public function save(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'system_name'=>'required|max:255',
            'logo'=>'nullable',
            'favicon'=>'nullable',
            'theme'=>'nullable'
        ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $setting=Setting::where('id','1')->first();
        if($setting)
        {
            $setting->system_name=$request->system_name;

            if($request->hasfile('logo')){
                 $destination= 'uploads/setting/'.$setting->logo;
               if(File::exists($destination)){
                   File::delete($destination);
               }
                $file=$request->file('logo');
                $filename=time().'.'.$file->getClientOriginalExtension();
                $file->move('uploads/settings/', $filename);
                $setting->logo=$filename;
            }

            if($request->hasfile('favicon')){
                $destination= 'uploads/settings/'.$setting->favicon;
                if(File::exists($destination)){
                    File::delete($destination);
                }
                $file=$request->file('favicon');
                $filename=time().'.'.$file->getClientOriginalExtension();
                $file->move('uploads/settings/', $filename);
                $setting->favicon=$filename;
            }
            $setting->theme=$request->theme;

            $setting->save();

            return redirect('admin/settings')->with('message','Settings Updated !');
        }
        else
        {
            $setting=new Setting;
            $setting->system_name=$request->system_name;

            if($request->hasfile('logo')){
                $file=$request->file('logo');
                $filename=time().'.'.$file->getClientOriginalExtension();
                $file->move('uploads/settings/', $filename);
                $setting->logo=$filename;
            }

            if($request->hasfile('favicon')){
                $file=$request->file('favicon');
                $filename=time().'.'.$file->getClientOriginalExtension();
                $file->move('uploads/settings/', $filename);
                $setting->favicon=$filename;
            }
            $setting->theme=$request->theme;

            $setting->save();

            return redirect('admin/settings')->with('message','Settings Added !');
        }
    }
}
