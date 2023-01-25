{{--  This is the ajax register new community  method page --}}
<script type="text/javascript">

   /*
            check if form submitted is for creating or updating
        */
        $("#save-community-btn").click(function(event ){
            event.preventDefault();
            if($("#update_id").val() == null || $("#update_id").val() == "")
            {
                storeCommunity();
            } else {
                updateCommunity();
            }
        })
     
        /*
            show modal for creating a record and
            empty the values of form and remove existing alerts
        */
        function createCommunity()
        {
            $("#alert-div").html("");
            $("#error-div").html("");
            $("#update_id").val("");
            $("#name").val("");
            $("#abbreviation").val("");
            $("#location").val("");
            $("#form-modal").modal('show');
        }
     
        /*
            submit the form and will be stored to the database
        */
        function storeCommunity()
        {
            $("#save-community-btn").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/admin/communities";
            let data = {
                name: $("#name").val(),
                abbreviation: $("#abbreviation").val(),
                location: $("#location").val(),
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: data,
                success: function(response) {
                    $("#save-community-btn").prop('disabled', false);
                    let successHtml = '<div class="alert alert-success " role="alert"> Community Was Added Successfully !</div>';
                    $("#alert-div").html(successHtml);
                    $("#name").val("");
                    $("#abbreviation").val("");
                    $("#location").val("");
                    showAllCommunities();
                    $("#form-modal").modal('hide');
                },
                error: function(response) {
                    $("#save-community-btn").prop('disabled', false);
     
                    /*
        show validation error
                    */
                    if (typeof response.responseJSON.errors !== 'undefined')
                    {
        let errors = response.responseJSON.errors;
        let abbreviationValidation = "";
        if (typeof errors.abbreviation !== 'undefined')
                        {
                            abbreviationValidation = '<li>' + errors.abbreviation[0] + '</li>';
                        }
        let locationValidation = "";
        if (typeof errors.location !== 'undefined')
                        {
                            locationValidation = '<li>' + errors.location[0] + '</li>';
                        }
        let nameValidation = "";
        if (typeof errors.name !== 'undefined')
                        {
                            nameValidation = '<li>' + errors.name[0] + '</li>';
                        }
         
        let errorHtml = '<div class="alert alert-danger" role="alert">' +
            '<b>Validation Error!</b>' +
            '<ul>' + nameValidation + abbreviationValidation +locationValidation + '</ul>' +
        '</div>';
        $("#error-div").html(errorHtml);
    }
                }
            });
        }
     
         

</script>
