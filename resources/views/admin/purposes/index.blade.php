@extends('layouts.master')

@section('title','All Communities')


@section('content')


<div class="row mb-1">
    <div class="col-sm-6" id="alert-div">

    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="">    

        <button type="button" class="btn btn-primary btn-sm"  onclick="createPurpose()">
        <i class="fa fa-plus"></i>
         Add New Purpose
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
                        <th>Purpose Title</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                         <th width="240px">Actions</th>

                    </tr>
                </thead>
                <tbody id="projects-table-body">

                </tbody>
            </table>

        </div>



    </div>
</div>



{{-- test modal --}}
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
            <label for="title" class=" text-secondary">Purpose Title:</label>
            <input type="text" class="form-control" id="title"  name="title" placeholder="Enter Purpose Title">
          </div>
          <div class="mb-3">
            <label for="message-text" class="text-secondary">Start Date:</label>
             <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Enter Start Date">
          </div>
          <div class="mb-3">
            <label for="message-text" class="text-secondary">End Date:</label>
             <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Enter End Date">
          </div>
          <div class="mb-3">
            <label for="message-text" class=" text-secondary">Purpose Description:</label>
             <textarea class="form-control" id="description" rows="3" name="description"></textarea>
          </div>
          <div class="row">
            <div class="col-md-6">

            </div>
            <div class="mb-3 col-md-6">
               <button type="submit" class="btn btn-primary btn-block " id="save-purpose-btn">
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
  
            showAllPurposes();
         
            /*
                This function will get all the purposes records
            */
            function showAllPurposes()
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/purposes";
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
                                ' onclick="showPurpose(' + purposes[i].id + ')">Show' +
                            '</button> ';
                            let editBtn =  '<button ' +
                                ' class="btn btn-secondary" ' +
                                ' onclick="editPurpose(' + purposes[i].id + ')">Edit' +
                            '</button> ';
                            let deleteBtn =  '<button ' +
                                ' class="btn btn-danger" ' +
                                ' onclick="destroyPurpose(' + purposes[i].id + ')">Delete' +
                            '</button>';
         
                            let projectRow = '<tr>' +
                                '<td>' + purposes[i].title + '</td>' +
                                '<td>' + purposes[i].start_date + '</td>' +
                                '<td>' + purposes[i].end_date + '</td>' +
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
            $("#save-purpose-btn").click(function(event ){
                event.preventDefault();
                if($("#update_id").val() == null || $("#update_id").val() == "")
                {
                    storePurpose();
                } else {
                    updatePurpose();
                }
            })
         
            /*
                show modal for creating a record and 
                empty the values of form and remove existing alerts
            */
            function createPurpose()
            {
                $("#alert-div").html("");
                $("#error-div").html("");   
                $("#update_id").val("");
                $("#title").val("");
                $("#start_date").val("");
                $("#end_date").val("");
                $("#description").val("");
                $("#form-modal").modal('show'); 
            }
         
            /*
                submit the form and will be stored to the database
            */
            function storePurpose()
            {   
                $("#save-purpose-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/purposes";
                let data = {
                    title: $("#title").val(),
                    start_date: $("#start_date").val(),
                    end_date: $("#end_date").val(),
                    description: $("#description").val(),
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: data,
                    success: function(response) {
                        $("#save-purpose-btn").prop('disabled', false);
                        let successHtml = '<div class="alert alert-success" role="alert">Purpose Was Created Successfully</div>';
                        $("#alert-div").html(successHtml);
                        $("#tite").val("");
                        $("#start_date").val("");
                        $("#end_date").val("");
                        $("#description").val("");
                        showAllPurposes();
                        $("#form-modal").modal('hide');
                    },
                    error: function(response) {
                        $("#save-purpose-btn").prop('disabled', false);
         
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
            let titleValidation = "";
            if (typeof errors.title !== 'undefined') 
                            {
                                titleValidation = '<li>' + errors.title[0] + '</li>';
                            }
            let startDateValidation = "";
            if (typeof errors.start_date !== 'undefined') 
                            {
                                startDateValidation = '<li>' + errors.start_date[0] + '</li>';
                            }
              
            let endDateValidation = "";
            if (typeof errors.end_date !== 'undefined') 
                            {
                                endDateValidation = '<li>' + errors.end_date[0] + '</li>';
                            }
             
            let errorHtml = '<div class="alert alert-danger" role="alert">' +
                '<b>Validation Error!</b>' +
                '<ul>' + titleValidation + descriptionValidation + startDateValidation + endDateValidation +'</ul>' +
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
            function editPurpose(id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/purposes/" + id ;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        let purpose = response.purpose;
                        $("#alert-div").html("");
                        $("#error-div").html("");   
                        $("#update_id").val(purpose.id);
                        $("#title").val(purpose.title);
                        $("#start_date").val(purpose.start_date);
                        $("#end_date").val(purpose.end_date);
                        $("#description").val(purpose.description);
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
            function updatePurpose()
            {
                $("#save-purpose-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/purposes/" + $("#update_id").val();
                let data = {
                    title: $("#title").val(),
                    start_date: $("#start_date").val(),
                    end_date: $("#end_date").val(),
                    description: $("#description").val(),
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "PUT",
                    data: data,
                    success: function(response) {
                        $("#save-purpose-btn").prop('disabled', false);
                        let successHtml = '<div class="alert alert-success" role="alert">Purpose Was Updated Successfully !</div>';
                        $("#alert-div").html(successHtml);
                        $("#tite").val("");
                        $("#start_date").val("");
                        $("#end_date").val("");
                        $("#description").val("");
                        showAllPurposes();
                        $("#form-modal").modal('hide');
                    },
                    error: function(response) {
                        /*
            show validation error
                        */
                        $("#save-purpose-btn").prop('disabled', false);
                        if (typeof response.responseJSON.errors !== 'undefined') 
                        {
                            console.log(response)
            let errors = response.responseJSON.errors;
           descriptionValidation = "";
            if (typeof errors.description !== 'undefined') 
                            {
                                descriptionValidation = '<li>' + errors.description[0] + '</li>';
                            }
            let titleValidation = "";
            if (typeof errors.title !== 'undefined') 
                            {
                                titleValidation = '<li>' + errors.title[0] + '</li>';
                            }
            let startDateValidation = "";
            if (typeof errors.start_date !== 'undefined') 
                            {
                                startDateValidation = '<li>' + errors.start_date[0] + '</li>';
                            }
              
            let endDateValidation = "";
            if (typeof errors.end_date !== 'undefined') 
                            {
                                endDateValidation = '<li>' + errors.end_date[0] + '</li>';
                            }
             
            let errorHtml = '<div class="alert alert-danger" role="alert">' +
                '<b>Validation Error!</b>' +
                '<ul>' + titleValidation + descriptionValidation + startDateValidation + endDateValidation +'</ul>' +
            '</div>';
            $("#error-div").html(errorHtml);        
        }
                    }
                });
            }
         
            /*
                get and display the record info on modal
            */
            function showPurpose(id)
            {
                $("#name-info").html("");
                $("#description-info").html("");
                let url = $('meta[name=app-url]').attr("content") + "/admin/purposes/" + id +"";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        let purpose = response.purpose;
                        $("#title-info").html(purpose.title);
                        $("#start-info").html(purpose.start_date);
                        $("#end-info").html(purpose.end_date);
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
            function destroyPurpose(id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/purposes/" + id;
                let data = {
                    title: $("#title").val(),
                    start_date: $("#start_date").val(),
                    end_date: $("#end_date").val(),
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
                        let successHtml = '<div class="alert alert-success" role="alert">Purpose Was Deleted Successfully </div>';
                        $("#alert-div").html(successHtml);
                        showAllPurposes();
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         
        </script>
@endsection