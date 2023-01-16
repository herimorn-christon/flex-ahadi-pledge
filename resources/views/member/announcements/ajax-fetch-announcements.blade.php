<script type="text/javascript">


showAllAnnouncements();
  
          /*
              This function will get all the Announcements records
          */
          function showAllAnnouncements()
          {
              let url = $('meta[name=app-url]').attr("content") + "/member/announcements";
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                      $("#announcements-table-body").html("");
                      let announcements = response.members;
                      for (var i = 0; i < announcements.length; i++) 
                      {
                          let showBtn =  '<button ' +
                                ' class="btn bg-flex text-light  btn-sm " ' +
                                ' onclick="showCardMember(' + announcements[i].id + ')"><i class="fa fa-eye"></i>' +
                            '</button> ';
                      

                          let announcementRow = '<tr>' +
                              '<td>' + (1+i) +  '</td>' +
                              '<td>' + announcements[i].created_at +  '</td>' +
                              '<td class="">' + announcements[i].title +'</td>' +
                              '<td>'  +showBtn+   '</td>' +
                          '</tr>';
                          $("#announcements-table-body").append(announcementRow);
                      
                      }
       
                       
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }
       
     
</script>