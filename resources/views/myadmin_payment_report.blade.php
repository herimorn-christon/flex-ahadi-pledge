<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>our payments</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style type="text/css">
   
    @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@600&display=swap');
   
    .belly{
        border: 2px solid rgb(34,184,209);
    }
    .belly1{
        border: 2px solid rgb(34,184,209);
    }
    .bb {
        border-bottom: 3px solid #ccc;
    }
  
       
    .page[size="A4"] {
        width: 21cm;
        overflow: hidden;
        background:red;
        height:100%;
    }
   
    
    /* Top Section */
    .top-content {
        padding-bottom: 15px;
    }
    
    .logo{
        height: 60px;
    }
    .img1{
        height:60px;
        position: relative;
        left:87%;
        top:-100%;
    }
    
    .top-left p {
        margin: 0;
    }
    
    .top-left .graphic-path {
        height: 40px;
        position: relative;
        width:30%;
    }
    
    .top-left .graphic-path::before {
        content: "";
        height: 20px;
        width:14rem;
        background-color:#615c60;
        position: absolute;
        left: 15px;
        right: 0;
        top: -15px;
        z-index: 2;
    }
    
    .top-left .graphic-path::after {
        content: "";
        height: 22px;
        width: 17px;
        background:black;
        position: absolute;
        top: -13px;
        left: 6px;
        transform: rotate(45deg);
    }
    
    .top-left .graphic-path p {
        color:#ccc;
        height: 40px;
        left: 0;
        right: -100px;
        text-transform: uppercase;
        background-color:#22b8d1;
        font: 26px;
        z-index: 3;
        position: absolute;
        padding-left: 10px;
    }
    .store-user {
        padding-bottom: 25px;
    }
    
    .store-user p {
        margin: 0;
        font-weight: 600;
    }
    
    .store-user .address {
        font-weight: 400;
    }
    
    .store-user h2 {
        color:#22b8d1;
        font-family: 'Rajdhani', sans-serif;
    }

    .thead {
        color:#ffff;
        background:#22b8d1;
        text-align:center;
        margin-top:-20px;
    }
    
    
    .table td,
    .table th {
        text-align:left;
        vertical-align: middle;
        text-transform:capitalize;
    }
    
    tr th:first-child,
    tr td:first-child {
        text-align: left;
    }
  
    .extra-info p span {
        font-weight: 400;
    }
    
    /* Product Section */
    /*
    thead {
        color: var(--white);
        background: var(--themeColor);
    }
    */
    .thead {
        color: var(--white);
        background:#22b8d1;
        text-align:center;
        margin-top:-20px;
    }
    
    
    .table td,
    .table th {
        text-align:left;
        vertical-align:left;
    }
    
    tr th:first-child,
    tr td:first-child {
        text-align: left;
    }
    
    .media img {
        height: 60px;
        width: 60px;
    }
    
    .media p {
        font-weight: 400;
        margin: 0;
    }
    
    .media p.title {
        font-weight: 600;
    }
    
    /* Balance Info Section */
    .balance-info .table td,
    .balance-info .table th {
        padding: 0;
        border: 0;
    }
    
    .balance-info tr td:first-child {
        font-weight: 600;
    }
    
    tfoot {
        border-top: 2px solid #ccc;
    }
    
    tfoot td {
        font-weight: 600;
    }
    
    /* Cart BG */
    .cart-bg {
        height: 250px;
        bottom: 32px;
        left: -40px;
        opacity: 0.3;
        position: absolute;
    }
    
    /* Footer Section */
    footer {
        text-align: center;
        position: absolute;
        bottom:-20%;
        left: 100px;
    }
    
    footer hr {
        margin-bottom: -22px;
        border-top: 3px solid #ccc;
    }
    
    footer a {
        color: #22b8d1;
    }
    
    footer p {
        padding: 6px;
        border: 3px solid #ccc;
        background-color:#ffff;
        display: inline;
    }
    body{
        height:100vh;
    }
    
    
</style>

</head>
<body>
    @php
$user=Auth::User()->id;
$company=App\Models\Company::first();
$ldate = date('Y-m-d H:i:s');
//user=Auth::User()->id;
 $purpouses=App\Models\Purpose::all();
 $payments=App\Models\Payment::all();
 $pledges_total=App\Models\Pledge::count();
 $purpouses_count=App\Models\Purpose::count();
 $unfullfiled_pledge=App\Models\Pledge::where('status','0')->count();
 $fullfiled_pledge=App\Models\Pledge::where('status','1')->count();
 $money_pledge=App\Models\payment::sum('amount');
 $ahadi=App\Models\Pledge::sum('amount');
