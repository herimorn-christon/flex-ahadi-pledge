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
    
    </div>
    <div class="">




        <div class="">
            <table class="table table-bordered responsive">
                <thead>
                    <tr class="text-secondary">
                        <th>Jumuiya Name</th>
                        <th>Abbreviation</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="projects-table-body">

                </tbody>
            </table>

        </div>



    </div>
</div>



{{-- add community modal --}}
<div class="modal" id="form-modal" tabindex="-1" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" name="update_id" id="update_id">
       
          <div class="mb-3">
            <label for="recipient-name" class=" text-secondary">Community Name:</label>
            <input type="text" class="form-control" id="name"  name="name" placeholder="Enter Community Name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="text-secondary">Community Abbreviation:</label>
             <input type="text" class="form-control" id="abbreviation" name="abbreviation" placeholder="Enter Community Abbreviation">
          </div>
          <div class="mb-3">
            <label for="message-text" class=" text-secondary">Community Location:</label>
            <input type="text" class="form-control" id="location" name="location" placeholder="Enter Community Location">
          </div>
          <div class="row">
            <div class="col-md-6">

            </div>
            <div class="mb-3 col-md-6">
               <button type="submit" class="btn btn-primary btn-block " id="save-project-btn">
                <i class="fa fa-save"></i>
                Save Community
              </button>
            </div>
          </div>

     
        </form>
      </div>
    </div>
  </div>
</div>

<!-- view record modal -->

<div class="modal fade" id="view-modal" tabindex="-1" >
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tr>
            <td class="font-weight-bolder text-secondary">Community Name</td>
            <td><span id="name-info" class="text-dark"></span></td>
          </tr>
          <tr>
            <td class="font-weight-bolder text-secondary">Abbreviation</td>
            <td><span id="description-info" class="text-dark"></span></td>
          </tr>
          <tr>
            <td class="font-weight-bolder text-secondary">Location</td>
            <td><span id="location-info" class="text-dark"></span></td>
          </tr>
        </table>
        <h6 class="text-secondary">
          Community(Jumuiya) Members
        </h6>
        <hr>
        <table class="table table-bordered responsive">
          <thead>
              <tr class="text-secondary">
                <th>Member ID</th>
                <th>Member Name</th>
                <th>Phone Number</th>
                <th>Gender</th>
                <th>Status </th>
              </tr>
          </thead>
          <tbody id="members-table-body">
        
          </tbody>
          <tfoot></tfoot>
      </table>
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
                    $("#members-table-body").html("");
                    let community = response.community;
                    $("#name-info").html(community.name);
                    $("#description-info").html(community.abbreviation);
                    $("#location-info").html(community.location);
                  
                  // for community members
                  let members = response.members;
                        for (var i = 0; i < members.length; i++) 
                        {      
         
                       let membersRow = '<tr>' +
                            '<td>' + community.abbreviation +'/' + members[i].id +'</td>' +
                                '<td>' + members[i].fname + '&nbsp;'+ members[i].mname + '&nbsp;'+ members[i].lname +'</td>' +
                                '<td>' + members[i].lname + '</td>' +  
                                '<td>' + members[i].phone + '</td>' +
                                '<td class="text-success">' + (members[i].status == '0' ? 'Enabled':'Disabled') + '</td>' +
                            '</tr>';
                            $("#members-table-body").append(membersRow);
                        }   


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