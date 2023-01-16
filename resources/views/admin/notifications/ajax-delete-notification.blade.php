{{-- This is the page is for ajax purpose deletion method --}}

 <script type="text/javascript">       
        
      /*
              delete record function
          */
          function destroyNotification(id)
          {
              let url = $('meta[name=app-url]').attr("content") + "/admin/notifications/" + id;
              let data = {
                  card_no: $("#card_no").val(),
                  user_id: $("#user_id").val(),
              };
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: url,
                  type: "DELETE",
                  data: data,
                  success: function(response) {
                      let successHtml = '<div class="alert alert-danger" role="alert">Notification Was Deleted Successfully !</div>';
                      $("#alert-div").html(successHtml);
                      showAllNotifications();
                      $("#notifications").modal('show'); 
                   
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }
       

      </script>