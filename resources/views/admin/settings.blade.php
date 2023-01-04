@extends('layouts.master')

@section('title','System Settings')


@section('content')


<section class="content">
    
      <!-- Small boxes (Stat box) -->
      <div class="row">
     
        <div class="col-md-12">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#interface" data-toggle="tab">System Settings</a></li>
                <li class="nav-item"><a class="nav-link" href="#audits" data-toggle="tab">System Audits</a></li>
                <li class="nav-item"><a class="nav-link" href="#announcements" data-toggle="tab">Announcements</a></li>
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
                              <form action="{{ url('admin/settings') }}" method="post"  enctype="multipart/form-data" >
                                  @csrf
                                  <div class="mb-3">
                                      <label for="" class="text-secondary">System Name</label>
                                      <input name="system_name"  type="text" class="form-control">
                                  </div>
                                   <div class="mb-3">
                                      <label for="" class="text-secondary">System Logo</label>
                                      <input name="logo" type="file" class="form-control">
                              
                                  </div>
                                  <div class="mb-3">
                                      <label for="" class="text-secondary">System Favicon</label>
                                      <input name="favicon" type="file" class="form-control">
                                      
                                      <img src="" width="20px" height="20px">
                                      
                                  </div>
                                  <div class="mb-3">
                                    <label for="" class="text-secondary">Landing Page Image</label>
                                    <input name="favicon" type="file" class="form-control">
                                    
                                    <img src="" width="20px" height="20px">
                                    
                                  </div>
                                  <div class="mb-3">
                                      <label for="" class="text-secondary">Navbar Theme</label>
                                      <select name="nav_bar" id="" class="form-control">
                                        <option value="">Light and Light Theme</option>
                                        <option value="">Light and Blue Theme</option>
                                        <option value="">Dark and Blue Theme</option>
                                        <option value="">Dark and Info Theme</option>
                                       
                                      </select>
                                     
                                  </div>
                                  <div class="mb-3">
                                    <label for="" class="text-secondary">Sidebar Theme</label>
                                    <select name="nav_bar" id="" class="form-control">
                                      <option value="">Light and Light Theme</option>
                                      <option value="">Light and Blue Theme</option>
                                      <option value="">Dark and Blue Theme</option>
                                      <option value="">Dark and Info Theme</option>
                                     
                                    </select>
                                   
                                </div>
                                <hr>
                                  <div class="row">
                                    
                                      <div class="col-md-6"></div>
                                      <div class="col-md-6 ">
                                          <button class="btn btn-primary btn-block float-end" type="submit">
                                            <i class="fa fa-save"></i>
                                            Save Settings
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
               
                  {{-- start of pledges --}}
              
                  <table id="my_table"  class="table table-bordered responsive">
                    <thead>
                        <tr class="text-secondary">
                            <th>ID</th>
                            <th>User</th>
                            <th>User Agent</th>
                            <th>Event</th>
                            <th>IP Address</th>
                            <th>Url</th>
                            <th>Audit Type</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody id="pledges-table-body">
                      @php

                      $user=Auth::user()->id;
                      $audits=App\Models\Audit::orderBy('created_at','DESC')->get();
                      @endphp
                      @foreach ($audits as $item)
                      <tr>
                      <td>{{$item->id}}</td>
                      <td>{{$item->user_id}}</td>
                      <td>{{$item->user_agent}}</td>
                      <td>{{$item->event}}</td>
                      <td>{{$item->ip_address}}</td>
                      <td>{{$item->url}}</td>
                      <td>{{$item->auditable_type}}</td>
                      <td>{{$item->created_at}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                 </table>
                {{-- end of pledges --}}
              
                 
               
              
              
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