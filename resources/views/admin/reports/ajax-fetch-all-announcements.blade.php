{{-- This is the page for ajax to fetch all registered Purposes/Contributions --}}

<script type="text/javascript">
    
            showAllAnnouncements();
         
            /*
                This function will get all the purposes records
            */
            function showAllAnnouncements()
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/announcements";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $("#purposes-table-body").html("");
                        let purposes = response.announcements;
                        for (var i = 0; i < purposes.length; i++) 
                        {
                            let showBtn =  '<button ' +
                                ' class="btn btn-sm bg-flex text-light" ' +
                                ' onclick="showPurpose(' + purposes[i].id + ')" data-toggle="tooltip" data-placement="bottom" title="Click here to View '+ purposes[i].title +' details."><i class="fa fa-eye"></i>' +
                            '</button> ';
                            let editBtn =  '<button ' +
                                ' class="btn btn-sm bg-flex text-light" ' +
                                ' onclick="editPurpose(' + purposes[i].id + ')" data-toggle="tooltip" data-placement="bottom" title="Click here to Update '+ purposes[i].title +' details."><i class="fa fa-edit"></i>' +
                            '</button> ';
                            let deleteBtn =  '<button ' +
                                ' class="btn btn-sm btn-danger" ' +
                                ' onclick="destroyPurpose(' + purposes[i].id + ')" data-toggle="tooltip" data-placement="bottom" title="Click here to Delete '+ purposes[i].title +'."><i class="fa fa-trash"></i>' +
                            '</button>';
         
                            let projectRow = '<tr>' +
                                '<td>' + (i+1) + '</td>' +
                                '<td>' + purposes[i].title + '</td>' +
                                '<td>' + showBtn + editBtn + deleteBtn + '</td>' +
                            '</tr>';
                            $("#purposes-table-body").append(projectRow);
                        }
         
                         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }        
</script>