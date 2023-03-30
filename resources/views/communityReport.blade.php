<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>propouse report </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
h1{
  color: red !important;
}

</style>

</head>
<body>
 
<!------ Include the above in your HEAD tag ---------->
<br>
<br>

@php
$user=Auth::User()->id;
$company=App\Models\Company::first();
$ldate = date('Y-m-d H:i:s');
$user=Auth::User()->id;
 $purpouses=App\Models\Purpose::all();
 $purpouses_count=App\Models\Purpose::count();
 $purpouses_count_uncomplished=App\Models\Purpose::where('status',0)->count();
 $purpouses_count_complished=App\Models\Purpose::where('status',1)->count();
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
       <center><h6 class="community"> My purpouse<h6></center>
        <div class="float-right  text-sm" style="position:absolute;left:100%;top:15%">
          <span>{{ $company->email }},</span><br>
          <span>p.o.box {{ $company->postal_box }},<span><br>
           <span>{{ $company->city }},<span>
            <span>{{ $company->town }},</span>
            <br>
            <br>
            {{$ldate}}
            <br>
            
        </div>
  </div>

  <div>
    <br>
    <br>
    <div style="margin-left:10px">
      <h4>card summary report</h4>
      <table class="table table-bordered"style="width:100%">
     
       <tbody>
         <tr>
           <td><strong>jumla ya malengo</strong></td>
           <td><strong>{{$purpouses_count }}</strong></td>
         </tr>
         <tr>
          <td><strong>uncomplished purpouse</strong></td>
          <td><strong>{{$purpouses_count_uncomplished }}</strong></td>
        </tr>
        <tr>
          <td><strong>complished purpouse</strong></td>
          <td><strong>{{$purpouses_count_complished }}</strong></td>
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
              <tr style="font-size:15px">
                <th>id</th>
                <th>purpouse title </th>
                <th>description</th>
                <th>start date</th>
                <th>end date</th>
                <th>status</th>
              </tr>
          </thead>   
          <tbody id="table_community">
            @php
            
            //$dependants=App\Models\User::find($user)->dependant;
           @endphp
            @foreach ( $purpouses as $purpouse )
            <?php
              if($purpouse->status==0){
               $purpouse->status='uncomplished';
                }else{
                    $purpouse->status='complished'; 
                }
               ?>
                
           
                
           
            <tr style="font-size:13px">
                
                <td>{{ $i++}}</td>
                <td>{{ $purpouse->title }}</td>
                <td>{{ $purpouse->description }}</span></td>
                <td>{{ $purpouse->start_date }}</span></td>
                <td>{{ $purpouse->end_date }}</span></td>
                <td>{{ $purpouse->status }}</span></td>
            </tr>
            @endforeach
           
          </tbody>
          </table>
            
          </div>
        </div>
      </div>
 
    
       
   
          
            
</body>
</html>










