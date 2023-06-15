{{-- This is the page for ajax register new pledge method --}}
<script type="text/javascript">


 
          /*
              check if form submitted is for creating or updating
          */
          $("#save-pledge-btn").click(function(event ){
              event.preventDefault();
              if($("#update_id").val() == null || $("#update_id").val() == "")
              {
                  storePledge();
              } else {
                  updatePledge();
              }
          })


      
       
          /*
              show modal for creating a record and 
              empty the values of form and remove existing alerts
          */
          function createPledge()
          {
              $("#alert-div").html("");
              $("#error-div").html("");   
              $("#update_id").val("");
              $("#name").val("");
              $("#type_id").val("");
              $("#purpose_id").val("");
              $("#deadline").val("");
              $("#amount").val("");
              $("#description").val("");
              $("#object_name").val("");
              $("#object_quantity").val("");
              $("#object_cost").val("");
              $("#metrics").val("");
             

              $("#form-modal").modal('show'); 
          }
       
          /*
              submit the form and will be stored to the database
          */
          function storePledge()
          {   
              $("#save-pledge-btn").prop('disabled', true);
              let url = $('meta[name=app-url]').attr("content") + "/member/pledges";
              let data = {
                  name: $("#name").val(),
                  amount: $("#amount").val(),
                  deadline: $("#deadline").val(),
                  description: $("#description").val(),
                  type_id: $("#type_id").val(),
                  purpose_id: $("#purpose_id").val(),
                  object_name: $("#object_name").val(),
                  object_quantity: $("#myquantity").val(),
                  object_cost: $("#object_cost").val(),
                  metrics: $("#metrics").val(),

                  
              };
               console.log(data);
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: url,
                  type: "POST",
                  data: data,
                  success: function(response) {
                      $("#save-pledge-btn").prop('disabled', false);
                      $("#form-modal").modal('hide');
                      let successHtml = '<div class="alert alert-success" role="alert">Pledge Was Created Successfully</div>';
                      $("#alert-div").html(successHtml);
                    toastr.success("pledge was added successfully");
                      $("#name").val("");
                      $("#type_id").val("");
                      $("#purpose_id").val("");
                      $("#deadline").val("");
                      $("#amount").val("");
                      $("#description").val("");
                      $("#object_name").val("");
                      $("#object_cost").val("");
                      $("#object_quantity").val("");
                      $("#metrics").val("");
                      showAllPledges();
                      $("#form-modal").modal('hide');
                  },
                  error: function(response) {
                      $("#save-pledge-btn").prop('disabled', false);
       
                      /*
          show validation error
                      */
                      if (typeof response.responseJSON.errors !== 'undefined') 
                      {
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