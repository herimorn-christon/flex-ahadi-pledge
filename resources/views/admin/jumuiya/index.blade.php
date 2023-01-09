{{-- This is the main view of Admin- Manage Communities --}}
@extends('layouts.master')

@section('title','All Communities (Jumuiya)')


@section('content')


<div class="row mb-1">
      {{-- start of activities notifications i.e registration,deletion and update status --}}
        <div class="col-sm-6" id="alert-div">
        </div>
      {{-- end of activities notifications --}}

    <div class="col-sm-6">
      <ol class=" float-sm-right" type="none">
        <li class="">    

        <button type="button" class="btn  bg-flex  text-light btn-sm"  onclick="createCommunity()">
        <i class="fa fa-plus"></i>
         Add New Community
        </button>

        {{-- start of ajax add community modal --}}
        @include('admin.jumuiya.register-community-modal')
        {{--  end of ajax add community modal --}}


        {{-- start of ajax add community method --}}
        @include('admin.jumuiya.ajax-register-community')
        {{--  end of ajax add community method --}}

    </li>
       
      </ol>
      
    </div>
  </div>


 
<div class="card mt-1">
    <div>
        <div class="mt-3 p-1">
           {{-- start of view all communities table --}}
             <table id="example1" class="table table-bordered " >
                <thead>
                    <tr class="text-secondary">
                        <th>SN</th>
                        <th>Jumuiya Name</th>
                        <th>Abbreviation</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="communities-table-body">

                </tbody>
                <tfoot>
                 
              </tfoot>
            </table>
             {{-- end of view all communities table --}}
        </div>

        {{-- start of ajax fetch all communities method --}}
        @include('admin.jumuiya.ajax-fetch-all-communities')
        {{--  end of ajax fetch all communities method --}}

        {{-- start of ajax view community details modal --}}
        @include('admin.jumuiya.view-community-detail-modal')
        {{--  end of ajax view community details modal --}}


        {{-- start of ajax fetch community details method --}}
        @include('admin.jumuiya.ajax-fetch-community-details')
        {{--  end of ajax fetch  community details method --}}


    </div>
</div>



<script type="text/javascript">
     
 
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
                    let successHtml = '<div class="alert alert-danger " role="alert">Community Was Deleted Successfully !</div>';
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