@extends('layouts.master')

@section('title','All Purposes')


@section('content')


<div class="row mb-1">
    <div class="col-sm-6" id="alert-div">

    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="float-sm-right" type="none">
        <li class="">    
        {{-- start of create purpose button --}}
        <button type="button" class="btn bg-flex text-light btn-sm"  onclick="createPurpose()">
        <i class="fa fa-plus"></i>
         Add New Purpose
        </button>
        {{-- end of create purpose button --}}

        {{-- start register purpose modal --}}
        @include('admin.purposes.register-purpose-modal')
        {{-- end of register purpose modal --}}

        {{-- start of ajax register purpose method --}}
        @include('admin.purposes.ajax-register-purpose')
        {{-- end of ajax register purpose method --}}

    </li>
       
      </ol>
      
    </div>
  </div>

<div class="card mt-1">
        <div class="responsive p-1">
          {{-- start of all purposes table --}}
            <table id="example1" class="table table-bordered ">
                <thead>
                    <tr class="text-secondary">
                        <th>SN</th>
                        <th>Purpose Title</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                         <th>Actions</th>

                    </tr>
                </thead>
                <tbody id="purposes-table-body">

                </tbody>
            </table>
        {{-- end of all purposes tables --}}

        {{-- start of ajax fetch all purposes method --}}
        @include('admin.purposes.ajax-fetch-all-purposes')
        {{-- end of ajax fetch all purposes method --}}

        {{-- start of ajax view purpose details method --}}
        @include('admin.purposes.ajax-fetch-purpose-details')
        {{-- end of ajax view purpose details method --}}

        </div>
</div>






{{-- View Single Purpose --}}
<div class="modal fade" id="view-modal" tabindex="-1" >
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>
                <b class="text-secondary">Purpose Title:</b>   <span id="title-info" class="text-dark"></span>
                <hr>
                <b class="text-secondary">Start Date:</b>   <span id="start-info" class="text-dark"></span>
                <hr>
                <b class="text-secondary">End Date:</b>   <span id="end-info" class="text-dark"></span>
                <hr>
                <b class="text-secondary">Description:</b> <br><span id="description-info" class="text-dark"></span>
            </p>
              <hr>
   <div class="">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link  nav-light" href="#timeline" data-toggle="tab">Purpose Pledges Made</a></li>
                      {{-- <li class="nav-item"><a class="nav-link bg-light" href="#pledges" data-toggle="tab">Payments Made</a></li> --}}
                     
                    </ul>
                  </div><!-- /.card-header -->
                  <div class="">
                    <div class="tab-content">
                      <div class="active tab-pane" id="pledges">
                        {{-- start of member payments --}}
                        <table id="mytable"  class="table display responsive table-bordered pt-2" width=""  >
                            <thead>
                                <tr class="text-secondary">
                                    <th>ID</th>
                                    <th>Member Fullname</th>
                                    <th>Payment Date</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                </tr>
                            </thead>
                            <tbody id="payments-table-body">

                            </tbody>
                            <tfoot></tfoot>
                        </table>
            
                      </div>
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="timeline">
                     
                        {{-- start of pledges --}}
     
                        <table id=""  class="table table-bordered mt-2 p-2">
                            <thead>
                                <tr class="text-secondary">
                                    <th>ID</th>
                                    <th>Pledge Name</th>
                                    <th>Amount</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="pledges-table-body">
                                
                
                            </tbody>
                         </table>
                        {{-- end of pledges --}}
                     
                    
                    
                    </div>
                      <!-- /.tab-pane -->
    
                    
                     
                    
                      </div>
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
        </div>
      </div>
    </div>
  </div>
  
   
    


   <script type="text/javascript">       
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