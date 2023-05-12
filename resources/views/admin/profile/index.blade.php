<!--  This is the admin view profile page -->
@extends('layouts.master')

@section('title','My Profile')
@php

$user=Auth::user()->id;
$profile=App\Models\User::where('id',$user)->with('community')->get();
@endphp

@section('content')
<div class="content-wrap">
  <div class="main">
    <div class="container-fluid">
      <section id="main-content">
        <div class="row">
          @if (session('status'))
          <div class="btn btn-success disabled" disabled role="alert">
              {{ session('status') }}
          </div>
          @endif
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="user-profile">
                  <div class="row">
                    <div class="col-lg-4">
                      <a href="#avatar-modal" data-toggle="modal" class="text-decoration-none"  onclick="editImage()">
                      <div class="user-photo m-b-30">
                        
                        <img class="img-fluid" src="{{ asset('uploads/user/'. Auth::user()->profile_picture ) }}" alt="" 
                        />
                        <br>
                        <small class="text-secondary" >
                         <i class="fa fa-edit muted text-secondary"></i>
                         Change Image
                        </small>
                      </div>
                      </a>
                      <div class="user-send-message">
                        <button type="button" class="btn bg-flex text-light btn-sm mb-2" data-toggle="modal" onclick="editProfile()">
            
                          <i class="fa fa-cog"></i>
                           Edit My Profile
                      </button>
                      {{-- end of edit profile button --}}
              
                      {{-- start of edit profile button --}}
                      <button type="button" class="btn bg-flex text-light btn-sm mb-2" data-toggle="modal" onclick="changePassword()">
                          <i class="fa fa-key"></i>
                           Change Password
                      </button>
                          
                      </div>
                        {{-- buttons for the updating profiles and deleting the profiles for the profile image page
                           --}}
                      



                    </div>
                    <div class="col-lg-8">
                      <h4>personal information</h4>
                      <div class="user-profile-name">name : 
                        <i class="ti-location-pin">{{ Auth::user()->fname }} {{ Auth::user()->mname }}
                          {{ Auth::user()->lname }}</i>
                      </div>
                      <div class="user-Location">
                       </div>
                      <div class="user-job-title">work: <i class="ti-location-pin">{{ Auth::user()->proffession }}
                      </i></div>
                      <hr>
                            {{-- user buttons --}}
                     
                      <div class="custom-tab user-profile-tab">
                        <ul class="nav nav-tabs" role="tablist">
                          <li role="presentation" class="active">
                         
                          </li>
                        </ul>
                        <div class="tab-content">
                          <div role="tabpanel" class="tab-pane active" id="1">
                            <div class="contact-information">
                              <h4>Contact information</h4>
                              <div class="phone-content">
                                <span class="contact-title">Phone:</span>
                                <span class="phone-number">{{ Auth::user()->phone }}</span>
                              </div>
                  
                              <div class="email-content">
                                <span class="contact-title">Email:</span>
                                <span class="contact-email">{{ Auth::user()->email }}</span>
                              </div>
              
                            </div>
                            <hr>
                            <div class="basic-information">
                              <h4>Basic information</h4>
                              <div class="birthday-content">
                                <span class="contact-title">Birthday:</span>
                                <span class="birth-date">{{ Auth::user()->date_of_birth }}</span>
                              </div>
                              <div class="gender-content">
                                <span class="contact-title">Gender:</span>
                                <span class="gender">{{ Auth::user()->gender}}</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    
      </section>
    </div>
  </div>
  @include('admin.profile.avatar-modal')
{{-- end of avatar modal --}}

<!-- Start of Profile Details -->

@include('admin.profile.profile-modal')
{{-- end of profile modal --}}


{{-- start of edit profile ajax method --}}

@include('admin.profile.edit-detail')
{{-- end of edit profile ajax method --}}

{{-- start of profile modal --}}
@include('admin.profile.change-password-modal')
</div>


@endsection