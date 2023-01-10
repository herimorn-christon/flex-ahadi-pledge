{{-- This is the page for Pledge Type detail update ajax method  --}}
<script type="text/javascript">
       
      /*
                edit record function
                it will get the existing value and show the payment form form
            */
            function editCardMember(id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/card-member/" + id ;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        let card = response.card;
                    $("#alert-div").html("");
                    $("#error-div").html("");   
                    $("#update_id").val(card.id);
                    $("#card_no").val(card.card_member);
                    $("#user_id").val(card.user_id);
                    $("#member-modal").modal('show'); 
                       
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
                $("#save-member-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/card-member/" + $("#update_id").val();
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
                    $("#save-member-btn").prop('disabled', false);
                    let successHtml = '<div class="alert alert-success" role="alert">Card Member Was Updated Successfully</div>';
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