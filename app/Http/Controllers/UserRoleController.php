<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    //
  public function storeRoles(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);
        $user = User::findOrFail($request->user);
        $user->syncRoles($request->roles);

        return redirect()->back()->with('success', 'Roles assigned successfully!');
    }
}
