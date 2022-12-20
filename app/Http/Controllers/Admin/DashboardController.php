<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Pledge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $pledges=Pledge::count();
        $members=User::where('role','member')->count();
        # code...
        return view('admin.dashboard',compact('pledges','members'));

    }
}
