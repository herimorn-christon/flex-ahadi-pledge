{{--  This is the ajax create a new card Ajax  method page --}}
<script type="text/javascript">
          /*
              check if form submitted is for creating or updating
          */
          $("#save-card-btn").click(function(event ){
              event.preventDefault();
              if($("#update_id").val() == null || $("#update_id").val() == "")
              {
                  storeCard();
              } else {
                  updateCard();
              }
          })
       
     

   
       
          /*
              show modal for creating a record and 
              empty the values of form and remove existing alerts
          */
          function createCard()
          {
              $("#alert-div").html("");
              $("#error-div").html("");   
              $("#update_id").val("");
              $("#card").val("");
              $("#form-modal").modal('show'); 
          }


          /*
              submit the form and will be stored to the database
          */
          function storeCard()
          {   
              $("#save-card-btn").prop('disabled', true);
              let url = $('meta[name=app-url]').attr("content") + "/admin/cards";
              let data = {
                  card_no: $("#card").val(),
              };
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: url,
                  type: "POST",
                  data: data,
                  success: function(response) {
                      $("#save-card-btn").prop('disabled', false);
                      let successHtml = '<div class="alert alert-success" role="alert">Card Was Created Successfully</div>';
                      $("#alert-div").html(successHtml);
                      $("#card").val("");
  //                     showAllCards();
                      $("#form-modal").modal('hide');
                  },
                  error: function(response) {
                      $("#save-card-btn").prop('disabled', false);
       
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