{{--  This is the ajax register new community  method page --}}
<script type="text/javascript">


    /*
                check if form submitted is for creating or updating
            */
            $("#save-announcement-btn").click(function(event ){
                event.preventDefault();
                if($("#update_id").val() == null || $("#update_id").val() == "")
                {
                    storeAnnouncement();
                } else {
                    updateAnnouncement();
                }
            })
         
            /*
                show modal for creating a record and 
                empty the values of form and remove existing alerts
            */
            function createAnnouncement()
            {
                $("#alert-div").html("");
                $("#error-div").html("");   
                $("#update_id").val("");
                $("#title").val("");
                $("#body").val("");
                $("#image").val("");
                $("#form-modal").modal('show'); 
            }
         

            /*
                submit the form and will be stored to the database
            */
            function storeAnnouncement()
            {   
                $("#save-announcement-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/announcements";
                let data = {
                    title: $("#title").val(),
                    body: $("#body").val(),
                    file: $("#image").val(),
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: data,
                    success: function(response) {
                        $("#save-announcement-btn").prop('disabled', false);
                        let successHtml = '<div class="alert alert-success" role="alert">Announcement Was Created Successfully</div>';
                        $("#alert-div").html(successHtml);
                        $("#tite").val("");
                        $("#body").val("");
                        $("image").val("");
                        showAllAnnouncements();
                        $("#form-modal").modal('hide');
                    },
                    error: function(response) {
                        $("#save-announcement-btn").prop('disabled', false);
         
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
            let bodyValidation = "";
            if (typeof errors.body !== 'undefined') 
                            {
                                bodyValidation = '<li>' + errors.body[0] + '</li>';
                            }
                      let fileValidation = "";
            if (typeof errors.image !== 'undefined') 
                            {
                                fileValidation = '<li>' + errors.image[0] + '</li>';
                            }
             
            let errorHtml = '<div class="alert alert-danger" role="alert">' +
                '<b>Validation Error!</b>' +
                '<ul>' + titleValidation + bodyValidation + attachmentValidation + '</ul>' +
            '</div>';
            $("#error-div").html(errorHtml);        
        }
                    }
                });
            }
         

</script>