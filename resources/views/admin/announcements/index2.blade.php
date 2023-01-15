@extends('layouts.master')

@section('title','Reports')


@section('content')


<section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        {{-- Registered Members Reports --}}
        <div class="col-lg-4 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-white">
            <div class="inner">
              <h5 class="text-center">
                {{-- <i class="fa fa-users"></i> --}}
              </h5>

              <p class="text-secondary">Registered Members Report</p>
              
            </div>
            <div class="icon text-center">
              <i class="fa fa-file-pdf text-danger"></i>
            </div>
            <br>
            <a href="" class=" mt-4 small-box-footer" type="button"  data-bs-toggle="modal" data-bs-target="#registeredModal">Generate Report <i class="fas fa-download text-primary"></i></a>
          </div>
        </div>
        {{-- Collected Payments Reports --}}
        <div class="col-lg-4 col-sm-6 col-12">
            <!-- small box -->
            <div class="small-box bg-white">
              <div class="inner">
                <h5 class="text-center">
                  {{-- <i class="fa fa-users"></i> --}}
                </h5>
  
                <p class="text-secondary">Collected Payments Report</p>
              </div>
              <div class="icon text-center">
                <i class="fa fa-dollar-sign text-danger"></i>
              </div>
              <br>
              <a href="" class="mt-4 small-box-footer" type="button"  data-bs-toggle="modal" data-bs-target="#paymentModal">Generate Report <i class="fas fa-download text-primary"></i></a>
            </div>
          </div>
        {{-- Collected Payments Reports --}}
        <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-white">
              <div class="inner">
                <h5 class="text-center">
                </h5>
  
                <p class="text-secondary">Pledges/Purpose Report</p>
              </div>
              <div class="icon text-center">
                <i class="fa fa-balance-scale text-danger"></i>
              </div>
              <br>
              <a href="" class="mt-4 small-box-footer" type="button"  data-bs-toggle="modal" data-bs-target="#pledgesModal">Generate Report <i class="fas fa-download text-primary"></i></a>
            </div>
          </div>

        {{-- Card Payments Reports --}}
        <div class="col-lg-4 col-12">
          <!-- small box -->
          <div class="small-box bg-white">
            <div class="inner">
              <h5 class="text-center">
              </h5>

              <p class="text-secondary">Pledges/Member Report</p>
            </div>
            <div class="icon text-center">
              <i class="fa fa-user-tie text-danger"></i>
            </div>
            <br>
            <a href="" class="mt-4 small-box-footer" type="button"  data-bs-toggle="modal" data-bs-target="#memberPledgesModal">Generate Report <i class="fas fa-download text-primary"></i></a>
          </div>
        </div>

        {{-- Collected Payments Reports --}}
        <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-white">
              <div class="inner">
                <h5 class="text-center">
                </h5>
  
                <p class="text-secondary">Card/Member Report</p>
              </div>
              <div class="icon text-center">
                <i class="fa fa-envelope text-danger"></i>
              </div>
              <br>
              <a href="" class="mt-4 small-box-footer" type="button"  data-bs-toggle="modal" data-bs-target="#pledgesModal">Generate Report <i class="fas fa-download text-primary"></i></a>
            </div>
          </div>

          {{-- Collected Payments Reports --}}
        <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-white">
              <div class="inner">
                <h5 class="text-center">
                </h5>
  
                <p class="text-secondary">Card/Payment Report</p>
              </div>
              <div class="icon text-center">
                <i class="fa fa-download text-danger"></i>
              </div>
              <br>
              <a href="" class="mt-4 small-box-footer" type="button"  data-bs-toggle="modal" data-bs-target="#cardPaymentModal">Generate Report <i class="fas fa-download text-primary"></i></a>
            </div>
          </div>

          <div class="col-m-12">
            <hr class="bg-primary font-weight-bolder">
          </div>
      </div>
    </div>
</section>
    

{{-- Register Member modal --}}
<div class="modal fade" id="paymentModal" tabindex="-1" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ url('admin/collected-payments') }}" method="GET">
            @csrf
    
            <div class="mb-3">
            <h5 class="text-secondary">
                Generate Collected Payments Report From the Given Start Date To the given End Date
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
                    <option value="created_at">Collected Date</option>
                    <option value="user_id">Payer</option>
                    <option value="pledge_id">Purpose</option>
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
          <form action="{{ url('admin/pledges-purposes') }}" method="GET">
            @csrf
    
            <div class="mb-3">
            <h5 class="text-secondary">
                Generate Pledges Per Purpose Report From the Given Start Date To the given End Date
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
                <select name="sort_by" id="sort_by">
                    <option value="created_at">Created Date</option>
                    <option value="user_id">Member</option>
                    <option value="purpose_id">Purpose</option>
                    <option value="type_id">Pledge Type</option>
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
          <form action="{{ url('admin/member-pledges') }}" method="GET">
            @csrf
    
            <div class="mb-3">
            <h5 class="text-secondary">
                Generate Pledges Per Member Report From the Given Start Date To the given End Date
            </h5>
            </div>
            @php
            $member= App\Models\User::where('role','member')->get();
            @endphp
            <div class="mb-3">
                <label for="" class="text-secondary">Choose Member</label>
                <select name="user_id" id="user_id" class="form-control">
                    <option value="">--Select Member Here --</option>
                    @foreach ( $member as $item)
                    <option value="{{ $item->id}}">{{ $item->fname}} {{ $item->mname}} {{ $item->lname}} </option>
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
                    <option value="purpose_id">Purpose</option>
                    <option value="type_id">Pledge Type</option>
                    <option value="status">Pledge Status</option>
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