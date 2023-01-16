{{-- This is the page for ajax method of fetching a particular member's pledges --}}
<script type="text/javascript">
  showAllPledges();
       
          /*
              This function will get all the purposes records
          */
          function showAllPledges()
          {
              let url = $('meta[name=app-url]').attr("content") + "/member/pledges";
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                      $("#pledges-table-body").html("");
                      let pledges = response.pledges;
                      for (var i = 0; i < pledges.length; i++) 
                      {
                          let showBtn =  '<button ' +
                              ' class="btn btn-sm bg-flex text-light    " ' +
                              ' onclick="showPledge(' + pledges[i].id + ')"><i class="fa fa-eye"></i>' +
                          '</button> ';

                        
                            let editBtn =  '<button ' +
                              ' class="btn btn-sm bg-flex text-light " ' +
                              ' onclick="editPledge(' + pledges[i].id + ')"><i class="fa fa-edit"></i>' +
                          '</button> ';
                          let deleteBtn =  '<button ' +
                              ' class="btn btn-sm btn-danger" ' +
                              ' onclick="destroyPledge(' + pledges[i].id + ')">Delete' +
                          '</button>';
                          let adminBtn =  '<button ' +
                              ' class="btn btn-sm text-center" disabled ><i class="fa fa-user-tie text-danger"></i>' +
                          '</button>';
                              
                   
                          
       
                          let pledgesRow = '<tr>' +
                              '<td>' + pledges[i].id + '</td>' +
                              '<td>' + pledges[i].name + '</td>' +
                              '<td>' + pledges[i].purpose.title + '</td>' +
                              '<td>' + pledges[i].amount +'</td>' +
                              '<td>' + pledges[i].deadline +'</td>' +
                              '<td class="text-success">' +(pledges[i].purpose.status == '0' ? 'Not Fullfilled':'Fullfilled')+ '</td>'+
                              '<td>' + showBtn + (pledges[i].user_id == pledges[i].created_by ? editBtn :adminBtn)+'</td>' +
                          '</tr>';
                          $("#pledges-table-body").append(pledgesRow);
                      }
                          $("#total").html(total_pledges);
                          $("#fullfilled").html(fullfilled);
                          $("#unfullfilled").html(unfullfilled);
                          $("#money").html(money);
                          $("#object").html(object);
       
                       
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }
       
   
        

</script>