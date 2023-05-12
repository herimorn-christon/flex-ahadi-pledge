<!DOCTYPE html>
<!--=== Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Member registration page </title>
  

</head>

<body>
  <div class="container">
      <header>Registration</header>
      @if ($errors->any())
      <div class="btn btn-danger disabled btn-block mb-3">
          @foreach ($errors->all() as $error)
          <div>{{$error}}</div>
          @endforeach
      </div>
      @endif

      <form method="POST" action="{{url("/register")}}" id="msform" style="background:rgb(248, 249, 250)">
        @csrf
          <div class="form first">
              <div class="details personal">
                  <span class="title">Personal Details</span>

                  <div class="fields">
                      <div class="input-field">
                          <label>First Name</label>
                          <input type="text" placeholder="Enter your name" required name="fname">
                      </div>

                      <div class="input-field">
                          <label>Middle Name </label>
                          <input type="text" placeholder="Enter middle name date" required name="mname">
                      </div>

                      <div class="input-field">
                          <label>Last Name</label>
                          <input type="text" placeholder="Enter  last Name" required name="lname">
                      </div>

                      <div class="input-field">
                          <label>Mobile Number</label>
                          <input type="number" placeholder="Enter mobile number" required name="phone">
                      </div>

                      <div class="input-field">
                          <label>Gender</label>
                          <select required name="gender">
                              <option disabled selected>Select gender</option>
                              <option value="male">Male</option>
                              <option value="female">Female</option>
                             
                          </select>
                      </div>

                      <div class="input-field">
                          <label>Email</label>
                          <input type="email" placeholder="Enter your ccupation" required name="email">
                      </div>
                  </div>
              </div>

              <div class="details ID">
                  <span class="title">Identity Details</span>

                  <div class="fields">
                      <div class="input-field">
                          <label>Password</label>
                          <input type="password" placeholder="Enter password" required  name="password" >
                      </div>

                      <div class="input-field">
                          <label>Confirm Password</label>
                          <input type="password" placeholder="confirm password" required name="password_confirmation">
                      </div>
                      <div class="input-field">
                        <label>Birth Date</label>
                        <input type="date" placeholder="Enter issued state" required name="date_of_birth">
                    </div>
                    
                      <div class="input-field">
                          <label>Place of birth</label>
                          <input type="text" placeholder="Enter place of birth"  name="place_of_birth">
                      </div>

                      <div class="input-field">
                          <label>Proffessional</label>
                          <input type="text" placeholder="Enter your proffession" required name="proffession">
                      </div>
                  </div>

                  <button class="nextBtn">
                      <span class="btnText">Next</span>
                      <i class="uil uil-navigator"></i>
                  </button>
              </div> 
          </div>

          <div class="form second">
              <div class="details address">
                  <span class="title">spiritual information</span>

                  <div class="fields">
                      <div class="input-field">
                          <label>old shirika</label>
                          <input type="text" placeholder="Please inter the old shirika" required 
                          name="old_usharika">
                      </div>
                         

                      <div class="input-field">
                          <label>Fellowship name</label>
                          <input type="text" placeholder="Enter fellowship name" required 
                          placeholder="inter the fellowship name" name="fellowship_name">
                      </div>

                      <div class="input-field">
                          <label>neighbour msharika name</label>
                          <input type="text" placeholder="Enter your neighbouring shirika" required
                          name="neighbour_msharika_name">
                      </div>

                      <div class="input-field">
                          <label>neighbour msharika phone	</label>
                          <input type="text" placeholder="" required name="neighbour_msharika_phone">
                      </div>

                      <div class="input-field">
                          <label>	deacon_name</label>
                          <input type="text" placeholder="Enter deacon name" required 
                          name="deacon_name">
                      </div>

                      <div class="input-field">
                          <label>Deacon Phone</label>
                          <input type="number" placeholder="Enter deacon Phone number" required name="deacon_phone">
                      </div>
                  </div>
              </div>

              <div class="details family">
                  <span class="title"> </span>

                  <div class="fields">
                    <div class="input-field">
                      <label>	sacramenti meza bwana</label>
                      <select required name="sacramenti_meza_bwana">
                          <option disabled selected>sacramenti meza bwana</option>
                          <option value="0">No</option>
                          <option value="1">Yes</option>
                         
                      </select>
                    </div>
                    <div class="input-field">
                      <label>Jumuiya</label>
                      <select required name="jumuiya">
                          <option disabled selected>Select Community </option>
                          @php
                          $jumuiyas=App\Models\Jumuiya::all();
                          @endphp
                          @foreach ($jumuiyas as $jumuiya)
                          <option value="{{ $jumuiya->id }}" class="form-control">{{ $jumuiya->name }}</option>
                          @endforeach
                      </select>
                    </div>


                      <div class="input-field">
                        <label>volontier</label>
                        <select required name="can_volunteer">
                            <option disabled selected>can you voluntier</option>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                           
                        </select>
                      </div>
                     
                  </div>

                  <div class="buttons">
                      <div class="backBtn">
                          <i class="uil uil-navigator"></i>
                          <span class="btnText">Back</span>
                      </div>
                      
                      <button class="sumbit">
                          <span class="btnText">Submit</span>
                          <i class="uil uil-navigator"></i>
                      </button>
                  </div>
              </div> 
          </div>
      </form>
  </div>

  <script src="{{ asset('js/index.js') }}"></script>
</body>
</html>