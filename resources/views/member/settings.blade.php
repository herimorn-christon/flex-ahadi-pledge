@extends('layouts.member')

@section('title','My Settings')


@section('content')

<style>
        .active {
            color: green !important;
        }
</style>
<section class="content">
    
      <!-- Small boxes (Stat box) -->
      <div class="row">
    
        <div class="col-md-12">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item active"><a class="nav-link bg-light " href="#interface" data-toggle="tab" >Change Password</a></li>
                <li class="nav-item"><a class="nav-link  bg-light " href="#audits" data-toggle="tab">Notifications</a></li>
                <li class="nav-item"><a class="nav-link bg-light" href="#announcements" data-toggle="tab">Announcements</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="">
              <div class="tab-content">
                <div class="active tab-pane" id="interface">
                  {{-- start of interface settings --}}
                  
                    <div class="col-md-12">
                      <div class="p-2">
                        
                          <div class="">
                               {{--displaying all the errors  --}}
                               @if ($errors->any())
                               <div class="alert alert-danger">
                                   @foreach ($errors->all() as $error)
                                       <div>{{$error}}</div>
                                   @endforeach
                               </div>
                               @endif
                              <form action="{{ url('member/change-password') }}" method="post"  enctype="multipart/form-data" >
                                  @csrf
                                  <div class="mb-3">
                                      <label for="" class="text-secondary">Current Password</label>
                                      <input name="current_password" placeholder="Enter Current Password" type="text" class="form-control">
                                  </div>
                                  <div class="mb-3">
                                    <label for="" class="text-secondary">New Password</label>
                                    <input name="password1" placeholder="Enter New Password" type="text" class="form-control">
                                  </div>
                                  <div class="mb-3">
                                    <label for="" class="text-secondary">Confirm New Password</label>
                                    <input name="password2"  type="text" placeholder="Re-enter Current Password" class="form-control">
                                  </div>                                
                                   
                                <hr>
                                  <div class="row">
                                    
                                      <div class="col-md-6"></div>
                                      <div class="col-md-6 ">
                                          <button class="btn bg-navy btn-block float-end" type="submit">
                                            <i class="fa fa-key"></i>
                                            Change Password
                                          </button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
                  

                  {{-- end of interface settings --}}
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="audits">
               
         
                 
               
              
              
              </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="announcements">

               
                  {{-- start of cards --}}

                  <table  class="table table-bordered ">
                      <thead>
                          <tr class="text-secondary">
                              <th>ID</th>
                              <th>Card Number</th>
                              <th>Status</th>
                              {{-- <th>Actions</th> --}}
                          </tr>
                      </thead>
                      <tbody id="cards-table-body">

        
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
   
</section>
    
{{-- Register Member modal --}}
<div class="modal fade" id="registeredModal" tabindex="-1" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ url('admin/registered-members') }}" method="GET">
            @csrf
    
            <div class="mb-3">
            <h5 class="text-secondary">
                Generate Registered Member Report From the Given Start Date To the given End Date
            </h5>
            </div>
            <div class="mb-3">
              <label for="message-text" class="text-secondary">From Date:</label>
               <input type="date" class="form-control" id="from_date" name="from_date" placeholder="Enter Start Date">
            </div>
            <div class="mb-3">
              <label for="message-text" class="text-secondary">To Date:</label>
               <input type="date" class="form-control" id="to_date" name="to_date" placeholder="Enter End Date">
            </div>
            <div class="mb-3">
                <label for="message-text" class="text-secondary">Sort By:</label>
                <select name="sort_by" id="sort_by">
                    <option value="created_at">Registered Date</option>
                    <option value="fname">First Name</option>
                    <option value="date_of_birth">Birthdate</option>
                </select>
              </div>
            <div class="row">
              <div class="col-md-6">
  
              </div>
              <div class="mb-3 col-md-6">
                 <button type="submit" class="btn btn-primary btn-block " id="save-purpose-btn">
                  <i class="fa fa-download"></i>
                  Download Report
                </button>
              </div>
            </div>
  
       
          </form>
        </div>
      </div>
    </div>
  </div>
  


  


  @endsection