<?php

namespace App\Http\Controllers\Admin;

use App\Models\Card;
use App\Models\User;
use App\Models\Pledge;
use App\Models\Jumuiya;
use App\Models\Payment;
use App\Models\CardPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DashboardController extends Controller
{

    public function index()
    {   
        $new_user = Auth::user()->church_id;
        
        // Function for number conversion
        function thousandsCurrencyFormat($num) {
            if($num > 1000) {
                $x = round($num);
                $x_number_format = number_format($x);
                $x_array = explode(',', $x_number_format);
                $x_parts = array('k', 'm', 'b', 't');
                $x_count_parts = count($x_array) - 1;
                $x_display = $x;
                $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
                $x_display .= $x_parts[$x_count_parts - 1];
                return $x_display;
            }
            return $num;
        }
        
        $num = CardPayment::whereYear('created_at', date('Y'))->sum('amount');
        $cards = thousandsCurrencyFormat($num);
        $pledges = thousandsCurrencyFormat(Pledge::whereYear('created_at', date('Y'))
        ->where("church_id",$new_user)->sum('amount'));
        $payments = thousandsCurrencyFormat(Payment::whereYear('created_at', date('Y'))
        ->where("church_id",$new_user)->sum('amount'));
        $members = thousandsCurrencyFormat(User::role('member')->where("church_id",$new_user)->count());
        $male = thousandsCurrencyFormat(User::role('member')->where('gender', 'male')
        ->where("church_id",$new_user)->count());
        $female = thousandsCurrencyFormat(User::role('member')->where('gender', 'female')->
        where("church_id",$new_user)->count());
        $communities = thousandsCurrencyFormat(Jumuiya::where("church_id",$new_user)->count());
        $contributions = thousandsCurrencyFormat(Payment::sum('amount') + CardPayment::sum('amount'));
        $total_pledges = thousandsCurrencyFormat(Pledge::where("church_id",$new_user)->count());
        $total_cards = thousandsCurrencyFormat(Card::where("church_id",$new_user)->count());
        $var1 = Pledge::where("church_id",$new_user)->whereYear('created_at', date('Y'))->sum('amount');
        $var2 = Payment::where("church_id",$new_user)->whereYear('created_at', date('Y'))->sum('amount');

        if ($var1 > $var2) {
            $remaining = thousandsCurrencyFormat($var1 - $var2);
        } else {
            $remaining = 0;
        }
      
        // For users chart js
        $users = User::role('member')
            ->where('church_id',$new_user)
            ->whereYear('created_at', date('Y'))
            ->where("church_id",$new_user)
            ->select(DB::raw('COUNT(*) as count'), DB::raw('MONTH(created_at) as month'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('count', 'month');

        // For monthly payments chart js
        $monthlyPayments = DB::table('payments')
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(amount) as sum'))
        ->where("church_id", $new_user)
        ->whereIn('user_id', function ($query) {
            $query->select('model_id')
                ->from('model_has_roles')
                ->where('model_type', 'App\Models\User')
                ->whereExists(function ($query) {
                    $query->select('role_id')
                        ->from('roles')
                        ->where('name', 'member')
                        ->whereRaw('model_has_roles.role_id = roles.id');
                });
        })
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy(DB::raw('MONTH(created_at)'))
        ->get();
        $months = [];
        $sums = [];

        foreach ($monthlyPayments as $payment) {
            $months[] = Carbon::createFromDate(null, $payment->month)->format('F');
            $sums[] = $payment->sum;
        }

        // For monthly user graphs enlargements
        $monthlyUsers = DB::table('users')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->where('church_id', $new_user)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        $pmonths = [];
        $counts = [];

        foreach ($monthlyUsers as $user) {
            $pmonths[] = Carbon::createFromDate(null, $user->month)->format('F');
            $counts[] = $user->count;
        }

        return view('admin.dashboard', compact(
            'pledges',
            'members',
            'pmonths',
            'counts',
            'payments',
            'sums',
            'users',
            'months',
            'cards',
            'communities',
            'contributions',
            'total_pledges',
            'total_cards',
            'male',
            'female',
            'remaining'
        ));
    }
}
