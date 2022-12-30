<?php

namespace App\Http\Controllers;
use PDF;
use PdfReport;
use App\Models\User;
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

public function displayReport(Request $request) {
    // Retrieve any filters
    $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');
    $sortBy = $request->input('sort_by');

    // Report title
    $title = 'Registered Member Report';

    // For displaying filters description on header
    $meta = [
        'Registered on' => $fromDate . ' To ' . $toDate,
        'Sort By' => $sortBy
    ];

    // Do some querying..
    // $queryBuilder = User::select(['name', 'balance', 'registered_at'])
    //                     ->whereBetween('registered_at', [$fromDate, $toDate])
    //                     ->orderBy($sortBy);
    $queryBuilder = User::select(['fname', 'mname','lname','gender','jumuiya', 'created_at'])
                        ->orderBy('id','ASC');

    // Set Column to be displayed
    $columns = [
        'First name' => 'fname','Middle name'=>'mname','Last name'=>'lname',
        'created_at','gender'
    ];

    return PdfReport::of($title, $meta, $queryBuilder, $columns)
                    ->editColumn('created_at', [
                        'displayAs' => function($result) {
                            return $result->created_at->format('d M Y');
                        }
                    ])
                    ->download('MemberReport'); 
}

}
