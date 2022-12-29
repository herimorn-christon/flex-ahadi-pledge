<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laravel Project Manager</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ url('/') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</head>
<body>
  
    <div class="container">
        <h2 class="text-center mt-5 mb-3">Laravel Project Manager</h2>
        <div class="card">
            <div class="card-header bg-light">
                <button class="btn btn-primary btn-sm" onclick="createPledge()"> 
                    Register New Payment

                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <div class="card-body">
                <div id="alert-div">
                 
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-secondary">
                            <th>Payer Name</th>
                            <th>Payment Method</th>
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
  
    <!-- modal for creating and editing function -->
    <div class="modal" tabindex="-1"  id="form-modal">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Project Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <label for="" class="text-secondary">Payer</label>
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="">--Select Member --</option>
                            @foreach ( $jumuiya as $item)
                             <option value="{{ $item->id}}">{{ $item->fname}} {{ $item->mname}} {{ $item->lname}}</option>
                             @endforeach
                        </select>
                    </div>

                    @php
                    
                    $purpose= App\Models\Purpose::where('status','')->get();
                    @endphp
                    <div class="col-md-6">
                        <label for="" class="text-secondary">Payment Purpose</label>
                        <select name="pledge_id" id="pledge_id" class="form-control">
                            <option value="">--Select Purpose --</option>
                            @foreach ( $purpose as $item)
                             <option value="{{ $item->id}}"> {{ $item->title}}</option>
                            @endforeach
                        </select>
                    </div>

     
                    @php
                    $purpose= App\Models\PaymentType::get();
                    @endphp
                    <div class="col-md-6">
                        <label for="" class="text-secondary">Payment Method</label>
                        <select name="type_id" id="type_id" class="form-control">
                            <option value="">--Select Payment Method --</option>
                            @foreach ( $purpose as $item)
                             <option value="{{ $item->id}}"> {{ $item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="amount" class="text-secondary">Paid Amount </label>
                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Payment Amount">
                    </div>
                 </div>
                 <div class="col-md-6 mt-2"></div>
                 <div class="col-md-6 mt-2">
                    <div class="form-group">
                     
                        <button type="submit" class="btn btn-primary btn-block" id="save-pledge-btn">
                            <i class="fa fa-save"></i>
                            Save Payment
                        </button>
                    </div>
                 </div>
                </div>
            </form>
            </div>
            </div>
        </div>
    </div>
 
  
    <!-- view record modal -->
    <div class="modal" tabindex="-1" id="view-modal">
        <div class="modal-dialog" >
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Project Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    <b class="text-secondary">Purpose Title:</b>   <span id="title-info" class="text-dark"></span>
                    <hr>
                    <b class="text-secondary">Start Date:</b>   <span id="start-info" class="text-dark"></span>
                    <hr>
                    <b class="text-secondary">End Date:</b>   <span id="end-info" class="text-dark"></span>
                    <hr>
                    <b class="text-secondary">Description:</b>   <span id="description-info" class="text-dark"></span>
                </p>
                
              
            </div>
            </div>
        </div>
    </div>
  
    <script type="text/javascript">
  
        showAllPledges();
     
        /*
            This function will get all the purposes records
        */
        function showAllPledges()
        {
            let url = $('meta[name=app-url]').attr("content") + "/admin/payments";
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
                            '<td>' + purposes[i].payer.fname + '&nbsp;' + purposes[i].payer.mname +  '&nbsp;' + purposes[i].payer.lname +   '</td>' +
                            '<td>' + purposes[i].payment.name + '</td>' +
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
            let url = $('meta[name=app-url]').attr("content") + "/admin/payments";
            let data = {
                pledge_id: $("#pledge_id").val(),
                amount: $("#amount").val(),
                user_id: $("#user_id").val(),
                type_id: $("#type_id").val(),
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
                    let successHtml = '<div class="alert alert-success" role="alert">Payment Was Added Successfully</div>';
                    $("#alert-div").html(successHtml);
                    $("#pledge_id").val("");
                    $("#type_id").val("");
                    $("#purpose_id").val("");
                    $("#user_id").val("");
                    $("#amount").val("");
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
        if (typeof errors.user_id !== 'undefined') 
                        {
                            descriptionValidation = '<li>' + errors.user_id[0] + '</li>';
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
            let url = $('meta[name=app-url]').attr("content") + "/admin/payments/" + id ;
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
            let url = $('meta[name=app-url]').attr("content") + "/admin/payments/" + $("#update_id").val();
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
                type: "PUT",
                data: data,
                success: function(response) {
                    $("#save-pledge-btn").prop('disabled', false);
                    let successHtml = '<div class="alert alert-success" role="alert">Payment Was Updated Successfully !</div>';
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
            let url = $('meta[name=app-url]').attr("content") + "/admin/payments/" + id +"";
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    let purpose = response.purpose;
                    $("#title-info").html(purpose.name);
                    $("#start-info").html(purpose.deadline);
                    $("#end-info").html(purpose.amount);
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
            let url = $('meta[name=app-url]').attr("content") + "/admin/payments/" + id;
            let data = {
                pledge_id: $("#pledge_id").val(),
                amount: $("#amount").val(),
                user_id: $("#user_id").val(),
                type_id: $("#type_id").val(),
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "DELETE",
                data: data,
                success: function(response) {
                    let successHtml = '<div class="alert alert-success" role="alert">Payment Was Deleted Successfully </div>';
                    $("#alert-div").html(successHtml);
                    showAllPledges();
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }
     
    </script>
</body>
</html>