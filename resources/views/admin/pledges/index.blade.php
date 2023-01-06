@extends('layouts.master')

@section('title','Admin | Manage Pledges')


@section('content')


<div class="row mb-1">
    <div class="col-sm-6" id="alert-div">
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="float-sm-right" type="none">
        <li class="">  
        <button type="button" class="btn bg-navy btn-sm"  onclick="createPledge()">
            <i class="fa fa-plus"></i>
             Register Pledge 
        </button>  
        <button type="button" class="btn bg-navy btn-sm" data-toggle="modal" onclick="showAllTypes()">
            <i class="fa fa-list"></i>
            Pledge Types
        </button>
        <button type="button" class="btn bg-navy btn-sm" data-toggle="modal" onclick="createType()">
        <i class="fa fa-plus"></i>
         Add Type
        </button>
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>

<div class="card mt-1">
    




        <div class="responsive p-1">
 
          <table id="example" class="table table-bordered cell-border">
            <thead>
               <tr class="text-secondary">
                  <th>Member Name</th>
                  <th>Pledge(Ahadi)</th>
                <th>Purpose</th>
                <th>Amount</th>
                 <th>Actions</th>

                </tr>
            </thead>
            <tbody id="projects-table-body">


            </tbody>
        </table>
        </div>



</div>


{{-- Add Pledge Type modal --}}

