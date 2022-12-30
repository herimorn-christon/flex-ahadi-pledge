<?php

namespace App\Http\Controllers;
use PDF;
use PdfReport;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;

class PDFViewController extends Controller
{
    public function index()
    {
        // $course=Faq::where('id','5');

        $users=User::where('status','0')->where('role','member')->get();


        $pdf = PDF::loadView('report', compact('users'));

        return $pdf->download('MembersReport.pdf');
    }
// For Registered Members Reports 
public function displayReport(Request $request) 
{
    // Retrieve any filters
    $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');
    $sortBy = $request->input('sort_by');
    $total=User::select(['fname', 'mname','lname','gender','jumuiya', 'created_at'])
    ->whereBetween('created_at', [$fromDate, $toDate])
    ->orderBy($sortBy)->count();
    // Report title
    $title = 'Registered Member Report';

    // For displaying filters description on header
    $meta = [
        'Registered From: ' => $fromDate .' ', ' To: ' => $toDate .' ',  'Total Members: '=>$total
      
    ];

    // Do some querying..
    // $queryBuilder = User::select(['name', 'balance', 'registered_at'])
    //                     ->whereBetween('registered_at', [$fromDate, $toDate])
    //                     ->orderBy($sortBy);
    $queryBuilder = User::select(['fname', 'mname','lname','gender','jumuiya', 'created_at'])
                        ->whereBetween('created_at', [$fromDate, $toDate])
                        ->orderBy($sortBy);

    // Set Column to be displayed
    $columns = [
        'First name' => 'fname','Middle name'=>'mname','Last name'=>'lname',
        'Registered At'=>'created_at','gender',    
        'jumuiya' => function($user) { // You can do data manipulation, if statement or any action do you want inside this closure
            return $user->community->name;
        }
    ];

    return PdfReport::of($title, $meta, $queryBuilder, $columns)
                    ->editColumn('Registered At', [
                        'displayAs' => function($result) {
                            return $result->created_at->format('d M Y');
                        }
                    ])
                    ->download('MemberReport'); 
}

// For Collected Payments Reports
public function paymentReport(Request $request) 
{
    // Retrieve any filters
    $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');
    $sortBy = $request->input('sort_by');

    $total=Payment::select(['amount'])
    ->whereBetween('created_at', [$fromDate, $toDate])
    ->sum('amount');
    // Report title
    $title = 'Collected Payments Report';

    // For displaying filters description on header
    $meta = [
        'Collected From: ' => $fromDate .' ', ' To: ' => $toDate .' ',  'Total Amount: '=>$total
      
    ];

    // Do some querying..
    $queryBuilder = Payment::select(['user_id', 'pledge_id','type_id','amount','created_at'])
                        ->whereBetween('created_at', [$fromDate, $toDate])
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
                    ->download('Collected_Payments_Report'); 
}

}
