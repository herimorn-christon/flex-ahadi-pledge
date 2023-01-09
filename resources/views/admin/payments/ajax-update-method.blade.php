{{-- This is the page for Pledge Type detail update ajax method  --}}
<script type="text/javascript">
       
      /*
                edit record function
                it will get the existing value and show the payment form form
            */
            function editMethod(id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/methods/" + id ;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        let method = response.method;
                        $("#alert-div").html("");
                        $("#error-div").html("");   
                        $("#update_id").val(method.id);
                        $("#name").val(method.name);
                        $("#types").modal('hide');
                        $("#method-modal").modal('show'); 
                       
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         
            /*
                sumbit the form and will update a record
            */
            function updateMethod()
            {
                $("#save-method-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/methods/" + $("#update_id").val();
                let data = {
                    name: $("#name").val(),
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
                        let successHtml = '<div class="alert alert-success" role="alert">Payment Method Was Updated Successfully !</div>';
                        $("#alert-div").html(successHtml);
                        $("#name").val("");
                        showAllMethods();
                        $("#method-modal").modal('hide');
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
            let nameValidation = "";
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