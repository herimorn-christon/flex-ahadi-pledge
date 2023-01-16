{{--  This is the ajax fetch Pledge details method page --}}
<script type="text/javascript">
              /*
              get and display the record info on modal
          */
          function showPledge(id)
          {
              $("#name-info").html("");
              $("#description-info").html("");
              let url = $('meta[name=app-url]').attr("content") + "/admin/pledges/" + id +"";
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                      let pledge = response.pledge;
                      $("#fname-info").html(pledge.user.fname );
                      $("#mname-info").html(pledge.user.mname );
                      $("#lname-info").html(pledge.user.lname );
                      $("#title-info").html(pledge.name);
                      $("#start-info").html(pledge.deadline);
                      $("#status-info").html(pledge.status == '0' ? 'Not Fullfilled':'Fullfilled');
                      $("#end-info").html(pledge.amount);
                      $("#type-info").html(pledge.type.title);
                      $("#purpose-info").html(pledge.purpose.title);
                      $("#description-info").html(pledge.description);
                      $("#view-modal").modal('show'); 
       
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }
                
           
</script>