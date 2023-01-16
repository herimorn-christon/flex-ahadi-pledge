{{--  This is the ajax fetch Purpose details method page --}}
<script type="text/javascript">
           /*
                get and display the record info on modal
            */
            function showPurpose(id)
            {
                $("#name-info").html("");
                $("#description-info").html("");
                let url = $('meta[name=app-url]').attr("content") + "/admin/purposes/" + id +"";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $("#payments-table-body").html("");
                        $("#pledges-table-body").html("");
                        let purpose = response.purpose;
                        $("#title-info").html(purpose.title);
                        $("#start-info").html(purpose.start_date);
                        $("#end-info").html(purpose.end_date);
                        $("#description-info").html(purpose.description);

                        // for pledges
                        
                        let pledges = response.pledges;
                        for (var i = 0; i < pledges.length; i++) 
                        {      
         
                          let pledgesRow = '<tr>' +
                                '<td>' + pledges[i].id + '</td>' +
                                '<td>' + pledges[i].name + '</td>' +
                                '<td>' + pledges[i].amount + '</td>' +
                                '<td>' + pledges[i].deadline + '</td>' +
                                '<td class="text-success">' + (pledges[i].status == '0' ? 'Not Fullfilled':'Fullfilled') + '</td>' +
                            '</tr>';
                            $("#pledges-table-body").append(pledgesRow);
                        }
                        // for payments
                                                            
                        let payments = response.payments;
                        for (var i = 0; i < payments.length; i++) 
                        {      
         
                       let paymentsRow = '<tr>' +
                                '<td>' + payments[i].id + '</td>' +
                                '<td>' + payments[i].payer.fname + '&nbsp;'+ payments[i].payer.mname + '&nbsp;'+ payments[i].payer.lname +'</td>' +
                                '<td>' + payments[i].created_at + '</td>' +
                                '<td>' + payments[i].amount + '</td>' +
                                '<td>' + payments[i].payment.name + '</td>' +
                            '</tr>';
                            $("#payments-table-body").append(paymentsRow);
                        }

                        $("#view-modal").modal('show'); 
         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
                
           
</script>