<div class="modal fade" id="type-modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <button type="button" class="btn-close btn-sm btn-danger " data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form >
              <input type="hidden" name="update_id" id="update_id">
                <div class="row mb-3">
                 <div class="col-md-12">
                    <div class="form-group">
                        <label for="title" class="text-secondary">Pledge Type</label>
                        <input type="text" name="title" id="title" class="title form-control" placeholder="Enter Pledge Type Title">
                    </div>
                 </div>
                 <div class="col-md-7"></div>
                 <div class="col-md-5">
                    <div class="form-group">
                     
                        <button type="submit" class="add_type btn bg-navy btn-block" id="save-type-btn">
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
      <div class="modal-header bg-light">
        <button type="button" class="btn-close btn-sm btn-danger " data-bs-dismiss="modal" aria-label="Close"></button>

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
              <tbody id="types-table-body">

              </tbody>
          </table>

      </div>
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
                        <select name="status" id="status" class="form-control bg-light">
                          <option value="0">Not Fullfilled</option> 
                          <option value="1">Fullfilled</option>
                        </select>
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
          <b class="text-secondary">Description:</b> <br><span id="description-info" class="text-dark"></span>
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
                              ' class="btn btn-sm bg-teal" ' +
                              ' onclick="showPledge(' + purposes[i].id + ')"><i class="fa fa-eye"></i>' +
                          '</button> ';
                          let editBtn =  '<button ' +
                              ' class="btn btn-sm bg-navy" ' +
                              ' onclick="editPledge(' + purposes[i].id + ')"><i class="fa fa-edit"></i>' +
                          '</button> ';
                          let deleteBtn =  '<button ' +
                              ' class="btn btn-danger btn-sm" ' +
                              ' onclick="destroyPledge(' + purposes[i].id + ')"><i class="fa fa-trash"></i>' +
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
                This function will get all the payments records
            */
            function showAllTypes()
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/types";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $("#types-table-body").html("");
                        let types = response.types;
                        for (var i = 0; i < types.length; i++) 
                        {
                          
                            let editBtn =  '<button ' +
                                ' class="btn bg-navy btn-sm" ' +
                                ' onclick="editType(' + types[i].id + ')"><i class="fa fa-edit"></i>' +
                            '</button> ';
                            let deleteBtn =  '<button ' +
                                ' class="btn btn-danger btn-sm" ' +
                                ' onclick="destroyType(' + types[i].id + ')"><i class="fa fa-trash"></i>' +
                            '</button>';
         
                            let projectRow = '<tr>' +
                                '<td>' + types[i].id + '</td>' +
                                '<td>' + types[i].title + '</td>' +
                                '<td>' + editBtn + deleteBtn + '</td>' +
                            '</tr>';
                            $("#types-table-body").append(projectRow);
                            $("#types").modal('show'); 
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
                check if form submitted is for creating or updating
            */
            $("#save-type-btn").click(function(event ){
                event.preventDefault();
                if($("#update_id").val() == null || $("#update_id").val() == "")
                {
                    storeType();
                } else {
                    updateType();
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
                show modal for creating a record and 
                empty the values of form and remove existing alerts
            */
            function createType()
            {
                $("#alert-div").html("");
                $("#error-div").html("");   
                $("#update_id").val("");
                $("#title").val("");
                $("#type-modal").modal('show'); 
            }
         
            /*
                submit the form and will be stored to the database
            */
            function storeType()
            {   
                $("#save-type-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/types";
                let data = {
                    title: $("#title").val(),
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: data,
                    success: function(response) {
                        $("#save-type-btn").prop('disabled', false);
                        let successHtml = '<div class="alert alert-success" role="alert">Pledge Type Was Added Successfully</div>';
                        $("#alert-div").html(successHtml);
                        $("#title").val("");
    //                     showAllTypes();
                        $("#type-modal").modal('hide');
                    },
                    error: function(response) {
                        $("#save-type-btn").prop('disabled', false);
         
                        /*
            show validation error
                        */
                        if (typeof response.responseJSON.errors !== 'undefined') 
                        {
            let errors = response.responseJSON.errors;
            if (typeof errors.title !== 'undefined') 
                            {
                                nameValidation = '<li>' + errors.title[0] + '</li>';
                            }
             
            let errorHtml = '<div class="alert alert-danger" role="alert">' +
                '<b>Validation Error!</b>' +
                '<ul>' + nameValidation + '</ul>' +
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
                edit record function
                it will get the existing value and show the payment form form
            */
            function editType(id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/types/" + id ;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        let type = response.type;
                        $("#alert-div").html("");
                        $("#error-div").html("");   
                        $("#update_id").val(type.id);
                        $("#title").val(type.title);
                        $("#types").modal('hide');
                        $("#type-modal").modal('show'); 
                       
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         
            /*
                sumbit the form and will update a record
            */
            function updateType()
            {
                $("#save-type-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/types/" + $("#update_id").val();
                let data = {
                    title: $("#title").val(),
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "PUT",
                    data: data,
                    success: function(response) {
                        $("#save-type-btn").prop('disabled', false);
                        let successHtml = '<div class="alert alert-success" role="alert">Pledge Type Was Updated Successfully !</div>';
                        $("#alert-div").html(successHtml);
                        $("#title").val("");
    //                     showAllTypes();
                        $("#type-modal").modal('hide');
                    },
                    error: function(response) {
                        /*
            show validation error
                        */
                        $("#save-type-btn").prop('enabled', true);
                        if (typeof response.responseJSON.errors !== 'undefined') 
                        {
                            console.log(response)
            let errors = response.responseJSON.errors;
            let nameValidation = "";
            if (typeof errors.title !== 'undefined') 
                            {
                                nameValidation = '<li>' + errors.title[0] + '</li>';
                            }
            let errorHtml = '<div class="alert alert-danger" role="alert">' +
                '<b>Validation Error!</b>' +
                '<ul>' + nameValidation + '</ul>' +
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
                      let successHtml = '<div class="alert alert-danger" role="alert">Pledge Was Deleted Successfully </div>';
                      $("#alert-div").html(successHtml);
                      showAllPledges();
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }
       

          /*
                delete pledge type record function
            */
            function destroyType(id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/types/" + id;
                let data = {
                    title: $("#title").val(),
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "DELETE",
                    data: data,
                    success: function(response) {
                        let successHtml = '<div class="alert alert-danger" role="alert">Pledge Type Was Deleted Successfully </div>';
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

@section('scripts')



@endsection