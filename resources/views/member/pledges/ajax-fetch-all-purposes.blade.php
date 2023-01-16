{{-- This is the page for ajax to fetch all registered Purposes/Contributions --}}

<script type="text/javascript">
    
         
            /*
                This function will get all the purposes records
            */
            function showAllPurposes()
            {
                let url = $('meta[name=app-url]').attr("content") + "/member/purposes";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $("#purposes-table-body").html("");
                        let purposes = response.purposes;
                        for (var i = 0; i < purposes.length; i++) 
                        {
                         
         
                            let projectRow = '<tr>' +
                                '<td>' + (i+1) + '</td>' +
                                '<td>' + purposes[i].title + '</td>' +
                                '<td>' + purposes[i].description + '</td>' +
                                '<td>' + purposes[i].start_date + '</td>' +
                                '<td>' + purposes[i].end_date + '</td>' +
                                '<td class="'+(purposes[i].status == '0' ? 'text-danger':'text-success')+'">' + (purposes[i].status == '0' ? 'Unaccomplished':'Accomplished')+'</td>' +
                              
                            '</tr>';
                            $("#purposes-table-body").append(projectRow);
                            
                        }
                        $("#types").modal('show'); 
                         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }        
</script>