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
                        $("#purpose-amount").html(purpose.pledge.amount);
                        $("#purpose-remained").html(purpose.money_transaction);
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
       

     function showPaymentObject(id)
            {
        //  console.log(id);
           $("#view-modalObjects").modal('show'); 
                $("#name-infos").html("");
                $("#description-infos").html("");
                let url = $('meta[name=app-url]').attr("content") + "/member/payments/" + id +"";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                    //    console.log(ids);
                        let purpose = response.payment;
                        // let pledges=response.pledges;
                        // console.log(pledges);
                        let myid = response.ids;
                         console.log(purpose);
                        // let payment_object_prev=response.payment_object_prev;
                        let payment_sum=response.payment_sum;
                        // console.log($payment_object_prev);
                       let amount_remained=purpose.pledge.object_quantity-purpose.object_quantity;
                        let remaining_object_cost=purpose.pledge.object_cost-purpose.object_cost;
                        console.log(remaining_object_cost);
    //                     $("#mname-infos").html(purpose.payer.mname);
    //                     $("#lname-infos").html(purpose.payer.lname);
    // amount_remain
                        $("#purpose-infos").html(purpose.pledge.name);
                        $("#purpose-object").html(purpose.pledge.object_name);
                        $("#purpose-quantity").html(purpose.pledge.object_quantity + purpose.pledge.metrics)
                        $("#amount-infos").html(purpose.object_cost +"  "+ "For"+ purpose.object_quantity_conversion + purpose.pledge.metrics);
                        $("#amountQuantity-infos").html(purpose.object_quantity + purpose.pledge.metrics);
                        $("#previously").html(purpose.money_transaction);
                        $("#amount-infosObject").html(purpose.pledge.object_cost);
                        // $("#Remained_amount-infos").html(remaining_object_cost);
                        $("#amount_remain").html(purpose.object_transaction);
    //                     $("#method-infos").html(purpose.payment.name);
                        $("#date-infos").html(purpose.formattedDate);
                        $("#view-modalObjects").modal('show'); 
         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         

</script>