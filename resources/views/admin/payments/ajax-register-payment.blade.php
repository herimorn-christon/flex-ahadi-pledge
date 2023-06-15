{{--  This is the ajax register new community  method page --}}
<script type="text/javascript">

    /*
                check if form submitted is for creating or updating
            */
            $("#save-payment-btn").click(function(event ){
                event.preventDefault();
                if($("#update_id").val() == null || $("#update_id").val() == "")
                {
                    storePayment();
                } else {
                    updatePayment();
                }
            })
         
          /*
                show modal for creating a record and 
                empty the values of form and remove existing alerts
            */
            function createPayment()
            {
                $("#alert-div").html("");
                $("#error-div").html("");   
                $("#update_id").val("");
                $("#type_id").val("");
                $("#pledgeSelect").val("");
                $("#userSelect").val("");
                $("#amount").val("");
                $("#objectQuantity").val("");
                $("#objectCost").val("");
                $("#form-modal").modal('show'); 
            }
         
            /*
                submit the form and will be stored to the database
            */
            function storePayment()
            {   
                $("#save-payment-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/payments";
                let data = {
                    pledge_id: $("#pledgeSelect").val(),
                    amount: $("#amount").val(),
                    user_id: $("#userSelect").val(),
                    type_id: $("#type_id").val(),
                    receipt:$("#receipt").val(),
                    object_quantity:$("#objectQuantity").val(),
                    object_cost:$("#objectCost").val(),
                    
                };
    console.log(data);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: data,
                    success: function(response) {
                        $("#save-paymentd-btn").prop('disabled', false);
                        toastr.success('Payment Was Added Successfully'); 
                        let successHtml = '<div class="alert alert-success" role="alert">Payment Was Added Successfully</div>';
                        $("#alert-div").html(successHtml);
                        $("#pledgeSelect").val("");
                        $("#type_id").val("");
                        $("#purpose_id").val("");
                        $("#userSelect").val("");
                        $("#amount").val("");
                        // $("#objectQuantity").val("");
                        // $("#objectCost").val("");
                        $("#receipt").val("");
                        showAllPayments();
                        $("#form-modal").modal('hide');
                    },
                    error: function(response) {
                        toastr.info("something went wrong !!!");
                        $("#save-payment-btn").prop('disabled', false);
         
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
            let receiptValidation = "";
            if (typeof errors.receipt !== 'undefined') 
                            {
                                receiptValidation = '<li>' + errors.receipt[0] + '</li>';
                            }
             
            let errorHtml = '<div class="alert alert-danger" role="alert">' +
                '<b>Validation Error!</b>' +
                '<ul>' + nameValidation + descriptionValidation + deadlineValidation + amountValidation +'</ul>' +
            '</div>';
            $("#error-div").html(errorHtml); 
            let fail = response.responseJSON.fail;
            $("#error-div").html(fail); 
                   
        }
                    }
                });
            }
         

         

</script>