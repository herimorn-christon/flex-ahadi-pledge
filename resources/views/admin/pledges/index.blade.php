@extends('layouts.master')

@section('title','All Communities')


@section('content')


<div class="row mb-1">
    <div class="col-sm-6" id="alert-div">
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="">  
        <button type="button" class="btn btn-primary btn-sm"  onclick="createPledge()">
            <i class="fa fa-plus"></i>
             Register Pledge 
        </button>  
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#types">
            <i class="fa fa-list"></i>
            Pledge Types
        </button>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_type">
        <i class="fa fa-plus"></i>
         Add Type
        </button>
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>

<div class="card mt-1">
    <div class="card-header bg-light">
        <h6 class="text-light">
          {{-- All Pledges Made --}}
           
        </h6>
    </div>
    <div class="card-body">




        <div class="row">
 
          <table  class="table table-bordered ">
            <thead>
               <tr class="text-secondary">
                  <th>Member Name</th>
                  <th>Pledge(Ahadi)</th>
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


{{-- Add Pledge Type modal --}}

<div class="modal fade" id="add_type">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          {{-- <h4 class="modal-title">Large Modal</h4> --}}
          <button type="button" class="close btn-danger btn-sm " data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ url('admin/add-type') }}" method="post">
                @csrf
                <div class="row mb-3">
                 <div class="col-md-12">
                    <div class="form-group">
                        <label for="title" class="text-secondary">Pledge Type</label>
                        <input type="text" name="title" id="title" class="title form-control" placeholder="Enter Pledge Title">
                    </div>
                 </div>
                 <div class="col-md-6"></div>
                 <div class="col-md-6">
                    <div class="form-group">
                     
                        <button type="submit" class="add_type btn btn-primary">
                            <i class="fa fa-save"></i>
                            Save Pledge Type
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
               <tr class="text-secondary">
                  <th>ID</th>
                  <th>Pledge Type</th>
                   <th width="240px">Actions</th>

                </tr>
              </thead>
              @php
              $types= App\Models\PledgeType::get();
              @endphp
              <tbody id="projects-table-body">
                @foreach ( $types as $item)
                <tr>
                  <td>{{ $item->id}}</td>
                  <td>{{ $item->title}}</td>
                  <td></td>
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

{{-- register new pledge  modal--}}

