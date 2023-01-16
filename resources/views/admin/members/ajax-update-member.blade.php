 <script type="text/javascript">
              
            /*
                edit record function
                it will get the existing value and show the project form
            */
            function editMember(id)
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
            function updateMember()
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
                        $("#save-member-btn").prop('disabled', false);
                        let successHtml = '<div class="btn btn-block btn-success" disabled style="opacity:90%;"> Member Was Updated Successfully !</div>';
                        $("#alert-div").html(successHtml);
                        $("#name").val("");
                        $("#description").val("");
                        showAllMembers();
                        $("#form-modal").modal('hide');
                    },
                    error: function(response) {
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
         
  
        </script>
