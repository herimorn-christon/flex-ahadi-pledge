{{-- This is the page for Pledge Type detail update ajax method  --}}
<script type="text/javascript">
   
           /*
              edit record function
              it will get the existing value and show the purpose form
          */
          function editCard(id)
          {
              let url = $('meta[name=app-url]').attr("content") + "/admin/cards/" + id ;
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                      let card = response.card;
                      $("#alert-div").html("");
                      $("#error-div").html("");   
                      $("#update_id").val(card.id);
                      $("#card").val(card.card_no);
                      $("#form-modal").modal('show'); 
                      $("#cards").modal('hide'); 
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }
       
          /*
              sumbit the form and will update a record
          */
          function updateCard()
          {
              $("#save-card-btn").prop('disabled', true);
              let url = $('meta[name=app-url]').attr("content") + "/admin/cards/" + $("#update_id").val();
              let data = {
                  card_no: $("#card").val(),
              };
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: url,
                  type: "PUT",
                  data: data,
                  success: function(response) {
                      $("#save-card-btn").prop('disabled', false);
                          toastr.success('Card Was Updated Successfully !');
                      let successHtml = '<div class="alert alert-success" role="alert">Card Was Updated Successfully !</div>';
                      $("#alert-div").html(successHtml);
                      $("#card").val("");  
  //                     showAllCards();
                      $("#form-modal").modal('hide');
                  },
                  error: function(response) {
                    toastr.info('Something went wrong !');
                      /*
          show validation error
                      */
                      $("#save-card-btn").prop('disabled', false);
                      if (typeof response.responseJSON.errors !== 'undefined') 
                      {
                          console.log(response)
          let errors = response.responseJSON.errors;
          let descriptionValidation = "";
          if (typeof errors.description !== 'undefined') 
                          {
                              descriptionValidation = '<li>' + errors.description[0] + '</li>';
                          }
          let nameValidation = "";
          if (typeof errors.name !== 'undefined') 
                          {
                              nameValidation = '<li>' + errors.name[0] + '</li>';
                          }
          let deadlineValidation = "";
          if (typeof errors.deadline !== 'undefined') 
                          {
                              deadlineValidation = '<li>' + errors.deadline[0] + '</li>';
                          }
            
          let amountValidation = "";
          if (typeof errors.amount !== 'undefined') 
                          {
                              amountValidation = '<li>' + errors.amount[0] + '</li>';
                          }
           
          let errorHtml = '<div class="alert alert-danger" role="alert">' +
              '<b>Validation Error!</b>' +
              '<ul>' + nameValidation + descriptionValidation + deadlineValidation + amountValidation +'</ul>' +
          '</div>';
          $("#error-div").html(errorHtml);        
      }
                  }
              });
          }
       

       
</script>