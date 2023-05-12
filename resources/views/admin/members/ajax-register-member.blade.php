{{--  This is the ajax register new member  method page --}}
<script type="text/javascript">

             /*
                check if form submitted is for creating or updating
            */
            $("#save-member-btn").click(function(event ){
                event.preventDefault();
                 var id=$("#update_id").val();
               
                if($("#update_id").val() == null || $("#update_id").val() == "")
                {
                    storeMember();
                } else {
        
                            console.log(id);
                 
                         $("#save-member-btn").prop('disabled', true);
                             let url = $('meta[name=app-url]').attr("content") + "/admin/members/" + id;
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
                                     $("#save-member-btn").prop('disabled', false);
                                            toastr.success('Member Was Updated Successfully !');
                                     let successHtml = '<div class="btn btn-block btn-success" disabled style="opacity:90%;"> Member Was Updated Successfully !</div>';
                                     $("#alert-div").html(successHtml);
                                     $("#name").val("");
                                     $("#description").val("");
                                     showAllMembers();
                                     $("#form-modal").modal('hide');
                                 },
                                 error: function(response) {
                                   toastr.success('something went wrong!');
                                     /*
                         show validation error
                                     */
                                     $("#save-member-btn").prop('disabled', false);
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
                         let errorHtml = '<div class="btn btn-danger btn-block" role="disabled">' +
                             '<b>Validation Error!</b>' +
                             '<ul>' + fnameValidation + mnameValidation + lnameValidation + passwordValidation + phoneValidation + emailValidation + genderValidation + jumuiyaValidation +  '</ul>' +
                         '</div>';
                         $("#error-div").html(errorHtml);        
                     }
                                 }
                             });
                }
            })
         
            /*
                show modal for creating a record and 
                empty the values of form and remove existing alerts
            */
            function createMember()
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
            function storeMember()
            {   
                $("#save-member-btn").prop('disabled', true);
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
                        $("#save-member-btn").prop('disabled', false);
                        toastr.success('Member Was Registered Successfully');
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
                        showAllMembers();
                        $("#form-modal").modal('hide');
                    },
                    error: function(response) {
                        $("#save-member-btn").prop('disabled', false);
                     toastr.success('there is something went wrong');
         
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
            let errorHtml = '<div class="btn btn-danger btn-block" role="alert" disabled> ' +
                '<b>Validation Error!</b>' +
                '<ul>' + fnameValidation + mnameValidation + lnameValidation + passwordValidation + phoneValidation + emailValidation + genderValidation + jumuiyaValidation +  '</ul>' +
            '</div>';
            $("#error-div").html(errorHtml);        
        }
                    }
                });
            }
         
         

</script>