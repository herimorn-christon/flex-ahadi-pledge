{{-- This is the page for Purpose detail update method  --}}
<script type="text/javascript">
        /*
                edit record function
                it will get the existing value and show the Payments form
            */
            function verifyRequest(id)
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
                        $("#vpledge_id").val(purpose.pledge_id);
                        $("#vamount").val(purpose.amount);
                        $("#vuser_id").val(purpose.user_id);
                        $("#vtype_id").val(purpose.type_id);
                        $("#vreceipt").val(purpose.receipt);
                        // $("#verified").val(purpose.verified);
                        $("#verify-modal").modal('show'); 
                        $("#requests").modal('hide'); 
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         
            /*
                sumbit the form and will update a record
            */
            function updateVerified()
            {
                $("#save-verification-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/payments/" + $("#update_id").val();
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
                    type: "PUT",
                    data: data,
                    success: function(response) {
                        $("#save-verification-btn").prop('disabled', false);
                        let successHtml = '<div class="alert alert-success" role="alert">Payment Was Updated Successfully !</div>';
                        $("#alert-div").html(successHtml);
                        $("#verified").val("");
                        showAllPayments();
                        $("#form-modal").modal('hide');
                    },
                    error: function(response) {
                        /*
            show validation error
                        */
                        $("#save-verification-btn").prop('disabled', false);
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
         
</script>