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
                $("#type").val("");
                $("#pledge").val("");
                $("#pamount").val("");
                $("#object_cost").val("");
                $("#object_quantity").val("");
                $("#form-modal").modal('show'); 
            }
         
            /*
                submit the form and will be stored to the database
            */
            function storePayment()
            {   
                $("#save-payment-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/member/payments";
                let data = {
                    pledge_id: $("#pledge").val(),
                    amount: $("#pamount").val(),
                    type_id: $("#type").val(),
                    object_cost: $("#object_cost").val(),
                    object_quantity: $("#object_quantity").val(),
                };
    // console.log(data);
            //    console.log(data);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: data,
                    success: function(response) {
                         console.log(response);
                        $("#save-paymentd-btn").prop('disabled', false);
                        let successHtml = '<div class="alert alert-success" role="alert">Payment Was Added Successfully</div>';
                        $("#alert-div").html(successHtml);
                        $("#pledge").val("");
                        $("#type").val("");
        //                 $("#purpose_id").val("");
                        $("#pamount").val("");
                        $("#receipt").val("");
                        $("#object_cost").val("");
                        $("#object_quantity").val("");
                        showAllPayments();
                        $("#form-modal").modal('hide');
                    },
                    error: function(response) {
                  console.log(response);
                    $("#save-payment-btn").prop('disabled', false);

                    if (response.responseJSON && response.responseJSON.errors) {
                        var errors = response.responseJSON.errors;
                         console.log(response);
                        // Handle the validation errors
                        // Display the errors to the user
                    } else {
                        // Handle other error scenarios
                        // Display a general error message
                    }
                                      
         
                  
                    }
                });
            }
         

         

</script>