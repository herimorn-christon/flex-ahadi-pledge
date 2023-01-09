{{--  This is the ajax fetch Purpose details method page --}}
<script type="text/javascript">
           /*
                get and display the record info on modal
            */
            function showPayment(id)
            {
                $("#name-info").html("");
                $("#description-info").html("");
                let url = $('meta[name=app-url]').attr("content") + "/admin/payments/" + id +"";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        let purpose = response.purpose;
                        $("#fname-info").html(purpose.payer.fname);
                        $("#mname-info").html(purpose.payer.mname);
                        $("#lname-info").html(purpose.payer.lname);
                        $("#purpose-info").html(purpose.pledge.name);
                        $("#amount-info").html(purpose.amount);
                        $("#method-info").html(purpose.payment.name);
                        $("#date-info").html(purpose.   created_at);
                        $("#view-modal").modal('show'); 
         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
           
</script>