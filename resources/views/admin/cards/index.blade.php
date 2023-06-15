@extends('layouts.master')

@section('title','Manage Cards')

@section('content')


<div class="card p-2">
<div class="row mb-1">
  {{-- start of statistics --}}
  <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon elevation-1"><i class="fas fa-credit-card"></i> <i class="fas fa-layer-group"></i></span>

        <div class="info-box-content">
      <span class="info-box-text">{{ __("Total Member Cards") }}</span>
          <span class="info-box-number" id="total_cards">
        
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon  elevation-1">
          <i class="fas fa-id-card"></i> <i class="fas fa-check-circle"></i>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">{{ __("Total Assigned Cards") }}</span>
          <span class="info-box-number" id="assigned" > </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
   
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon elevation-1">
          <i class="fas fa-credit-card"></i> <i class="fas fa-bolt"></i>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">{{ __("Total Active Cards") }}</span>
          <span class="info-box-number"  id="active"> </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon elevation-1">
          <i class="fas fa-credit-card"></i> <i class="fas fa-ban"></i>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">{{ __("Total Inactive Cards") }}</span>
          <span class="info-box-number"  id="inactive"> </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon  elevation-1" >
          <i class="fas fa-credit-card"></i> <i class="fas fa-coins"></i>

        </span>

        <div class="info-box-content">
          <span class="info-box-text">{{ __("Total Card Payments") }}</span>
          <span class="info-box-number"  id="total_payments"> 
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <!-- /.col -->
  </div>
  {{-- <div class="">

    <div class="row starts-border mt-2" >
      <div class="col-md-6"> <h6 class="text-secondary">Total Member Cards:</h6></div>
      <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="total_cards"></h6></div>
    </div>
  
    <div class="row starts-border" >
      <div class="col-md-6"> <h6 class="text-secondary">Total Assigned Cards </h6></div>
      <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="assigned"> </h6></div>
    </div>
  
    <div class="row starts-border mb-2" >
      <div class="col-md-6"> <h6 class="text-secondary">Total Active Cards</h6></div>
      <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="active"> </h6></div>
    </div>
    <div class="row starts-border mb-2" >
      <div class="col-md-6"> <h6 class="text-secondary">Total Inactive Cards</h6></div>
      <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="inactive"></h6></div>
    </div>

    <div class="row starts-border mb-2" >
      <div class="col-md-6"> <h6 class="text-secondary">Total Card Payments</h6></div>
      <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="total_payments"></h6></div>
    </div>

   
  
  </div> --}}
  {{-- end of statistics --}}


  <div class="col-sm-5" id="alert-div3">
    @if (session('status'))
    <div class="alert disabled" style="background-color: rgb(198, 253, 216)" role="alert">
        {{ session('status') }}
    </div>
    @endif

   
  </div><!-- /.col -->
  <div class="col-sm-7">
       {{-- start of create card button--}}
       <button type="button" class="btn bg-flex text-light btn-sm mb-1" data-toggle="modal" onclick="createCard()">
        <i class="fa fa-plus"></i>
            {{ __("Create Card Member") }}
        </button>
         {{-- end of create card button --}}  
            {{-- start of available cards button --}}
      <button type="button" class="btn bg-flex text-light btn-sm mb-1" data-toggle="modal" onclick="showAllCards()">
        <i class="fa fa-envelope"></i>
      {{__("Available Card Members")}}
    </button>
    {{-- end of available cards button --}}
           {{-- start of assign card button --}}
      <button type="button" class="btn bg-flex text-light btn-sm mb-1"  onclick="createCardMember()">
        <i class="fa fa-list"></i>
        {{("Assign Card")}}
    </button>
    {{-- end of assign card button --}}
      {{-- start of add card payment button --}}         
      <button type="button" class="btn bg-flex text-light btn-sm mb-1" data-toggle="modal" onclick="createPayment()">
          <i class="fa fa-dollar-sign"></i>
         {{__("Add Card Payment")}}
      </button>
      {{-- start of add card payment button --}}

   

    

   
      <a href="" class="btn btn-sm bg-flex mb-1 text-light" data-toggle="modal" onclick="cardRequests()">
        <i class="fa fa-download"></i>
       {{ __("Requests") }}
      </a>
      <button style="margin-left:15px" type="button" class="btn text-light btn-sm mb-2" data-toggle="modal" onclick="showAllRequests()">
        <a href="{{route("myadmin_card")}}" class="btn bg-cyan  btn-sm" type="button">
          <i class="fa fa-download text-light" ></i>
          {{ __("Generate Report") }}
        </a>
       </button>
      {{-- <a href="{{route("myadmin_card")}}">
        <button style="margin-left: 20px" type="button" class="btn bg-cyan text-light btn-sm mb-2">
          <i class="fa fa-download text-light" >
        
            generate report
      </i>
     </button>
        </a> --}}

     

  </div><!-- /.col -->
