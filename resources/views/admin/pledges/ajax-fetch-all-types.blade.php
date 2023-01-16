{{-- This is the page for ajax to fetch all registered Pledge Types --}}

<script type="text/javascript">
   

        /*
            This function will get all the payments records
        */
        function showAllTypes()
        {
            let url = $('meta[name=app-url]').attr("content") + "/admin/types";
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    $("#types-table-body").html("");
                    let types = response.types;
                    for (var i = 0; i < types.length; i++) 
                    {
                      
                        let editBtn =  '<button ' +
                            ' class="btn bg-flex text-light btn-sm" ' +
                            ' onclick="editType(' + types[i].id + ')"><i class="fa fa-edit"></i>' +
                        '</button> ';
                        let deleteBtn =  '<button ' +
                            ' class="btn btn-danger  btn-sm" ' +
                            ' onclick="destroyType(' + types[i].id + ')"><i class="fa fa-trash"></i>' +
                        '</button>';
     
                        let projectRow = '<tr>' +
                            '<td>' + types[i].id + '</td>' +
                            '<td>' + types[i].title + '</td>' +
                            '<td>' + editBtn + deleteBtn + '</td>' +
                        '</tr>';
                        $("#types-table-body").append(projectRow);
                        $("#types").modal('show'); 
                    }
     
                     
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }

</script>