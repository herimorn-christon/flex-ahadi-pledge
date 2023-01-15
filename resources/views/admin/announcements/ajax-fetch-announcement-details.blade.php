{{--  This is the ajax fetch Purpose details method page --}}
<script type="text/javascript">
           /*
                get and display the record info on modal
            */
            function showAnnouncement(id)
            {
                $("title-info").html("");
                $("#body-info").html("");
                let url = $('meta[name=app-url]').attr("content") + "/admin/announcements/" + id +"";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $("#attachment").html("");
                        let purpose = response.announcement;
                        $("#title-info").html(purpose.title);
                        $("#body-info").html(purpose.body);

                     let showAttachment =  '<img ' +
                                ' src="{{asset("uploads/announcements/'+purpose.file'")}}" ' +
                                'alt="no attachment" >';
                        $("#attachment").append(showAttachment);
                        $("#view-modal").modal('show'); 
         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
                
           
</script>