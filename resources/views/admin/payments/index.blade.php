@extends('layouts.master')

@section('title','All Communities')


@section('content')


<div class="row mb-1">
    <div class="col-sm-6" id="alert-div">
      @if (session('status'))
      <div class="alert disabled" style="background-color: rgb(198, 253, 216)" role="alert">
          {{ session('status') }}
      </div>
      @endif
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class=""> 
        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" onclick="createPledge()">
            <i class="fa fa-plus"></i>
            Register Payment
        </button>   
        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#types">
            <i class="fa fa-list"></i>
             Payment Methods
        </button>
        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#modal-lg">
        <i class="fa fa-plus"></i>
         Add Payment Method
        </button>
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>

<div class="card mt-1">
    <div class="card-header bg-light">
        <h6 class="text-light">
          
        </h6>
    </div>
    <div class="card-body">




        <div class="row">
            <table  class="table table-bordered responsive">
                <thead>
                     <tr class="text-secondary">
                        <th>Payer Name</th>
                        <th>Payment Method</th>
                        <th>Purpose</th>
                        <th>Amount</th>
                        <th width="240px">Actions</th>
                    </tr>
                </thead>
                <tbody id="projects-table-body">
          
  
                </tbody>
            </table>

        </div>



    </div>
</div>


{{-- Add Payment Type modal --}}

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          {{-- <h4 class="modal-title">Large Modal</h4> --}}
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ url('admin/add-method') }}" method="post">
                @csrf
                <div class="row mb-3">
                 <div class="col-md-12">
                    <div class="form-group">
                        <label for="name" class="text-secondary">Payment Method</label>
                        <input type="text" name="name" id="title" class="form-control" placeholder="Enter Payment Method Name">
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                     
                        <button type="submit" class="btn btn-primary">
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
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
        <div class="row">
          <table   class="table table-bordered ">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Method Name</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody>
                @php
                $types= App\Models\PaymentType::all();
                @endphp
                  @foreach ($types as $item)
                  <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->name }}</td>
                      

                      <td>
                          <a href="{{ url('admin/edit-method/'.$item->id)}}" class="btn btn-primary btn-sm mx-1">
                              <i class="fa fa-edit" aria-hidden="true"></i>
                          </a>
                          <a href="{{ url('admin/delete-method/'.$item->id)}}" class="btn btn-danger btn-sm">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                          </a>
                      </td>
                  </tr>
                  @endforeach

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

{{-- Register Payment Modal --}}

