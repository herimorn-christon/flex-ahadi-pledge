@extends('layouts.master')

@section('title','Manage Cards')

@section('content')


<div class="row mb-1">
    <div class="col-sm-5" id="alert-div">
      @if (session('status'))
      <div class="alert disabled" style="background-color: rgb(198, 253, 216)" role="alert">
          {{ session('status') }}
      </div>
      @endif
    </div><!-- /.col -->
    <div class="col-sm-7">
      <ol class="float-sm-right" type="none">
        <li class="">   
        {{-- start of add card payment button --}}         
        <button type="button" class="btn bg-flex text-light btn-sm" data-toggle="modal" onclick="createPayment()">
            <i class="fa fa-dollar-sign"></i>
             Add Card Payment
        </button>
        {{-- start of add card payment button --}}

        {{-- start of available cards button --}}
        <button type="button" class="btn bg-flex text-light btn-sm" data-toggle="modal" onclick="showAllCards()">
            <i class="fa fa-envelope"></i>
             Available Cards
        </button>
        {{-- end of available cards button --}}

   


        {{-- start of assign card button --}}
        <button type="button" class="btn bg-flex text-light btn-sm"  onclick="createCardMember()">
            <i class="fa fa-list"></i>
             Assign Card
        </button>
        {{-- end of assign card button --}}


        {{-- start of create card button--}}
        <button type="button" class="btn bg-flex text-light btn-sm" data-toggle="modal" onclick="createCard()">
        <i class="fa fa-plus"></i>
            Create Card
        </button>
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
        

    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>

{{-- start of statistics --}}
<div class="">
  <div class="card p-2">
     <p>Total Cards:</p>
     <p>Total Assigned Cards:</p>
     <p>Total Active Cards:</p>
     <p>Total Inactive Cards:</p>
  </div>
</div>
{{-- end of statistics --}}

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