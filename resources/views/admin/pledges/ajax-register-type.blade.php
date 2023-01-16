{{--  This is the ajax register new Pledge Type Ajax  method page --}}
<script type="text/javascript">
            
          /*
                check if form submitted is for creating or updating
            */
            $("#save-type-btn").click(function(event ){
                event.preventDefault();
                if($("#update_id").val() == null || $("#update_id").val() == "")
                {
                    storeType();
                } else {
                    updateType();
                }
            })
       
            /*
                show modal for creating a record and 
                empty the values of form and remove existing alerts
            */
            function createType()
            {
                $("#alert-div").html("");
                $("#error-div").html("");   
                $("#update_id").val("");
                $("#title").val("");
                $("#type-modal").modal('show'); 
            }
         
            /*
                submit the form and will be stored to the database
            */
            function storeType()
            {   
                $("#save-type-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/types";
                let data = {
                    title: $("#title").val(),
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: data,
                    success: function(response) {
                        $("#save-type-btn").prop('disabled', false);
                        let successHtml = '<div class="alert alert-success" role="alert">Pledge Type Was Added Successfully</div>';
                        $("#alert-div").html(successHtml);
                        $("#title").val("");
    //                     showAllTypes();
                        $("#type-modal").modal('hide');
                    },
                    error: function(response) {
                        $("#save-type-btn").prop('disabled', false);
         
                        /*
            show validation error
                        */
                        if (typeof response.responseJSON.errors !== 'undefined') 
                        {
            let errors = response.responseJSON.errors;
            if (typeof errors.title !== 'undefined') 
                            {
                                nameValidation = '<li>' + errors.title[0] + '</li>';
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