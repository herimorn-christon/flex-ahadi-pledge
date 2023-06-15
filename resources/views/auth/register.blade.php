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

    <title>{{ __('Member registration page') }} </title>
  

</head>
@php
     $churches = App\Models\Church::all();
@endphp

<body>
  <div class="container">
      <header>{{ __('Registration') }}</header>
      @if ($errors->any())
      <div class="btn btn-danger disabled btn-block mb-3">
          @foreach ($errors->all() as $error)
          <div>{{$error}}</div>
          @endforeach
      </div>
      @endif

      <form method="POST" id="msform">
        @csrf
          <div class="form first">
              <div class="details personal">
                  <span class="title">{{ __("Personal Details") }}</span>

                  <div class="fields">
                      <div class="input-field">
                          <label>{{ __('First Name') }}</label>
                          <input type="text" placeholder="{{ __('Enter First name') }}" required name="fname">
                      </div>

                      <div class="input-field">
                          <label>{{ __("Middle Name") }} </label>
                          <input type="text" placeholder="{{ __('Enter middle name') }}" required name="mname">
                      </div>

                      <div class="input-field">
                          <label>{{ __('Last Name') }}</label>
                          <input type="text" placeholder="{{ __('Enter  last Name')}}" required name="lname">
                      </div>

                      <div class="input-field">
                          <label>{{ __('Mobile Number') }}</label>
                          <input type="number" placeholder="{{ __('Enter mobile number') }}" required name="phone">
                      </div>

                      <div class="input-field">
                          <label>{{ __('Gender') }}</label>
                          <select required name="gender">
                              <option disabled selected>{{ __('Select gender') }}</option>
                              <option value="male">{{ __('Male') }}</option>
                              <option value="female">{{ __('Female') }}</option>
                             
                          </select>
                      </div>

                      <div class="input-field">
                          <label>{{ __('Email') }}</label>
                          <input type="email" placeholder="{{ __('Enter your ccupation') }}" required name="email">
                      </div>
                  </div>
              </div>

              <div class="details ID">
                  <span class="title">{{__('Identity Details') }}</span>

                  <div class="fields">
                      <div class="input-field">
                          <label>{{__("Password") }}</label>
                          <input type="password" placeholder="{{ __('Enter password') }}" required  name="password" >
                      </div>

                      <div class="input-field">
                          <label>{{ __('Confirm Password') }}</label>
                          <input type="password" placeholder="{{ __('confirm password') }}" required name="password_confirmation">
                      </div>
                      <div class="input-field">
                        <label>{{ __('Birth Date') }}</label>
                        <input type="date" placeholder="Enter issued state" required name="date_of_birth">
                    </div>
                    
                      <div class="input-field">
                          <label>{{ __('Place of birth') }}</label>
                          <input type="text" placeholder="{{ __('Enter place of birth') }}"  name="place_of_birth">
                      </div>

                      <div class="input-field">
                          <label>{{ __('Proffessional') }}</label>
                          <input type="text" placeholder="{{ __('Enter your proffession') }}" required name="proffession">
                      </div>
                  </div>

                  <button class="nextBtn">
                      <span class="btnText">{{ __("Next") }}</span>
                      <i class="uil uil-navigator"></i>
                  </button>
              </div> 
          </div>

          <div class="form second">
              <div class="details address">
                  <span class="title">{{ __("spiritual information") }}</span>

                  <div class="fields">
                      <div class="input-field">
                          <label>{{ __("old shirika") }}</label>
                          <input type="text" placeholder="{{ __('Please inter the old shirika') }}" required 
                          name="old_usharika">
                      </div>
                         

                      <div class="input-field">
                          <label>{{ __('Fellowship name') }}</label>
                          <input type="text" placeholder="Enter fellowship name" required 
                          placeholder="{{ __("inter the fellowship name") }}" name="fellowship_name">
                      </div>

                      <div class="input-field">
                          <label>{{ __('neighbour msharika name') }}</label>
                          <input type="text" placeholder="Enter your neighbouring shirika" required
                          name="neighbour_msharika_name">
                      </div>

                      <div class="input-field">
                          <label>{{ __('neighbour msharika phone') }}</label>
                          <input type="text" placeholder="" required name="neighbour_msharika_phone">
                      </div>

                      <div class="input-field">
                          <label>{{ __('deacon_name') }}</label>
                          <input type="text" placeholder="{{ __('Enter deacon name') }}" required 
                          name="deacon_name">
                      </div>

                      <div class="input-field">
                          <label>{{ __('Deacon Phone') }}</label>
                          <input type="number" placeholder="{{ __('Enter deacon Phone number') }}" required name="deacon_phone">
                      </div>
                  </div>
              </div>

              <div class="details family">
                  <span class="title"> </span>

                  <div class="fields">
                    <div class="input-field">
                      <label>{{ __('sacramenti meza bwana') }}</label>
                      <select required name="sacramenti_meza_bwana">
                          <option disabled selected>{{ __('sacramenti meza bwana') }}</option>
                          <option value="0">{{ __('No') }}</option>
                          <option value="1">{{ __('Yes') }}</option>
                         
                      </select>
                    </div>
                    
                    <div class="input-field">
                        <label for="churchSelect">{{ __('Church') }}</label>
                        <select id="churchSelect" name="church_id" class="form-control" required>
                            <option value="" disabled selected>{{ __('Select Church') }}</option>
                            @foreach ($churches as $church)
                                <option value="{{ $church->id }}">{{ $church->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-field">
                        <label for="communitySelect">{{ __('Community') }}</label>
                        <select id="communitySelect" name="jumuiya" class="form-control" required>
                            <option value="">{{ __('Select Community') }}</option>
                        </select>
                    </div>


                    {{-- jquery to select churches before jumuiya --}}






                    {{-- <div class="input-field">
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
                    </div> --}}


                      <div class="input-field">
                        <label>{{ __('volontier') }}</label>
                        <select required name="can_volunteer">
                            <option disabled selected>{{ __('can you voluntier') }}</option>
                            <option value="0">{{ __('No') }}</option>
                            <option value="1">{{ __('Yes') }}</option>
                           
                        </select>
                      </div>
                     
                  </div>

                  <div class="buttons">
                      <div class="backBtn">
                          <i class="uil uil-navigator"></i>
                          <span class="btnText">{{ __('Back') }}</span>
                      </div>
                      
                      <button class="sumbit">
                          <span class="btnText">{{ __('Submit') }}</span>
                          <i class="uil uil-navigator"></i>
                      </button>
                  </div>
              </div> 
          </div>
      </form>
  </div>

  <script src="{{ asset('js/index.js') }}"></script>
  {{-- ajax script?/ --}}
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#churchSelect').change(function() {
            var churchId = $(this).val();
            console.log(churchId);
            if (churchId) {
                $.ajax({
                    url: '/churches/' + churchId + '/communities',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#communitySelect').empty();
                        $('#communitySelect').append('<option value="">Select Community</option>');
                        $.each(data, function(key, value) {
                            $('#communitySelect').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#communitySelect').empty();
                $('#communitySelect').append('<option value="">Select Community</option>');
            }
        });
    });
</script>
{{-- ajax form submission to the database --}}
<script>
    $(document).ready(function() {
      $('#msform').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission
  
        // Serialize the form data
        var formData = $(this).serialize();
  
        // Send the form data using AJAX
        $.ajax({
          url: "{{ url('/register') }}",
          type: "POST",
          data: formData,
          success: function(response) {
            // Handle the successful response here, if needed
            // For example, you can redirect the user to the login page
            window.location.href = "{{ url('/login') }}";
          },
          error: function(xhr, status, error) {
            // Handle the error here, if needed
            console.log(xhr.responseText);
          }
        });
      });
  
      // Add event listeners for the next and back buttons
      $('.nextBtn').click(function() {
        $(this).closest('.form').removeClass('active');
        $(this).closest('.form').next('.form').addClass('active');
      });
  
      $('.backBtn').click(function() {
        $(this).closest('.form').removeClass('active');
        $(this).closest('.form').prev('.form').addClass('active');
      });
    });
  </script>
</body>
</html>