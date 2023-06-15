{{-- This is the page for Pledge detail update method  --}}
<script type="text/javascript">
        /*
              edit record function
              it will get the existing value and show the purpose form
          */
          function editPledge(id)
          {
              let url = $('meta[name=app-url]').attr("content") + "/admin/pledges/" + id ;
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                      let pledge = response.pledge;
                      let pledgeObject = response.pledges_object;
                        console.log(pledge);
                      $("#alert-div").html("");
                      $("#error-div").html("");   
                      $("#update_id").val(pledge.id);
                      $("#name").val(pledge.name);
                      $("#amount").val(pledge.amount);
                      $("#user_id").val(pledge.user_id);
                      $("#type_id").val(pledge.type_id).trigger('change');
                      $("#purpose_id").val(pledge.purpose_id);
                      $("#deadline").val(pledge.deadline);
                      $("#description").val(pledge.description);
                      $("#objectName").val(pledge.object_name);
                      $("#objectCost").val(pledge.object_cost);
                      $("#objectQuantity").val(pledge.object_quantity);
                      $("#status").val(pledge.status);
                      // $("#status").val(pledge.status);
                  
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
          showAllPledges(); 
           showAllPledgesObject();
          function updatePledge()
          {
              $("#save-pledge-btn").prop('disabled', true);
              let url = $('meta[name=app-url]').attr("content") + "/admin/pledges/" + $("#update_id").val();
              let data = {
                  name: $("#name").val(),
                  amount: $("#amount").val(),
                  deadline: $("#deadline").val(),
                  description: $("#description").val(),
                  user_id: $("#user_id").val(),
                  type_id: $("#type_id").val(),
                  purpose_id: $("#purpose_id").val(),
                  status: $("#status").val(),
                  object_name:$("#objectName").val(),
                  object_cost:$("#objectCost").val(),
                  object_quantity:$("#objectQuantity").val(),
                  
              };
              console.log(data);
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: url,
                  type: "PUT",
                  data: data,
                  success: function(response) {
                      $("#save-pledge-btn").prop('disabled', false);
                       toastr.success('Pledge Was Updated Successfully ');
                      let successHtml = '<div class="alert alert-success" role="alert">Pledge Was Updated Successfully !</div>';
                      $("#alert-div").html(successHtml);
                      $("#name").val("");
                      $("#type_id").val("");
                      $("#purpose_id").val("");
                      $("#user_id").val("");
                      $("#deadline").val("");
                      $("#amount").val("");
                      $("#description").val("");   
                      $("#status").val(""); 
                      $("#objectName").val("");
                      $("#objectCost").val("");
                      $("#objectQuantity").val("");
                      showAllPledges();
                      showAllPledgesObject();
                      $("#form-modal").modal('hide');
                  },
                  error: function(response) {
                     showAllPledges();
                      showAllPledgesObject();
                      /*
          show validation error
                      */
                      $("#save-pledge-btn").prop('disabled', false);
                      if (typeof response.responseJSON.errors !== 'undefined') 
                            // toastr.info('Something went wrong');
                              $("#form-modal").modal('hide');
                             showAllPledgesObject();
                      {
        toastr.success(' something went wrong ');
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