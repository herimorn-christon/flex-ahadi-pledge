<script type="text/javascript">
  
            showAllNotifications();
    
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
                        $("#notifications-table-body").html("");
                        let notifications = response.notifications;
                        for (var i = 0; i < notifications.length; i++) 
                        {
                            let showBtn =  '<button ' +
                                  ' class="btn bg-teal  btn-sm " ' +
                                  ' onclick="showNotification(' + notifications[i].id + ')"><i class="fa fa-eye"></i>' +
                              '</button> ';
                              let deleteBtn =  '<button ' +
                                ' class="btn btn-danger btn-sm" ' +
                                ' onclick="destroyNotification(' + notifications[i].id + ')"><i class="fa fa-trash"></i>' +
                            '</button>';
  
         
                            let projectRow = '<tr>' +
                                '<td>' + notifications[i].id +  '</td>' +
                                '<td class="">' + notifications[i].type +'</td>' +
                                '<td>' + notifications[i].created_at +  '</td>' +
                                '<td>'  +showBtn+ deleteBtn+   '</td>' +
                            '</tr>';
                            $("#notifications-table-body").append(projectRow);
                        
                        }
         
                         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         
       
         
  
     
            /*
                submit the form and will be stored to the database
            */
            function storeCard()
            {   
                $("#save-card-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/cards";
                let data = {
                    card_no: $("#card").val(  
  
                      ),
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: data,
                    success: function(response) {
                        $("#save-card-btn").prop('disabled', false);
                        let successHtml = '<div class="alert alert-success" role="alert">Card Was Created Successfully</div>';
                        $("#alert-div").html(successHtml);
                        $("#card").val("");
    //                     showAllCards();
                        $("#form-modal").modal('hide');
                    },
                    error: function(response) {
                        $("#save-card-btn").prop('disabled', false);
         
                        /*
            show validation error
                        */
                        if (typeof response.responseJSON.errors !== 'undefined') 
                        {
            let errors = response.responseJSON.errors;
            let numberValidation = "";
            if (typeof errors.card_no !== 'undefined') 
                            {
                                numberValidation = '<li>' + errors.card_no[0] + '</li>';
                            }
             
            let errorHtml = '<div class="alert alert-danger" role="alert">' +
                '<b>Validation Error!</b>' +
                '<ul>' + numberValidation  +'</ul>' +
            '</div>';
            $("#error-div").html(errorHtml);        
        }
                    }
                });
            }
  
  
  
            /*
                get and display the record info on modal
            */
            function showCardMember(id)
            {
                $("#fname-info").html("");
                $("#mname-info").html("");
                let url = $('meta[name=app-url]').attr("content") + "/admin/notifications/" + id +"";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                          let notification = response.notification;
                         $("#name-info").html(notification.type );
                         $("#date-info").html(notification.created_at );
                         $("#message-info").html(notification.message );
                         $("#view-modal").modal('show'); 
                      
         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
  
         /*
                delete record function
            */
            function destroyCardMember(id)
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
                        let successHtml = '<div class="alert alert-danger" role="alert">Assigned Card Was Deleted Successfully </div>';
                        $("#alert-div").html(successHtml);
                        showAllCardMembers();
                        showAllCards();
                     
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         
        </script>