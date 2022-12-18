<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    // for index function
    public function index()
    {
        $users=User::all()->where('role','member');
        return view('admin.members.index',compact('users'));
    }
}
