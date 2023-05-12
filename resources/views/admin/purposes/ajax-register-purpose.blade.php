{{--  This is the ajax register new community  method page --}}
<script type="text/javascript">

    /*
                check if form submitted is for creating or updating
            */
            $("#save-purpose-btn").click(function(event ){
                event.preventDefault();
                if($("#update_id").val() == null || $("#update_id").val() == "")
                {
                    storePurpose();
                } else {
                    updatePurpose();
                }
            })
         
            /*
                show modal for creating a record and 
                empty the values of form and remove existing alerts
            */
            function createPurpose()
            {
                $("#alert-div").html("");
                $("#error-div").html("");   
                $("#update_id").val("");
                $("#title").val("");
                $("#start_date").val("");
                $("#end_date").val("");
                $("#description").val("");
                $("#form-modal").modal('show'); 
            }
         
            /*
                submit the form and will be stored to the database
            */
            function storePurpose()
            {   
                $("#save-purpose-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/purposes";
                let data = {
                    title: $("#title").val(),
                    start_date: $("#start_date").val(),
                    end_date: $("#end_date").val(),
                    description: $("#description").val(),
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: data,
                    success: function(response) {
                        $("#save-purpose-btn").prop('disabled', false);
                        toastr.info('Purpose Was Created Successfully');  
                        let successHtml = '<div class="alert alert-success" role="alert">Purpose Was Created Successfully</div>';
                        $("#alert-div").html(successHtml);
                        $("#tite").val("");
                        $("#start_date").val("");
                        $("#end_date").val("");
                        $("#description").val("");
                        showAllPurposes();
                        $("#form-modal").modal('hide');
                    },
                    error: function(response) {
                  
                        $("#save-purpose-btn").prop('disabled', false);
                             showAllPurposes();
                     toastr.info('Purpose Was Created Successfully');  
                        $("#form-modal").modal('hide');    
                    
         
                        /*
            show validation error
                        */
                        if (typeof response.responseJSON.errors !== 'undefined') 
                        {
            let errors = response.responseJSON.errors;
            let descriptionValidation = "";
            if (typeof errors.description !== 'undefined') 
                            {
                                descriptionValidation = '<li>' + errors.description[0] + '</li>';
                            }
            let titleValidation = "";
            if (typeof errors.title !== 'undefined') 
                            {
                                titleValidation = '<li>' + errors.title[0] + '</li>';
                            }
            let startDateValidation = "";
            if (typeof errors.start_date !== 'undefined') 
                            {
                                startDateValidation = '<li>' + errors.start_date[0] + '</li>';
                            }
              
            let endDateValidation = "";
            if (typeof errors.end_date !== 'undefined') 
                            {
                                endDateValidation = '<li>' + errors.end_date[0] + '</li>';
                            }
             
            let errorHtml = '<div class="alert alert-danger" role="alert">' +
                '<b>Validation Error!</b>' +
                '<ul>' + titleValidation + descriptionValidation + startDateValidation + endDateValidation +'</ul>' +
            '</div>';
            $("#error-div").html(errorHtml);        
        }
                    }
                });
            }
         

</script>