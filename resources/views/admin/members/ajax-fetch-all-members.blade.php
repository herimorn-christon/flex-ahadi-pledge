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
                        $("#projects-table-body").html("");
                        let members = response.members;
                        for (var i = 0; i < members.length; i++) 
                        {
                            let showBtn =  '<button ' +
                                ' class="btn bg-flex btn-sm    " ' +
                                ' onclick="showMember(' + members[i].id + ')"><i class="fa fa-eye"></i>' +
                            '</button> ';
                            let editBtn =  '<button ' +
                                ' class="btn bg-flex btn-sm" ' +
                                ' onclick="editMember(' + members[i].id + ')"><i class="fa fa-edit"></i>' +
                            '</button> ';
                            let deleteBtn =  '<button ' +
                                ' class="btn btn-danger btn-sm bg-gradient-danger" ' +
                                ' onclick="destroyMember(' + members[i].id + ')"><i class="fa fa-trash"></i>' +
                            '</button>';
         
                            let projectRow = '<tr>' +
                                '<td>' +(i+1)+ '</td>' +
                                '<td>' + members[i].community.abbreviation +'/' + members[i].id +'</td>' +
                                '<td>' + members[i].fname + '&nbsp;'+ members[i].mname + '&nbsp;'+ members[i].lname +'</td>' +
                                '<td>' + members[i].community.name + '</td>' +
                                // '<td>' + members[i].phone + '</td>' +
                                '<td>' + members[i].gender + '</td>' +
                                // '<td class="'+(members[i].status == '0' ? 'text-success':'text-danger')+'">' + (members[i].status == '0' ? 'Enabled':'Disabled') + '</td>'+
                                '<td>' + showBtn + editBtn + deleteBtn + '</td>'+
                            '</tr>';
                            $("#members-table-body").append(projectRow);
                        }
         
                         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
</script>