{{-- This is the page for ajax to fetch all registered Pledges --}}
<script type="text/javascript">
    
          showAllPledges();
       
          /*
              This function will get all the purposes records
          */
          function showAllPledges()
          {
              let url = $('meta[name=app-url]').attr("content") + "/admin/pledges";
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                      $("#pledges-table-body").html("");
                      let pledges = response.pledges;
                      let total_pledges = response.total_pledges;
                      let unfullfilled = response.unfullfilled;
                      let total_amount = response.total_amount;
                      let object = response.object;
                      let fullfilled = response.fullfilled;
                      let best = response.best;
                      for (var i = 0; i < pledges.length; i++) 
                      {
                          let showBtn =  '<button ' +
                              ' class="btn btn-sm bg-flex text-light" ' +
                              ' onclick="showPledge(' + pledges[i].id + ')"><i class="fa fa-eye"></i>' +
                          '</button> ';
                          let editBtn =  '<button ' +
                              ' class="btn btn-sm bg-flex text-light" ' +
                              ' onclick="editPledge(' + pledges[i].id + ')"><i class="fa fa-edit"></i>' +
                          '</button> ';
                          let deleteBtn =  '<button ' +
                              ' class="btn btn-danger btn-sm" ' +
                              ' onclick="destroyPledge(' + pledges[i].id + ')"><i class="fa fa-trash"></i>' +
                          '</button>';
       
                          let pledgesRow = '<tr>' +
                              '<td>' + (i+1) + '</td>' +
                              '<td>' + pledges[i].user.fname + '&nbsp;' + pledges[i].user.mname +  '&nbsp;' + pledges[i].user.lname +   '</td>' +
                              '<td>' + pledges[i].name + '</td>' +
                              '<td>' + pledges[i].purpose.title + '</td>' +
                              '<td>' + pledges[i].amount + '</td>' +
                              '<td class="'+(pledges.status == '0' ? 'text-teal':'text-danger')+'">'+(pledges.status == '0' ? 'Fullfilled':'Not Fullfilled')+ '</td>'+
                              '<td>' + showBtn + editBtn + deleteBtn + '</td>' +
                          '</tr>';
                          $("#pledges-table-body").append(pledgesRow);
                          $("#total").html(total_pledges);
                          $("#total_amount").html(total_amount);
                          $("#unfullfilled").html(unfullfilled);
                          $("#object").html(object);
                          $("#fullfilled").html(fullfilled);
                          $("#best").html(best);
                          
                      }
       
                       
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }
       
   
</script>