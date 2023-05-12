 <script type="text/javascript">
  
            /*
                  delete pledge type record function
              */
              function destroyType(id)
              {
                  let url = $('meta[name=app-url]').attr("content") + "/admin/types/" + id;
                  let data = {
                      title: $("#title").val(),
                  };
                  $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      url: url,
                      type: "DELETE",
                      data: data,
                      success: function(response) {
                           toastr.success('Pledge Type Was Deleted Successfully');
                          let successHtml = '<div class="alert alert-danger" role="alert">Pledge Type Was Deleted Successfully </div>';
                          $("#types").modal('hide'); 
                      },
                      error: function(response) {
                          toastr.info('Something went wrong');
                          console.log(response.responseJSON)
                      }
                  });
              }
           
        </script>