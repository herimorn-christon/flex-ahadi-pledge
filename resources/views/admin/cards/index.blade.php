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
        <button type="button" class="btn bg-flex text-light btn-sm" data-toggle="modal" onclick="createPayment()">
            <i class="fa fa-dollar-sign"></i>
             Add Card Payment
        </button>
        <button type="button" class="btn bg-flex text-light btn-sm" data-toggle="modal" onclick="showAllCards()">
            <i class="fa fa-envelope"></i>
             Available Cards
        </button>
        <button type="button" class="btn bg-flex text-light btn-sm"  onclick="createCardMember()">
            <i class="fa fa-list"></i>
             Assign Card
        </button>
        <button type="button" class="btn bg-flex text-light btn-sm" data-toggle="modal" onclick="createCard()">
        <i class="fa fa-plus"></i>
            Create Card
        </button>
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>

<div class="card mt-1">
    <div class="">
        <div class="p-1 mt-2">
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
        </div>
  </div>

@endsection