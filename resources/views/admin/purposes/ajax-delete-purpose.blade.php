{{-- This is the page is for ajax purpose deletion method --}}

 <script type="text/javascript">       
        
         
          
          /*
              delete record function
          */
          function destroyPurpose(id)
          {
              let url = $('meta[name=app-url]').attr("content") + "/admin/purposes/" + id;
              let data = {
                  title: $("#title").val(),
                  start_date: $("#start_date").val(),
                  end_date: $("#end_date").val(),
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
                      let successHtml = '<div class="alert alert-danger" role="alert">Purpose Was Deleted Successfully </div>';
                      $("#alert-div").html(successHtml);
                      showAllPurposes();
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }
       
      </script>