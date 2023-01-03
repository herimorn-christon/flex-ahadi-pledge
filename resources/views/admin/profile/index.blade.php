@extends('layouts.master')

@section('title','My Profile')


@section('content')

@php

$user=Auth::user()->id;
$profile=App\Models\User::where('id',$user)->with('community')->get();
@endphp
<div class="row mb-1">
    <div class="col-sm-6">
      @if (session('status'))
      <div class="alert disabled" style="background-color: rgb(198, 253, 216)" role="alert">
          {{ session('status') }}
      </div>
      @endif
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class=""> 
          @foreach ($profile as $item)
        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" onclick="editProfile({{ $item->id }})">
            <i class="fa fa-cog"></i>
             Edit My Profile
        </button>
        @endforeach
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>





        <div class="row">
            <div class="col-md-12 mx-auto">

             
                
                <!-- /.card -->
    
                <!-- About Me Box -->
                <div class="card card-light">
                  <div class="card-header">
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">

                    <div class="col-md-12">
                         <!-- Profile Image -->
           
                    <div class="text-center">
                      <img class="profile-user-img img-fluid img-circle"
                           src="{{ asset('img/user.png') }}"
                           alt="User profile picture" width="240px">
                    </div>
                    @foreach($profile as $item)
                    <h3 class="profile-username text-center"> {{ $item->fname}} {{ $item->mname}} {{ $item->lname}}</h3>
    
                    <p class="text-muted text-center">Member</p>
               
                    </div>
                    <strong  class="text-secondary"><i class="fas fa-user-tie mr-1"></i> Full Names</strong>
    
                    <p class="text-dark">
                        {{ $item->fname}} {{ $item->mname}} {{ $item->lname}}
                    </p>
    
                    <hr>
    
                    <strong  class="text-secondary"><i class="fas fa-users mr-1"></i> Community (Jumuiya)</strong>
    
                    <p class="text-dark">{{ $item->community->name}}</p>
    
                    <hr>
    
                    <strong  class="text-secondary"><i class="fas fa-calendar mr-1"></i> Birthdate</strong>
    
                    <p class="text-dark">
                        {{ $item->date_of_birth}}
                   
                    </p>
    
                    <hr>
    
                    <strong class="text-secondary"><i class="fa fa-address-book mr-1 text-secondary"></i> Contacts</strong>
    
                    <p class="text-dark">
                        {{ $item->phone}}
                   <br>
                        {{ $item->email}}
                    </p>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>

        </div>


        @endforeach


{{-- edit profile modal --}}
<div class="modal fade" id="profile-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:1250px;">
    <div class="modal-content">
      <div class="modal-header bg-light">
          <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
    
      </div>
      <div class="modal-body">
          <div id="error-div"></div>
          <form >
                 <input type="hidden" name="update_id" id="update_id">
              <div class="row">
              <div class="mb-3 col-md-6">
                  <label for="fname" class="text-secondary">{{ __('First Name') }}</label>

                  <div class="form-group">
                      <input id="fname" type="text" placeholder="Enter First Name" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="name" autofocus>

                      @error('fname')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="mb-3 col-md-6">
                  <label for="mname" class="text-secondary">{{ __('Middle Name') }}</label>

                  <div class="">
                      <input id="mname" type="text" placeholder="Enter Middle Name" class="form-control @error('mname') is-invalid @enderror" name="mname" value="{{ old('fname') }}" required autocomplete="name" autofocus>

                      @error('mname')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="col-md-6 mb-3">
                  <label for="lname" class="text-secondary">{{ __('Last Name') }}</label>

                  <div class="form-group">
                      <input id="lname" type="text" placeholder="Enter Last Name" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="name" autofocus>

                      @error('lname')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="col-lg-6 mb-3">
                  <label for="phone" class="form-label text-secondary ">{{ __('phone') }}</label>

                  <div class="form-group">
                      <input id="phone" type="text" placeholder="Enter Phone Number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

      
                  </div>
              </div>
              <div class="col-lg-6 mb-3">
                  <label for="email" class="text-secondary">{{ __('Email Address') }}</label>

                  <div class="form-group">
                      <input id="email" type="email" placeholder="Enter Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

      
                  </div>
              </div>

              @php
              $jumuiya= App\Models\Jumuiya::get();
              @endphp
              <div class="col-md-6">
                  <label for="" class="text-secondary">Jumuiya (Community) </label>
                  <select name="jumuiya" id="jumuiya" class="form-control">
                      <option value="">--Select Community (Jumuiya) --</option>
                      @foreach ( $jumuiya as $item)
                       <option value="{{ $item->id}}">{{ $item->name}}</option>
                      @endforeach
                  </select>
              </div>

              <div class="col-lg-6">
                  <label for="card_no" class="text-secondary">Birthdate</label>
                  <div class="form-group form-primary mb-3"> 
                      <input id="date_of_birth" type="date" class="form-control" name="date_of_birth" placeholder="" > </div>
              </div>

          <div class="col-lg-6">
                  <label for="gender" class="text-secondary">Gender</label>
                  <select name="gender" id="gender" class="form-control">
                          <option value="">--Select Gender --</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                  </select>
             
          </div>

           
              <div class="col-md-6">
               
                
              </div>

              <div class="col-md-6 mb-0 ">
                      <label for="" class="text-white">.</label>
                          <button type="submit" class="btn  text-decoration-none text-light bg-primary btn-block col-lg-12" id="save-profile-btn">
                             <i class="fa fa-save"></i>
                              {{ __('Save Changes') }}
                          </button>
                      </div>
           
          </div>
          </form>
      </div>
  
    </div>
  </div>
</div>



<script>
      /*
                check if form submitted is for creating or updating
            */
            $("#save-profile-btn").click(function(event ){
                event.preventDefault();
                if($("#update_id").val() == null || $("#update_id").val() == "")
                {
                    storeProject();
                } else {
                    updateProject();
                }
            })
         

        /*
                edit record function
                it will get the existing value and show the project form
            */
            function editProfile(id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/profile/" + id ;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        let member = response.member;
                        $("#alert-div").html("");
                        $("#error-div").html("");   
                        $("#update_id").val(member.id);
                        $("#fname").val(member.fname);
                        $("#mname").val(member.mname);
                        $("#lname").val(member.lname);
                        $("#phone").val(member.phone);
                        $("#email").val(member.email);
                        $("#date_of_birth").val(member.date_of_birth);
                        $("#gender").val(member.gender);
                        $("#jumuiya").val(member.jumuiya);
                        $("#password").val(member.password);
                        $("#status").val(member.status);
                        $("#profile-modal").modal('show'); 
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
</script>
@endsection