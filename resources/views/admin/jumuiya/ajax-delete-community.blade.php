{{-- This is the page is for community update method --}}

<script type="text/javascript">
     
 
     
            /*
                delete record function
            */
            function destroyCommunity(id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/communities/" + id;
                let data = {
                    name: $("#name").val(),
                    abbreviation: $("#abbreviation").val(),
                    location: $("#location").val(),
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "DELETE",
                    data: data,
                    success: function(response) {
                        let successHtml = '<div class="alert alert-danger " role="alert">Community Was Deleted Successfully !</div>';
                        $("#alert-div").html(successHtml);
                        showAllCommunities();
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         
    </script>