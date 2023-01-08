{{-- This is the file for ajax method of changing the user profile image --}}
<script>


   /*
                    check if form submitted is for uploading or updating
                */
                $("#save-profile-btn").click(function(event ){
                    event.preventDefault();
                    if($("#update_id").val() == null || $("#update_id").val() == "")
                    {
                        storeImage();
                    } else {
                        updateImage();
                    }
                })


          /*
                    edit profile detail function
                    it will get the existing value and show the edit profile form
                */
       
                function editImage()
                {
    
        //             let url = $('meta[name=app-url]').attr("content") + "/admin/profile-image/{{Auth::User()->id; }}" ;
                    $.ajax({
                        url: url,
                        type: "GET",
                        success: function(response) {
                            $("#avatar-modal").modal('show'); 
                        },
                        error: function(response) {
                            console.log(response.responseJSON)
                        }
                    });
                }
    
             
    
</script>