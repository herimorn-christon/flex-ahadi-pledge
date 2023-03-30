@extends('layouts.member')

@section('title','my profile')


@section('content')


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
         <?php
                    $user=Auth::User()->id;

          ?>
                <!--write the code to find easy the user profile-->
          
                <a href="my-profile/edit/{{$user}}">
        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#types" >
            <i class="fa fa-cog"></i>
            Edit Profile
           </button>
          </a>
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>

 
  @foreach($profile as $item)



        <div class="row">
            <div class="col-md-12 mx-auto">

                <!-- Profile Image -->
           
                    <div class="text-center">
                      <img class="profile-user-img img-fluid img-circle"
                           src="{{ asset('img/user.png') }}"
                           alt="User profile picture">
                    </div>
                        <h3 class="profile-username text-center"> {{ $item->fname}} {{ $item->mname}} {{ $item->lname}}</h3>
    
                    <p class="text-muted text-center">Member</p>
               
                
                <!-- /.card -->
    
                <!-- About Me Box -->
                <div class="card card-light">
                  <div class="card-header">
                    <h5 class="card-title">About Me</h5>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <strong><i class="fas fa-user-tie mr-1"></i> Full Names</strong>
    
                    <p class="text-muted">
                        {{ $item->fname}} {{ $item->mname}} {{ $item->lname}}
                    </p>
    
                    <hr>
    
                    <strong><i class="fas fa-users mr-1"></i> Community (Jumuiya)</strong>
    
                    <p class="text-muted">{{ $item->community->name}}</p>
    
                    <hr>
    
                    <strong><i class="fas fa-calendar mr-1"></i> Birthdate</strong>
    
                    <p class="text-muted">
                        {{ $item->date_of_birth}}
                   
                    </p>
    
                    <hr>
                    <strong><i class="fas fa-calendar mr-1"></i>proffession</strong>
    
                    <p class="text-muted">
                        {{ $item->proffession}}
                   
                    </p>
    
                    <hr>
                    <strong><i class="fas fa-calendar mr-1"></i>baptizim date</strong>
    
                    <p class="text-muted">
                        {{ $item->baptization_date}}
                   
                    </p>
    
                    <hr>
                    <strong><i class="fas fa-calendar mr-1"></i>deacon name</strong>
    
                    <p class="text-muted">
                        {{ $item->deacon_name}}
                   
                    </p>
    
                    <hr>
                    <strong><i class="fas fa-calendar mr-1"></i>deacon phone</strong>
    
                    <p class="text-muted">
                        {{ $item->deacon_phone}}
                   
                    </p>
    
                    <hr>
    
                    <strong><i class="fa fa-address-book mr-1"></i> Contacts</strong>
    
                    <p class="text-muted">
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




@endsection