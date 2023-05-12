{{-- This is the page for Pledge Type detail update ajax method  --}}
<script type="text/javascript">
   

             /*
              check if form submitted is for creating or updating
          */
          $("#edit-member-btn").click(function(event ){
              event.preventDefault();
              if($("#update_Id").val() == null || $("#update_Id").val() == "" )
              {
                  storeCardMember();
              } else {
                  updateCardMember();
              }
          })
         

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
                    let member = response.member;
                    $("#alert-div").html("");
                    $("#error-div").html("");   
                    $("#update_Id").val(member.id);
                    $("#card_No").val(member.card_no);
                    $("#user_Id").val(member.user_id);
                    $("#card_status").val(member.status);
                    $("#edit-modal").modal('show'); 
                       
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }


            /*
                sumbit the form and will update a record
            */
            function updateCardMember()
            {
                $("#edit-member-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/card-member/" + $("#update_Id").val();
                let data = {
                        card_No: $("#card_No").val(),
                        user_Id: $("#user_Id").val(),
                        card_status: $("#card_status").val(),
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "PUT",
                    data: data,
                    success: function(response) {
                    $("#edit-member-btn").prop('disabled', false);
                        toastr.success('Card Member Was Updated Successfully');
                    let successHtml = '<div class="alert alert-success" role="alert">Card Member Was Updated Successfully</div>';
                    $("#alert-div").html(successHtml);
                     $("#card_No").val("");
                     $("#user_Id").val("");
                     $("#card_status").val("");
                     $("#edit-modal").modal('hide');
                    showAllCardMembers();
                   
                    },
                     error: function(response) {
                    $("#edit-member-bt").prop('disabled', false);
                  toastr.success('Something went wrong !!');
     
                    /*
        show validation error
                    */
                    if (typeof response.responseJSON.errors !== 'undefined') 
                    {
        let errors = response.responseJSON.errors;
        let numberValidation = "";
        if (typeof errors.card_No !== 'undefined') 
                        {
                            numberValidation = '<li>' + errors.card_No[0] + '</li>';
                        }
        let userValidation = "";
        if (typeof errors.user_Id !== 'undefined') 
                        {
                            userValidation = '<li>' + errors.user_Id[0] + '</li>';
                        }        
        let errorHtml = '<div class="alert alert-danger" role="alert">' +
            '<b>Validation Error!</b>' +
            '<ul>' + numberValidation  + userValidation  +'</ul>' +
        '</div>';   
            $("#errors-div").html(errorHtml);        
        }
                    }
                });
            }
         
          
</script>