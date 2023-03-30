@extends('layouts.member')

@section('title','My Pledges')


@section('content')

<div class="card  border-left-flex">
  <div class="row mb-1 m-2">

  {{-- start of statistics --}}
<div class="px-2">
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

</div>
{{-- end of statistics --}}

    <div class="col-sm-6" id="alert-div">
      @if (session('status'))
      <div class="alert disabled" style="background-color: rgb(198, 253, 216)" role="alert">
          {{ session('status') }}
      </div>
      @endif
    </div><!-- /.col -->
    <div class="col-sm-6">
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
      
    </div><!-- /.col -->
  </div>

</div>
<div class="card mt-1">
    
    <div class="">




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
{{-- end of single pledge modal --}}


@endsection

@section('scripts')
  {{-- start of ajax fetch all pledges method --}}
  @include('member.pledges.ajax-fetch-all-pledges')
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
          function showPledge(id)
          {
              $("#name-info").html("");
              $("#description-info").html("");
              $("#payments-table-body").html("");
              let url = $('meta[name=app-url]').attr("content") + "/member/pledges/" + id +"";
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                      let pledge = response.pledge;
                      $("#title-info").html(pledge.name);
                      $("#start-info").html(pledge.deadline);
                      $("#status-info").html(pledge.status == '0' ? 'Not Fullfilled':'Fullfilled');
                      $("#end-info").html(pledge.amount);
                      $("#type-info").html(pledge.type.title);
                      $("#purpose-info").html(pledge.purpose.title);
                      $("#description-info").html(pledge.description);
                      $("#view-modal").modal('show'); 
                         // for payments
                                     
                        let payments = response.payments;
                        for (var j = 0; i < payments.length; j++) 
                        {      
         
                       let paymentsRow = '<tr>' +
                                '<td>' + payments[i].id + '</td>' +
                                '<td>' + payments[i].created_at+ '</td>' +
                                // '<td>' + payments[i].pledge.name + '</td>' +
                                '<td>' + payments[i].amount + '</td>' +
                                // '<td>' + payments[i].payment.name + '</td>' +
                            '</tr>';
                            $("#payments-table-body").append(paymentsRow);
                        }

                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }
       
</script>

@endsection