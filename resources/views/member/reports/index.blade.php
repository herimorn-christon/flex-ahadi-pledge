@extends('layouts.member')

@section('title','My Reports')


@section('content')


<section class="content">
    <div class="">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        {{-- Registered Members Reports --}}
        <div class="col-lg-6 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-white">
            <div class="inner">
              <h5 class="text-center">
                {{-- <i class="fa fa-users"></i> --}}
              </h5>

              <p class="text-navy font-weight-bolder">Pledges Report</p>
              <small class="text-secondary">This is ....</small>
            </div>
            <div class="icon text-center">
              <i class="fa fa-balance-scale text-teal"></i>
             
            </div>
            <br>
            <a href="" class=" mt-4 small-box-footer" type="button"  data-bs-toggle="modal" data-bs-target="#registeredModal">Generate Report <i class="fas fa-download text-navy"></i></a>
          </div>
        </div>
        {{-- Collected Payments Reports --}}
        <div class="col-lg-6 col-sm-6 col-12">
            <!-- small box -->
            <div class="small-box bg-white">
              <div class="inner">
                <h5 class="text-center">
                  {{-- <i class="fa fa-users"></i> --}}
                </h5>
                <p class="text-navy font-weight-bolder">Payments Report</p>
                <small class="text-secondary">This is ....</small>
              </div>
              <div class="icon text-center">
                <i class="fa fa-file-pdf text-teal"></i>
              </div>
              <br>
              <a href="" class="mt-4 small-box-footer" type="button"  data-bs-toggle="modal" data-bs-target="#paymentModal">Generate Report <i class="fas fa-download text-navy"></i></a>
            </div>
          </div>
        {{-- Collected Payments Reports --}}
        <div class="col-lg-6 col-12">
            <!-- small box -->
            <div class="small-box bg-white">
              <div class="inner">
                <h5 class="text-center">
                </h5>
                <p class="text-navy font-weight-bolder">Card Payment Reports</p>
                <small class="text-secondary">This is ....</small>
              </div>
              <div class="icon text-center">
                <i class="fa fa-envelope text-teal"></i>
              </div>
              <br>
              <a href="" class="mt-4 small-box-footer" type="button"  data-bs-toggle="modal" data-bs-target="#pledgesModal">Generate Report <i class="fas fa-download text-navy"></i></a>
            </div>
          </div>

        {{-- Card Payments Reports --}}
        <div class="col-lg-6 col-12">
          <!-- small box -->
          <div class="small-box bg-white">
            <div class="inner">
              <h5 class="text-center">
              </h5>

              <p class="text-navy font-weight-bolder">Contributions Reports</p>
              <small class="text-secondary">This is ....</small>
            </div>
            <div class="icon text-center">
              <i class="fa fa-download text-teal"></i>
            </div>
            <br>
            <a href="" class="mt-4 small-box-footer" type="button"  data-bs-toggle="modal" data-bs-target="#memberPledgesModal">Generate Report <i class="fas fa-download text-navy"></i></a>
          </div>
        </div>

       
          <div class="col-m-12">
            <hr class="bg-primary font-weight-bolder">
          </div>
      </div>
    </div>
</section>
    
{{-- Register Member modal --}}
<div class="modal fade" id="registeredModal" tabindex="-1" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h6 class="modal-title" id="exampleModalLabel">
            <i class="fa fa-file-pdf text-danger"></i>
            My Pledges Report
          </h6>
          <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ url('member/pledges-report') }}" method="GET">
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
                <select name="sort_by" id="sort_by" class="bg-navy text-light form-control">
                    <option value="name">Pledge Name</option>
                    <option value="purpose">Pledge Purpose</option>
                    <option value="type_id">Pledge Type</option>
                    <option value="created_at">Created Date</option>
                    <option value="status">Status</option>
                  
                </select>
              </div>
            <div class="row">
              <div class="col-md-6">
  
              </div>
              <div class="mb-3 col-md-6">
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
  

{{-- Pleges Payment modal --}}
<div class="modal fade" id="paymentModal" tabindex="-1" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
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
                <select name="sort_by" id="sort_by" class="form-control bg-navy text-white">
                    <option value="created_at">Collected Date</option>
                    <option value="pledge_id">Purpose</option>
                    <option value="type_id">Payment Method</option>
                </select>
              </div>
            <div class="row">
              <div class="col-md-6">
  
              </div>
              <div class="mb-3 col-md-6">
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
  


  {{-- card payment modal --}}

  <div class="modal fade" id="cardPaymentModal" tabindex="-1" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ url('admin/card-payments') }}" method="GET">
            @csrf
    
            <div class="mb-3">
            <h5 class="text-secondary">
                Generate Card Payments Report From the Given Start Date To the given End Date
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
                    <option value="created_at">Payment Date</option>
                    <option value="card_member">Member Card</option>
                    <option value="amount">Amount</option>
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
  


  {{-- Pledges/Purpose modal --}}

  <div class="modal fade" id="pledgesModal" tabindex="-1" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
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
                <select name="card_no" id="card_no" class="form-control bg-navy text-white">
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
                <select name="sort_by" id="sort_by">
                    <option value="created_at">Created Date</option>
                    <option value="amount">Amount Paid</option>
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
  

  {{-- Member Pledges Modal --}}

  <div class="modal fade" id="memberPledgesModal" tabindex="-1" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ url('admin/purpose-payment-report') }}" method="GET">
            @csrf
    
            <div class="mb-3">
            <h5 class="text-secondary">
                <small>
                    Generate Contribution by purpose Report From the Given Start Date To the given End Date
                </small>     
            </h5>
            </div>
            @php
            $member= App\Models\Purpose::get();
            @endphp
            <div class="mb-3">
                <label for="" class="text-secondary">Choose Contribution Purpose</label>
                <select name="user_id" id="user_id" class="form-control bg-navy text-white">
                    <option value="">-- Choose Contribution Purpose Here --</option>
                    @foreach ( $member as $item)
                    <option value="{{ $item->id}}">{{ $item->title}}  </option>
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
                <select name="sort_by" id="sort_by" class="form-control bg-navy text-white">
                    <option value="created_at">Created Date</option>
                    <option value="type_id">Pledge Type</option>
                    <option value="status">Pledge Status</option>
                </select>
              </div>
            <div class="row">
              <div class="col-md-6">
  
              </div>
              <div class="mb-3 col-md-6">
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

  @endsection