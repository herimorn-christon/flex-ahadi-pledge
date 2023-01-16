{{-- This is the page for ajax to fetch all registered Communities /Jumuiya --}}

<script type="text/javascript">
    

        showAllCommunities();
     
        /*
            This function will get all the project records
        */
        function showAllCommunities()
        {
            let url = $('meta[name=app-url]').attr("content") + "/admin/communities";
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    $("#communities-table-body").html("");
                    let communities = response.communities;
                    let total_communities = response.total_communities;
                    let largest_community = response.largest_community;
                    for (var i = 0; i < communities.length; i++) 
                    {
                        let showBtn =  '<button ' +
                            ' class="btn  btn-sm bg-flex text-light" ' +
                            ' onclick="showCommunity(' + communities[i].id + ')" data-toggle="tooltip" data-placement="left" title="Click here to View ' + communities[i].name + ' details" ><i class="fa fa-eye"></i>' +
                        '</button> ';
                        let editBtn =  '<button ' +
                            ' class="btn bg-flex btn-sm text-light" ' +
                            ' onclick="editCommunity(' + communities[i].id + ')" data-toggle="tooltip" data-placement="left" title="Click here to Edit ' + communities[i].name + ' details"><i class="fa fa-edit"></i>' +
                        '</button> ';
                        let deleteBtn =  '<button ' +
                            ' class="btn btn-danger  btn-sm" ' +
                            ' onclick="destroyCommunity(' + communities[i].id + ')" data-toggle="tooltip" data-placement="left" title="Click here to Delete ' + communities[i].name + '."><i class="fa fa-trash"></i>' +
                        '</button>';
     
                        let projectRow = '<tr>' +
                            '<td>' + (i+1) + '</td>' +
                            '<td>' + communities[i].name + '</td>' +
                            '<td>' + communities[i].abbreviation + '</td>' +
                            '<td>' + communities[i].location + '</td>' +
                            '<td>' + showBtn + editBtn + deleteBtn + '</td>' +
                        '</tr>';
                        $("#communities-table-body").append(projectRow);
                        $("#total").html(total_communities);
                        $("#largest").html(largest_community);
                    }
     
                     
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }
    
        
</script>