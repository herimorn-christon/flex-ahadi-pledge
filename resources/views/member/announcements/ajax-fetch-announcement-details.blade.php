<script type="text/javascript">
   /*
                get and display the record info on modal
            */
            function showAnnouncement(id)
            {
                $("#fname-info").html("");
                $("#mname-info").html("");
                let url = $('meta[name=app-url]').attr("content") + "/member/announcements/" + id +"";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                           let notification = response.member;
                         $("#name-info").html(notification.title );
                         $("#date-info").html(notification.created_at );
                         $("#message-info").html(notification.body );
                         $("#view-modal").modal('show'); 
                      
         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
  
        </script>