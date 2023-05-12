{{-- This is the page for commmunity detail update   --}}
<script type="text/javascript">
       /*
            edit record function
            it will get the existing value and show the project form
        */
        function editCommunity(id)
        {
            let url = $('meta[name=app-url]').attr("content") + "/admin/communities/" + id ;
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    let community = response.community;
                    $("#alert-div").html("");
                    $("#error-div").html("");   
                    $("#update_id").val(community.id);
                    $("#name").val(community.name);
                    $("#abbreviation").val(community.abbreviation);
                    $("#location").val(community.location);
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
        function updateCommunity()
        {
            $("#save-community-btn").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/admin/communities/" + $("#update_id").val();
            let data = {
                id: $("#update_id").val(),
                name: $("#name").val(),
                abbreviation: $("#abbreviation").val(),
                location: $("#location").val(),
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "PUT",
                data: data,
                success: function(response) {
                    $("#save-community-btn").prop('disabled', false);
                   toastr.success('Community Was Updated Successfully');
                    let successHtml = '<div class="alert alert-success " role="alert">Community Was Updated Successfully !</div>';
                    $("#alert-div").html(successHtml);
                    $("#name").val("");
                    $("#abbreviation").val("");
                    $("#location").val("");
                    showAllCommunities();
                    $("#form-modal").modal('hide');
                },
                error: function(response) {
                    /*
        show validation error
                    */
                    $("#save-community-btn").prop('disabled', false);
                    if (typeof response.responseJSON.errors !== 'undefined') 
                    {
                      toastr.info('something went wrong');
                        console.log(response)
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