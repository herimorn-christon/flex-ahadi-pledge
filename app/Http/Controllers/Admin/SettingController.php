<?php
namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SettingController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $users = User::all();
            $roles = Role::all();
            $setting = Setting::find(1);
            $permissions = Permission::all();
            
            return view('admin.settings', compact('setting', 'users', 'roles', 'permissions'));
        }
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'system_name' => 'required|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'theme' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $setting = Setting::find(1);

        if ($setting) {
            $setting->system_name = $request->system_name;

            if ($request->hasFile('logo')) {
                $destination = 'uploads/settings/' . $setting->logo;

                if (File::exists($destination)) {
                    File::delete($destination);
                }

                $file = $request->file('logo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/settings/', $filename);
                $setting->logo = $filename;
            }

            if ($request->hasFile('favicon')) {
                $destination = 'uploads/settings/' . $setting->favicon;

                if (File::exists($destination)) {
                    File::delete($destination);
                }

                $file = $request->file('favicon');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/settings/', $filename);
                $setting->favicon = $filename;
            }

            $setting->theme = $request->theme;
            $setting->save();

            return redirect('admin/settings')->with('message', 'Settings Updated!');
        } else {
            $setting = new Setting;
            $setting->system_name = $request->system_name;

            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/settings/', $filename);
                $setting->logo = $filename;
            }

            if ($request->hasFile('favicon')) {
                $file = $request->file('favicon');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/settings/', $filename);
                $setting->favicon = $filename;
            }

            $setting->theme = $request->theme;
            $setting->save();

            return redirect('admin/settings')->with('message', 'Settings Added!');
        }
    }
}
