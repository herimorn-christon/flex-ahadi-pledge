<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>flex-ahadi pledge</title>
      <!-- Normalize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
      <!-- Bootstrap 4 CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css'>
      <!-- Telephone Input CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/css/intlTelInput.css'>
      <!-- Icons CSS -->
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
      <!-- Nice Select CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css'>
     <!-- Style CSS -->
    <link rel="stylesheet" href="css/style.css">
	<!-- Demo CSS -->
	<link rel="stylesheet" href="css/demo.css">
  <style>
   
    </style>
  
  </head>
  <body>
 
 <main style="width:150%">
  <article >

      <!-- Start Multiform HTML -->
  <section class="multi_step_form"  >  
    
     {{-- start displaying errors --}}
     @if ($errors->any())
     <div class="btn btn-danger disabled btn-block mb-3">
         @foreach ($errors->all() as $error)
         <div>{{$error}}</div>
         @endforeach
     </div>
     @endif
    <form method="POST" action="{{url("/register")}}" id="msform" style="background:rgb(248, 249, 250)">
      @csrf
    <!-- Tittle -->
    <div class="tittle">
      <h2>personal information</h2>
      <p>please fill yor personal information here</p>
    </div>
    <!-- progressbar -->
    <ul id="progressbar">
      <li class="active">personal information</li>  
      <li>community information</li> 
      <li>professional information</li>
    </ul>
    <!-- fieldsets -->
    <fieldset>
      <div class="form-row"> 
        <div class="form-group col-md-6">  
          <input type="text" id="fname" type="text" placeholder="Enter First Name" name="fname" class="form-control"> 
        </div>  
        <div class="form-group col-md-6">  
          <input type="text" id="mname" type="text" placeholder="Enter Middle Name"name="mname"class="form-control"> 
        </div>  
        <div class="form-group col-md-6">  
          <input type="email" id="mname"  placeholder="Enter email"name="email"class="form-control"> 
        </div>  
        <div class="form-group col-md-6">  
          <input nput id="lname" type="text" placeholder="Enter Last Name" name="lname" class="form-control"> 
        </div>  
        <div class="form-group col-md-6">  
          <input type="text" class="form-control" placeholder="+2551123456789" name="phone" id="phone">
        </div>  
        <div class="form-group col-md-6">  
          <input type="password" class="form-control" placeholder="password" name="password" id="password">
        </div>  
        <div class="form-group col-md-6">  
          <input type="password" class="form-control"placeholder="Confirm Password" type="password"
          name="password_confirmation" required id="confirm_password">
        </div> 
       
          <div class="card-body col-md-6"style="margin-left:50%;position:relative;top:-100px">
            <label for="gender">gender</label>
            <div class="form-group col-md-10" >  
              <select name="gender" id="" class="form-control" style="height:3rem">
                <option> select your gender</option>
               <option value="male"> male</option>
               <option value="female"> female</option>
              </select>
         </div>  
        
        </div>
      
      </div>
    
      <button type="button" class="action-button previous_button">Back</button>
      <button type="button" class="next action-button">Continue</button>  
    </fieldset>

    <fieldset>
     
      <div class="form-row"> 
        <div class="form-group col-md-6">  
          <input type="text" id="fname" type="text" placeholder="Enter your birth place" name="place_of_birth" class="form-control"> 
        </div>  
        <div class="form-group col-md-6">  
             <select name="martial_status" id="" class="form-control" style="height:3rem">
              <option value="0"> married status</option>
              <option value="1"> married</option>
              <option value="2"> single</option>
              <option value="3"> devorced</option>
              <option value="4"> widow</option>
             </select>
        </div>  
        <div class="form-group col-md-6">  
          <select name="marriage_type" id="" class="form-control" style="height:3rem">
           <option value="0"> marriage types..</option>
           <option value="1">christian</option>
           <option value="2">muslim</option>
           <option value="3">hindus</option>
          </select>
     </div>  
    
        <div class="form-group col-md-6">  
          <input  id="lname" type="text" placeholder="Enter place of marriage" name="place_of_marriage" class="form-control"> 
        </div>  
        <div class="form-group col-md-6">  
          <input type="text" class="form-control" placeholder="inter old shirika" name="old_usharika" id="phone">
        </div>  
        <div class="form-group col-md-6">  
          <input type="text" class="form-control" placeholder="inter fellowship name" name="fellowship_name" id="password" >
        </div>  
        <div class="form-group col-md-6">  
          <input type="text" class="form-control"placeholder="inter neigbor member name" type="text"
          name="neighbour_msharika_name" required id="confirm_password">
        </div>  
        <div class="form-group col-md-6">  
          <input type="text" class="form-control" placeholder="inter neigbour phone no" name="neighbour_msharika_phone" id="phone">
        </div> 
        <div class="form-group col-md-6">  
          <input type="text" class="form-control" placeholder="inter patner name" name="partner_name" 
          id="phone">
        </div> 
        <div style="position:relative; top:-10px;left:50px">
        <label for="mariageDate">mariage date</label>
      
          <input type="date" id="mname" name="marriage_date"class="form-control"> 
       
      </div>
      </div>
      <button type="button" class="action-button previous previous_button">Back</button>
      <button type="button" class="next action-button">Continue</button>  
    </fieldset>


    <fieldset>
      <div class="form-row"> 
        <div class="form-group col-md-6">  
          <input type="text" id="fname" type="text" placeholder="Enter occupation" name="proffession" class="form-control"> 
        </div>  
        <div class="form-group col-md-6">  
          <input type="text" id="mname" type="text" placeholder="Enter place of work"name="place_of_work"class="form-control"> 
        </div>  
        <div class="form-group col-md-6">  
          <input type="text" id="mname" type="text" placeholder="Enter name of your 
          decon"name="deacon_name"class="form-control"> 
        </div>  
        <div class="form-group col-md-6">  
          <input type="text" id="mname" type="text" placeholder="Enter phone number
          "name="deacon_phone" class="form-control"> 
        </div>  
              
            <!-handling for each loop to get the data -->
          
        <div class="form-group col-md-6">
          <label for="community">proffesion</label>  
          <select name="jumuiya" id="" class="form-control" style="height:3rem">
            @php
              $jumuiyas=App\Models\Jumuiya::all();
              @endphp
              @foreach ($jumuiyas as $jumuiya)
              <option value="{{ $jumuiya->id }}" class="form-control">{{ $jumuiya->name }}</option>
              @endforeach
          </select>
     </div>  

            
     <div class="form-group col-md-6">
      <label for="community"> occupation</label>  
      <select name="occupation" id="" class="form-control" style="height:3rem">
        <option value="1" class="form-control">employed</option>
        <option value="2" class="form-control">unemployed</option>
        <option value="3" class="form-control">students</option>
    </select>
 </div> 
     <div style="margin-left:auto" >
      <h6 style="padding:0">enter the birth of date</h6>
        <div class="form-group col-md-10"> 
          <input type="date" id="mname" name="date_of_birth"class="form-control"> 
        </div> 
      </div> 
      </div>
      </div>
      <button type="button" class="action-button previous previous_button">Back</button>
      <button type="submit" class="action-button"> finish</button>
    </fieldset>
  </form>  
</section> 
      <!-- END Multiform HTML -->
  </article>
 </main>
 
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/js/intlTelInput.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js'></script>
    <script src="js/script.js"></script>
  
  </body>
</html>