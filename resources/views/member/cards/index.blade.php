@extends('layouts.member')

@section('title','My Cards')


@section('content')


<div class="card  p-1 border-left-flex">
  <div class="row mb-1 mx-1">
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><img src="{{asset('icons/sigma.png')}}"/></span>
  
          <div class="info-box-content">
            <span class="info-box-text">Total Card Payments Made in {{ date('Y')}}</span>
            <span class="info-box-number" id="card-payments">
          
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><img src="{{asset('icons/debit-card.png')}}"/></span>
  
          <div class="info-box-content">
            <span class="info-box-text">Current Card Member </span>
            <span class="info-box-number" id="current-card">
          
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
  
      <!-- /.col -->
    </div>
  {{-- start of statistics --}}
{{-- <div class="">
  <div class="row starts-border  mt-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Card Payments Made in {{ date('Y')}} </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="card-payments"></h6></div>
  </div>
  <div class="row starts-border mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Current Card Member </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="current-card"></h6></div>
  </div>
  

</div> --}}
{{-- end of statistics --}}
    <div class="col-sm-5" id="alert-div">
      @if (session('status'))
      <div class="alert alert-success"  role="alert">
          {{ session('status') }}
      </div>
      @endif
      
    </div><!-- /.col -->
    <div class="col-sm-7">
      @php
      $member_status=Auth::user()->status;
      //dd($member_status);
       @endphp
       @if ($member_status=='0')
      <ul class="float-sm-right" type="none">
        <li class="">  
          <form action="{{ url('member/request-card') }}" method="post">
            @csrf 
                <input type="text" name="user_id" value="{{ Auth::User()->id; }}" hidden>
                 
        
          <button  type="submit"  class="btn bg-flex text-light  btn-sm mb-1" >
            <i class="fa fa-envelope"></i>
             Request New Card
        </button>
        <a href="{{ route('show_cards') }}" class="btn btn-sm bg-cyan mb-1">
          <i class="fa fa-file-pdf"></i>
          Generate Report
        </a>
      </form> 
    </li>
       
      </ul>
      @endif
    </div><!-- /.col -->
  </div>
</div>

<div class="card mt-1">
    <div class="mt-2">

        <div class="responsive mx-1 mt-2">
            <table id="example1" class="table table-bordered cell-border">
                <thead>
                    <tr class="text-secondary">
                        <th>SN</th>
                        <th>Card Number</th>
                        <th>Status</th>
                        <th>Issued Date</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody id="members-table-body">
   
  
                </tbody>
            </table>
  
        </div>


  {{-- start of single card modal --}}
  @include('member.cards.single-card-modal')
  {{-- end of single card modal --}}

  {{-- start of ajax fetch all member cards --}}
  @include('member.cards.ajax-fetch-all-cards-method')
  {{-- end of ajax fetch all member cards --}}

  {{-- start of ajax fetch member card details --}}
  @include('member.cards.ajax-fetch-card-details')
  {{-- end of ajax fetch member card details --}}

@endsection