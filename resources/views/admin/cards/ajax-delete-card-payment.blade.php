{{-- This is the page is for ajax purpose deletion method --}}

 <script type="text/javascript">       
 
   /*
              delete record function
          */
          function destroyCardPayment(id)
          {
              let url = $('meta[name=app-url]').attr("content") + "/admin/card-payments/" + id;
              let data = {
                  card_member: $("#card_member").val(),
                  amount: $("#card_amount").val(),
              };
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: url,
                  type: "DELETE",
                  data: data,
                  success: function(response) {
                      toastr.success('Card Payment Was Deleted Successfully ');
                      let successHtml = '<div class="alert alert-danger" role="alert">Card Payment Was Deleted Successfully </div>';
                      $("#alert-div").html(successHtml);
                      showAllCardMembers();
                      $("#view-modal").modal('hide'); 
                  },
                  error: function(response) {
                    toastr.success('something went wrong ');
                      console.log(response.responseJSON)
                  }
              });
          }
       
      </script>