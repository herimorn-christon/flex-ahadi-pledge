{{--  This is the ajax register new community  method page --}}
<script type="text/javascript">

       /*
              check if form submitted is for creating or updating
          */
    

   function createPayment()
          {
              $("#alert-div").html("");
              $("#error-div").html("");   
              $("#update_id").val("");
              $("#card_member").val("");
              $("#card_amount").val("");
              $("#payment-modal").modal('show'); 
          }
       
     
        /*
              check if form submitted is for creating or updating
          */
          $("#save-payment-btn").click(function(event ){
              event.preventDefault();
              if($("#update_id").val() == null || $("#update_id").val() == "")
              {
                  storePayment();
              } else {
                  updatePayment();
              }
          })
       

     

  

         /*
              submit the form and will be stored to the database
          */
          function storePayment()
          {   
              $("#save-payment-btn").prop('disabled', true);
              let url = $('meta[name=app-url]').attr("content") + "/admin/card-payments";
              let data = {
                  card_member: $("#card_member").val(),
                  card_amount: $("#card_amount").val(),
              };
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: url,
                  type: "POST",
                  data: data,
                  success: function(response) {
                      $("#save-payment-btn").prop('disabled', false);
                       toastr.success('Payment Was Recorded Successfully');
                      let successHtml = '<div class="alert alert-success" role="alert">Payment Was Recorded Successfully</div>';
                      $("#alert-div").html(successHtml);
                      $("#card_member").val("");
                      $("#card_amount").val("");
  //                     showAllCards();
                      $("#payment-modal").modal('hide');
                  },
                  error: function(response) {
                     toastr.info('Something went wrong !!!');
                      $("#save-payment-btn").prop('disabled', false);
       
                      /*
          show validation error
                      */
                      if (typeof response.responseJSON.errors !== 'undefined') 
                      {
          let errors = response.responseJSON.errors;
          let amountValidation = "";
          if (typeof errors.card_amount !== 'undefined') 
                          {
                              amountValidation = '<li>' + errors.card_amount[0] + '</li>';
                          }
          let cardValidation = "";
          if (typeof errors.card_member !== 'undefined') 
                          {
                              cardValidation = '<li>' + errors.card_member[0] + '</li>';
                          }
          let errorHtml = '<div class="alert alert-danger" role="alert">' +
              '<b>Validation Error!</b>' +
              '<ul>' + amountValidation  + cardValidation  +'</ul>' +
          '</div>';
          $("#error-div").html(errorHtml);        
      }
                  }
              });
          }
       

</script>