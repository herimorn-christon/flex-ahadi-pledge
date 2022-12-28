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
                <button class="btn btn-primary btn-sm" onclick="createProject()"> 
                    Create New Project

                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <div class="card-body">
                <div id="alert-div">
                 
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-secondary">
                            <th>Member Name</th>
                            <th>Community (Jumuiya)</th>
                            <th>Phone Number</th>
                            <th>Gender</th>
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
                    <div class="form-group col-md-6">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" id="fname" name="fname">
                    </div>
                    <div class="form-group col-md-6">
                            <label for="mname">Middle Name</label>
                            <input type="text" class="form-control" id="mname" name="mname">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="lname">Last Name</label>
                           <input type="text" class="form-control" id="lname" name="lname">
                       </div>
                       <div class="form-group col-md-6">
                          <label for="phone">Phone Number</label>
                           <input type="text" class="form-control" id="phone" name="phone">
                       </div>
                      <div class="form-group col-md-6">
                          <label for="email">Email</label>
                           <input type="email" class="form-control" id="email" name="email">
                       </div>
                        <div class="form-group col-md-6">
                              <label for="fname">Password</label>
                               <input type="password" class="form-control" id="password" name="password">
                        </div>
                       <div class="form-group col-md-6">
                          <label for="fname">Birthdate</label>
                           <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
                       </div>
                 
                 @php
                $jumuiya= App\Models\Jumuiya::get();
                @endphp
                <div class="form-group col-md-6">
                    <label for="" class="text-secondary">Jumuiya (Community) </label>
                    <select name="jumuiya" id="jumuiya" class="form-control">
                        <option value="">--Select Community (Jumuiya) --</option>
                        @foreach ( $jumuiya as $item)
                         <option value="{{ $item->id}}">{{ $item->name}}</option>
                        @endforeach
                    </select>
                </div>
                 
                <div class="form-group col-md-6">
                    <label for="gender" class="text-secondary">Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="">--Select Gender --</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
               
                    
                
                </div>
                 
                 
                    <button type="submit" class="btn btn-outline-primary mt-3" id="save-project-btn">Save Member</button>
             
   
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
                <h5 class="modal-title">Member Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    <b class="text-secondary">Name:</b>   <span id="name-info" class="text-dark"></span>
                </p>
                                      
                <p>
                    <b class="text-secondary">Description:</b>   <span id="description-info" class="text-dark"></span>
                </p>
                
              
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
            let url = $('meta[name=app-url]').attr("content") + "/admin/members";
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    $("#projects-table-body").html("");
                    let members = response.members;
                    for (var i = 0; i < members.length; i++) 
                    {
                        let showBtn =  '<button ' +
                            ' class="btn btn-primary    " ' +
                            ' onclick="showProject(' + members[i].id + ')">Show' +
                        '</button> ';
                        let editBtn =  '<button ' +
                            ' class="btn btn-secondary" ' +
                            ' onclick="editProject(' + members[i].id + ')">Edit' +
                        '</button> ';
                        let deleteBtn =  '<button ' +
                            ' class="btn btn-danger" ' +
                            ' onclick="destroyProject(' + members[i].id + ')">Delete' +
                        '</button>';
     
                        let projectRow = '<tr>' +
                            '<td>' + members[i].fname + '&nbsp;'+members[i].mname + '&nbsp;'+members[i].lname +'</td>' +
                            '<td>' + members[i].community.name + '</td>' +
                            '<td>' + members[i].phone + '</td>' +
                            '<td>' + members[i].gender + '</td>' +
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
            $("#fname").val("");
            $("#mname").val("");
            $("#lname").val("");
            $("#gender").val("");
            $("#phone").val("");
            $("#date_of_birth").val("");
            $("#password").val("");
            $("#jumuiya").val("");
            $("#email").val("");
            $("#form-modal").modal('show'); 
        }
     
        /*
            submit the form and will be stored to the database
        */
        function storeProject()
        {   
            $("#save-project-btn").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/admin/members";
            let data = {
                fname: $("#fname").val(),
                mname: $("#mname").val(),
                lname: $("#lname").val(),
                gender: $("#gender").val(),
                email: $("#email").val(),
                phone: $("#phone").val(),
                date_of_birth: $("#date_of_birth").val(),
                jumuiya: $("#jumuiya").val(),
                password: $("#password").val(),
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
                    let successHtml = '<div class="alert alert-success" role="alert"><b>Member Was Registered Successfully</b></div>';
                    $("#alert-div").html(successHtml);
                    $("#fname").val("");
                    $("#mname").val("");
                    $("#lname").val("");    
                    $("#date_of_birth").val("");
                    $("#phone").val("");
                    $("#email").val("");
                    $("#gender").val("");
                    $("#jumuiya").val("");
                    $("#password").val("");
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
        let fnameValidation = "";
        if (typeof errors.fname !== 'undefined') 
                        {
                            fnameValidation = '<li>' + errors.fname[0] + '</li>';
                        }
        let mnameValidation = "";
        if (typeof errors.mname !== 'undefined') 
                        {
                            mnameValidation = '<li>' + errors.mname[0] + '</li>';
                        }
        let lnameValidation = "";
        if (typeof errors.lname !== 'undefined') 
                        {
                            lnameValidation = '<li>' + errors.lname[0] + '</li>';
                        }
        let emailValidation = "";
        if (typeof errors.email !== 'undefined') 
                        {
                            emailValidation = '<li>' + errors.email[0] + '</li>';
                        }    
        let phoneValidation = "";
        if (typeof errors.phone !== 'undefined') 
                        {
                            phoneValidation = '<li>' + errors.phone[0] + '</li>';
                        }
        let jumuiyaValidation = "";
        if (typeof errors.jumuiya !== 'undefined') 
                        {
                            jumuiyaValidation = '<li>' + errors.jumuiya[0] + '</li>';
                        }
        let passwordValidation = "";
        if (typeof errors.password !== 'undefined') 
                        {
                            passwordValidation = '<li>' + errors.password[0] + '</li>';
                        }
        let genderValidation = "";
        if (typeof errors.gender !== 'undefined') 
                        {
                            genderValidation = '<li>' + errors.gender[0] + '</li>';
                        }
        let errorHtml = '<div class="alert alert-danger" role="alert">' +
            '<b>Validation Error!</b>' +
            '<ul>' + fnameValidation + mnameValidation + lnameValidation + passwordValidation + phoneValidation + emailValidation + genderValidation + jumuiyaValidation +  '</ul>' +
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
            let url = $('meta[name=app-url]').attr("content") + "/admin/members/" + id ;
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    let member = response.member;
                    $("#alert-div").html("");
                    $("#error-div").html("");   
                    $("#update_id").val(member.id);
                    $("#fname").val(member.fname);
                    $("#mname").val(member.mname);
                    $("#lname").val(member.lname);
                    $("#phone").val(member.phone);
                    $("#email").val(member.email);
                    $("#date_of_birth").val(member.date_of_birth);
                    $("#gender").val(member.gender);
                    $("#jumuiya").val(member.jumuiya);
                    $("#password").val(member.password);
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
            let url = $('meta[name=app-url]').attr("content") + "/admin/members/" + $("#update_id").val();
            let data = {
                fname: $("#fname").val(),
                mname: $("#mname").val(),
                lname: $("#lname").val(),
                gender: $("#gender").val(),
                email: $("#email").val(),
                phone: $("#phone").val(),
                date_of_birth: $("#date_of_birth").val(),
                jumuiya: $("#jumuiya").val(),
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
                    let successHtml = '<div class="alert alert-success" role="alert"> Member Was Updated Successfully !</div>';
                    $("#alert-div").html(successHtml);
                    $("#name").val("");
                    $("#description").val("");
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
     let fnameValidation = "";
        if (typeof errors.fname !== 'undefined') 
                        {
                            fnameValidation = '<li>' + errors.fname[0] + '</li>';
                        }
        let mnameValidation = "";
        if (typeof errors.mname !== 'undefined') 
                        {
                            mnameValidation = '<li>' + errors.mname[0] + '</li>';
                        }
        let lnameValidation = "";
        if (typeof errors.lname !== 'undefined') 
                        {
                            lnameValidation = '<li>' + errors.lname[0] + '</li>';
                        }
        let emailValidation = "";
        if (typeof errors.email !== 'undefined') 
                        {
                            emailValidation = '<li>' + errors.email[0] + '</li>';
                        }    
        let phoneValidation = "";
        if (typeof errors.phone !== 'undefined') 
                        {
                            phoneValidation = '<li>' + errors.phone[0] + '</li>';
                        }
        let jumuiyaValidation = "";
        if (typeof errors.jumuiya !== 'undefined') 
                        {
                            jumuiyaValidation = '<li>' + errors.jumuiya[0] + '</li>';
                        }
        let passwordValidation = "";
        if (typeof errors.password !== 'undefined') 
                        {
                            passwordValidation = '<li>' + errors.password[0] + '</li>';
                        }
        let genderValidation = "";
        if (typeof errors.gender !== 'undefined') 
                        {
                            genderValidation = '<li>' + errors.gender[0] + '</li>';
                        }
        let errorHtml = '<div class="alert alert-danger" role="alert">' +
            '<b>Validation Error!</b>' +
            '<ul>' + fnameValidation + mnameValidation + lnameValidation + passwordValidation + phoneValidation + emailValidation + genderValidation + jumuiyaValidation +  '</ul>' +
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
            let url = $('meta[name=app-url]').attr("content") + "/admin/members/" + id +"";
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    let member = response.member;
                    $("#name-info").html(member.fname);
    $("#description-info").html(member.gender);
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
            let url = $('meta[name=app-url]').attr("content") + "/admin/members/" + id;
            let data = {
                fname: $("#fname").val(),
                mname: $("#mname").val(),
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "DELETE",
                data: data,
                success: function(response) {
                    let successHtml = '<div class="alert alert-success" role="alert"> Member Was Deleted Successfully</div>';
                    $("#alert-div").html(successHtml);
                    showAllProjects();
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }
     
    </script>
</body>
</html>