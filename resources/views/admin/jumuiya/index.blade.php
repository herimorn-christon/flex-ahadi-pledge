@extends('layouts.master')

@section('title','All Communities')


@section('content')


<div class="row mb-1">
    <div class="col-sm-6" id="alert-div">

    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="">    

        <button type="button" class="btn btn-primary btn-sm"  onclick="createProject()">
        <i class="fa fa-plus"></i>
         Add New Community
        </button>
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>

<div class="card mt-1">
    <div class="card-header bg-light">
        <h6 class="text-light">
          {{-- All Communities --}}
        </h6>
    </div>
    <div class="card-body">




        <div class="row">
            <table id="mytable" class="table table-bordered responsive">
                <thead>
                    <tr class="text-secondary">
                        <th>Jumuiya Name</th>
                        <th>Abbreviation</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="community-table-body">

                </tbody>
            </table>

        </div>



    </div>
</div>

    <!-- modal for creating and editing function -->
    <div class="modal" tabindex="-1"  id="form-modal">
        <div class="modal-dialog " >
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
{{--                 <div id="error-div"></div> --}}
                <form class="form"> 
                    <div class="form-group mb-0">
                 <input type="hidden" name="update_id" id="update_id">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Community Name">
                  
                        <input type="text" class="form-control" id="location" name="location" placeholder="Enter Community Location">
                     
                          <input type="text" class="form-control" id="abbreviation" name="abbreviation" placeholder="Enter Community Abbreviation">
                      </div>
                 
                    <button type="submit" class="btn btn-primary mt-3 form-control" id="save-project-btn">
                      <i class="fa fa-save"></i>
                      Save Community
                    </button>
                </form>
            </div>
            </div>
        </div>
    </div>
{{-- Add Community modal --}}

<div class="modal fade" tabindex="-1"  id="form-modal1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          {{-- <h4 class="modal-title">Large Modal</h4> --}}
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              <div id="error-div"></div>
            <form>
                <div class="row mb-3">
                  <input type="hidden" name="update_id" id="update_id">
                 <div class="col-md-12">
                    <div class="form-group">
                        <label for="name" class="text-secondary">Community Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Community Name">
                    </div>
                 </div>
                 <div class="col-md-12">
                  <div class="form-group">
                      <label for="abbreviation" class="text-secondary">Abbreviation</label>
                      <input type="text" name="abbreviation" id="abbreviation" class="form-control" placeholder="Enter Abbreviation">
                  </div>
               </div>
               <div class="col-md-12">
                <div class="form-group">
                    <label for="location" class="text-secondary">Location</label>
                    <input type="text" name="location" id="location" class="form-control" placeholder="Enter Location">
                </div>
                </div>
                <div class="col-md-6"></div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary mt-3 form-control" id="save-project-btn">
                        <i class="fa fa-save"></i>
                        Save Community
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

      <!-- view record modal -->
      <div class="modal" tabindex="-1" id="view-modal">
          <div class="modal-dialog modal-lg" >
              <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title text-secondary">Community Information</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <p>
                      <b class="text-secondary">Name:</b>   <span id="name-info" class="text-dark"></span>
                  </p>
                                        
                  <p>
                      <b class="text-secondary">Abbreviation:</b>   <span id="description-info" class="text-dark"></span>
                  </p>
                   <p>
                      <b class="text-secondary">Location:</b>   <span id="location-info" class="text-dark"></span>
                  </p>
                <hr>
                  {{-- <a href="{{ url('/admin/')}}" class="btn"></a> --}}
              </div>
              </div>
          </div>
      </div>
    

