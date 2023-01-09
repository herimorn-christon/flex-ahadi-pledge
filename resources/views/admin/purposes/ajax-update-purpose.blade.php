{{-- This is the page for Purpose detail update method  --}}
<script type="text/javascript">
        /*
                edit record function
                it will get the existing value and show the purpose form
            */
            function editPurpose(id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/purposes/" + id ;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        let purpose = response.purpose;
                        $("#alert-div").html("");
                        $("#error-div").html("");   
                        $("#update_id").val(purpose.id);
                        $("#title").val(purpose.title);
                        $("#start_date").val(purpose.start_date);
                        $("#end_date").val(purpose.end_date);
                        $("#description").val(purpose.description);
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
            function updatePurpose()
            {
                $("#save-purpose-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/purposes/" + $("#update_id").val();
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
                    type: "PUT",
                    data: data,
                    success: function(response) {
                        $("#save-purpose-btn").prop('disabled', false);
                        let successHtml = '<div class="alert alert-success" role="alert">Purpose Was Updated Successfully !</div>';
                        $("#alert-div").html(successHtml);
                        $("#tite").val("");
                        $("#start_date").val("");
                        $("#end_date").val("");
                        $("#description").val("");
                        showAllPurposes();
                        $("#form-modal").modal('hide');
                    },
                    error: function(response) {
                        /*
            show validation error
                        */
                        $("#save-purpose-btn").prop('disabled', false);
                        if (typeof response.responseJSON.errors !== 'undefined') 
                        {
                            console.log(response)
            let errors = response.responseJSON.errors;
           descriptionValidation = "";
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