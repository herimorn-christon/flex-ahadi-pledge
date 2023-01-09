{{-- This is the page for ajax to fetch all registered Payment Methods --}}

<script type="text/javascript">
   
  /*
                This function will get all the payments records
            */
            function showAllMethods()
            {
                let url = $('meta[name=app-url]').attr("content") + "/admin/methods";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $("#methods-table-body").html("");
                        let methods = response.methods;
                        for (var i = 0; i < methods.length; i++) 
                        {
                          
                            let editBtn =  '<button ' +
                                ' class="btn btn-sm bg-flex text-light" ' +
                                ' onclick="editMethod(' + methods[i].id + ')"><i class="fa fa-edit"></i>' +
                            '</button> ';
                            let deleteBtn =  '<button ' +
                                ' class="btn btn-danger btn-sm" ' +
                                ' onclick="destroyMethod(' + methods[i].id + ')"><i class="fa fa-trash"></i>' +
                            '</button>';
         
                            let projectRow = '<tr>' +
                                '<td>' + methods[i].id + '</td>' +
                                '<td>' + methods[i].name + '</td>' +
                                '<td>' + editBtn + deleteBtn + '</td>' +
                            '</tr>';
                            $("#methods-table-body").append(projectRow);
                            $("#types").modal('show'); 
                        }
         
                         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         

</script>