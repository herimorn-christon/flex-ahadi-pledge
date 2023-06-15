{{-- This is the page for Purpose detail update method  --}}
<script type="text/javascript">

     /*
                check if form submitted is for creating or updating
            */
            $("#saves-verifications-btns").click(function(event ){
                event.preventDefault();
                if($("#vupdate_id").val() == null || $("#vupdate_id").val() == "")
                {
                    storeMethod();
                } else {
                      updateVerified();
                }
            })
     

      //varifying the mormal payments


    


        /*
                edit record function
                it will get the existing value and show the Payments form
            */
            function verifyRequestMoney(id)
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
                        // $("#vmethod-info").html(purpose.payment.name);
                        $("#vdate-info").html(purpose. formattedDate);
                        $("#vreceipt-info").html(purpose. receipt);
                        //podate-info
                        
                        $("#verify-modal").modal('show'); 
                        $("#requests").modal('hide');
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }


    //verrying in terms of objects
          function verifyObjectRequest(id)
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/prequests/" + id ;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        let purpose = response.purpose;
                       
                        $("#error-divs").html("");   
                        $("#vupdate_ids").val(purpose.id);
                        $("#vfname-infos").html(purpose.payer.fname);
                        $("#vmname-infos").html(purpose.payer.mname);
                        $("#vlname-infos").html(purpose.payer.lname);
                        $("#vpurpose-infos").html(purpose.pledge.name);
                        $("#vamount-infos").html(purpose.total_Paid_object);
                        // $("#vmethod-info").html(purpose.payment.name);
                        $("#vdate-infos").html(purpose. formattedDate);
                        $("#vreceipt-infos").html(purpose. receipt);
                        //podate-info
                        
                        $("#verify-modalObject").modal('show'); 
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
                console.log("clicked");
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


<script>
  
            function updateObjectVerified()
            {
                $("#saves-verifications-btn").prop('disabled', true);
       
                console.log("clicked");
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