</div>

</div>


<div class="card mt-1">
    <div class="">
        <div class="p-1 mt-2">
          {{-- start of all assigned card members --}}
            <table id="example1"  class="table table-bordered cell-bordered">
                <thead>
                    <tr class="text-secondary">
                        <th>ID</th>
                        <th>{{ __("Issued Date") }}</th>
                        <th>{{__("Member")}}</th>
                        <th>{{__("Card Number") }}</th>
                        <th>{{ __("Status") }}</th>
                        <th>{{ __("Actions") }}</th>
                    </tr>
                </thead>
                <tbody id="members-table-body">    
                </tbody>
            </table>  
          {{-- end of all assigned card members --}}

            {{-- start of ajax fetch all card-member method --}}
            @include('admin.cards.ajax-fetch-all-card-members')
            {{-- end of ajax fetch all card-member method --}}
    
            {{-- start of ajax view  card-member details method --}}
            @include('admin.cards.ajax-fetch-card-member-details')
            {{-- end of ajax view card-member details method --}}
    
            {{-- start of ajax view card-member details modal --}}
            @include('admin.cards.single-card-member-modal')
            {{-- end of ajax view card-member details modal --}}
             
            {{-- start of ajax delete card member method --}}
            @include('admin.cards.ajax-delete-card-member')
            {{-- end of ajax delete card member method --}}


        </div>
  </div>

   {{-- start assign card member modal --}}
   @include('admin.cards.register-card-payment-modal')
   {{-- end of assign card member modal --}}

   {{-- start of ajax assign card member method --}}
   @include('admin.cards.ajax-register-card-payment')
   {{-- end of ajax assign card member method --}}

   {{-- start assign card member modal --}}
   @include('admin.cards.register-card-member-modal')
   {{-- end of assign card member modal --}}

    {{-- start edit card member modal --}}
   @include('admin.cards.edit-card-member-modal')
   {{-- end ofeditn card member modal --}}

   {{-- start of ajax assign card member method --}}
   @include('admin.cards.ajax-register-card-member')
   {{-- end of ajax assign card member method --}}
   
   {{-- start of ajax update payment methods method --}}
   @include('admin.cards.ajax-update-card-member')
   {{-- end of ajax update payment methods method --}}

   {{-- start of ajax delete payment method --}}
   @include('admin.cards.ajax-delete-card-payment')
   {{-- end of ajax delete  payment method --}}

   {{-- start create card modal --}}
   @include('admin.cards.register-card-modal')
   {{-- end of create card modal --}}

   {{-- start of ajax register card method --}}
   @include('admin.cards.ajax-register-card')
   {{-- end of ajax register card method --}}

 {{-- start all available modal --}}
 @include('admin.cards.all-available-cards-modal')
 {{-- end of all available modal --}}

 {{-- start of ajax fetch all available cards method --}}
 @include('admin.cards.ajax-fetch-all-cards')
 {{-- end of ajax fetch all available cards method --}}


 {{-- start of ajax update payment methods method --}}
 @include('admin.cards.ajax-update-card')
 {{-- end of ajax update payment methods method --}}
    
 {{-- start of ajax delete payment methods method --}}
 @include('admin.cards.ajax-delete-card')
 {{-- end of ajax delete payment methods method --}}
   
@endsection