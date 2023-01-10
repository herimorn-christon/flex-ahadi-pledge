@extends('layouts.master')

@section('title','Admin | Manage Payments')


@section('content')

<div class="card  p-2 border-left-flex">

<div class="row mb-1">
  {{-- start of statistics --}}
<div class="">

  <div class="row starts-border mt-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Pledges Payments</h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder"> 212</h6></div>
  </div>

  <div class="row starts-border" >
    <div class="col-md-6"> <h6 class="text-secondary">Highest Pledge Payment </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder"> 212</h6></div>
  </div>

  <div class="row starts-border mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Lowest Pledge Payment</h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder"> 212</h6></div>
  </div>
  <div class="row starts-border mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Best Pledge Payer</h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder"> 212</h6></div>
  </div>



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
      <ol class="float-sm-right" type="none">
        <li class=""> 
        {{-- start of register payment button --}}
        <button type="button" class="btn bg-flex text-light btn-sm mb-2" data-toggle="modal" onclick="createPayment()">
            <i class="fa fa-plus"></i>
            Register Payment
        </button>   
        {{-- end of register payment button --}}

        <button type="button" class="btn bg-flex text-light btn-sm mb-2" data-toggle="modal" onclick="showAllMethods()">
            <i class="fa fa-list"></i>
             Payment Methods
        </button>
        

        <button type="button" class="btn bg-flex text-light btn-sm mb-2" data-toggle="modal" onclick="createMethod()">
        <i class="fa fa-plus"></i>
         Add Payment Method
        </button>
      
        {{-- start of generate report button --}}
      <a href="" class="btn bg-cyan  btn-sm mb-2" type="button"  data-bs-toggle="modal" data-bs-target="#registeredModal">
        <i class="fa fa-download text-light" ></i>
        Generate Report
      </a>
        {{-- end of generate report button --}}

        {{-- start register payment modal --}}
        @include('admin.payments.register-payment-modal')
        {{-- end of register  payment modal --}}

        {{-- start of ajax register  payment method --}}
        @include('admin.payments.ajax-register-payment')
        {{-- end of ajax register  payment method --}}

        {{-- start of ajax update  payment method --}}
        @include('admin.payments.ajax-update-payment')
        {{-- end of ajax update  payment method --}}

        {{-- start of ajax delete payment method --}}
        @include('admin.payments.ajax-delete-payment')
        {{-- end of ajax delete  payment method --}}
        
        {{-- start all payment methods modal --}}
        @include('admin.payments.all-payment-methods-modal')
        {{-- end of all payment methods modal --}}

        {{-- start of ajax fetch all pledges method --}}
        @include('admin.payments.ajax-fetch-all-methods')
        {{-- end of ajax fetch all pleges method --}}


        {{-- start of ajax update payment methods method --}}
        @include('admin.payments.ajax-update-method')
        {{-- end of ajax update payment methods method --}}
       
        {{-- start of ajax delete payment methods method --}}
        @include('admin.payments.ajax-delete-method')
        {{-- end of ajax delete payment methods method --}}
        {{-- start register pledge type modal --}}
        @include('admin.payments.register-method-modal')
        {{-- end of register pledge type modal --}}

        {{-- start of ajax register pledge method --}}
        @include('admin.payments.ajax-register-method')
        {{-- end of ajax register pledge method --}}

    </li>
       
      </ol>
      
    </div>
  </div>
</div>
<div class="card mt-1">

        <div class="responsiveness p-1">
            <table id="example1" class="table table-bordered cell-border responsive">
                <thead>
                     <tr class="text-secondary">
                        <th>ID</th>
                        <th>Payer Name</th>
                        <th>Payment Method</th>
                        <th>Purpose</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="payments-table-body">
          
  
                </tbody>
            </table>
            
             {{-- start of ajax fetch all pledges method --}}
             @include('admin.payments.ajax-fetch-all-payments')
             {{-- end of ajax fetch all pleges method --}}
     
             {{-- start of ajax view pledge details method --}}
             @include('admin.payments.ajax-fetch-payments-details')
             {{-- end of ajax view purpose details method --}}
     
             {{-- start of ajax view payment details modal --}}
             @include('admin.payments.single-payment-modal')
             {{-- end of ajax view payment details modal --}}

    </div>
</div>

 
  {{-- start auto populate member pledges --}}

         <!-- Script -->
         <script type='text/javascript'>

          $(document).ready(function(){

            // Department Change
            $('#user_id').change(function(){

                // Department id
                var id = $(this).val();

                // Empty the dropdown
                $('#pledge_id').find('option').not(':first').remove();

                // AJAX request 
                $.ajax({
                  url: 'getEmployees/'+id,
                  type: 'get',
                  dataType: 'json',
                  success: function(response){

                    var len = 0;
                    if(response['data'] != null){
                      len = response['data'].length;
                    }

                    if(len > 0){
                      // Read data and create <option >
                      for(var i=0; i<len; i++){

                        var id = response['data'][i].id;
                        var name = response['data'][i].name;

                        var option = "<option value='"+id+"'>"+name+"</option>"; 

                        $("#pledge_id").append(option); 
                      }
                    }

                  }
              });
            });

          });

          </script>
         
  {{-- end of auto populate member pledges --}}
   
@endsection