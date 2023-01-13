{{-- This is the page for ajax to fetch all registered members --}}

<script type="text/javascript">
    
            showAllMembers();
         
    
            /*
                This function will get all the project records
            */
            function showAllMembers()
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/members";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $("#members-table-body").html("");
                        let members = response.members;
                        let total_members = response.total_members;
                        let active_members = response.active_members;
                        let inactive_members = response.inactive_members;
                        let male_members = response.male_members;
                        let female_members = response.female_members;
                        for (var i = 0; i < members.length; i++) 
                        {
                            //For View Single Member Details
                            let showBtn =  '<button ' +
                                ' class="btn bg-flex btn-sm   text-light" ' +
                                ' onclick="showMember(' + members[i].id + ')" data-toggle="tooltip" data-placement="left" title="Click here to View Member Details"><i class="fa fa-eye"></i>' +
                            '</button> ';

                           //For Edit Single Member Details
                            let editBtn =  '<button ' +
                                ' class="btn bg-flex btn-sm text-light" ' +
                                ' onclick="editMember(' + members[i].id + ')" data-toggle="tooltip" data-placement="bottom" title="Click here to Edit Member Details"><i class="fa fa-edit"></i>' +
                            '</button> ';
                            
                            //For View Single Member Details
                            let deleteBtn =  '<button ' +
                                ' class="btn btn-danger btn-sm bg-gradient-danger" ' +
                                ' onclick="destroyMember(' + members[i].id + ')" data-toggle="tooltip" data-placement="left" title="Click here to Delete this Member"><i class="fa fa-trash"></i>' +
                            '</button>';
         
                            let projectRow = '<tr>' +
                                '<td>' +(i+1)+ '</td>' +
                                '<td>' + members[i].community.abbreviation +'/' + members[i].id +'</td>' +
                                '<td>' + members[i].fname + '&nbsp;'+ members[i].mname + '&nbsp;'+ members[i].lname +'</td>' +
                                '<td>' + members[i].community.name + '</td>' +
                                '<td>' + members[i].phone + '</td>' +
                                '<td>' + members[i].gender + '</td>' +
                                // '<td class="'+(members[i].status == '0' ? 'text-success':'text-danger')+'">' + (members[i].status == '0' ? 'Enabled':'Disabled') + '</td>'+
                                '<td>' + showBtn + editBtn + deleteBtn + '</td>'+
                            '</tr>';
                            $("#members").html(total_members);
                            $("#active").html(active_members);
                            $("#inactive").html(inactive_members);
                            $("#male").html(male_members);
                            $("#female").html(female_members);
                            $("#members-table-body").append(projectRow);
                        }
         
                         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
</script>