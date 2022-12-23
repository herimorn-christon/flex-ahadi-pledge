@extends('layouts.master')

@section('title','My Profile')


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





        <div class="row">
            <div class="col-md-12 mx-auto">

 
                
                <!-- /.card -->
    
                <!-- About Me Box -->
                <div class="card card-light">
                  <div class="card-header">
                    <h5 class="card-title">About Member</h5>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                                           <!-- Profile Image -->
           
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="{{ asset('img/user.png') }}"
                             alt="User profile picture">
                      </div>
                      @foreach($user as $item)
                      <h5 class=" text-center">
                         {{ $item->fname}} {{ $item->mname}} {{ $item->lname}}
                      </h5>
      
                      <p class="text-muted text-center">ID: {{ $item->community->abbreviation }}/{{ $item->id }}</p>
                 
                        </div>
                        <div class="col-md-10">
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
            
                            <strong><i class="fa fa-address-book mr-1"></i> Contacts</strong>
            
                            <p class="text-muted">
                                {{ $item->phone}}
                           <br>
                                {{ $item->email}}
                            </p>
                        </div>
                    </div>
       
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>

        


        @endforeach

        <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#pledges" data-toggle="tab">Payments</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Pledges</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Cards</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="pledges">
                    {{-- start of member payments --}}
                    <table id="mytable"  class="table table-bordered responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Payment Date</th>
                                <th>Payment Purpose</th>
                                <th>Amount</th>
                                <th>Method</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->purpose->title }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ $item->payment->name }}</td>
                             
                            </tr>
                            @endforeach
          
                        </tbody>
                    </table>
        
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                 
                    {{-- start of pledges --}}
 
                    <table id="mytable"  class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pledge Name</th>
                                <th>Amount</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pledges as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ $item->deadline }}</td>
                                <td class="text-success">{{ $item->status=='1'? 'Inactive':'Active' }}</td>
            
                                <td>
                                   <a href="{{ url('admin/view-pledge/'.$item->id)}}" class="btn btn-primary btn-sm mx-1">
                                      <i class="fa fa-eye" aria-hidden="true"></i>
                                   </a>
                                    <a href="{{ url('admin/edit-pledge/'.$item->id)}}" class="btn btn-secondary btn-sm mx-1">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
            
                        </tbody>
                     </table>
                    {{-- end of pledges --}}
                 
                
                
                </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">

                 
                    {{-- start of pledges --}}
 
                    <table id="datatablesSimple" class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Card Number</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cards as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->card->card_no }}/{{ $item->user->community->abbreviation }}/{{ $item->user->id }}</td>
                                <td class="text-success">{{ $item->status=='1'? 'Inactive':'Active' }}</td>
          
                                <td>
                                    <a href="{{ url('admin/edit-card/'.$item->id)}}" class="btn btn-primary btn-sm mx-1">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ url('admin/delete-card/'.$item->id)}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
          
                        </tbody>
                    </table>
                    {{-- end of pledges --}}
                 
                
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
    
    </div>


@endsection