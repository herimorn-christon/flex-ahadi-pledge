<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use PDF;
use PdfReport;
use App\Models\User;
use App\Models\Pledge;
use App\Models\Payment;
use App\Models\CardPayment;


use Illuminate\Support\Facades\Auth;

class MyReportController extends Controller
{
 

    // For My Pledges Reports 
public function pledgesReport(Request $request) 
{
    // Retrieve any filters
    $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');
    $sortBy = $request->input('sort_by');
    $user=Auth::User()->id;
    $total=Pledge::select(['fname', 'mname','lname','gender','jumuiya', 'created_at'])
                    ->where('user_id',$user)
                    ->whereBetween('created_at', [$fromDate, $toDate])
                    ->orderBy($sortBy)->count();
    // Report title
    $title = 'My Pledges Report';

    // For displaying filters description on header
    $meta = [
        'Made From: ' => $fromDate .' ', ' To: ' => $toDate .' ',  'Total Pledges: '=>$total
      
    ];

    // Do some querying..
    // $queryBuilder = User::select(['name', 'balance', 'registered_at'])
    //                     ->whereBetween('registered_at', [$fromDate, $toDate])
    //                     ->orderBy($sortBy);
    $queryBuilder =Pledge::select(['name','user_id', 'purpose_id','status','created_at','amount','deadline'])
                            ->whereBetween('created_at', [$fromDate, $toDate])
                            ->where('user_id',$user)
                            ->with('user')
                            ->with('purpose')
                            ->orderBy($sortBy);
    // Set Column to be displayed
 // Set Column to be displayed
    $columns = [

        'Full Name' => function($user) { // You can do data manipulation, if statement or any action do you want inside this closure
            return $user->user->fname.' '.$user->user->mname.' '.$user->user->lname;
        },
        'Pledge Title'=>'name',
        'Purpose' => function($user) { // You can do data manipulation, if statement or any action do you want inside this closure
            return $user->purpose->title;
        },
        'Created Date'=>'created_at',
        'Amount'=>'amount',
        
        
    ];

    return PdfReport::of($title, $meta, $queryBuilder, $columns)
                    ->editColumn('Created Date', [
                        'displayAs' => function($result) {
                            return $result->created_at->format('d M Y');
                        }
                    ])
                    // ->groupBy('Purpose')
                    ->showTotal([
                        'Amount' => 'point'
                    ])
                    ->download('My_Pledges_Report'); 
    }
    
    // For Payments Made Reports
public function paymentReport(Request $request) 
{
    // Retrieve any filters
    $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');
    $sortBy = $request->input('sort_by');
    $user=Auth::User()->id;

    $total=Payment::select(['amount'])
                    ->where('user_id',$user)
                    ->whereBetween('created_at', [$fromDate, $toDate])
                    ->sum('amount');
    // Report title
    $title = 'Pledges Payments Report';

    // For displaying filters description on header
    $meta = [
        'Collected From: ' => $fromDate .' ', ' To: ' => $toDate .' ',  'Total Amount: '=>$total
      
    ];

    // Do some querying..
    $queryBuilder = Payment::select(['user_id', 'pledge_id','type_id','amount','created_at'])
                        ->whereBetween('created_at', [$fromDate, $toDate])
                        ->where('user_id',$user)
                        ->with('payer')
                        ->with('payment')
                        ->orderBy($sortBy);

    // Set Column to be displayed
    $columns = [
        'Full Name' => function($user) { // You can do data manipulation, if statement or any action do you want inside this closure
            return $user->payer->fname.' '.$user->payer->mname.' '.$user->payer->lname;
        },
        'Purpose' => function($user) { // You can do data manipulation, if statement or any action do you want inside this closure
            return $user->purpose->title;
        },
        'Payment Method' => function($user) { // You can do data manipulation, if statement or any action do you want inside this closure
            return $user->payment->name;
        },
        'Payment Date'=>'created_at','Amount'=>'amount',
        
    ];

    return PdfReport::of($title, $meta, $queryBuilder, $columns)
                    ->editColumn('Payment Date', [
                        'displayAs' => function($result) {
                            return $result->created_at->format('d M Y');
                        }
                    ])
                    // ->groupBy('Purpose')
                    ->showTotal([
                        'Amount' => 'point'
                    ])
                    ->download('Pledges_Payments_Report'); 
}


}
