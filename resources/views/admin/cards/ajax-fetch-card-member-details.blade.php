{{--  This is the ajax fetch card member  details method page --}}
<script type="text/javascript">
         
        /*
              check if form submitted is for creating or updating
          */
          $("#save-member-btn").click(function(event ){
              event.preventDefault();
              if($("#update_id").val() == null || $("#update_id").val() == "")
              {
                  storeCardMember();
              } else {
                  updateCardMember();
              }
          })
       
     /*
              get and display the record info on modal
          */
          function showCardMember(id)
          {
              $("#fname-info").html("");
              $("#mname-info").html("");
              let url = $('meta[name=app-url]').attr("content") + "/admin/card-payments/" + id +"";
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                    $("#payment-table-body").html("");

                       let card = response.card;
                       $("#fname-info").html(card.user.fname );
                       $("#mname-info").html(card.user.mname );
                       $("#lname-info").html(card.user.lname );
    //                      let addBtn =  '<button ' +
    //                             ' class="btn btn-primary    " ' +
    //                             ' onclick="addCardPayment(' + card[i].id + ')"> Create Payment' +
    //                         '</button> ';
    //                    $("#add_payment").append(addBtn);
                       let payment = response.payment;
                      for (var i = 0; i < payment.length; i++) 
                      {
                         
                          let editBtn =  '<button ' +
                              ' class="btn bg-navy btn-sm" ' +
                              ' onclick="editPayment(' + payment[i].id + ')"><i class="fa fa-edit"></i>' +
                          '</button> ';
                          let deleteBtn =  '<button ' +
                              ' class="btn btn-danger btn-sm" ' +
                              ' onclick="destroyCardPayment(' + payment[i].id + ')"><i class="fa fa-trash"></i>' +
                          '</button>';
       
                          let projectRow = '<tr>' +
                              '<td>' + payment[i].id + '</td>' +
                              '<td>' + payment[i].created_at+ '</td>' +
                              '<td>' + payment[i].amount + '</td>' +
                              '<td>'  + editBtn + deleteBtn + '</td>' +
                          '</tr>';
                          $("#payment-table-body").append(projectRow);
                       $("#view-modal").modal('show'); 
                      }
                    
       
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }

</script>