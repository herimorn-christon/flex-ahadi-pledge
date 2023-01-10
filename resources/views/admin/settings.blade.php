@extends('layouts.master')

@section('title','System Settings')


@section('content')


<section class="content">
    
      <!-- Small boxes (Stat box) -->
      <div class="row">
     
        <div class="col-md-12">
          <div class="card">
            <div class="card-header p-2 bg-white">
              <ul class="nav nav-tabs nav-light">
                <li class="nav-item">
                  <a class="nav-link text-navy active" href="#interface"  data-toggle="tab">System Settings</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-navy" href="#audits"  data-toggle="tab">System Audits</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-navy" href="#announcements" data-toggle="tab" >Announcements</a>
                </li>
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
                                      <select name="nav_bar" id="" class="form-control bg-light">
                                        <option value="">Light and Light Theme</option>
                                        <option value="">Light and Blue Theme</option>
                                        <option value="">Dark and Blue Theme</option>
                                        <option value="">Dark and Info Theme</option>
                                       
                                      </select>
                                     
                                  </div>
                                  <div class="mb-3">
                                    <label for="" class="text-secondary">Sidebar Theme</label>
                                    <select name="nav_bar" id="" class="form-control bg-light">
                                      <option value="">Light and Light Theme</option>
                                      <option value="">Light and Blue Theme</option>
                                      <option value="">Dark and Blue Theme</option>
                                      <option value="">Dark and Info Theme</option>
                                     
                                    </select>
                                   
                                </div>
                                <hr>
                                  <div class="row">
                                    
                                      <div class="col-md-9"></div>
                                      <div class="col-md-3 ">
                                          <button class="btn bg-navy btn-block float-end" type="submit">
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
                  <div class="p-2">
                    <table id="example1"  class="table table-bordered cell-border">
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
                  </div>
              
            
                {{-- end of pledges --}}
              
                 
               
              
              
              </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="announcements">

               
                  {{-- start of cards --}}

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