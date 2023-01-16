<script type="text/javascript">
    
            showAllCardMembers();
  
          /*
              This function will get all the Available Cards records
          */
          function showAllCardMembers()
          {
              let url = $('meta[name=app-url]').attr("content") + "/member/cards";
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                      $("#members-table-body").html("");
                      let members = response.members;
                      let card_payments = response.card_payments;
                      for (var i = 0; i < members.length; i++) 
                      {
                            let showBtn =  '<button ' +
                                ' class="btn bg-flex text-light btn-sm " ' +
                                ' onclick="showCardMember(' + members[i].id + ')"><i class="fa fa-eye"></i>' +
                            '</button> ';

                          let status= members[i].status == '0' ? 'Active':'InActive';
       
                          let projectRow = '<tr>' +
                              '<td>' + (1+i) +  '</td>' +
                              '<td>' + members[i].card.card_no + ' /'+ members[i].user.id + '</td>' +
                              '<td class="text-success">' + status +'</td>' +
                              '<td>' + members[i].formattedDate+  '</td>' +
                              '<td>'  + showBtn+  '</td>' +
                          '</tr>';

                          $("#card-payments").html(card_payments+' Tsh');
                          $("#members-table-body").append(projectRow);
                      
                      }
       
                       
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }
       
</script>