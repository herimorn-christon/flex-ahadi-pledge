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
                      for (var i = 0; i < pledges.length; i++) 
                      {
                          let showBtn =  '<button ' +
                              ' class="btn btn-sm bg-flex text-light" ' +
                              ' onclick="showPledge(' + pledges[i].id + ')"><i class="fa fa-eye"></i>' +
                          '</button> ';
                          let editBtn =  '<button ' +
                              ' class="btn btn-sm bg-flex text-light" ' +
                              ' onclick="editPledge(' + pledges[i].id + ')"><i class="fa fa-pen"></i>' +
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
                              '<td>' + showBtn + editBtn + deleteBtn + '</td>' +
                          '</tr>';
                          $("#pledges-table-body").append(pledgesRow);
                      }
       
                       
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }
       
   
</script>