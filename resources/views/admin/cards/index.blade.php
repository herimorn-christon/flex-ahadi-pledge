@extends('layouts.master')

@section('title','Manage Cards')

@section('content')


<div class="card p-2">
<div class="row mb-1">
    
{{-- start of statistics --}}
<div class="">
     <p>Total Member Cards:</p>
     <p>Total Assigned Cards:</p>
     <p>Total UnAssigned Cards:</p>
     <p>Total Active Cards:</p>
     <p>Total Inactive Cards:</p>
     <p>Total Card Payments </p>

     <hr class="bg-light">
  </div>

{{-- end of statistics --}}

  <div class="col-sm-5" id="alert-div">
    @if (session('status'))
    <div class="alert disabled" style="background-color: rgb(198, 253, 216)" role="alert">
        {{ session('status') }}
    </div>
    @endif

   
  </div><!-- /.col -->
  <div class="col-sm-7">  
      {{-- start of add card payment button --}}         
      <button type="button" class="btn bg-flex text-light btn-sm mb-1" data-toggle="modal" onclick="createPayment()">
          <i class="fa fa-dollar-sign"></i>
           Add Card Payment
      </button>
      {{-- start of add card payment button --}}

      {{-- start assign card member modal --}}
      @include('admin.cards.register-card-payment-modal')
      {{-- end of assign card member modal --}}

      {{-- start of ajax assign card member method --}}
      @include('admin.cards.ajax-register-card-payment')
      {{-- end of ajax assign card member method --}}

      {{-- start of available cards button --}}
      <button type="button" class="btn bg-flex text-light btn-sm mb-1" data-toggle="modal" onclick="showAllCards()">
          <i class="fa fa-envelope"></i>
           Available Cards
      </button>
      {{-- end of available cards button --}}

      {{-- start of assign card button --}}
      <button type="button" class="btn bg-flex text-light btn-sm mb-1"  onclick="createCardMember()">
          <i class="fa fa-list"></i>
           Assign Card
      </button>
      {{-- end of assign card button --}}

      {{-- start assign card member modal --}}
      @include('admin.cards.register-card-member-modal')
      {{-- end of assign card member modal --}}

      {{-- start of ajax assign card member method --}}
      @include('admin.cards.ajax-register-card-member')
      {{-- end of ajax assign card member method --}}
      
      {{-- start of ajax update payment methods method --}}
      @include('admin.cards.ajax-update-card-member')
      {{-- end of ajax update payment methods method --}}

      {{-- start of ajax delete payment method --}}
      @include('admin.cards.ajax-delete-card-payment')
      {{-- end of ajax delete  payment method --}}

      {{-- start of create card button--}}
      <button type="button" class="btn bg-flex text-light btn-sm mb-1" data-toggle="modal" onclick="createCard()">
      <i class="fa fa-plus"></i>
          Create Card
      </button>
      <a href="" class="btn btn-sm bg-cyan mb-1">
        <i class="fa fa-file-pdf"></i>
        Generate Report
      </a>
      {{-- end of create card button --}}

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
      

  </div><!-- /.col -->
</div>

</div>


<div class="card mt-1">
    <div class="">
        <div class="p-1 mt-2">
          {{-- start of all assigned card members --}}
            <table id="example1"  class="table table-bordered cell-border">
                <thead>
                    <tr class="text-secondary">
                        <th>ID</th>
                        <th>Member</th>
                        <th>Card Number</th>
                        <th>Status</th>
                        <th>Actions</th>
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


        </div>
  </div>

@endsection