$i=1;

        // $jumuiya_max=App\Models\Jumuiya::->max('id');

  @endphp

    <div class="my-5 " size="A4" style="margin-left:-9.4%;position:relative;top:-10%">
        <div class="p-5">
            <section class="top-content bb d-flex justify-content-between">
                <div class="logo">
                <div class="top-left">
                    <div class="graphic-path">
                        <p style="text-transform:capitalize;z-index:5;color:whitesmoke"><strong>{{$company->system_name }}</strong></p>
                    </div>
                    <div class="position-relative">
                             <h5 style="text-transform:capitalize">kanisa la KKT kikundi</h5>
                            <p class="address">{{ $company->email }}, <br>P.O.Box {{ $company->postal_box  }}, <br>{{$company->city}}, </p>
                             <p class="address"style="text-transform:capitalize">{{ $company->town }},</p>
                            <div class="txn mt-2" style="text-transform:capitalize">web:<a href="www.cits.com">www.cits.com</a></div>
                        </div>
                    </div>
                </div>
                <div class="p-5" >
                    <div class="logo">
                        <img src="{{ public_path($company->logo)}}" alt="" 
                        class="image-fruid img1" style="width:8rem;height:8rem">
                    </div>
            </section>

                 <hr>


            <section class="store-user">
                    <center><h3 style="text-transform:capitalize;color:#22b8d1">our payments<h3></center>
                <table class="table"style="width:100%;" class="belly">
    
                    <tbody style="text-transform:capitalize" class="belly">
                      <tr class="belly">
                        <td class="belly">total money paid</td>
                        <td class="belly">{{$money_pledge}}</td>
                      </tr>
                      <tr class="belly">
                        <td class="belly">total money pledge</td>
                        <td class="belly">{{$ahadi}}</td>
                      </tr>
                      <tr class="belly">
                        <td class="belly">total money remained</td>
                        <td class="belly">{{$ahadi-$money_pledge}}</td>
                      </tr>
                      <tr class="belly">
                        <td class="belly">total fullfilled pledge </td>
                        <td class="belly">{{$fullfiled_pledge }}</td>
                      </tr>
                    </tbody>  
                  </table>
            </section>
           <hr>

            <section class="product-area mt-4">
               <h3 class="thead" style="color:white;text-transform:capitalize;border-radius:5px;
                height:3rem;padding-top:11px">
                    payments report summary</h3>
                <table class="table table-hover table-bordered belly1">
                    <thead class="belly1">
                        <tr class>
                        <td>S/N</td>
                       <td>Date</td>
                        <td>method</td>
                        <td>purpouse</td>
                        <td>Amount</td>
                        <td>status</td>
                        </tr>
                    </thead>
                    <tbody class="belly1">
                        
                        @foreach ( $payments as $payment )
                        <?php
                         if($payment->varified==0){
                           $pledgestatus="not verified";
                         }else{
                            $pledgestatus="verified";
                         }
                        ?>
                        
          
                            <tr class="belly1" style="text-transform:capitalize">
                                <td>{{ $i++}}</td>
                                <td>{{ $payment->created_at}}</td>
                                <td>{{ $payment->payment->name}}</td>
                                <td>{{ $payment->pledge->name}}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{  $pledgestatus }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
            <!-- Cart BG -->
            <img src="{{ public_path("img/kkt.png") }}" alt="" 
            class="image-fruid cart-bg">
          

            <footer>
                <hr>
                <p class="m-0 text-center" style="text-transform:capitalize">
                    this is the product of <a href="#!"> ahadi flex </a>
                </p>
                <div class="social pt-3">
                    <span class="pr-2">
                        <i class="fas fa-mobile-alt"></i>
                        <span>0655921861</span>
                    </span>
                    <span class="pr-2">
                        <i class="fab fa-instagram"></i>
                        <span>ahadi_pledge</span>
                    </span>
                    <span class="pr-2">
                        <i class="fab fa-facebook-f"></i>
                        <span>ahadi pledge</span>
                    </span>
                    <span class="pr-2">
                        <i class="fab fa-youtube"></i>
                        <span>ahadi pledge</span>
                    </span>
                </div>
            </footer>
</div>
</body>
</html>