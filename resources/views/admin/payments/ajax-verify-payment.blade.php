{{-- This is the page for Purpose detail update method  --}}
<script type="text/javascript">

     /*
                check if form submitted is for creating or updating
            */
            $("#save-verification-btn").click(function(event ){
                event.preventDefault();
                if($("#vupdate_id").val() == null || $("#vupdate_id").val() == "")
                {
                    storeMethod();
                } else {
                      updateVerified();
                }
            })

        /*
                edit record function
                it will get the existing value and show the Payments form
            */
            function verifyRequest(id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/prequests/" + id ;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        let purpose = response.purpose;
                        $("#error-div").html("");   
                        $("#vupdate_id").val(purpose.id);
                        $("#vfname-info").html(purpose.payer.fname);
                        $("#vmname-info").html(purpose.payer.mname);
                        $("#vlname-info").html(purpose.payer.lname);
                        $("#vpurpose-info").html(purpose.pledge.name);
                        $("#vamount-info").html(purpose.amount);
                        $("#vmethod-info").html(purpose.payment.name);
                        $("#vdate-info").html(purpose. formattedDate);
                        $("#vreceipt-info").html(purpose. receipt);
                        $("#verify-modal").modal('show'); 
                        $("#requests").modal('hide'); 
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         
     
            /*
                sumbit the form and will update a record
            */
            function updateVerified()
            {
                $("#save-verification-btn").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin/prequests/" + $("#vupdate_id").val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "PUT",
                    success: function(response) {
                        $("#save-verification-btn").prop('disabled', false);
                               toastr.success('Payment Was Verified Successfully !');
                        let successHtml = '<div class="alert alert-success" role="alert">Payment Was Verified Successfully !</div>';
                        $("#alert-div").html(successHtml);
                     
                        $("#verify-modal").modal('hide');
                        showAllPayments();
                    },
                   
                });
            }
         
</script>