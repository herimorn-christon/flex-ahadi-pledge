<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserRolePermissionController extends Controller
{
    //
    public function storePermissions(Request $request, Role $role)
    {
        $request->validate([
            'role' => 'required|exists:roles,id',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);
    
        $role = Role::findOrFail($request->role);
        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name');
    
        $role->syncPermissions($permissions);
        // return $role;

        // Additional logic, if needed

        return redirect()->back()->with('success', 'Permissions assigned successfully!');
    }

}
