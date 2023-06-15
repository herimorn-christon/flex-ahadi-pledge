@extends('layouts.member')

@section('title','My Pledges')


@section('content')
@php
$user=Auth::User()->id;
$i=1;
//$dependants=App\Models\User::find($user)->dependant;
$problems=App\Models\Problem::where('user_id',$user)->get();
@endphp

<div class="card  border-left-flex">
  <div class="row mb-1 m-2">

  {{-- start of statistics --}}
  <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon elevation-1">
          <i class="fas fa-calculator"></i>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">Total Pledges Made in {{ date('Y')}} </span>
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
        <span class="info-box-icon elevation-1">
          <i class="fas fa-check-circle"></i>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">Total Fullfilled Pledges in {{ date('Y')}}</span>
          <span class="info-box-number" id="fullfilled" > </span>
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
          <i class="fas fa-times-circle"></i> 
        </span>

        <div class="info-box-content">
          <span class="info-box-text">Total Unfullfilled Pledges in {{ date('Y')}}</span>
          <span class="info-box-number" id="unfullfilled"> </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon elevation-1">
          <i class="fas fa-coins"></i>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">Total Money Pledges in {{ date('Y')}}</span>
          <span class="info-box-number"  id="money"> </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon  elevation-1">
          <i class="fas fa-cube"></i>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">Total Object Pledges in {{ date('Y')}}</span>
          <span class="info-box-number"  id="object"> 
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <!-- /.col -->
  </div>

