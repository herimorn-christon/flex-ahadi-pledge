@extends('layouts.member')

@section('title','My Payments')


@section('content')

<style>
  #example_filter.dataTaable_filter{
    width: 200px !important;
  }
</style>

<div class="card  p-1 border-left-flex">
  <div class="row mx-1 mb-1">

  {{-- start of statistics --}}
<div class="">
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
      <ol class="float-sm-right" type="none">
        <li class=""> 
    
        <button type="button" class="btn bg-flex text-light btn-sm mb-1" data-toggle="modal" onclick="showAllMethods()">
            <i class="fa fa-list"></i>
            Available Payment Methods
        </button>
        <a href="" class="btn btn-sm bg-cyan mb-1">
          <i class="fa fa-file-pdf"></i>
          Generate Report
        </a>
     
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>
</div>
<div class="card ">
 

        <div class="responsivenes  p-1">
            <table id="example"  class="table table-bordered  cell-border">
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


{{-- Add Payment Type modal --}}

<div class="modal fade" id="method-modal">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header bg-light">
           <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
              <input type="hidden" name="update_id" id="update_id">
                <div class="row mb-3">
                 <div class="col-md-12">
                    <div class="form-group">
                        <label for="name" class="text-secondary">Payment Method</label>
                        <input type="text" id="name" name="name" id="title" class="form-control" placeholder="Enter Payment Method Name">
                    </div>
                 </div>
                 <div class="col-md-6"></div>
                 <div class="col-md-6">
                    <div class="form-group">
                     
                        <button type="submit" class="btn btn-primary btn-block" id="save-method-btn">
                            <i class="fa fa-save"></i>
                            Save Payment Method
                        </button>
                    </div>
                 </div>
                </div>
            </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

{{-- All Pledge Types Modal --}}

<div class="modal fade" id="types">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-light">
         <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>
      <div class="modal-body">
        <div class="col-sm-12" id="alert-div">
        </div>
        <div class="row">
          <table   class="table table-bordered ">
              <thead>
                  <tr class="text-secondary">
                      <th>ID</th>
                      <th>Method Name</th>
                  </tr>
              </thead>
              <tbody id="methods-table-body">

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



  {{-- view payment modal --}}

  <div class="modal fade" id="view-modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
           <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>
            
            <b class="text-secondary">Payment Purpose:</b>   <span id="purpose-info" class="text-dark"></span>
            <hr>
            <b class="text-secondary">Payment Amount:</b>   <span id="amount-info" class="text-dark"></span>
            <hr>
            <b class="text-secondary">Payment Method:</b>   <span id="method-info" class="text-dark"></span>
            <hr>
            <b class="text-secondary">Payment Date:</b>   <span id="date-info" class="text-dark"></span>
            <hr>
        </p>       
       
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
   <script type="text/javascript">
  
            showAllPledges();
        
            /*
                This function will get all the payments records
            */
            function showAllPledges()
            {
                let url = $('meta[name=app-url]').attr("content") + "/member/payments";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $("#projects-table-body").html("");
                        let purposes = response.payments;
                        for (var i = 0; i < purposes.length; i++) 
                        {
                            let showBtn =  '<button ' +
                                ' class="btn btn-sm bg-flex text-light " ' +
                                ' onclick="showPledge(' + purposes[i].id + ')"><i class="fa fa-eye"></i>' +
                            '</button> ';
                            let editBtn =  '<button ' +
                                ' class="btn btn-secondary" ' +
                                ' onclick="editPledge(' + purposes[i].id + ')">Edit' +
                            '</button> ';
                            let deleteBtn =  '<button ' +
                                ' class="btn btn-danger" ' +
                                ' onclick="destroyPledge(' + purposes[i].id + ')">Delete' +
                            '</button>';
         
                            let projectRow = '<tr>' +
                                '<td>' + (1+i)+ '</td>' +
                                '<td>' + purposes[i].formattedDate   + '</td>' +
                                '<td>' + purposes[i].pledge.name + '</td>' +
                                '<td>' + purposes[i].payment.name + '</td>' +
                                '<td>' + purposes[i].amount+ 'Tsh'+ '</td>' +
                                '<td class="'+(purposes.verified == '0' ? 'text-teal':'text-danger')+'">'+(purposes.verified == '0' ? 'Verified':'Not Verified')+ '</td>'+
                                '<td>' + showBtn + '</td>' +
                            '</tr>'+'';
                            $("#projects-table-body").append(projectRow);
                        }
         
                         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         

    //         showAllMethods();


            /*
                This function will get all the payments records
            */
            function showAllMethods()
            {
                let url = $('meta[name=app-url]').attr("content") + "/member/methods";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $("#methods-table-body").html("");
                        let methods = response.methods;
                        for (var i = 0; i < methods.length; i++) 
                        {
                          
                            let editBtn =  '<button ' +
                                ' class="btn btn-secondary" ' +
                                ' onclick="editMethod(' + methods[i].id + ')">Edit' +
                            '</button> ';
                            let deleteBtn =  '<button ' +
                                ' class="btn btn-danger" ' +
                                ' onclick="destroyMethod(' + methods[i].id + ')">Delete' +
                            '</button>';
         
                            let projectRow = '<tr>' +
                                '<td>' + methods[i].id + '</td>' +
                                '<td>' + methods[i].name + '</td>' +
                            '</tr>';
                            $("#methods-table-body").append(projectRow);
                            $("#types").modal('show'); 
                        }
         
                         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
   
            /*
                get and display the record info on modal
            */
            function showPledge(id)
            {
                $("#name-info").html("");
                $("#description-info").html("");
                let url = $('meta[name=app-url]').attr("content") + "/member/payments/" + id +"";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        let purpose = response.purpose;
                        $("#mname-info").html(purpose.payer.mname);
                        $("#lname-info").html(purpose.payer.lname);
                        $("#purpose-info").html(purpose.purpose.title);
                        $("#amount-info").html(purpose.amount);
                        $("#method-info").html(purpose.payment.name);
                        $("#date-info").html(purpose.   created_at);
                        $("#view-modal").modal('show'); 
         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         
            /*
                delete record function
            */
            function destroyPledge(id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/payments/" + id;
                let data = {
                    pledge_id: $("#pledge_id").val(),
                    amount: $("#amount").val(),
                    user_id: $("#user_id").val(),
                    type_id: $("#type_id").val(),
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "DELETE",
                    data: data,
                    success: function(response) {
                        let successHtml = '<div class="alert alert-success" role="alert">Payment Was Deleted Successfully </div>';
                        $("#alert-div").html(successHtml);
                        showAllPledges();
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }


            /*
                delete payment record function
            */
            function destroyMethod(id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/methods/" + id;
                let data = {
                    name: $("#name").val(),
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "DELETE",
                    data: data,
                    success: function(response) {
                        let successHtml = '<div class="alert alert-danger" role="alert">Payment Method Was Deleted Successfully </div>';
                        $("#alert-div").html(successHtml);
    //                     showAllMethods();
    
                        $("#types").modal('hide'); 
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         
         
  </script>
@endsection