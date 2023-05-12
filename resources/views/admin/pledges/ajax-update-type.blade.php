{{-- This is the page for Pledge Type detail update ajax method  --}}
<script type="text/javascript">
       
              /*
                edit record function
                it will get the existing value and show the payment form form
            */
            function editType(id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/types/" + id ;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        let type = response.type;
                        $("#alert-div").html("");
                        $("#error-div").html("");   
                        $("#update_id").val(type.id);
                        $("#title").val(type.title);
                        $("#types").modal('hide');
                        $("#type-modal").modal('show'); 
                       
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         
            /*
                sumbit the form and will update a record
            */
            function updateType()
            {
                $("#save-type-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/types/" + $("#update_id").val();
                let data = {
                    title: $("#title").val(),
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "PUT",
                    data: data,
                    success: function(response) {
                        $("#save-type-btn").prop('disabled', false);
                          toastr.success('Pledge Type Was Updated Successfully');
                        let successHtml = '<div class="alert alert-success" role="alert">Pledge Type Was Updated Successfully !</div>';
                        $("#alert-div").html(successHtml);
                        $("#title").val("");
                        $("#type-modal").modal('hide');
                    },
                    error: function(response) {
                        /*
            show validation error
                        */
                        $("#save-type-btn").prop('enabled', true);
                        if (typeof response.responseJSON.errors !== 'undefined') 
                        {
                           toastr.info('something went wrong');
                            console.log(response)
            let errors = response.responseJSON.errors;
            let nameValidation = "";
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