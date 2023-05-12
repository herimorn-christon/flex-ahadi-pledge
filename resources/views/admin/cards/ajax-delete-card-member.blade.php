{{--  This is the page for ajax method to delete card member --}}
<script type="text/javascript">
     /*
              delete record function
          */
          function destroyCardMember(id)
          {
              let url = $('meta[name=app-url]').attr("content") + "/admin/card-member/" + id;
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
                        
                     toastr.success('Assigned Card Was Deleted Successfully');
                      let successHtml = '<div class="alert alert-danger" role="alert">Assigned Card Was Deleted Successfully </div>';
                      $("#alert-div").html(successHtml);
                      showAllCardMembers();
                      showAllCards();
                   
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                    toastr.info('Something went wrong!!!!');
                  }
              });
          }
        </script>