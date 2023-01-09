@extends('layouts.master')

@section('title','Admin | Manage Pledges')


@section('content')


<div class="row mb-1">
    <div class="col-sm-6" id="alert-div">
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="float-sm-right" type="none">
        <li class="">  
          {{-- start of create pledge button --}}
        <button type="button" class="btn bg-flex text-light btn-sm"  onclick="createPledge()">
            <i class="fa fa-plus"></i>
             Register Pledge 
        </button> 
            {{-- end of create purpose button --}}

        {{-- start register purpose modal --}}
        @include('admin.pledges.register-pledge-modal')
        {{-- end of register purpose modal --}}

        {{-- start of ajax register pledge method --}}
        @include('admin.pledges.ajax-register-pledge')
        {{-- end of ajax register pledge method --}}

        {{-- start of ajax update purpose method --}}
        @include('admin.pledges.ajax-update-pledge')
        {{-- end of ajax update purpose method --}}

        {{-- start of ajax delete purpose method --}}
        @include('admin.pledges.ajax-delete-pledge')
        {{-- end of ajax delete purpose method --}}

          {{-- End of create pledge button  --}}

        {{-- start of view all pledge types modal --}}
        <button type="button" class="btn bg-flex text-light btn-sm" data-toggle="modal" onclick="showAllTypes()">
            <i class="fa fa-list"></i>
            Pledge Types
        </button>
        {{-- end of button --}}

        {{-- start all pledge types modal --}}
        @include('admin.pledges.all-pledge-types-modal')
        {{-- end of all pledge types modal --}}

        {{-- start of ajax fetch all pledges method --}}
        @include('admin.pledges.ajax-fetch-all-types')
        {{-- end of ajax fetch all pleges method --}}


        
        <button type="button" class="btn bg-flex text-light btn-sm" data-toggle="modal" onclick="createType()">
        <i class="fa fa-plus"></i>
         Add Type
        </button>
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>

<div class="card mt-1">
        <div class="responsive p-1">
          {{--  start of alll pledges table --}}
          <table id="example1" class="table table-bordered cell-border">
            <thead>
               <tr class="text-secondary">
                <th>SN</th>
                <th>Member Name</th>
                <th>Pledge(Ahadi)</th>
                <th>Purpose</th>
                <th>Amount</th>
                <th>Actions</th>
               </tr>
            </thead>
            <tbody id="pledges-table-body">
            </tbody>
          </table>
          {{--  start of all pledges table --}}

             {{-- start of ajax fetch all pledges method --}}
             @include('admin.pledges.ajax-fetch-all-pledges')
             {{-- end of ajax fetch all pleges method --}}
     
             {{-- start of ajax view pledge details method --}}
             @include('admin.pledges.ajax-fetch-pledge-details')
             {{-- end of ajax view purpose details method --}}
     
             {{-- start of ajax view purpose details modal --}}
             @include('admin.pledges.single-pledge-modal')
             {{-- end of ajax view purpose details modal --}}

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




  <script type="text/javascript">
  

     
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