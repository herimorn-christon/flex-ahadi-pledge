@extends('layouts.master')

@section('title','Admin | Manage Members')


@section('content')

<div class="row mb-1">
  <div class="col-sm-6" id="alert-div">

  </div><!-- /.col -->
  <div class="col-sm-6">
    <ul class="float-sm-right" type="none">
      <li class="">  
      <button type="button" class="btn bg-navy btn-sm" onclick="createProject()">
          <i class="fa fa-user-plus"></i>
           Register New Member
      </button>  
  </li>
     
</ul>
    
  </div><!-- /.col -->
</div>
<div class="card mt-1">
    <div class="">


        <div class="p-1">
            <table id="example1"  class="table  responsive table-bordered " width=""  >
                <thead>
                     <tr class="text-secondary ">
                            <th>SN</th>
                            <th>Member ID</th>
                            <th>Member Name</th>
                            <th>Community </th>
                            <th>Gender</th>
                            <th>Actions</th>
                        </tr>
                </thead>
                <tbody id="projects-table-body">
                 
                </tbody>
            </table>

        </div>



    </div>
</div>



<!-- View User detail Modal-->


    <div class="modal fade" id="view-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-xl" style="width:1250px;">
          <div class="modal-content">
            <div class="modal-header bg-light">
                <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
          
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <td><b class="text-secondary">Full Member Name:</b></td>
                        <td><span id="name-info" class="text-dark"></span> <span id="mname-info" class="text-dark"></span> <span id="lname-info" class="text-dark"></span></td>
                    </tr>
                    <tr>
                        <td>  <b class="text-secondary">Community:</b></td>
                        <td><span id="community-info" class="text-dark"></span> </td>
                    </tr>
                    <tr>
                        <td><b class="text-secondary">Birthdate:</b> </td>
                        <td> <span id="date-info" class="text-dark"></span></td>
                    </tr>
                    <tr>
                        <td>  <b class="text-secondary">Gender:</b></td>
                        <td><span id="description-info" class="text-dark"></span> </td>
                    </tr>
                    <tr>
                        <td>  <b class="text-secondary">Phone Number:</b></td>
                        <td><span id="phone-info" class="text-dark"></span> </td>
                    </tr>
                    <tr>
                        <td>  <b class="text-secondary">Email:</b></td>
                        <td><span id="email-info" class="text-dark"></span> </td>
                    </tr>
                    <tr>
                        <td>  <b class="text-secondary">Member Status:</b></td>
                        <td><span id="status-info" class="text-success"></span> </td>
                    </tr>
                </table>
            </div>
        
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active bg-light nav-light" href="#pledges" data-toggle="tab">Payments</a></li>
                      <li class="nav-item"><a class="nav-link bg-light" href="#timeline" data-toggle="tab">Pledges</a></li>
                      <li class="nav-item"><a class="nav-link bg-light" href="#settings" data-toggle="tab">Cards</a></li>
                    </ul>
                  </div><!-- /.card-header -->
                  <div class="">
                    <div class="tab-content">
                      <div class="active tab-pane" id="pledges">
                        {{-- start of member payments --}}
                        <table id="mytable"   class="table table-bordered responsive ">
                            <thead>
                                <tr class="text-secondary">
                                    <th>ID</th>
                                    <th>Payment Date</th>
                                    <th>Payment Purpose</th>
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
     
                        <table id="my_table"  class="table table-bordered ">
                            <thead>
                                <tr class="text-secondary">
                                    
                                    <th>ID</th>
                                    <th>Pledge Name</th>
                                    <th>Amount</th>
                                    <th>Purpose</th>
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
    
                      <div class="tab-pane" id="settings">
    
                     
                        {{-- start of cards --}}
     
                        <table  class="table table-bordered ">
                            <thead>
                                <tr class="text-secondary">
                                    <th>ID</th>
                                    <th>Card Number</th>
                                    <th>Status</th>
                                    {{-- <th>Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody id="cards-table-body">

              
                            </tbody>
                        </table>
                        {{-- end of pledges --}}
                     
                    
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

  {{-- start of register member modal --}}


  {{-- end of register member modal --}}
     <script type="text/javascript">
  


         
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
                $("#status").val("");
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
                    status: $("#status").val(),
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
                        $("#status").val("");
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
                        $("#status").val(member.status);
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
                    status: $("#status").val(),
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
                        $("#payments-table-body").html("");
                        $("#pledges-table-body").html("");
                        $("#cards-table-body").html("");                       
                        let member = response.member;
                        $("#name-info").html(member.fname);
                        $("#mname-info").html(member.mname);
                        $("#lname-info").html(member.lname);
                        $("#date-info").html(member.date_of_birth);
                        $("#description-info").html(member.gender);
                        $("#community-info").html(member.community.name);
                        $("#phone-info").html(member.phone);
                        $("#email-info").html(member.email);
                        $("#status-info").html(member.status == '1' ? 'Disabled':'Enabled');
                        $("#user-link").html(member.id);
                        
                        // for payments
                      
                        let payments = response.payments;
                        for (var i = 0; i < payments.length; i++) 
                        {      
         
                       let paymentsRow = '<tr>' +
                                '<td>' + payments[i].id + '</td>' +
                                '<td>' + payments[i].created_at + '</td>' +
                                '<td>' + payments[i].purpose.title + '</td>' +
                                '<td>' + payments[i].amount + '</td>' +
                                '<td>' + payments[i].payment.name + '</td>' +
                            '</tr>';
                            $("#payments-table-body").append(paymentsRow);
                        }

                        // for pledges
                        
                        let pledges = response.pledges;
                        for (var i = 0; i < pledges.length; i++) 
                        {      
         
                       let pledgesRow = '<tr>' +
                                '<td>' + pledges[i].id + '</td>' +
                                '<td>' + pledges[i].name + '</td>' +
                                '<td>' + pledges[i].amount + '</td>' +
                                '<td>' + pledges[i].purpose.title + '</td>' +  
                                '<td>' + pledges[i].deadline + '</td>' +
                                '<td class="text-success">' + (pledges[i].status == '0' ? 'Not Fullfilled':'Fullfilled') + '</td>' +
                            '</tr>';
                            $("#pledges-table-body").append(pledgesRow);
                        }

                        // for cards

                        let cards = response.cards;
                        for (var i = 0; i < cards.length; i++) 
                        {      
         
                       let cardsRow = '<tr>' +
                                '<td>' + cards[i].id + '</td>' +
                                '<td>' + cards[i].card.card_no +'/'+ cards[i].user_id +'</td>' +
                                '<td class="text-success">' + (cards[i].status == '0' ? 'Active':'InActive') + '</td>' +
                            '</tr>';
                            $("#cards-table-body").append(cardsRow);
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


@endsection