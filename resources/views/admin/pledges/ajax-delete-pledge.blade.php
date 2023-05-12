{{-- This is the page is for ajax purpose deletion method --}}

 <script type="text/javascript">       
        
         /*
              delete record function
          */
          function destroyPledge(id)
          {
              let url = $('meta[name=app-url]').attr("content") + "/admin/pledges/" + id;
              let data = {
                  name: $("#name").val(),
                  amount: $("#amount").val(),
                  deadline: $("#deadline").val(),
                  user_id: $("#user_id").val(),
                  type_id: $("#type_id").val(),
                  purpose_id: $("#purpose_id").val(),
                  description: $("#description").val(),
              };
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: url,
                  type: "DELETE",
                  data: data,
                  success: function(response) {
                      toastr.success('Pledge Was Deleted Successfully');
                      let successHtml = '<div class="alert alert-danger" role="alert">Pledge Was Deleted Successfully </div>';
                      $("#alert-div").html(successHtml);
                      showAllPledges();
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                     toastr.info('Something went wrong!!!!');
                  }
              });
          }
       

      </script>