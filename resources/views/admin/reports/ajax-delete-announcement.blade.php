{{-- This is the page is for ajax purpose deletion method --}}

 <script type="text/javascript">       
        
         
          
          /*
              delete record function
          */
          function destroyAnnouncement(id)
          {
              let url = $('meta[name=app-url]').attr("content") + "/admin/announcements/" + id;
              let data = {
                  title: $("#title").val(),
                  start_date: $("#body").val(),
                  description: $("#attachment").val(),
              };
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: url,
                  type: "DELETE",
                  data: data,
                  success: function(response) {
                      let successHtml = '<div class="alert alert-danger" role="alert">Announcement Was Deleted Successfully </div>';
                      $("#alert-div").html(successHtml);
                      showAllAnnouncements();
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }
       
      </script>