<script type="text/javascript">
          showAllProjects();
     
        /*
            This function will get all the project records
        */
        function showAllProjects()
        {
            let url = $('meta[name=app-url]').attr("content") + "/admin/communities";
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    $("#projects-table-body").html("");
                    let communities = response.communities;
                    for (var i = 0; i < communities.length; i++) 
                    {
                        let showBtn =  '<button ' +
                            ' class="btn btn-primary" ' +
                            ' onclick="showProject(' + communities[i].id + ')">Show' +
                        '</button> ';
                        let editBtn =  '<button ' +
                            ' class="btn btn-secondary" ' +
                            ' onclick="editProject(' + communities[i].id + ')">Edit' +
                        '</button> ';
                        let deleteBtn =  '<button ' +
                            ' class="btn btn-danger" ' +
                            ' onclick="destroyProject(' + communities[i].id + ')">Delete' +
                        '</button>';
     
                        let projectRow = '<tr>' +
                            '<td>' + communities[i].name + '</td>' +
                            '<td>' + communities[i].abbreviation + '</td>' +
                            '<td>' + communities[i].location + '</td>' +
                            '<td>' + showBtn + editBtn + deleteBtn + '</td>' +
                        '</tr>';
                        $("#community-table-body").append(projectRow);
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
        $("#save-project-btn").click(function(event ){
            event.preventDefault();
            if($("#update_id").val() == null || $("#update_id").val() == "")
            {
                storeProject();
            } else {
                updateProject();
            }
        })
     
        /*
            show modal for creating a record and 
            empty the values of form and remove existing alerts
        */
        function createProject()
        {
            $("#alert-div").html("");
            $("#error-div").html("");   
            $("#update_id").val("");
            $("#name").val("");
            $("#abbreviation").val("");
            $("#location").val("");
            $("#form-modal").modal('show'); 
        }
     
        /*
            submit the form and will be stored to the database
        */
        function storeProject()
        {   
            $("#save-project-btn").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/admin/communities";
            let data = {
                name: $("#name").val(),
                abbreviation: $("#abbreviation").val(),
                location: $("#location").val(),
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: data,
                success: function(response) {
                    $("#save-project-btn").prop('disabled', false);
                    let successHtml = '<div class="alert alert-success " role="alert"> Community Was Added Successfully !</div>';
                    $("#alert-div").html(successHtml);
                    $("#name").val("");
                    $("#abbreviation").val("");
                    $("#location").val("");
                    showAllProjects();
                    $("#form-modal").modal('hide');
                },
                error: function(response) {
                    $("#save-project-btn").prop('disabled', false);
     
                    /*
        show validation error
                    */
                    if (typeof response.responseJSON.errors !== 'undefined') 
                    {
        let errors = response.responseJSON.errors;
        let abbreviationValidation = "";
        if (typeof errors.abbreviation !== 'undefined') 
                        {
                            abbreviationValidation = '<li>' + errors.abbreviation[0] + '</li>';
                        }
        let locationValidation = "";
        if (typeof errors.location !== 'undefined') 
                        {
                            locationValidation = '<li>' + errors.location[0] + '</li>';
                        }
        let nameValidation = "";
        if (typeof errors.name !== 'undefined') 
                        {
                            nameValidation = '<li>' + errors.name[0] + '</li>';
                        }
         
        let errorHtml = '<div class="alert alert-danger" role="alert">' +
            '<b>Validation Error!</b>' +
            '<ul>' + nameValidation + abbreviationValidation +locationValidation + '</ul>' +
        '</div>';
        $("#error-div").html(errorHtml);        
    }
                }
            });
        }
     
     
        /*
            edit record function
            it will get the existing value and show the project form
        */
        function editProject(id)
        {
            let url = $('meta[name=app-url]').attr("content") + "/admin/communities/" + id ;
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    let community = response.community;
                    $("#alert-div").html("");
                    $("#error-div").html("");   
                    $("#update_id").val(community.id);
                    $("#name").val(community.name);
                    $("#abbreviation").val(community.abbreviation);
                    $("#location").val(community.location);
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
        function updateProject()
        {
            $("#save-project-btn").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/admin/communities/" + $("#update_id").val();
            let data = {
                id: $("#update_id").val(),
                name: $("#name").val(),
                abbreviation: $("#abbreviation").val(),
                location: $("#location").val(),
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "PUT",
                data: data,
                success: function(response) {
                    $("#save-project-btn").prop('disabled', false);
                    let successHtml = '<div class="alert alert-success " role="alert">Community Was Updated Successfully !</div>';
                    $("#alert-div").html(successHtml);
                    $("#name").val("");
                    $("#abbreviation").val("");
                    $("#location").val("");
                    showAllProjects();
                    $("#form-modal").modal('hide');
                },
                error: function(response) {
                    /*
        show validation error
                    */
                    $("#save-project-btn").prop('disabled', false);
                    if (typeof response.responseJSON.errors !== 'undefined') 
                    {
                        console.log(response)
        let errors = response.responseJSON.errors;
        let abbreviationValidation = "";
        if (typeof errors.abbreviation !== 'undefined') 
                        {
                            abbreviationValidation = '<li>' + errors.abbreviation[0] + '</li>';
                        }
        let locationValidation = "";
        if (typeof errors.location !== 'undefined') 
                        {
                            locationValidation = '<li>' + errors.location[0] + '</li>';
                        }
        let nameValidation = "";
        if (typeof errors.name !== 'undefined') 
                        {
                            nameValidation = '<li>' + errors.name[0] + '</li>';
                        }
         
        let errorHtml = '<div class="alert alert-danger" role="alert">' +
            '<b>Validation Error!</b>' +
            '<ul>' + nameValidation + abbreviationValidation +locationValidation + '</ul>' +
        '</div>';
        $("#error-div").html(errorHtml);        
    }
                }
            });
        }
     
        /*
            get and display the record info on modal
        */
        function showProject(id)
        {
            $("#name-info").html("");
            $("#description-info").html("");
            let url = $('meta[name=app-url]').attr("content") + "/admin/communities/" + id +"";
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    let community = response.community;
                    $("#name-info").html(community.name);
                    $("#description-info").html(community.abbreviation);
                    $("#location-info").html(community.location);
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
        function destroyProject(id)
        {
            let url = $('meta[name=app-url]').attr("content") + "/admin/communities/" + id;
            let data = {
                name: $("#name").val(),
                abbreviation: $("#abbreviation").val(),
                location: $("#location").val(),
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "DELETE",
                data: data,
                success: function(response) {
                    let successHtml = '<div class="alert alert-success " role="alert">Community Was Deleted Successfully !</div>';
                    $("#alert-div").html(successHtml);
                    showAllProjects();
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }
     
</script>
@endsection