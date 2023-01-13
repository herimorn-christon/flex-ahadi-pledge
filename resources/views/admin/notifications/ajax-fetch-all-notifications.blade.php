{{-- This is the page for ajax to fetch all created Cards Methods --}}

<script type="text/javascript">
      /*
                This function will get all the Available Cards records
            */
            function showAllNotifications()
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/notifications";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $("#notification-table-body").html("");
                        let notifications = response.notifications;
                        for (var i = 0; i < notifications.length; i++) 
                        {
                           
                            let viewBtn =  '<button ' +
                                ' class="btn btn-sm bg-flex text-light" ' +
                                ' onclick="editCard(' + notifications[i].id + ')"><i class="fa fa-eye"></i>' +
                            '</button> ';
                            let deleteBtn =  '<button ' +
                                ' class="btn btn-sm btn-danger" ' +
                                ' onclick="destroyCard(' + notifications[i].id + ')"><i class="fa fa-trash"></i>' +
                            '</button>';
         
                            let projectRow = '<tr>' +
                                '<td>' + (i+1) + '</td>' +
                                '<td>' + notifications[i].type +'</td>' +
                                '<td>'  +viewBtn + deleteBtn + '</td>' +
                            '</tr>';
                            $("#notification-table-body").append(projectRow);
                            $("#notifications").modal('show'); 
                        }
         
                         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
           
  
  </script>