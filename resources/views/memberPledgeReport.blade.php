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
<title>member predge report </title>
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
 $pledges=App\Models\Pledge::all();
 $pledges_total=App\Models\Pledge::count();
 $purpouses_count=App\Models\Purpose::count();
 $unfullfiled_pledge=App\Models\Pledge::where('status','0')->count();
 $fullfiled_pledge=App\Models\Pledge::where('status','1')->count();
 $money_pledge=App\Models\Pledge::where('user_id',$user)->sum('amount');
$i=1;
//$dependants=App\Models\User::find($user)->dependant;
@endphp
        
<div class="card">
  <div class="card-body" style="position:relative">
    <div class="text-center">
      <img src={{ public_path("img/kkkt.png") }} width="100px" height="100px" alt="" class="img-fluid"/>
    </div>
    <h6 class="text-secondary text-center">{{ $company->system_name}}</h6>
    <h6 class="text-dark text-center">{{ $company->name }}- {{ $company->city }}</h6>
       <center><h6 class="community"> My pledges<h6></center>
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
       <h3>pleadge summary report</h3>
     <table class="table table-bordered"style="width:50%">
    
      <tbody>
        <tr>
          <td><strong>jumla ya ahadi</strong></td>
          <td><strong>{{$pledges_total }}</strong></td>
        </tr>
        <tr>
          <td><strong> zisizo timizwa</strong></td>
          <td><strong>{{$unfullfiled_pledge }}</strong></td>
        </tr>
        <tr>
          <td><strong> zilizo timizwa</strong></td>
          <td><strong>{{$fullfiled_pledge }}</strong></td>
        </tr>
        <tr>
          <td><strong>   jumla ya fedha</strong></td>
          <td> <strong>{{$money_pledge}}</strong></td>
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
                <th>created at</th>
                <th>updated at</th>
                <th>pledge name</th>
                <th>purpouse</th>
                <th>amount</th>
                <th>dedline</th>
                <th>status</th>
              </tr>
          </thead>   
          <tbody>
            @php
              
            //$dependants=App\Models\User::find($user)->dependant;
           @endphp
            @foreach ( $pledges as $pledge )
            <?php
             if($pledge->status==0){
               $pledgestatus="not fullfilled";
             }
            ?>
            
                  
        
            <tr style="font-size:13px">
                
                <td>{{ $i++}}</td>
                <td>{{ $pledge->created_at}}</td>
                <td>{{ $pledge->updated_at}}</td>
                <td>{{ $pledge->name }}</span></td>
                <td>{{ $pledge->purpose->title }}</span></td>
                <td>{{ $pledge->amount }}</span></td>
                <td>{{ $pledge->deadline }}</span></td>
                <td>{{  $pledgestatus }}</span></td>
            </tr>
            @endforeach
           
          </tbody>
          </table>
            
          </div>
        </div>
      </div>
 
    
       
   
          
            
</body>
</html>










