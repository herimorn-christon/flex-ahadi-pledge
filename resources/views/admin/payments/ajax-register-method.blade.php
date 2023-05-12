{{--  This is the ajax register new Pledge Type Ajax  method page --}}
<script type="text/javascript">
      
            /*
                check if form submitted is for creating or updating
            */
            $("#save-method-btn").click(function(event ){
                event.preventDefault();
                if($("#update_id").val() == null || $("#update_id").val() == "")
                {
                    storeMethod();
                } else {
                    updateMethod();
                }
            })
            

      /*
                show modal for creating a record and 
                empty the values of form and remove existing alerts
            */
            function createMethod()
            {
                $("#alert-div").html("");
                $("#error-div").html("");   
                $("#update_id").val("");
                $("#name").val("");
                $("#method-modal").modal('show'); 
            }
         
            /*
                submit the form and will be stored to the database
            */
            function storeMethod()
            {   
                $("#save-method-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/methods";
                let data = {
                    name: $("#name").val(),
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: data,
                    success: function(response) {
                        $("#save-method-btn").prop('disabled', false);
                          toastr.success('Payment Method Was Added Successfully');
                        let successHtml = '<div class="alert alert-success" role="alert">Payment Method Was Added Successfully</div>';
                        $("#alert-div").html(successHtml);
                        $("#name").val("");
                        showAllPayments();
                        $("#method-modal").modal('hide');
                    },
                    error: function(response) {
                        $("#save-method-btn").prop('disabled', false);
                          toastr.info("something went wrong !!!");
             
         
                        /*
            show validation error
                        */
                        if (typeof response.responseJSON.errors !== 'undefined') 
                        {
            let errors = response.responseJSON.errors;
            if (typeof errors.name !== 'undefined') 
                            {
                                nameValidation = '<li>' + errors.name[0] + '</li>';
                            }
             
            let errorHtml = '<div class="alert alert-danger" role="alert">' +
                '<b>Validation Error!</b>' +
                '<ul>' + nameValidation + '</ul>' +
            '</div>';
            $("#error-div").html(errorHtml);        
        }
                    }
                });
            }
                 
</script>