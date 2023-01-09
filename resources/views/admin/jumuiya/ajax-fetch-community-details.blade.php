{{--  This is the ajax fetch member details method page --}}
<script type="text/javascript">
         /*
            get and display the record info on modal
        */
        function showCommunity(id)
        {
            $("#name-info").html("");
            $("#description-info").html("");
            let url = $('meta[name=app-url]').attr("content") + "/admin/communities/" + id +"";
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    $("#members-table-body").html("");
                    let community = response.community;
                    $("#name-info").html(community.name);
                    $("#description-info").html(community.abbreviation);
                    $("#location-info").html(community.location);
                  
                  // for community members
                  let members = response.members;
                        for (var i = 0; i < members.length; i++) 
                        {      
         
                       let membersRow = '<tr>' +
                            '<td>' + community.abbreviation +'/' + members[i].id +'</td>' +
                                '<td>' + members[i].fname + '&nbsp;'+ members[i].mname + '&nbsp;'+ members[i].lname +'</td>' +
                                '<td>' + members[i].lname + '</td>' +  
                                '<td>' + members[i].phone + '</td>' +
                                '<td class="text-success">' + (members[i].status == '0' ? 'Enabled':'Disabled') + '</td>' +
                            '</tr>';
                            $("#members-table-body").append(membersRow);
                        }   


                $("#view-modal").modal('show'); 
     
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }
     
            
</script>