<div class="modal fade" id="form-modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
           <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <div id="error-div"></div>
          <div class="row">
            <form>
              <input type="hidden" name="update_id" id="update_id">
                <div class="row mb-3">
                    @php
                    $jumuiya= App\Models\User::where('role','member')->get();
                    @endphp
                    <div class="col-md-6">
                        <label for="" class="text-secondary">Payer</label>
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="">--Select Member --</option>
                            @foreach ( $jumuiya as $item)
                             <option value="{{ $item->id}}">{{ $item->fname}} {{ $item->mname}} {{ $item->lname}}</option>
                             @endforeach
                        </select>
                    </div>

                    @php
                    
                    $purpose= App\Models\Purpose::where('status','')->get();
                    @endphp
                    <div class="col-md-6">
                        <label for="" class="text-secondary">Payment Purpose</label>
                        <select name="pledge_id" id="pledge_id" class="form-control">
                            <option value="">--Select Purpose --</option>
                            @foreach ( $purpose as $item)
                             <option value="{{ $item->id}}"> {{ $item->title}}</option>
                            @endforeach
                        </select>
                    </div>

     
                    @php
                    $purpose= App\Models\PaymentType::get();
                    @endphp
                    <div class="col-md-6">
                        <label for="" class="text-secondary">Payment Method</label>
                        <select name="type_id" id="type_id" class="form-control">
                            <option value="">--Select Payment Method --</option>
                            @foreach ( $purpose as $item)
                             <option value="{{ $item->id}}"> {{ $item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="amount" class="text-secondary">Paid Amount </label>
                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Payment Amount">
                    </div>
                 </div>
                 <div class="col-md-6"></div>
                 <div class="col-md-6">
                    <div class="form-group">
                     
                        <button type="submit" class="btn btn-primary btn-block" id="save-pledge-btn">
                            <i class="fa fa-save"></i>
                            Save Payment
                        </button>
                    </div>
                 </div>
                </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  {{-- view payment modal --}}
   <script type="text/javascript">
  
            showAllPledges();
         
            /*
                This function will get all the purposes records
            */
            function showAllPledges()
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/payments";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $("#projects-table-body").html("");
                        let purposes = response.purposes;
                        for (var i = 0; i < purposes.length; i++) 
                        {
                            let showBtn =  '<button ' +
                                ' class="btn btn-primary    " ' +
                                ' onclick="showPledge(' + purposes[i].id + ')">Show' +
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
                                '<td>' + purposes[i].payer.fname + '&nbsp;' + purposes[i].payer.mname +  '&nbsp;' + purposes[i].payer.lname +   '</td>' +
                                '<td>' + purposes[i].payment.name + '</td>' +
                                '<td>' + purposes[i].purpose.title + '</td>' +
                                '<td>' + purposes[i].amount + '</td>' +
                                '<td>' + showBtn + editBtn + deleteBtn + '</td>' +
                            '</tr>';
                            $("#projects-table-body").append(projectRow);
                        }
         
                         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         
            /*
                check if form submitted is for creating or updating
            */
            $("#save-pledge-btn").click(function(event ){
                event.preventDefault();
                if($("#update_id").val() == null || $("#update_id").val() == "")
                {
                    storePledge();
                } else {
                    updatePledge();
                }
            })
         
            /*
                show modal for creating a record and 
                empty the values of form and remove existing alerts
            */
            function createPledge()
            {
                $("#alert-div").html("");
                $("#error-div").html("");   
                $("#update_id").val("");
                $("#name").val("");
                $("#type_id").val("");
                $("#purpose_id").val("");
                $("#user_id").val("");
                $("#deadline").val("");
                $("#amount").val("");
                $("#description").val("");
                $("#form-modal").modal('show'); 
            }
         
            /*
                submit the form and will be stored to the database
            */
            function storePledge()
            {   
                $("#save-pledge-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/payments";
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
                    type: "POST",
                    data: data,
                    success: function(response) {
                        $("#save-ledge-btn").prop('disabled', false);
                        let successHtml = '<div class="alert alert-success" role="alert">Payment Was Added Successfully</div>';
                        $("#alert-div").html(successHtml);
                        $("#pledge_id").val("");
                        $("#type_id").val("");
                        $("#purpose_id").val("");
                        $("#user_id").val("");
                        $("#amount").val("");
                        showAllPledges();
                        $("#form-modal").modal('hide');
                    },
                    error: function(response) {
                        $("#save-pledge-btn").prop('disabled', false);
         
                        /*
            show validation error
                        */
                        if (typeof response.responseJSON.errors !== 'undefined') 
                        {
            let errors = response.responseJSON.errors;
            let descriptionValidation = "";
            if (typeof errors.user_id !== 'undefined') 
                            {
                                descriptionValidation = '<li>' + errors.user_id[0] + '</li>';
                            }
            let nameValidation = "";
            if (typeof errors.name !== 'undefined') 
                            {
                                nameValidation = '<li>' + errors.name[0] + '</li>';
                            }
            let deadlineValidation = "";
            if (typeof errors.deadline !== 'undefined') 
                            {
                                deadlineValidation = '<li>' + errors.deadline[0] + '</li>';
                            }
              
            let amountValidation = "";
            if (typeof errors.amount !== 'undefined') 
                            {
                                amountValidation = '<li>' + errors.amount[0] + '</li>';
                            }
             
            let errorHtml = '<div class="alert alert-danger" role="alert">' +
                '<b>Validation Error!</b>' +
                '<ul>' + nameValidation + descriptionValidation + deadlineValidation + amountValidation +'</ul>' +
            '</div>';
            $("#error-div").html(errorHtml);        
        }
                    }
                });
            }
         
         
            /*
                edit record function
                it will get the existing value and show the purpose form
            */
            function editPledge(id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/payments/" + id ;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        let purpose = response.purpose;
                        $("#alert-div").html("");
                        $("#error-div").html("");   
                        $("#update_id").val(purpose.id);
                        $("#pledge_id").val(purpose.pledge_id);
                        $("#amount").val(purpose.amount);
                        $("#user_id").val(purpose.user_id);
                        $("#type_id").val(purpose.type_id);
                        $("#form-modal").modal('show'); 
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         
            /*
                sumbit the form and will update a record
            */
            function updatePledge()
            {
                $("#save-pledge-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/payments/" + $("#update_id").val();
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
                    type: "PUT",
                    data: data,
                    success: function(response) {
                        $("#save-pledge-btn").prop('disabled', false);
                        let successHtml = '<div class="alert alert-success" role="alert">Payment Was Updated Successfully !</div>';
                        $("#alert-div").html(successHtml);
                        $("#pledge_id").val("");
                        $("#type_id").val("");
                        $("#user_id").val("");
                        $("#amount").val(""); 
                        showAllPledges();
                        $("#form-modal").modal('hide');
                    },
                    error: function(response) {
                        /*
            show validation error
                        */
                        $("#save-pledge-btn").prop('disabled', false);
                        if (typeof response.responseJSON.errors !== 'undefined') 
                        {
                            console.log(response)
            let errors = response.responseJSON.errors;
            let descriptionValidation = "";
            if (typeof errors.description !== 'undefined') 
                            {
                                descriptionValidation = '<li>' + errors.description[0] + '</li>';
                            }
            let nameValidation = "";
            if (typeof errors.name !== 'undefined') 
                            {
                                nameValidation = '<li>' + errors.name[0] + '</li>';
                            }
            let deadlineValidation = "";
            if (typeof errors.deadline !== 'undefined') 
                            {
                                deadlineValidation = '<li>' + errors.deadline[0] + '</li>';
                            }
              
            let amountValidation = "";
            if (typeof errors.amount !== 'undefined') 
                            {
                                amountValidation = '<li>' + errors.amount[0] + '</li>';
                            }
             
            let errorHtml = '<div class="alert alert-danger" role="alert">' +
                '<b>Validation Error!</b>' +
                '<ul>' + nameValidation + descriptionValidation + deadlineValidation + amountValidation +'</ul>' +
            '</div>';
            $("#error-div").html(errorHtml);        
        }
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
                let url = $('meta[name=app-url]').attr("content") + "/admin/payments/" + id +"";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        let purpose = response.purpose;
                        $("#fname-info").html(purpose.payer.fname);
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
         
  </script>
@endsection