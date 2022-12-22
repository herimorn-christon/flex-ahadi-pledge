<?php

namespace App\Http\Controllers\Admin;

use App\Models\Card;
use App\Models\User;
use App\Models\Pledge;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $cards=Card::count();
        $pledges=Pledge::sum('amount');
        $payments=Payment::sum('amount');
        $members=User::where('role','member')->count();
    //   for users chat js
        $users = User::select(\DB::raw("COUNT(*) as count"))
        ->whereYear('created_at', date('Y'))
        ->where('role','member')
        ->groupBy(\DB::raw("Month(created_at)"))
        ->pluck('count');
    // for payments
        $payrate = Payment::select(\DB::raw("SUM(amount) as count"))
        ->whereYear('created_at', date('Y'))
        ->groupBy(\DB::raw("Day(created_at)"))
        ->pluck('count');
        return view('admin.dashboard',compact('pledges','members','payments','users','payrate','cards'));

    }
}
