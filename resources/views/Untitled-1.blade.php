<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pledge report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
h1{
  color: red !important;
}

</style>
<title>card payment</title>
</head>
<body>
 
<!------ Include the above in your HEAD tag ---------->
<br>
<br>

@php
$user=Auth::User()->id;
$company=App\Models\Company::first();
$ldate = date('Y-m-d H:i:s');
//user=Auth::User()->id;
$purpouses=App\Models\Purpose::all();
 $payments=App\Models\Payment::where('user_id',$user)->get();
 $pledges_total=App\Models\Pledge::count();
 $purpouses_count=App\Models\Purpose::count();
 $unfullfiled_pledge=App\Models\Pledge::where('status','0')->count();
 $fullfiled_pledge=App\Models\Pledge::where('status','1')->count();
 $money_pledge=App\Models\payment::where('user_id',$user)->sum('amount');
 $ahadi=App\Models\Pledge::where('user_id',$user)->sum('amount');
$i=1;
//card report
$cards=App\Models\Card::join('cards_members', 'cards_members.card_no', '=', 'cards.id')
->where('cards_members.user_id',$user)
->get(['cards.card_no','cards.status','cards.created_at']);

//$dependants=App\Models\User::find($user)->dependant;
@endphp
        
<div class="card">
  <div class="card-body" style="position:relative">
    <div class="text-center">
      <img src={{ public_path("img/kkkt.png") }} width="100px" height="100px" alt="" class="img-fluid"/>
    </div>
    <h6 class="text-secondary text-center">{{ $company->system_name}}</h6>
    <h6 class="text-dark text-center">{{ $company->name }}- {{ $company->city }}</h6>
       <center><h6 class="community"> My card<h6></center>
        <div class="float-right  text-sm" style="position:absolute;left:100%;top:15%">
          <span>{{ $company->email }},</span><br>
          <span>p.o.box {{ $company->postal_box }},<span><br>
           <span>{{ $company->city }},<span>
            <span>{{ $company->town }},</span>
            <br>
            <br>
          
            {{$ldate}}
           
        </div>
  </div>

  <div>
    <div style="margin-left:10px">
       <br>
       <br>
       <h4>card summary report</h4>
     <table class="table table-bordered"style="width:100%">
    
      <tbody>
        <tr>
          <td><strong>namba ya kadi ya sasa</strong></td>
          @foreach ( $cards as $card )
          <td><strong>{{$card->card_no}}</strong></td>
          @endforeach
          
        </tr>
   
      
      </tbody>  
    </table>
    </div>

  </div>
 </div>
  </div>


    
       
       
        <div class="card">
          <div class="card-body">
            <table class="table table-striped table-condensed">
              <thead>
              <tr style="font-size:14px">
                <th>id</th>
                <th>card number</th>
                <th>status</th>
                <th>issued date</th>
                 
               
              </tr>
          </thead>   
          <tbody>
            @php
              
            //$dependants=App\Models\User::find($user)->dependant;
           @endphp
            @foreach ( $cards as $card )
            <?php
            if($card->status==1){
              $cardstatus="active";
            }else{
              $cardstatus="not active";
            }
           ?>
           
            
                  
        
            <tr style="font-size:13px">
                <td>{{ $i++}}</td>
                <td>{{ $card->card_no}}</td>
                <td>{{ $cardstatus}}</span></td>
                <td>{{ $card->created_at}}</span></td>
            </tr>
            @endforeach
           
          </tbody>
          </table>
            
          </div>
        </div>
      </div>
 
    
       
   
          
            
</body>
</html>










