{{-- This is the page for ajax to fetch all registered Purposes/Contributions --}}
<script type="text/javascript">
             /*
              This function will get all the Available Cards records
          */
          function AllNotifications()
          {
              let url = $('meta[name=app-url]').attr("content") + "/admin/notifications";
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                      $("#notifications-table-body").html("");
                      let members = response.notifications;
                      for (var i = 0; i < members.length; i++) 
                      {
                          let showBtn =  '<button ' +
                                ' class="btn bg-teal  btn-sm " ' +
                                ' onclick="showCardMember(' + members[i].id + ')"><i class="fa fa-eye"></i>' +
                            '</button> ';
                            let deleteBtn =  '<button ' +
                              ' class="btn btn-danger btn-sm" ' +
                              ' onclick="destroyCardMember(' + members[i].id + ')"><i class="fa fa-trash"></i>' +
                          '</button>';

                          let projectRow = '<tr>' +
                              '<td>' + members[i].id +  '</td>' +
                              '<td class="">' + members[i].type +'</td>' +
                              '<td>' + members[i].created_at +  '</td>' +
                              '<td>'  +showBtn+ deleteBtn+   '</td>' +
                          '</tr>';

                          $("#notifications-table-body").append(projectRow);
                            $("#notify-modal").modal('show'); 
                      
                      }
       
                       
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }
       
     
       
    </script>