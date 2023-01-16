<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function save(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'website_name'=>'required|max:255',
            'logo'=>'nullable',
            'favicon'=>'nullable',
            'about'=>'nullable',
            'terms'=>'nullable',
            'description'=>'nullable',
            'privacy'=>'nullable',
            'meta_title'=>'nullable',
            'meta_description'=>'required',
            'meta_keyword'=>'required'
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
