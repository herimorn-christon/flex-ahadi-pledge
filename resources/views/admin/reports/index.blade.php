@extends('layouts.master')

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
            <div class="card-header p-2 bg-white">
              <ul class="nav nav-pills nav-light">
                <li class="nav-item active"><a class="nav-link bg-light nav-white " href="#interface" data-toggle="tab" >Members Report</a></li>
                <li class="nav-item"><a class="nav-link bg-light nav-light " href="#audits" data-toggle="tab">Payments Report</a></li>
                <li class="nav-item"><a class="nav-link bg-light nav-light" href="#announcements" data-toggle="tab">Purpose Report</a></li>
                <li class="nav-item"><a class="nav-link bg-light nav-light" href="#cards" data-toggle="tab">Card Payments Report</a></li>
                <li class="nav-item"><a class="nav-link bg-light nav-light" href="#announcements" data-toggle="tab">Member Pledges Report</a></li>
              </ul>
              {{-- <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link " href="#interface"  data-toggle="tab">Active</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#audits"  data-toggle="tab">Link</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#">Disabled</a>
                </li>
              </ul> --}}
            </div>
            <!-- /.card-header -->
            <div class="">
              <div class="tab-content">
                <div class="active tab-pane" id="interface">
                  {{-- start of interface settings --}}
                  
                    <div class="col-md-12">
                      <div class="p-2">
                        
                          <div class="col-md-12">
                            @if (session('status'))
                            <div class="btn btn-danger disabled btn-block"  role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                               {{--displaying all the errors  --}}
                               @if ($errors->any())
                               <div class="alert alert-danger">
                                   @foreach ($errors->all() as $error)
                                       <div>{{$error}}</div>
                                   @endforeach
                               </div>
                               @endif
                               <form action="{{ url('admin/registered-members') }}" method="GET">
                                @csrf
                        
                                <div class="mb-3">
                                <h5 class="text-secondary">
                                    <small>
                                        Generate Registered Member Report From the Given Start Date To the given End Date
                                    </small>
                                 
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
                                    <select name="sort_by" id="sort_by" class="form-control bg-light">
                                        <option value="created_at">Registered Date</option>
                                        <option value="fname">First Name</option>
                                        <option value="date_of_birth">Birthdate</option>
                                    </select>
                                  </div>
                                <div class="row">
                                  <div class="col-md-9">
                      
                                  </div>
                                  <div class="mb-3 col-md-3">
                                     <button type="submit" class="btn bg-navy btn-block " id="save-purpose-btn">
                                      <i class="fa fa-download"></i>
                                      Download Report
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
                    <div class="col-md-12">
                        <div class="p-2">
                          
                            <div class="col-md-12">
                                <form action="{{ url('admin/collected-payments') }}" method="GET">
                                    @csrf
                            
                                    <div class="mb-3">
                                    <h5 class="text-secondary">
                                        <small>
                                            Generate Collected Payments Report From the Given Start Date To the given End Date
                                        </small>
                                       
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
                                        <select name="sort_by" id="sort_by" class="form-control bg-light">
                                            <option value="created_at">Collected Date</option>
                                            <option value="user_id">Payer</option>
                                            <option value="pledge_id">Purpose</option>
                                        </select>
                                      </div>
                                    <div class="row">
                                      <div class="col-md-9">
                          
                                      </div>
                                      <div class="mb-3 col-md-3">
                                         <button type="submit" class="btn bg-navy btn-block " id="save-purpose-btn">
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
                <!-- /.tab-pane -->

                <div class="tab-pane" id="announcements">

               
                  {{-- start of report form --}}

                  <div class="col-md-12">
                    <div class="p-2">
                      
                        <div class="col-md-12">
                          @if (session('status'))
                          <div class="btn btn-danger disabled btn-block"  role="alert">
                              {{ session('status') }}
                          </div>
                          @endif
                             {{--displaying all the errors  --}}
                             @if ($errors->any())
                             <div class="alert alert-danger">
                                 @foreach ($errors->all() as $error)
                                     <div>{{$error}}</div>
                                 @endforeach
                             </div>
                             @endif
        <form action="{{ url('admin/pledges-purposes') }}" method="GET">
            @csrf
    
            <div class="mb-3">
            <h5 class="text-secondary">
                <small>
                    Generate Pledges Per Purpose Report From the Given Start Date To the given End Date
                </small>
                
            </h5>
            </div>
            @php
            $purpose= App\Models\Purpose::get();
            @endphp
            <div class="mb-3">
                <label for="" class="text-secondary">Choose Purpose</label>
                <select name="purpose_id" id="purpose_id" class="form-control">
                    <option value="">--Select Purpose --</option>
                    @foreach ( $purpose as $item)
                    <option value="{{ $item->id}}">{{ $item->title}} </option>
                    @endforeach
                </select>
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
                <select name="sort_by" id="sort_by" class="form-control bg-light">
                    <option value="created_at">Created Date</option>
                    <option value="user_id">Member</option>
                    <option value="purpose_id">Purpose</option>
                    <option value="type_id">Pledge Type</option>
                </select>
              </div>
            <div class="row">
              <div class="col-md-9">
  
              </div>
              <div class="mb-3 col-md-3">
                 <button type="submit" class="btn bg-navy btn-block " id="save-purpose-btn">
                  <i class="fa fa-download"></i>
                  Download Report
                </button>
              </div>
            </div>
  
       
          </form>
                        </div>
                    </div>
                </div>
                
                  {{-- end of report form --}}
               
              
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