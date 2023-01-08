<!--  This is the admin view profile page -->
@extends('layouts.master')

@section('title','My Profile')


@section('content')

@php

$user=Auth::user()->id;
$profile=App\Models\User::where('id',$user)->with('community')->get();
@endphp
<div class="row mb-1">
    <div class="col-sm-6">

    {{-- start of alert message i.e updated or failed requesst --}}
      @if (session('status'))
      <div class="btn btn-success disabled" disabled role="alert">
          {{ session('status') }}
      </div>
      @endif
    {{-- end of alert message  --}}

    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="float-sm-right" type="none">
        <li class=""> 
          {{-- start of edit profile button --}}
        <button type="button" class="btn bg-flex text-light btn-sm mb-2" data-toggle="modal" onclick="editProfile()">
            
            <i class="fa fa-cog"></i>
             Edit My Profile
        </button>
        {{-- end of edit profile button --}}
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>





        <div class="row">
            <div class="col-md-12 mx-auto">
                <!-- About Me Box -->
                <div class="card card-light">
                  <!-- /.card-header -->
                  <div class="card-body">

                    <div class="col-md-12">
                         <!-- Start of Profile Image -->
                        
                    <a href="#avatar-modal" data-toggle="modal" class="text-decoration-none"  onclick="editImage()">
                    <div class="text-center" >
                      <img class="profile-user-img img-fluid img-circle"
                           src="{{ asset('img/user.png') }}"
                           alt="User profile picture" width="240px">
                           <br>
                           <small class="text-secondary">
                            <i class="fa fa-edit muted text-secondary"></i>
                            Change Image
                           </small>
                    </div> 
                    
                    </a>
                    <!-- End of Profile Image -->
{{-- start of avatar modal --}}
@include('admin.profile.avatar-modal')
{{-- end of avatar modal --}}

<!-- Start of Profile Details -->
@include('admin.profile.profile-detail')
 <!-- End Of Profile Details -->
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>

        </div>




{{-- start of profile modal --}}
@include('admin.profile.profile-modal')
{{-- end of profile modal --}}


{{-- start of edit profile ajax method --}}

@include('admin.profile.edit-detail')
{{-- end of edit profile ajax method --}}
@endsection