@extends('layouts.member')

@section('title','My Pledges')


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
      <ol class="float-sm-right" type="none">
        <li class="">  
        <button type="button" class="btn bg-navy btn-sm" data-toggle="modal"  onclick="createPledge()">
            <i class="fa fa-plus"></i>
             Register New Pledge 
        </button>  
        <button type="button" class="btn bg-navy btn-sm" data-toggle="modal" data-target="#types">
            <i class="fa fa-list"></i>
            Purposes
        </button>
    
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>

<div class="card mt-1">
    
    <div class="">




        <div class="mt-4 px-2 ">
 
          <table id="mytable"  class="table table-bordered cell-border " >
            <thead>
                <tr class="text-secondary">
                    <th>ID</th>
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
        <button type="button" class="close btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
        @php
        $purposes=App\Models\Purpose::where('status','')->get();
      
        @endphp
        <div class="row">
          <table id="modaltable"  class="cell-border table table-bordered ">
              <thead>
                  <tr class="text-secondary">
                      <th>ID</th>
                      <th>Purpose</th>
                      <th>Details</th>
                      <th>Start date</th>
                      <th>End date</th>
                      <th>Status</th>
                  </tr>
              </thead>
              <tbody id="types-table-body">
                  @foreach ($purposes as $item)
                  <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->title }}</td>
                      <td>{{ $item->description }}</td>
                      <td>{{ $item->start_date }}</td>
                      <td>{{ $item->end_date }}</td>
                      <td class="text-success">{{ $item->status=='1'? 'Hidden':'Active' }}</td>
                   
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
                $types= App\Models\PledgeType::get();
                @endphp
                <div class="col-md-12">
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
                 
                    </div>

                    <div class="col-md-6 ">
                      <label for="" class="text-white">.</label>
                        <button class="btn bg-navy btn-block " id="save-pledge-btn" type="submit">
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
          <b class="text-secondary">Description:</b> <br><span id="description-info" class="text-dark"></span>
      </p>
                
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


@endsection

@section('scripts')

<script type="text/javascript">
  
          showAllPledges();
       
          /*
              This function will get all the purposes records
          */
          function showAllPledges()
          {
              let url = $('meta[name=app-url]').attr("content") + "/member/pledges";
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                      $("#pledges-table-body").html("");
                      let pledges = response.pledges;
                      for (var i = 0; i < pledges.length; i++) 
                      {
                          let showBtn =  '<button ' +
                              ' class="btn btn-sm bg-warning    " ' +
                              ' onclick="showPledge(' + pledges[i].id + ')"><i class="fa fa-eye"></i>' +
                          '</button> ';

                        
                            let editBtn =  '<button ' +
                              ' class="btn btn-sm bg-navy " ' +
                              ' onclick="editPledge(' + pledges[i].id + ')"><i class="fa fa-edit"></i>' +
                          '</button> ';
                          let deleteBtn =  '<button ' +
                              ' class="btn btn-sm btn-danger" ' +
                              ' onclick="destroyPledge(' + pledges[i].id + ')">Delete' +
                          '</button>';
                          let adminBtn =  '<button ' +
                              ' class="btn btn-sm bg-navy" disabled><i class="fa fa-user-tie text-danger"></i>' +
                          '</button>';
                              
                   
                          
       
                          let pledgesRow = '<tr>' +
                              '<td>' + pledges[i].id + '</td>' +
                              '<td>' + pledges[i].name + '</td>' +
                              '<td>' + pledges[i].purpose.title + '</td>' +
                              '<td>' + pledges[i].amount +'</td>' +
                              '<td>' + pledges[i].deadline +'</td>' +
                              '<td class="text-success">' +(pledges[i].purpose.status == '0' ? 'Not Fullfilled':'Fullfilled')+ '</td>'+
                              '<td>' + showBtn + (pledges[i].user_id == pledges[i].created_by ? editBtn :adminBtn)+'</td>' +
                          '</tr>';
                          $("#pledges-table-body").append(pledgesRow);
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
              let url = $('meta[name=app-url]').attr("content") + "/member/pledges";
              let data = {
                  name: $("#name").val(),
                  amount: $("#amount").val(),
                  deadline: $("#deadline").val(),
                  description: $("#description").val(),
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
                      $("#save-pledge-btn").prop('disabled', false);
                      let successHtml = '<div class="alert alert-success" role="alert">Pledge Was Created Successfully</div>';
                      $("#alert-div").html(successHtml);
                      $("#name").val("");
                      $("#type_id").val("");
                      $("#purpose_id").val("");
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
              let url = $('meta[name=app-url]').attr("content") + "/member/pledges/" + id ;
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
              let url = $('meta[name=app-url]').attr("content") + "/member/pledges/" + $("#update_id").val();
              let data = {
                  name: $("#name").val(),
                  amount: $("#amount").val(),
                  deadline: $("#deadline").val(),
                  description: $("#description").val(),
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
              let url = $('meta[name=app-url]').attr("content") + "/member/pledges/" + id +"";
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                      let purpose = response.purpose;
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
       
</script>

@endsection