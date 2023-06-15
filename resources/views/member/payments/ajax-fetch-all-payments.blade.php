{{-- This is the page for ajax method of fetching a particular member's pledges --}}
<script type="text/javascript">
   showAllPayments();
        
            /*
                This function will get all the payments records
            */
            function showAllPayments()
            {
                let url = $('meta[name=app-url]').attr("content") + "/member/payments";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $("#projects-table-body").html("");
                        let purposes = response.payments;
                       console.log(purposes);
                        let total_payments = response.total_payments;
                        let remaining = response.remaining;
                        let highest = response.highest;
                        let lowest = response.lowest;
                        let pledges = response.pledges;
                        for (var i = 0; i < purposes.length; i++) 
                        {
                            let showBtn =  '<button ' +
                                ' class="btn btn-sm bg-flex text-light " ' +
                                ' onclick="showPayment(' + purposes[i].id + ')"><i class="fa fa-eye"></i>' +
                            '</button> ';
         
                            let projectRow = '<tr>' +
                                '<td>' + (1+i)+ '</td>' +
                                '<td>' + purposes[i].formattedDate   + '</td>' +
                                '<td>' + purposes[i].pledge.name + '</td>' +
                                '<td>' + purposes[i].payment.name + '</td>' +
                                '<td>' + purposes[i].amount+ ' Tsh'+ '</td>' +
                                '<td class="text-teal">' + (purposes[i].verified == '1' ? 'Verified':'Not Verified' )+  '</td>' +
                                // '<td class="'+(purposes.verified == '0' ? 'text-teal':'text-danger')+'">'+(purposes.verified == '1' ? 'Verified':'Not Verified')+ '</td>'+
                                '<td>' + showBtn + '</td>' +
                            '</tr>'+'';
                            $("#projects-table-body").append(projectRow);
                        }
                          $("#total-payments").html(total_payments+' Tsh');
                          $("#remaining-payment").html(remaining+' Tsh');
                          $("#highest").html(highest+' Tsh');
                          $("#lowest").html(lowest+' Tsh');
                          $("#total-pledges").html(pledges+' Tsh');
                         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         
            
</script>