<div class="modal fade" id="form-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                <div id="error-div"></div>
             <form>
             <input type="hidden" name="update_id" id="update_id">
                <div class="row mb-3">
                @php
                $jumuiya= App\Models\User::where('role','member')->get();
                @endphp
                <div class="col-md-6">
                    <label for="" class="text-secondary">Pledge Owner</label>
                    <select name="user_id" id="user_id" class="form-control">
                        <option value="">--Select Member --</option>
                        @foreach ( $jumuiya as $item)
                        <option value="{{ $item->id}}">{{ $item->fname}} {{ $item->mname}} {{ $item->lname}}</option>
                        @endforeach
                    </select>
                </div>
                @php
                $types= App\Models\PledgeType::get();
                @endphp
                <div class="col-md-6">
                    <label for="" class="text-secondary">Pledge Type</label>
                    <select name="type_id"  id="type_id" class="form-control">
                        <option value="">--Select Pledge Type --</option>
                        @foreach ( $types as $item)
                        <option value="{{ $item->id}}">{{ $item->title}}</option>
                        @endforeach
                    </select>
                </div>
                @php
                $purpose= App\Models\Purpose::where('status','')->get();
                @endphp
                <div class="col-md-6">
                    <label for="" class="text-secondary">Pledge Purpose</label>
                    <select name="purpose_id" id="purpose_id" class="form-control">
                        <option value="">--Select Purpose --</option>
                        @foreach ( $purpose as $item)
                        <option value="{{ $item->id}}"> {{ $item->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="text-secondary">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Pledge Name">
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="amount" class="text-secondary">Amount</label>
                    <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Pledge Amount">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="deadline" class="text-secondary">Deadline</label>
                    <input type="date" name="deadline" id="deadline" class="form-control" placeholder="Enter Pledge Deadline">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description" class="text-secondary">Description</label>
                    <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                </div>
            </div>
                <div class="col-md-12">

                <div class="row mt-2">

                    <div class="col-md-6 ">
                        <label for="" class="text-secondary"> Pledge Status</label>
                        {{-- <input type="checkbox" name="status" id="status"> --}}
                        <select name="status" id="status" class="form-control">
                          <option value="0">Not Fullfilled</option>
                          <option value="1">Fullfilled</option>
                        </select>
                    </div>

                    <div class="col-md-6 ">
                      <label for="" class="text-white">.</label>
                        <button class="btn btn-primary btn-block " id="save-pledge-btn" type="submit">
                        <i class="fa fa-save"></i>
                        Save Pledge 
                        </button>
                    </div>
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

{{-- view single pledge info--}}
<div class="modal fade" id="view-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>
          <b class="text-secondary">Member Name:</b>   <span id="fname-info" class="text-dark"></span> <span id="mname-info" class="text-dark"></span> <span id="lname-info" class="text-dark"></span>
          <hr>
          <b class="text-secondary">Pledge Name:</b>   <span id="title-info" class="text-dark"></span>
          <hr>
          <b class="text-secondary">Pledge Type:</b>   <span id="type-info" class="text-dark"></span>
          <hr>
          <b class="text-secondary">Pledge Purpose:</b>   <span id="purpose-info" class="text-dark"></span>
          <hr>    
          <b class="text-secondary">Pledge Status:</b>   <span id="status-info" class="text-success"></span>
          <hr>        
          <b class="text-secondary">Deadline:</b>   <span id="start-info" class="text-dark"></span>
          <hr>
          <b class="text-secondary">Amount:</b>   <span id="end-info" class="text-dark"></span>
          <hr>
          <b class="text-secondary">Description:</b> <br>   <span id="description-info" class="text-dark"></span>
      </p>
                
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


  <script type="text/javascript">
  
          showAllPledges();
       
          /*
              This function will get all the purposes records
          */
          function showAllPledges()
          {
              let url = $('meta[name=app-url]').attr("content") + "/admin/pledges";
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
                              '<td>' + purposes[i].user.fname + '&nbsp;' + purposes[i].user.mname +  '&nbsp;' + purposes[i].user.lname +   '</td>' +
                              '<td>' + purposes[i].name + '</td>' +
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
              let url = $('meta[name=app-url]').attr("content") + "/admin/pledges";
              let data = {
                  name: $("#name").val(),
                  amount: $("#amount").val(),
                  deadline: $("#deadline").val(),
                  description: $("#description").val(),
                  user_id: $("#user_id").val(),
                  type_id: $("#type_id").val(),
                  purpose_id: $("#purpose_id").val(),
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
                      let successHtml = '<div class="alert alert-success" role="alert">Pledge Was Created Successfully</div>';
                      $("#alert-div").html(successHtml);
                      $("#name").val("");
                      $("#type_id").val("");
                      $("#purpose_id").val("");
                      $("#user_id").val("");
                      $("#deadline").val("");
                      $("#amount").val("");
                      $("#description").val("");
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
              edit record function
              it will get the existing value and show the purpose form
          */
          function editPledge(id)
          {
              let url = $('meta[name=app-url]').attr("content") + "/admin/pledges/" + id ;
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                      let purpose = response.purpose;
                      $("#alert-div").html("");
                      $("#error-div").html("");   
                      $("#update_id").val(purpose.id);
                      $("#name").val(purpose.name);
                      $("#amount").val(purpose.amount);
                      $("#user_id").val(purpose.user_id);
                      $("#type_id").val(purpose.type_id);
                      $("#purpose_id").val(purpose.purpose_id);
                      $("#deadline").val(purpose.deadline);
                      $("#description").val(purpose.description);
                      $("#status").val(purpose.status);
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
              let url = $('meta[name=app-url]').attr("content") + "/admin/pledges/" + $("#update_id").val();
              let data = {
                  name: $("#name").val(),
                  amount: $("#amount").val(),
                  deadline: $("#deadline").val(),
                  description: $("#description").val(),
                  user_id: $("#user_id").val(),
                  type_id: $("#type_id").val(),
                  purpose_id: $("#purpose_id").val(),
                  status: $("#status").val(),
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
                      let successHtml = '<div class="alert alert-success" role="alert">Pledge Was Updated Successfully !</div>';
                      $("#alert-div").html(successHtml);
                      $("#name").val("");
                      $("#type_id").val("");
                      $("#purpose_id").val("");
                      $("#user_id").val("");
                      $("#deadline").val("");
                      $("#amount").val("");
                      $("#description").val("");   
                      $("#status").val(""); 
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
              let url = $('meta[name=app-url]').attr("content") + "/admin/pledges/" + id +"";
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                      let purpose = response.purpose;
                      $("#fname-info").html(purpose.user.fname );
                      $("#mname-info").html(purpose.user.mname );
                      $("#lname-info").html(purpose.user.lname );
                      $("#title-info").html(purpose.name);
                      $("#start-info").html(purpose.deadline);
                      $("#status-info").html(purpose.status == '0' ? 'Not Fullfilled':'Fullfilled');
                      $("#end-info").html(purpose.amount);
                      $("#type-info").html(purpose.type.title);
                      $("#purpose-info").html(purpose.purpose.title);
                      $("#description-info").html(purpose.description);
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
              let url = $('meta[name=app-url]').attr("content") + "/admin/pledges/" + id;
              let data = {
                  name: $("#name").val(),
                  amount: $("#amount").val(),
                  deadline: $("#deadline").val(),
                  user_id: $("#user_id").val(),
                  type_id: $("#type_id").val(),
                  purpose_id: $("#purpose_id").val(),
                  description: $("#description").val(),
              };
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: url,
                  type: "DELETE",
                  data: data,
                  success: function(response) {
                      let successHtml = '<div class="alert alert-success" role="alert">Pledge Was Deleted Successfully </div>';
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

@section('scripts')



@endsection