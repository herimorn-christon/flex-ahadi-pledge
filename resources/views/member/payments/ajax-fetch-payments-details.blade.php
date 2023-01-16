 <script type="text/javascript">


 /*
                get and display the record info on modal
            */
            function showPayment(id)
            {
                $("#name-info").html("");
                $("#description-info").html("");
                let url = $('meta[name=app-url]').attr("content") + "/member/payments/" + id +"";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        let purpose = response.payment;
                        $("#mname-info").html(purpose.payer.mname);
                        $("#lname-info").html(purpose.payer.lname);
                        $("#purpose-info").html(purpose.pledge.name);
                        $("#amount-info").html(purpose.amount);
                        $("#method-info").html(purpose.payment.name);
                        $("#date-info").html(purpose.formattedDate);
                        $("#view-modal").modal('show'); 
         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         

</script>