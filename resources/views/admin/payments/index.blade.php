@extends('layouts.master')

@section('title','Admin | Manage Payments')


@section('content')

<div class="card  p-2 border-left-flex">

<div class="row mb-1">
  {{-- start of statistics --}}
  <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon elevation-1"><i class="fas fa-coins"></i></i> <i class="fas fa-tasks"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">{{ __("Total Pledges Payments") }}</span>
          <span class="info-box-number" id="total">
        
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
          <i class="fas fa-coins"></i> <i class="fas fa-arrow-up"></i>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">{{ __("Highest Pledge Payment") }}</span>
          <span class="info-box-number" id="highest" > </span>
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
          <i class="fas fa-coins"></i> <i class="fas fa-arrow-down"></i>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">{{ __("Lowest Pledge Payment") }}</span>
          <span class="info-box-number"  id="lowest"> </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon elevation-1">
          <i class="fas fa-award"></i> <i class="fas fa-user"></i>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">{{ __("Best Pledge Payer") }}</span>
          <span class="info-box-number"   id="best"> </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- /.col -->
  </div>





{{-- <div class="">

  <div class="row starts-border mt-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Pledges Payments</h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="total"></h6></div>
  </div>

  <div class="row starts-border" >
    <div class="col-md-6"> <h6 class="text-secondary">Highest Pledge Payment </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="highest"></h6></div>
  </div>

  <div class="row starts-border mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Lowest Pledge Payment</h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="lowest"></h6></div>
  </div>
  <div class="row starts-border mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Best Pledge Payer</h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="best"></h6></div>
  </div>



</div> --}}
{{-- end of statistics --}}

    <div class="col-sm-5" id="alert-div4">
      @if (session('status'))
      <div class="alert disabled" style="background-color: rgb(198, 253, 216)" role="alert">
          {{ session('status') }}
      </div>
      @endif
    </div><!-- /.col -->
    <div class="col-sm-7">
         <div style="display:flex;justify-content:space-around;align-items:center;margin:3%">
        {{-- start of registe r payment button --}}
        <button type="button" class="btn bg-flex text-light btn-sm mb-2" data-toggle="modal" onclick="createPayment()">
            <i class="fa fa-plus"></i>
            {{ __("Register Payment") }}
           
        </button>   
        {{-- end of register payment button --}}

        <button style="margin-left: 20px" type="button" class="btn bg-flex text-light btn-sm mb-2" data-toggle="modal" onclick="showAllMethods()">
            <i class="fa fa-list"></i>
             {{ __("Payment Methods") }}
        </button>
        

        <button style="margin-left:15px"type="button" class="btn bg-flex text-light btn-sm mb-2" data-toggle="modal" onclick="createMethod()">
        <i class="fa fa-plus"></i>
        {{ __("Add Payment Method") }}
       
        </button>
      
        {{-- start of generate report button --}}

        <button style="margin-left: 20px" type="button" class="btn bg-flex text-light btn-sm mb-2" data-toggle="modal" onclick=" showAllMoneyRequests()">
       
           <i class="fa fa-download text-light" ></i>
         {{ __("Payment Money Requests")}}
          </button>
          <button style="margin-left: 20px" type="button" class="btn bg-flex text-light btn-sm mb-2" data-toggle="modal" onclick=" showAllPaymentObjectRequests()">
       
            <i class="fa fa-download text-light" ></i>
           {{ __("Payment Object Requests") }}
           </button>
          <button style="margin-left: 20px" type="button" class="btn text-light btn-sm mb-2" data-toggle="modal" onclick="showAllRequests()">
            <a href="{{route("myadmin_payment")}}" class="btn bg-cyan  btn-sm" type="button">
              <i class="fa fa-download text-light" ></i>
             {{__("Generate Report")}}
            </a>
           </button>

         
        {{-- end of generate report button --}}
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


        {{-- start all payment requests modal --}}
        @include('admin.payments.all-payment-requests')
        {{-- end of all payment requests modal --}}

        {{-- start of ajax fetch all pledges method --}}
        @include('admin.payments.ajax-fetch-all-methods')
        {{-- end of ajax fetch all pleges method --}}

        {{-- start of ajax fetch all payments requests --}}
        @include('admin.payments.ajax-fetch-all-requests')
        {{-- end of ajax fetch all payments requests --}}

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


         {{-- start verify payment modal --}}
        @include('admin.payments.verify-modal')
        {{-- end of verify payment modal --}}  

        {{-- start of ajax register pledge method --}}
        @include('admin.payments.ajax-verify-payment')
        {{-- end of ajax register pledge method --}}

      
    </div>
  </div>
</div>
<div class="card mt-1">
  <div class="row">
    
    <div class="col-md-12">
      <div class="card">
        <div class="card-header p-2 bg-white">
          <ul class="nav nav-tabs nav-light">
            <li class="nav-item">
        <a class="nav-link text-navy active" href="#problems"  data-toggle="tab">{{ __("Money Payments") }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-navy" href="#report"  data-toggle="tab">{{ __("Object Payments") }}</a>
            </li>
            {{--<li class="nav-item">
              <a class="nav-link text-navy" href="#announcements"  data-toggle="tab">Cards Payments Report</a>
            </li> --}}
          </ul>
        </div><!-- /.card-header -->
        {{-- <div class=""> --}}
          <div class="tab-content">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
           
            <div class="active tab-pane" id="problems">
              {{-- start of interface settings --}}
              
                <div class="p-1 mt-2">
                  <table id="example1" class="table table-bordered cell-border responsive">
                    <thead>
                         <tr class="text-secondary">
                            <th>ID</th>
                            <th>{{ __("Date")}}</th>
                            <th>{{ __("Payer Name") }}</th>
                            <th>{{ __("Payment Method") }}</th>
                            <th>{{ __("Purpose") }}</th>
                            <th>{{ __("Amount") }}</th>
                            <th>{{ __("Actions") }}</th>
                        </tr>
                    </thead>
                    <tbody id="payments-table-body">
              
      
                    </tbody>
                </table>
                </div>
            

              {{-- end of interface settings --}}
            </div>
            <!-- /.tab-pane -->
        

            <div class="tab-pane" id="report">

           
              {{-- start of report form --}}

              <div class="col-md-12">
                <div class="p-2">
                    <!--the status for the messagge-->
                    <!--end for the status msg -->

                    <div class="col-md-12">
                      <table id="example4"  class="table table-bordered   cell-border">
                        <thead>
                             <tr class="text-secondary">
                                <th>SN</th>
                                <th>{{ __("Payment Date") }}</th>
                                <th>{{ __("Pledge Name") }}</th>
                                <th>{{ __("Object Name") }}</th>
                                <th>{{ __("Object Quantity") }}</th>
                                <th>{{ __("Status") }}</th>
                                <th>{{ __("Actions") }}</th>
                            </tr>
                        </thead>
                        <tbody id="projects-table-bodyObject">
                  
          
                        </tbody>
                    </table>
                    
                     
                       
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

 

   
@endsection