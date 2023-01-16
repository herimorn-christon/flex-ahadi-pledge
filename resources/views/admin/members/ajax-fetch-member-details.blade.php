{{--  This is the ajax fetch member details method page --}}
<script type="text/javascript">
      /*
                get and display the record info on modal
            */
            function showMember(id)
            {
                $("#name-info").html("");
                $("#description-info").html("");
                let url = $('meta[name=app-url]').attr("content") + "/admin/members/" + id +"";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $("#payments-table-body").html("");
                        $("#pledges-table-body").html("");
                        $("#cards-table-body").html("");                       
                        let member = response.member;
                        $("#name-info").html(member.fname);
                        $("#mname-info").html(member.mname);
                        $("#lname-info").html(member.lname);
                        $("#date-info").html(member.date_of_birth);
                        $("#description-info").html(member.gender);
                        $("#community-info").html(member.community.name);
                        $("#phone-info").html(member.phone);
                        $("#email-info").html(member.email);
                        $("#status-info").html(member.status == '1' ? 'Disabled':'Enabled');
                        $("#user-link").html(member.id);
                        
                        // for payments
                      
                        let payments = response.payments;
                        for (var i = 0; i < payments.length; i++) 
                        {      
         
                       let paymentsRow = '<tr>' +
                                '<td>' + payments[i].id + '</td>' +
                                '<td>' + payments[i].created_at+ '</td>' +
                                '<td>' + payments[i].pledge.name + '</td>' +
                                '<td>' + payments[i].amount + '</td>' +
                                '<td>' + payments[i].payment.name + '</td>' +
                            '</tr>';
                            $("#payments-table-body").append(paymentsRow);
                        }

                        // for pledges
                        
                        let pledges = response.pledges;
                        for (var i = 0; i < pledges.length; i++) 
                        {      
         
                       let pledgesRow = '<tr>' +
                                '<td>' + pledges[i].id + '</td>' +
                                '<td>' + pledges[i].name + '</td>' +
                                '<td>' + pledges[i].amount + '</td>' +
                                '<td>' + pledges[i].purpose.title + '</td>' +  
                                '<td>' + pledges[i].deadline + '</td>' +
                                '<td class="text-success">' + (pledges[i].status == '0' ? 'Not Fullfilled':'Fullfilled') + '</td>' +
                            '</tr>';
                            $("#pledges-table-body").append(pledgesRow);
                        }

                        // for cards

                        let cards = response.cards;
                        for (var i = 0; i < cards.length; i++) 
                        {      
         
                       let cardsRow = '<tr>' +
                                '<td>' + cards[i].id + '</td>' +
                                '<td>' + cards[i].card.card_no +'/'+ cards[i].user_id +'</td>' +
                                '<td class="text-success">' + (cards[i].status == '0' ? 'Active':'InActive') + '</td>' +
                            '</tr>';
                            $("#cards-table-body").append(cardsRow);
                        }


                        $("#view-modal").modal('show'); 
  
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         
            
</script>