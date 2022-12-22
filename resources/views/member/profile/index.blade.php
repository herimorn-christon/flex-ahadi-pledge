@extends('layouts.member')

@section('title','All Communities')


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
  
        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#types">
            <i class="fa fa-cog"></i>
             Edit Profile
        </button>
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>

<div class="card mt-1">
    <div class="card-header bg-light">
        <h6 class="text-light">
          
        </h6>
    </div>
    <div class="card-body">




        <div class="row">
            <div class="col-md-12 mx-auto">

                <!-- Profile Image -->
           
                    <div class="text-center">
                      <img class="profile-user-img img-fluid img-circle"
                           src="../../dist/img/user4-128x128.jpg"
                           alt="User profile picture">
                    </div>
                    @foreach($profile as $item)
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
                      B.S. in Computer Science from the University of Tennessee at Knoxville
                    </p>
    
                    <hr>
    
                    <strong><i class="fas fa-users mr-1"></i> Community (Jumuiya)</strong>
    
                    <p class="text-muted">{{ $item->community->name}}</p>
    
                    <hr>
    
                    <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
    
                    <p class="text-muted">
                      <span class="tag tag-danger">UI Design</span>
                      <span class="tag tag-success">Coding</span>
                      <span class="tag tag-info">Javascript</span>
                      <span class="tag tag-warning">PHP</span>
                      <span class="tag tag-primary">Node.js</span>
                    </p>
    
                    <hr>
    
                    <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
    
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>

        </div>


        @endforeach
    </div>
</div>




@endsection