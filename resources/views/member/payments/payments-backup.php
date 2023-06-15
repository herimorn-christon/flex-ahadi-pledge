@extends('layouts.member')

@section('title','My Payments')


@section('content')



<div class="card  p-1 border-left-flex">
  <div class="row mx-1 mb-1">

  {{-- start of statistics --}}
  <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon elevation-1"><img src="{{asset('icons/sigma.png')}}"/></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Pledges Made in {{ date('Y')}} </span>
          <span class="info-box-number" id="total-pledges">
        
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon elevation-1">
          <img src="{{asset('icons/money_sum.png')}}"/>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">Total Pledge Payments Made in {{ date('Y')}}</span>
          <span class="info-box-number"  id="total-payments" > </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
   
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon  elevation-1">
          <img src="{{asset('icons/coins.png')}}"/>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">Remaining Pledge Payments in {{ date('Y')}}</span>
          <span class="info-box-number"  id="remaining-payment"> </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon  elevation-1">
          <img src="{{asset('icons/high.png')}}"/>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">Highest Pledge Payments in {{ date('Y')}}</span>
          <span class="info-box-number"  id="highest"> </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon  elevation-1">
          <img src="{{asset('icons/less-than.png')}}"/>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">Lowest Payments Made in {{ date('Y')}} </span>
          <span class="info-box-number"  id="lowest"> 
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <!-- /.col -->
  </div>



{{-- <div class="">
  <div class="row starts-border mt-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Pledge Amount Made in {{ date('Y')}} </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="total-pledges"> </h6></div>
  </div> 

  <div class="row starts-border mt-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Pledge Payments Made in {{ date('Y')}} </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="total-payments"> </h6></div>
  </div>

  <div class="row starts-border mt-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Remaining Pledge Payments in {{ date('Y')}} </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="remaining-payment"> </h6></div>
  </div>

  <div class="row starts-border mt-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Highest Pledge Payments in {{ date('Y')}} </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="highest"> </h6></div>
  </div>

  <div class="row starts-border mt-2 mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Lowest Payments Made in {{ date('Y')}} </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="lowest"> </h6></div>
  </div>

</div> --}}
{{-- end of statistics --}}
    <div class="col-sm-6" id="alert-div">
      @if (session('status'))
      <div class="alert disabled" style="background-color: rgb(198, 253, 216)" role="alert">
          {{ session('status') }}
      </div>
      @endif
    </div><!-- /.col -->
    <div class="col-sm-6">
      @php
      $member_status=Auth::user()->status;
      //dd($member_status);
       @endphp
       @if ($member_status=='0')
      <ul class="float-sm-right" type="none">
        <li class=""> 
    
        <button type="button" class="btn bg-flex text-light btn-sm mb-1" data-toggle="modal" onclick="showAllMethods()">
            <i class="fa fa-list"></i>
            Available Payment Methods
        </button>
        {{-- start of register payment button --}}
        <button type="button" class="btn bg-flex text-light btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
        {{-- <button type="button" class="btn bg-flex text-light btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal"> --}}
            <i class="fa fa-plus"></i>
            Add Payment
        </button>   
            {{-- end of register payment button --}}
        <a href="{{ route('view_payment') }}" class="btn btn-sm bg-cyan mb-1" >
          <i class="fa fa-file-pdf"></i>
          Generate Report
        </a>
     
    </li>
       
      </ul>
      @endif
    </div><!-- /.col -->
  </div>
</div>
<div class="card ">
 

        <div class="  p-1">
            <table id="example1"  class="table table-bordered   cell-border">
                <thead>
                     <tr class="text-secondary">
                        <th>SN</th>
                        <th>Payment Date</th>
                        <th>Method</th>
                        <th>Purpose</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="projects-table-body">
          
  
                </tbody>
            </table>
    </div>
</div>




    {{-- start of ajax register pledge method --}}
    @include('admin.payments.single-payment-modal')
    {{-- end of ajax register pledge method --}}

  
    {{-- start register pledge type modal --}}
    @include('member.payments.register-method-modal')
    {{-- end of register pledge type modal --}}

    {{-- start of ajax register pledge method --}}
    @include('admin.payments.ajax-register-method')
    {{-- end of ajax register pledge method --}}

    {{-- start of ajax fetch all payments --}}
    @include('member.payments.ajax-fetch-all-payments')
    {{-- end of ajax fetch all payments --}}

    {{-- start of ajax fetch single payment detail --}}
    @include('member.payments.ajax-fetch-payments-details')
    {{-- end of ajax fetch single payment detail --}}

    {{-- start of ajax fetch all methods --}}
    @include('member.payments.ajax-fetch-all-methods')
    {{-- end of ajax fetch all methods --}}

     {{-- star all payment methods modal --}}
     @include('member.payments.all-payment-methods-modal')
     {{-- end all payment methods modal --}}

    {{-- start register payment modal --}}
    @include('member.payments.register-payment-modal')
    {{-- end of register  payment modal --}}
     
    {{-- start of ajax update  payment method --}}
    @include('member.payments.ajax-register-payment')
    {{-- end of ajax update  payment method --}}
  
@endsection