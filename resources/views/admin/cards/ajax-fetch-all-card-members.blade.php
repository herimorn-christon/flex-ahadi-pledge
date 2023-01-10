{{-- This is the page for ajax to fetch all Assigned Card members Methods --}}

<script type="text/javascript">
  
          showAllCardMembers();
  
          /*
              This function will get all the Available Cards records
          */
          function showAllCardMembers()
          {
              let url = $('meta[name=app-url]').attr("content") + "/admin/card-member";
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                      $("#members-table-body").html("");
                      let members = response.members;
                      for (var i = 0; i < members.length; i++) 
                      {
                            let showBtn =  '<button ' +
                                ' class="btn bg-flex text-light  btn-sm   " ' +
                                ' onclick="showCardMember(' + members[i].id + ')"><i class="fa fa-eye"></i>' +
                            '</button> ';
                          let editBtn =  '<button ' +
                              ' class="btn bg-flex text-light btn-sm" ' +
                              ' onclick="editCardMember(' + members[i].id + ')"><i class="fa fa-edit"></i>' +
                          '</button> ';
                          let deleteBtn =  '<button ' +
                              ' class="btn btn-danger btn-sm" ' +
                              ' onclick="destroyCardMember(' + members[i].id + ')"><i class="fa fa-trash"></i>' +
                          '</button>';
                          let status= members[i].status == '0' ? 'Active':'InActive';
       
                          let projectRow = '<tr>' +
                              '<td>' + (1+i) +  '</td>' +
                              '<td>' + members[i].user.fname + '&nbsp;' + members[i].user.mname +  '&nbsp;' + members[i].user.lname +   '</td>' +
                              '<td>' + members[i].card.card_no + ' /'+ members[i].user.id + '</td>' +
                              '<td class="text-success">' + status +'</td>' +
                              '<td>'  + showBtn+ editBtn + deleteBtn + '</td>' +
                          '</tr>';
                          $("#members-table-body").append(projectRow);
                      
                      }
       
                       
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }
       
</script>