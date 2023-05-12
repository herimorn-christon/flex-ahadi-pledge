{{--  --}}
<script type="text/javascript">
            
    // delete record function
            
            function destroyMember(id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/members/" + id;
                let data = {
                    fname: $("#fname").val(),
                    mname: $("#mname").val(),
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "DELETE",
                    data: data,
                    success: function(response) {
                          toastr.success('Member Was Deleted Successfully');
                        let successHtml = '<div class="btn btn-danger btn-block" disabled role="alert"> Member Was Deleted Successfully</div>';
                        $("#alert-div").html(successHtml);
                        showAllMembers();
                    },
                    error: function(response) {
                      toastr.info('something went wrong ');
                        console.log(response.responseJSON)
                    }
                });
            }
         
</script>