{{-- <div class="px-2">
  <div class="row starts-border mt-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Pledges Made in {{ date('Y')}} </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="total"> </h6></div>
  </div>
  <div class="row starts-border" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Fullfilled Pledges in {{ date('Y')}} </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="fullfilled"></h6></div>
  </div>
  <div class="row starts-border mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Unfullfilled Pledges in {{ date('Y')}}</h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="unfullfilled"></h6></div>
  </div>
  <div class="row starts-border mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Money Pledges in {{ date('Y')}}</h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="money"></h6></div>
  </div>
  <div class="row starts-border mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Object Pledges in {{ date('Y')}}</h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="object"></h6></div>
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
        <button type="button" class="btn bg-flex text-light btn-sm mb-1" data-toggle="modal"  onclick="createPledge()">
            <i class="fa fa-plus"></i>
             Register New Pledge 
        </button>  
        <button type="button" class="btn bg-flex text-light btn-sm mb-1" data-toggle="modal" onclick="showAllPurposes()">
            <i class="fa fa-list"></i>
            Contribution Purposes
        </button>
        <a href="{{ route("memberPleadgeReport") }}" class="btn btn-sm bg-cyan mb-1">
          <i class="fa fa-file-pdf"></i>
          Generate Report
        </a>
    
    </li>
       
      </ul>
      @endif
      
    </div><!-- /.col -->
  </div>

</div>
<div class="card mt-1">
    
    <div class="">
      <div class="row">
    
        <div class="col-md-12">
          <div class="card">
            <div class="card-header p-2 bg-white">
              <ul class="nav nav-tabs nav-light">
                <li class="nav-item">
                  <a class="nav-link text-navy active" href="#problems"  data-toggle="tab">Money</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-navy" href="#report"  data-toggle="tab">Object</a>
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
    
                  {{-- end of interface settings --}}
                                   {{-- start of interface settings --}}
    <div class="mt-4 px-2 ">
      <table id="mytable"  class="table table-bordered cell-border " >
                <thead>
                    <tr class="text-secondary">
                        <th>ID</th>
                        <th>Created Date</th>
                        <th>Pledge Name</th>
                        <th>Purpose</th>
                        <th>Amount</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="pledges-table-body">
                
    
                </tbody>
               
             </table>
            </div>
                    
    
                </div>
                <!-- /.tab-pane -->
            

                <div class="tab-pane" id="report">

               
                  {{-- start of report form --}}

                  <div class="col-md-12">
                    <div class="p-2">
                                    {{-- start of interface settings --}}
    <div class="mt-4 px-2 ">
      <table id="example1" class="table table-bordered cell-border " >
                <thead>
                    <tr class="text-secondary">
                        <th>ID</th>
                        <th>Created Date</th>
                        <th>Pledge Name</th>
                        <th>Purpose</th>
                        <th>Object Name</th>
                        <th>Quantity</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="pledges-table_object-body">
                
    
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

      <!--adding the panel table to fetch the object and the pledge payment-->
   




    </div>
</div>



{{-- All Pledge Types Modal --}}

<div class="modal fade" id="types">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
        
      </div>
      <div class="modal-body">
     
        <div class="row">
          <table id="example2"  class="cell-border table table-bordered ">
              <thead>
                  <tr class="text-secondary">
                      <th>SN</th>
                      <th>Purpose</th>
                      <th>Details</th>
                      <th>Start date</th>
                      <th>End date</th>
                      <th>Status</th>
                  </tr>
              </thead>
              <tbody id="purposes-table-body">
                
              </tbody>
          </table>

      </div>
      </div>
      <div class="modal-footer justify-content-between">
        {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      --}}
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

{{-- start of register new pledge modal --}}
  @include('member.pledges.register-pledge-modal')
{{-- end of register new pledge modal --}}

{{-- start of single pledge modal --}}
@include('member.pledges.single-pledge-modal')
@include('member.pledges.single-pledgeObject-modal')
{{-- end of single pledge modal --}}


@endsection

@section('scripts')
  {{-- start of ajax fetch all pledges method --}}
  @include('member.pledges.ajax-fetch-all-pledges')
  @include('member.pledges.ajax-fetch-all-Objectpledge')
  {{-- end of ajax fetch all pleges method --}}

  {{-- start of ajax register pledge method --}}
  @include('member.pledges.ajax-register-pledge-method')
  {{-- end of ajax register plege method --}}

  {{-- start of ajax update pledge method --}}
  @include('member.pledges.ajax-update-pledge')
  {{-- end of ajax update plege method --}}

  {{-- start of ajax fetch all pledges method --}}
  @include('member.pledges.ajax-fetch-all-purposes')
  {{-- end of ajax fetch all pleges method --}}
  
  <script type="text/javascript">
    /*
    get and display the record info on modal
    */
    function showPledgeObject(id) {
      console.log(id);
      $("#name-info").html("");
      $("#description-info").html("");
      $("#payments-table-body").html("");
  
      let url = $('meta[name=app-url]').attr("content") + "/member/pledges/" + id;
      $.ajax({
        url: url,
        type: "GET",
        success: function(response) {
          let pledge = response.objectPledges;
          let Pledge_total=response.pledge_value.object_quantity;
         let payment_object_total=response.payment_object_sum;
         let remaining=Pledge_total-payment_object_total;
        //  console.log(remaining);
        //  console.log(Pledge_total);
        //  console.log(remaining);
          //  console.log(pledge);
          // console.log(pledge.deadline);
         
          $("#totalPayment_show").html(payment_object_total);
          $("#title-info_show").html(pledge.name);
          $("#deadlines").html(pledge.deadline);
          $("#status-info_show").html(pledge.status == '0' ? 'Not Fulfilled' : 'Fulfilled');
          $("#end-info_show").html(pledge.amount);
          $("#type-info_show").html(pledge.type.title);
          $("#purpose-info_show").html(pledge.purpose.title);
          $("#description-info_show").html(pledge.description);
          $("#myObject-show").html(pledge.object_name);
          $("#myobject_cost").html(pledge.object_cost);
          $("#myRemainQuantity_show").html(remaining);
          $("#myQuantity_show").html(pledge.object_quantity + pledge.metrics);
          $("#views-modal").modal('show');
  
          let payments = response.payments;
          payments.forEach(payment => {
            let paymentsRows = '<tr>' +
              '<td>' + payment.id + '</td>' +
              '<td>' + payment.created_at + '</td>' +
              '<td>' + payment.pledge.object_name + '</td>' +
              '<td>' + payment.object_transaction + '</td>' +
              '<td>' + payment.object_quantity + payment.pledge.metrics + '</td>' +
              '<td>' + payment.object_cost + '</td>' +
              '<td>' + (payment.verified == '1' ? 'verified' : 'not verified') + '</td>' +
              '</tr>';
            $("#payments-tableObject-body").append(paymentsRows);
          });
        },
        error: function(response) {
          console.log(response.responseJSON);
        }
      });
    }
  </script>
  
  <script type="text/javascript">
    /*
    get and display the record info on modal
    */
    function showPledge(id) {
      $("#name-info").html("");
      $("#description-info").html("");
      $("#payments-table-body").html("");
      let url = $('meta[name=app-url]').attr("content") + "/member/pledges/" + id;
      $.ajax({
        url: url,
        type: "GET",
        success: function(response) {
          let pledge = response.pledge;
          let paymentAmount = response.paymentsAamount;
          let remainingAmount = pledge.amount - paymentAmount;
          $("#title-info").html(pledge.name);
          $("#start-info").html(pledge.deadline);
          $("#status-info").html(pledge.status == '0' ? 'Not Fulfilled' : 'Fulfilled');
          $("#end-info").html(pledge.amount);
          $("#type-info").html(pledge.type.title);
          $("#remain-info").html(remainingAmount);
          $("#purpose-info").html(pledge.purpose.title);
          $("#description-info").html(pledge.description);
         
         
          $("#myObject").html(pledge.object_name);
          $("#myQuantity").html(pledge.object_quantity);
          $("#view-modal").modal('show');
  
          let payments = response.payments;
          console.log(payments);
          payments.forEach(payment => {
            let paymentsRow = '<tr>' +
              '<td>' + payment.id + '</td>' +
              '<td>' + payment.created_at + '</td>' +
              '<td>' + payment.payment.name + '</td>' +
              '<td>' + payment.amount + '</td>' +
              '<td>' + payment.money_transaction + '</td>' +
              '<td>' + (payment.verified == '1' ? 'verified' : 'not verified') + '</td>' +
              '</tr>';
            $("#payments-table-body").append(paymentsRow);
          });
        },
        error: function(response) {
          console.log(response.responseJSON);
        }
      });
    }
  </script>
  


@endsection