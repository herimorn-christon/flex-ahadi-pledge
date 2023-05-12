 <script type="text/javascript">
  
     /*
                delete payment record function
            */
            function destroyMethod(id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/methods/" + id;
                let data = {
                    name: $("#name").val(),
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "DELETE",
                    data: data,
                    success: function(response) {
                        toastr.success('Payment Method Was Deleted Successfully ');
                        let successHtml = '<div class="alert alert-danger" role="alert">Payment Method Was Deleted Successfully </div>';
                        $("#alert-div").html(successHtml);
    //                     showAllMethods();
    
                        $("#types").modal('hide'); 
                    },
                    error: function(response) {
                        toastr.info('something went wrong');
                        console.log(response.responseJSON)
                    }
                });
            }
        </script>