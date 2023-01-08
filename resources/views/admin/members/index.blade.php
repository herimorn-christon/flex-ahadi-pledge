{{-- This is the main Admin manage members page --}}
@extends('layouts.master')

@section('title','AhadiPledge Members')


@section('content')

<div class="row mb-1">
  <div class="col-sm-6" id="alert-div">

  </div><!-- /.col -->
  <div class="col-sm-6">
    <ul class="float-sm-right" type="none">
      <li class="">  

        {{-- start of register member button --}}
      <button type="button" class="btn bg-flex text-light btn-sm" data-toggle="tooltip" data-placement="bottom" title="Click here to Register a New Member" onclick="createProject()">
          <i class="fa fa-user-plus"></i>
           Register New Member
      </button>  
        {{-- end of register member button --}}

        {{-- start of register member modal --}}
        @include('admin.members.register-member-modal')
        {{-- end of register member modal --}}
  </li>
     
</ul>
    
  </div><!-- /.col -->
</div>
{{-- start of all members card --}}
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
                <tbody id="members-table-body">
                 
                </tbody>
            </table>

        </div>

        {{-- start of ajax fetch all members method --}}
        @include('admin.members.ajax-fetch-all-members')
        {{-- end of ajax fetch all members method --}}


    </div>
</div>

  
  {{-- start of single member modal --}}


  {{-- end of single member modal --}}
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