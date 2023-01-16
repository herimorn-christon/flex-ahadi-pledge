{{-- This is the page for Purpose detail update method  --}}
<script type="text/javascript">
        /*
                edit record function
                it will get the existing value and show the Payments form
            */
            function editPayment(id)
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
                        $("#pledge_id").val(purpose.pledge_id);
                        $("#amount").val(purpose.amount);
                        $("#user_id").val(purpose.user_id);
                        $("#type_id").val(purpose.type_id);
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
            function updatePayment()
            {
                $("#save-pledge-btn").prop('disabled', true);
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
                        $("#save-pledge-btn").prop('disabled', false);
                        let successHtml = '<div class="alert alert-success" role="alert">Payment Was Updated Successfully !</div>';
                        $("#alert-div").html(successHtml);
                        $("#pledge_id").val("");
                        $("#type_id").val("");
                        $("#user_id").val("");
                        $("#amount").val(""); 
                        showAllPayments();
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
         
</script>