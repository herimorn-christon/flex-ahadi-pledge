{{-- This is the page for Purpose detail update method  --}}
<script type="text/javascript">
        /*
                edit record function
                it will get the existing value and show the purpose form
            */
            function editAnnouncement(id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/announcements/" + id ;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        let purpose = response.announcement;
                        $("#alert-div").html("");
                        $("#error-div").html("");   
                        $("#update_id").val(purpose.id);
                        $("#title").val(purpose.title);
                        $("#body").val(purpose.body);
                        $("#image").val(purpose.file);
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
            function updateAnnouncement()
            {
                $("#save-announcement-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/announcements/" + $("#update_id").val();
                let data = {
                    title: $("#title").val(),
                    body: $("#body").val(),
                    image: $("#image").val()
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "PUT",
                    data: data,
                    success: function(response) {
                        $("#save-announcement-btn").prop('disabled', false);
                        let successHtml = '<div class="alert alert-success" role="alert">Announcement Was Updated Successfully !</div>';
                        $("#alert-div").html(successHtml);
                        $("#tite").val("");
                        $("#body").val("");
                        $("#image").val("");
                         showAllAnnouncements();
                         $("#form-modal").modal('hide'); 
                       
                       
                    },
                    error: function(response) {
                        /*
            show validation error
                        */
                        $("#save-announcement-btn").prop('disabled', false);
                        if (typeof response.responseJSON.errors !== 'undefined') 
                        {
                            console.log(response)
            let errors = response.responseJSON.errors;
           descriptionValidation = "";
            if (typeof errors.title !== 'undefined') 
                            {
                                descriptionValidation = '<li>' + errors.title[0] + '</li>';
                            }
            let titleValidation = "";
            if (typeof errors.body !== 'undefined') 
                            {
                                titleValidation = '<li>' + errors.body[0] + '</li>';
                            }
            let startDateValidation = "";
            if (typeof errors.image !== 'undefined') 
                            {
                                startDateValidation = '<li>' + errors.image[0] + '</li>';
                            }
             
            let errorHtml = '<div class="alert alert-danger" role="alert">' +
                '<b>Validation Error!</b>' +
                '<ul>' + titleValidation + descriptionValidation + startDateValidation +'</ul>' +
            '</div>';
            $("#error-div").html(errorHtml);        
        }
                    }
                });
            }
         
 
    
</script>