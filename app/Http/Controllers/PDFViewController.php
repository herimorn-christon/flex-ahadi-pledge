<?php

namespace App\Http\Controllers;
use PDF;
use PdfReport;
use App\Models\User;
use App\Models\Pledge;
use App\Models\Payment;
use App\Models\CardPayment;
use App\Models\Jumuiya;
use App\Models\Purpose;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Barryvdh\Snappy\Facades\SnappyPdf as FacadesSnappyPdf;
use Illuminate\Http\Request;
use Jimmyjs\ReportGenerator\Facades\PdfReportFacade;
use Jimmyjs\ReportGenerator\ReportMedia\PdfReport as ReportMediaPdfReport;
use Knp\Snappy\Pdf as SnappyPdf;
use PhpOffice\PhpSpreadsheet\Writer\Pdf as WriterPdf;

class PDFViewController extends Controller
{
    public function index()
    {

        $users=User::where('status','0')->where('role','member')->get();


        $pdf = PDF::loadView('report', compact('users'));

        return $pdf->download('MembersReport.pdf');
    }
// For Registered Members Reports 
public function displayReport(Request $request) 
{
    $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');
    $sortBy = $request->input('sort_by');
    $title = 'Registered Member Report';
    // Retrieve any filters
    /*
    
    $total=User::select(['fname', 'mname','lname','gender','jumuiya', 'created_at'])
    ->whereBetween('created_at', [$fromDate, $toDate])
    ->orderBy($sortBy)->count();
    // Report title
   

    // For displaying filters description on header
    $meta = [
        'Registered From' => $fromDate .' ', ' To' => $toDate .' ',  'Total Members'=>$total
      
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
                    */
                    $pdf=FacadePdf::loadView("adminMemberReport",["fromDate"=>$fromDate,
                "toDate"=>$toDate, 'sortBy'=>$sortBy,'title'=>$title]);
  
                    return $pdf->stream();
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


// For Pledges Per Purpose Reports
public function pledgesReport(Request $request) 
{
    // Retrieve any filters
    $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');
    $sortBy = $request->input('sort_by');
    $purpose = $request->input('purpose_id');

    $total=Pledge::select(['purpose_id','type_id','created_at'])
  //  ->whereBetween('created_at', [$fromDate, $toDate])
    ->where('purpose_id',$purpose)
    ->count();
    // Report title
    $title = 'Pledges Per Purpose Report';

    // For displaying filters description on header
    $meta = [
        'Collected From: ' => $fromDate .' ', ' To: ' => $toDate .' ',  'Total Pledges: '=>$total
      
    ];

    // Do some querying..
    $queryBuilder = Pledge::select(['name','user_id', 'purpose_id','status','created_at','amount','deadline']);
                        //->whereBetween('created_at')
                        //->where('purpose_id',$purpose);
                        //->with('user')
                        //->with('purpose')
                        //, [$fromDate, $toDate]
                        //->orderBy($sortBy);

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
                    ->download('Pledges_Per_Purpose_Report'); 
}

// For Pledges Per Member Reports
public function  memberPledgesReport(Request $request) 
{
    // Retrieve any filters
    $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');
    $sortBy = $request->input('sort_by');
    $member = $request->input('user_id');

    $total=Pledge::select(['user_id','type_id','created_at'])
    ->whereBetween('created_at', [$fromDate, $toDate])
    ->where('user_id',$member)
    ->count();

    $name=User::where('id',$member)->first();
    // Report title
    $title = 'Member Pledges Report';

    // For displaying filters description on header
    $meta = [

         'Member Name: ' => $name->fname .' '.$name->mname.' '.$name->lname.' ','Jumuiya: '=>$name->community->name.' ','Collected From: ' => $fromDate .' ', ' To: ' => $toDate .' ',  'Total Pledges: '=>$total
      
    ];

    // Do some querying..
    $queryBuilder = Pledge::select(['name','user_id','description','purpose_id','status','created_at','amount','deadline'])
                        ->whereBetween('created_at', [$fromDate, $toDate])
                        ->where('user_id',$member)
                        ->with('user')
                        ->with('purpose')
                        ->orderBy($sortBy);

    // Set Column to be displayed
    $columns = [

       
        'Pledge Title'=>'name',
        'Purpose' => function($user) { // You can do data manipulation, if statement or any action do you want inside this closure
            return $user->purpose->title;
        },
        'Description'=>'description',
        'Status' => function($user) { // You can do data manipulation, if statement or any action do you want inside this closure
            return $user->status == 0 ? 'Not Fullfilled':'Fullfiled';
        },
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
                    ->download('Pledges_Per_Purpose_Report'); 
}

// For Pledges Per Purpose Reports
public function cardPaymentReport(Request $request) 
{
    // Retrieve any filters
    $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');
    $sortBy = $request->input('sort_by');

    $total=CardPayment::select(['amount','card_member','created_at'])
    ->whereBetween('created_at', [$fromDate, $toDate])
    ->sum('amount');
    // Report title
    $title = 'Payments Made by Cards Report';

    // For displaying filters description on header
    $meta = [
        'Collected From: ' => $fromDate .' ', ' To: ' => $toDate .' ',  'Collected Amount: '=>$total
      
    ];

    // Do some querying..
    $queryBuilder = CardPayment::select(['card_member','created_at','amount'])
                        ->whereBetween('created_at', [$fromDate, $toDate])
                        ->with('user')
                        ->with('card')
                        ->orderBy($sortBy);

    // Set Column to be displayed
    $columns = [

        'Full Name' => function($name) { // You can do data manipulation, if statement or any action do you want inside this closure
            return $name->card->user->fname.' '.$name->card->user->mname.' '.$name->card->user->lname;
        },
        'Member Card' => function($user) { // You can do data manipulation, if statement or any action do you want inside this closure
            return $user->card->card->card_no.'/'.$user->card->user_id;
        },
        'Payment Date'=>'created_at',
        'Amount'=>'amount',
        
        
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
                    ->download('Card_Payments_Report'); 
}


public function purpousePdf(){


   //return view("communityReport");
  
     //dd($purpouse);
    //showing purpouse pdf
   // $purpouses=Purpose::all();

   $pdf=FacadePdf::loadView("communityReport");
  
 return $pdf->stream();
    

}

public function communityPdf(){
    // return view("community1Report");
     $pdf=FacadePdf::loadView("community1Report");
  return $pdf->stream();
}
public function memberPleadgeReport(){
    //lets runs the commands to preview the reports before printing
    $pdf=FacadePdf::loadView("memberPledgeReport");
    

  
    return $pdf->stream();
    //return view("memberPledgeReport");
}
public function admin_user_report(){
    //return view("admin_dependancyReport");
    $pdf=FacadePdf::loadView("admin_dependancyReport");
  
    return $pdf->stream();
}
public function view_payment(){
    $pdf=FacadePdf::loadView("paymentReport");
  
    return $pdf->stream();
}
public function showCards(){
    $pdf=FacadePdf::loadView("cardReport");
  
    return $pdf->stream();
   // return view("cardReport");
}
public function myadmin_pledge(){
    $pdf=FacadePdf::loadView("adminPledgesReport");
  
    return $pdf->stream();
    //return view("adminPledgesReport");
}
public function myadmin_payment(){
    $pdf=FacadePdf::loadView("myadmin_payment_report");
  
    return $pdf->stream();
}
public function myadmin_card(){
    $pdf=FacadePdf::loadView("all_cards_report");
  
    return $pdf->stream();

}


}
