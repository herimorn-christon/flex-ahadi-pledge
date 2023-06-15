{{--  This is the ajax fetch member details method page --}}
<script type="text/javascript">
      /*
                get and display the record info on modal
            */
            function showMember(id)
            {
                //console.log(id);
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
                        //for dependants



                                   // for pledges
                        
                        let dependants=response.dependants;
                         $("#dependant-table-body").empty();
                        for(var i=0;i<dependants.length;i++){
                            // console.log(dependants[i].id);
                            
                            let dependant = '<tr>' +
                                '<td>' + dependants[i].id + '</td>' +
                                '<td>' + dependants[i].fullName+ '</td>' +
                                '<td>' + dependants[i].birth_date + '</td>' +
                                '<td>' + dependants[i].relationship + '</td>' +
                               
                            '</tr>';
                            $("#dependant-table-body").append(dependant);
    
                        }
                        


                          //for the object pledge  $pledges_object
                          let pledges_object= response.pledges_object;
                        for (var i = 0; i < pledges_object.length; i++) 
                        {      
        
                       let pledgesRowss = '<tr>' +
                                '<td>' + pledges_object[i].id + '</td>' +
                                '<td>' + pledges_object[i].purpose.title + '</td>' + 
                                '<td>' + pledges_object[i].name + '</td>' +
                                '<td>' + pledges_object[i].object_name + '</td>' +
                                '<td>' + pledges_object[i].object_quantity + + pledges_object[i].metrics +'</td>' +
                                '<td>' + pledges_object[i].object_cost + '</td>' +
                                '<td>' + pledges_object[i].deadline + '</td>' +  
                             
                                '<td class="text-success">' + (pledges_object[i].status == '0' ? 'Not Fullfilled':'Fullfilled') + '</td>' +
                            '</tr>';
                            $("#object-table-body").append(pledgesRowss);
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

                        //for member 
                        //console.log(member.id);
                        //console.log(member.id);
                        $("#ten").empty();
                        $('#two').html(member.marriage_date);
                        $('#three').html(member.baptization_date );
                        $('#four').html(member.deacon_name);
                        $('#five').html(member.deacon_phone);
                        $('#six').html(member.kipaimara_date);
                        $('#seven').html(member.fellowship_name);
                        $('#eight').html(member.partner_name);
                        $('#nine').html(member.proffession);
                        
                             let editBtn =  '<button ' +
                                ' class="btn bg-flex btn-sm text-light" ' +
                                ' onclick="editSpiritual(' + member.id + ')" data-toggle="tooltip" data-placement="bottom" title="Click here to Edit Member Details"><i class="fa fa-edit"></i>' +
                            '</button> ';
                          $('#ten').append(editBtn);

                        /*
                         var  members= '<tr>' +d
                                '<td>' + member.id + '</td>' +
                                '<td>' +member.marriage_date+ '</td>' +
                                '<td>' + member.baptization_date + '</td>' +
                                '<td>' +member.deacon_name+ '</td>' +  
                                '<td>' +member.deacon_phone+ '</td>' +
                                '<td>' +member.kipaimara_date + '</td>' +
                                '<td>' +member.fellowship_name+ '</td>' +
                                '<td>' +member.partner_name+ '</td>' +
                                '<td>' +member.proffession+ '</td>' +
                             $("#spiritual-table-body").add(members);
    */
                    
                    
                        // for cards
                    
                       //console.log(member.fname);

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