@extends('layouts.master')

@section('title','Admin | Manage Payments')


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
        {{-- start of register payment button --}}
        <button type="button" class="btn bg-flex text-light btn-sm mb-2" data-toggle="modal" onclick="createPayment()">
            <i class="fa fa-plus"></i>
            Register Payment
        </button>   
        {{-- end of register payment button --}}

        {{-- start register payment modal --}}
        @include('admin.payments.register-payment-modal')
        {{-- end of register  payment modal --}}

        {{-- start of ajax register  payment method --}}
        @include('admin.payments.ajax-register-payment')
        {{-- end of ajax register  payment method --}}

        {{-- start of ajax update  payment method --}}
        @include('admin.payments.ajax-update-payment')
        {{-- end of ajax update  payment method --}}

        {{-- start of ajax delete payment method --}}
        @include('admin.payments.ajax-delete-payment')
        {{-- end of ajax delete  payment method --}}


        <button type="button" class="btn bg-flex text-light btn-sm mb-2" data-toggle="modal" onclick="showAllMethods()">
            <i class="fa fa-list"></i>
             Payment Methods
        </button>


        
        {{-- start all pledge types modal --}}
        @include('admin.payments.all-payment-methods-modal')
        {{-- end of all pledge types modal --}}

        {{-- start of ajax fetch all pledges method --}}
        @include('admin.payments.ajax-fetch-all-methods')
        {{-- end of ajax fetch all pleges method --}}


        {{-- start of ajax update pledge types method --}}
        @include('admin.pledges.ajax-update-type')
        {{-- end of ajax update pledge types method --}}
       
        {{-- start of ajax delete Pledge type method --}}
        @include('admin.pledges.ajax-delete-type')
        {{-- end of ajax delete Pledge type method --}}

        <button type="button" class="btn bg-flex text-light btn-sm mb-2" data-toggle="modal" onclick="createMethod()">
        <i class="fa fa-plus"></i>
         Add Payment Method
        </button>
    </li>
       
      </ol>
      
    </div>
  </div>

<div class="card mt-1">

        <div class="responsiveness p-1">
            <table id="example1" class="table table-bordered cell-border responsive">
                <thead>
                     <tr class="text-secondary">
                        <th>ID</th>
                        <th>Payer Name</th>
                        <th>Payment Method</th>
                        <th>Purpose</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="payments-table-body">
          
  
                </tbody>
            </table>


             
             {{-- start of ajax fetch all pledges method --}}
             @include('admin.payments.ajax-fetch-all-payments')
             {{-- end of ajax fetch all pleges method --}}
     
             {{-- start of ajax view pledge details method --}}
             @include('admin.payments.ajax-fetch-payments-details')
             {{-- end of ajax view purpose details method --}}
     
             {{-- start of ajax view payment details modal --}}
             @include('admin.payments.single-payment-modal')
             {{-- end of ajax view payment details modal --}}

    </div>
</div>


{{-- Add Payment Type modal --}}

<div class="modal fade" id="method-modal">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header bg-light">
           <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
              <input type="hidden" name="update_id" id="update_id">
                <div class="row mb-3">
                 <div class="col-md-12">
                    <div class="form-group">
                        <label for="name" class="text-secondary">Payment Method</label>
                        <input type="text" id="name" name="name" id="title" class="form-control" placeholder="Enter Payment Method Name">
                    </div>
                 </div>
                 <div class="col-md-6"></div>
                 <div class="col-md-6">
                    <div class="form-group">
                     
                        <button type="submit" class="btn bg-navy btn-block" id="save-method-btn">
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





 
  {{-- start auto populate member pledges --}}

         <!-- Script -->
         <script type='text/javascript'>

          $(document).ready(function(){

            // Department Change
            $('#user_id').change(function(){

                // Department id
                var id = $(this).val();

                // Empty the dropdown
                $('#pledge_id').find('option').not(':first').remove();

                // AJAX request 
                $.ajax({
                  url: 'getEmployees/'+id,
                  type: 'get',
                  dataType: 'json',
                  success: function(response){

                    var len = 0;
                    if(response['data'] != null){
                      len = response['data'].length;
                    }

                    if(len > 0){
                      // Read data and create <option >
                      for(var i=0; i<len; i++){

                        var id = response['data'][i].id;
                        var name = response['data'][i].name;

                        var option = "<option value='"+id+"'>"+name+"</option>"; 

                        $("#pledge_id").append(option); 
                      }
                    }

                  }
              });
            });

          });

          </script>
         
  {{-- end of auto populate member pledges --}}
   <script type="text/javascript">
  
         

    //         showAllMethods();


          
          

            /*
                check if form submitted is for creating or updating
            */
            $("#save-method-btn").click(function(event ){
                event.preventDefault();
                if($("#update_id").val() == null || $("#update_id").val() == "")
                {
                    storeMethod();
                } else {
                    updateMethod();
                }
            })
            

      /*
                show modal for creating a record and 
                empty the values of form and remove existing alerts
            */
            function createMethod()
            {
                $("#alert-div").html("");
                $("#error-div").html("");   
                $("#update_id").val("");
                $("#name").val("");
                $("#method-modal").modal('show'); 
            }
         
            /*
                submit the form and will be stored to the database
            */
            function storeMethod()
            {   
                $("#save-method-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/methods";
                let data = {
                    name: $("#name").val(),
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: data,
                    success: function(response) {
                        $("#save-method-btn").prop('disabled', false);
                        let successHtml = '<div class="alert alert-success" role="alert">Payment Method Was Added Successfully</div>';
                        $("#alert-div").html(successHtml);
                        $("#name").val("");
                        showAllPledges();
                        $("#method-modal").modal('hide');
                    },
                    error: function(response) {
                        $("#save-method-btn").prop('disabled', false);
         
                        /*
            show validation error
                        */
                        if (typeof response.responseJSON.errors !== 'undefined') 
                        {
            let errors = response.responseJSON.errors;
            if (typeof errors.name !== 'undefined') 
                            {
                                nameValidation = '<li>' + errors.name[0] + '</li>';
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
            function editMethod(id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/methods/" + id ;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        let method = response.method;
                        $("#alert-div").html("");
                        $("#error-div").html("");   
                        $("#update_id").val(method.id);
                        $("#name").val(method.name);
                        $("#types").modal('hide');
                        $("#method-modal").modal('show'); 
                       
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         
            /*
                sumbit the form and will update a record
            */
            function updateMethod()
            {
                $("#save-method-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/methods/" + $("#update_id").val();
                let data = {
                    name: $("#name").val(),
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
                        let successHtml = '<div class="alert alert-success" role="alert">Payment Method Was Updated Successfully !</div>';
                        $("#alert-div").html(successHtml);
                        $("#name").val("");
                        showAllMethods();
                        $("#method-modal").modal('hide');
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
            let nameValidation = "";
            if (typeof errors.name !== 'undefined') 
                            {
                                nameValidation = '<li>' + errors.name[0] + '</li>';
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
                delete payment record function
            */
            function destroyMethod(id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/methods/" + id;
                let data = {
                    name: $("#name").val(),
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "DELETE",
                    data: data,
                    success: function(response) {
                        let successHtml = '<div class="alert alert-danger" role="alert">Payment Method Was Deleted Successfully </div>';
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