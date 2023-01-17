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
            <div class="card-header p-2 bg-white">
              <ul class="nav nav-tabs nav-light">
                <li class="nav-item">
                  <a class="nav-link text-navy active" href="#interface"  data-toggle="tab">Pledges Report</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-navy" href="#audits"  data-toggle="tab">Payments Report</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-navy" href="#announcements"  data-toggle="tab">Cards Report</a>
                </li>
              </ul>
            </div><!-- /.card-header -->
            <div class="">
              <div class="tab-content">
                <div class="active tab-pane" id="interface">
                  {{-- start of interface settings --}}
                  
                    <div class="col-md-9 mx-auto">
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
                               <form action="{{ url('member/pledges-report') }}" method="GET">
                                @csrf
                                <div class="mb-3 row">
                                <div class="mb-3 ">
                                <h5 class="text-secondary text-center">
                                    <small>
                                        Generate a Report about Pledges that you made in a given period by filling the fields below.
                                    </small>  
                                </h5>
                                </div>
                                <div class="mb-3 col-md-6">
                                  <label for="" class="text-secondary">From Date:</label>
                                   <input type="date" class="form-control" id="from_date" name="from_date" placeholder="Enter Start Date">
                                </div>
                                <div class="mb-3 col-md-6">
                                  <label for="message-text" class="text-secondary">To Date:</label>
                                   <input type="date" class="form-control" id="to_date" name="to_date" placeholder="Enter End Date">
                                </div>
                                <div class="mb-3 form-group col-md-6">
                                    <label for="message-text" class="text-secondary">Sort By:</label>
                                    <select name="sort_by" id="sort_by" class="bg-light text-navy form-control">
                                        <option value="name">Pledge Name</option>
                                        <option value="purpose">Pledge Purpose</option>
                                        <option value="type_id">Pledge Type</option>
                                        <option value="created_at">Created Date</option>
                                        <option value="status">Status</option>
                                      
                                    </select>
                                  </div>
                                <div class="row">
                                  <div class="col-md-9">
                      
                                  </div>
                                  <div class="mb-3 col-md-3">
                                     <button type="submit" class="btn bg-flex text-light btn-block " id="save-purpose-btn">
                                      <i class="fa fa-download"></i>
                                      Download Report
                                    </button>
                                  </div>
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
                                <form action="{{ url('member/pledges-payment-report') }}" method="GET">
                                    @csrf
                            
                                    <div class="mb-3">
                                    <h5 class="text-secondary">
                                        <small>
                                            Generate Pledge Payments Made Report From the Given Start Date To the given End Date
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
                                        <select name="sort_by" id="sort_by" class="form-control bg-light text-navy">
                                            <option value="created_at">Collected Date</option>
                                            <option value="pledge_id">Purpose</option>
                                            <option value="type_id">Payment Method</option>
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
                             <form action="{{ url('member/cards-payment-report') }}" method="GET">
                                @csrf
                        
                                <div class="mb-3">
                                <h5 class="text-secondary">
                                    <small>
                                        Generate Card Payments Made Report From the Given Start Date To the given End Date
                                    </small>
                                </h5>
                                </div>
                                @php
                                $user=Auth::User()->id;
                                $purpose= App\Models\CardMember::where('user_id',$user)
                                                                ->orderBy('created_at')
                                                                ->get();
                                @endphp
                                <div class="mb-3">
                                    <label for="" class="text-secondary">Choose Your Card</label>
                                    <select name="card_no" id="card_no" class="form-control bg-light text-navy">
                                        <option value="">--Select Card --</option>
                                        @foreach ( $purpose as $item)
                                        <option value="{{ $item->id}}">{{ $item->card->card_no}} / {{ $item->user_id }}   </option>
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
                                    <select name="sort_by" id="sort_by" class="bg-light text-navy form-control">
                                        <option value="created_at">Created Date</option>
                                        <option value="amount">Amount Paid</option>
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