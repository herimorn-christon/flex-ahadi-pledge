<script type="text/javascript">

  /*
              get and display the record info on modal
          */
          function showCardMember(id)
          {
              $("#fname-info").html("");
              $("#mname-info").html("");
              let url = $('meta[name=app-url]').attr("content") + "/member/cards/" + id +"";
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                    $("#payment-table-body").html("");

                       let card = response.card;
                       
                       $("#fname-info").html(card.user.fname );
                       $("#mname-info").html(card.user.mname );
                       $("#lname-info").html(card.user.lname );
                       $("#card-info").html(card.card.card_no+'/'+card.user_id );
                       $("#card-status").html(card.status == '0' ? 'Active':'InActive');
    //                 
                       let payment = response.payment;
                      for (var i = 0; i < payment.length; i++) 
                      {
                         
                     
       
                          let projectRow = '<tr>' +
                              '<td>' + payment[i].id + '</td>' +
                              '<td>' + payment[i].formattedDate+ '</td>' +
                              '<td>' + payment[i].amount + '</td>' +
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