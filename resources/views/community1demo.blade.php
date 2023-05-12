<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>community report  </title>
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
         $jumuiyas_count=App\Models\Jumuiya::count();
         $ldate = date('Y-m-d H:i:s');
         $user=Auth::User()->id;
        $company=App\Models\Company::first();
        $member_count=App\Models\User::join('jumuiya', 'users.jumuiya', '=', 'jumuiya.id')->count();

        // $jumuiya_max=App\Models\Jumuiya::->max('id');

  @endphp

        <div class="card">
          <div class="card-body" style="position:relative">
            <div class="text-center">
              <img src={{ public_path("img/kkkt.png") }} width="100px" height="100px" alt="" class="img-fluid"/>
            </div>
            <h6 class="text-secondary text-center">{{ $company->system_name}}</h6>
            <h6 class="text-dark text-center">{{ $company->name }}- {{ $company->city }}</h6>
               <center><h6 class="community"> My community<h6></center>
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
              <h4>communitysummary report</h4>
            <table class="table table-bordered"style="width:100%">
           
             <tbody>
               <tr>
                 <td><strong>jumla ya jumuiya</strong></td>
                 <td><strong>{{ $jumuiyas_count }}</strong></td>
               </tr>
               <tr>
                <td><strong> jumla yawanachama</strong></td>
                <td><strong>{{ $member_count  }}</strong></td>
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
              <tr  style="font-size:15px">
                <th>sn</th>
                <th>JINA LA JUMUIYA</th>
                <th>KIFUPISHO</th>
                <th>MAHARI</th>
              </tr>
          </thead>   
          <tbody>
            @php
//$user=Auth::User()->id;
            $jumuiyas=App\Models\Jumuiya::all();
            //getting the max
           //$jumuiyas_max=App\Models\Jumuiya::max('id');
            $i=1;
          
            //$jumuiya_max=App\Models\Jumuiya::max($jumuiyas);
            //select the 
            //$dependants=App\Models\User::find($user)->dependant;
           @endphp
           {{ $jumuiyas_count }}
          
            @foreach ( $jumuiyas as $jumuiya )
          
                
           
                
           
            <tr style="font-size:13px">
                
                <td>{{ $i++}}</td>
                <td>{{ $jumuiya->name }}</td>
                <td>{{ $jumuiya->abbreviation }}</span></td>
                <td>{{ $jumuiya->location }}</span></td>
            </tr>
            @endforeach
           
          </tbody>
          </table>
            
          </div>
        </div>
      </div>
 
    
       
   
          
            
</body>
</html>










