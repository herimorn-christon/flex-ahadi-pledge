{{-- This is the page for ajax to fetch all registered Purposes/Contributions --}}

<script type="text/javascript">
    showAllPurposes();
         
            /*
                This function will get all the purposes records
            */
            function showAllPurposes()
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/purposes";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $("#purposes-table-body").html("");
                        let purposes = response.purposes;
                        let total_purposes = response.total_purposes;
                        let accomplished_purposes = response.accomplished_purposes;
                        let unaccomplished_purposes = response.inaccomplished_purposes;
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
                                '<td>' + purposes[i].start_date + '</td>' +
                                '<td>' + purposes[i].end_date + '</td>' +
                                '<td class="'+(purposes[i].status == '0' ? 'text-danger':'text-success')+'">' + (purposes[i].status == '0' ? 'Unaccomplished':'Accomplished')+'</td>' +
                                '<td>' + showBtn + editBtn + deleteBtn + '</td>' +
                            '</tr>';
                            $("#purposes-table-body").append(projectRow);
                            $("#total").html(total_purposes);
                            $("#accomplished").html(accomplished_purposes);
                            $("#unaccomplished").html(unaccomplished_purposes);
                        }
         
                         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }        
</script>