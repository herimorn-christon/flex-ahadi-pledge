<script>
          /*
                    check if form submitted is for creating or updating
                */
                $("#save-profile-btn").click(function(event ){
                    event.preventDefault();
                    if($("#update_id").val() == null || $("#update_id").val() == "")
                    {
                        storeProfile();
                    } else {
                        updateProfile();
                    }
                })
             

           function changePassword()
                {
    
        //             let url = $('meta[name=app-url]').attr("content") + "/admin/profile/{{Auth::User()->id; }}" ;
                    $.ajax({
        //                 url: url,
        //                 type: "GET",
                        success: function(response) {
                            $("#password-modal").modal('show'); 
                        },
                        error: function(response) {
                            console.log(response.responseJSON)
                        }
                    });
                }
    
            /*
                    edit profile detail function
                    it will get the existing value and show the edit profile form
                */
       
                function editProfile()
                {
    
                    let url = $('meta[name=app-url]').attr("content") + "/admin/profile/{{Auth::User()->id; }}" ;
                    $.ajax({
                        url: url,
                        type: "GET",
                        success: function(response) {
                            let member = response.member;
                            $("#alert-div").html("");
                            $("#error-div").html("");   
                            $("#update_id").val("{{Auth::User()->id;}}");
                            $("#fname").val("{{Auth::User()->fname;}}");
                            $("#mname").val("{{Auth::User()->mname;}}");
                            $("#lname").val("{{Auth::User()->lname;}}");
                            $("#phone").val("{{Auth::User()->phone;}}");
                            $("#email").val("{{Auth::User()->email;}}");
                            $("#date_of_birth").val("{{Auth::User()->date_of_birth;}}");
                            $("#gender").val("{{Auth::User()->gender;}}");
                            $("#jumuiya").val("{{Auth::User()->jumuiya;}}");
                            $("#status").val("{{Auth::User()->status;}}");
                            $("#profile-modal").modal('show'); 
                        },
                        error: function(response) {
                            console.log(response.responseJSON)
                        }
                    });
                }
    
          /*
                    sumbit the form and will update a record
                */
                function updateProfile()
                {
                    $("#save-profile-btn").prop('disabled', true);
                    let url = $('meta[name=app-url]').attr("content") + "/admin/profile/" + $("#update_id").val();
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
                            let successHtml = '<div class="btn btn-block btn-success" disabled role="alert"> Your Profile Was Updated Successfully !</div>';
                            $("#alert-div").html(successHtml);
                            $("#profile-modal").modal('hide');
                        },
                        error: function(response) {
                            /*
                show validation error
                            */
                            $("#save-profile-btn").prop('disabled', false);
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
                let errorHtml = '<div class="btn btn-danger btn-block" role="alert" disabled>' +
                    '<b>Validation Error!</b>' +
                    '<ul>' + fnameValidation + mnameValidation + lnameValidation + passwordValidation + phoneValidation + emailValidation + genderValidation + jumuiyaValidation +  '</ul>' +
                '</div>';
                $("#error-div").html(errorHtml);        
            }
                        }
                    });
                }
             
    </script>