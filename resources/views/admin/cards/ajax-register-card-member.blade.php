{{--  This is the ajax assign new card member Ajax  method page --}}
<script type="text/javascript">
      
        /*
            show modal for creating a record and 
            empty the values of form and remove existing alerts
        */
        function createCardMember()
        {
            $("#alert-div").html("");
            $("#error-div").html("");   
            $("#update_id").val("");
            $("#card_no").val("");
            $("#user_id").val("");
            $("#member-modal").modal('show'); 
        }
     
        /*
            submit the form and will be stored to the database
        */
        function storeCardMember()
        {   
            $("#save-member-btn").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/admin/card-member";
            let data = {
                card_no: $("#card_no").val(),
                user_id: $("#user_id").val(),
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: data,
                success: function(response) {
                    $("#save-member-btn").prop('disabled', false);
                    let successHtml = '<div class="alert alert-success" role="alert">Card Was Assigned Successfully</div>';
                    $("#alert-div").html(successHtml);
                    $("#card_no").val("");
                     $("#user_id").val("");
                    showAllCardMembers();
                    showAllCards();
                    $("#member-modal").modal('hide');
                },
                error: function(response) {
                    $("#save-member-btn").prop('disabled', false);
     
                    /*
        show validation error
                    */
                    if (typeof response.responseJSON.errors !== 'undefined') 
                    {
        let errors = response.responseJSON.errors;
        let numberValidation = "";
        if (typeof errors.card_no !== 'undefined') 
                        {
                            numberValidation = '<li>' + errors.card_no[0] + '</li>';
                        }
        let userValidation = "";
        if (typeof errors.user_id !== 'undefined') 
                        {
                            userValidation = '<li>' + errors.user_id[0] + '</li>';
                        }        
        let errorHtml = '<div class="alert alert-danger" role="alert">' +
            '<b>Validation Error!</b>' +
            '<ul>' + numberValidation  +'</ul>' +
        '</div>';
        $("#error-div").html(errorHtml);        
    }
                }
            });
        }
     
</script>