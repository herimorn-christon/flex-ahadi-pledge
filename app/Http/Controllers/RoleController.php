<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //this is something that wants to be no way
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $role = Role::create(['name' => $request->name]);

        // Additional logic, if needed

        return redirect()->back()->with('success', 'Role created successfully!');
    }
}
