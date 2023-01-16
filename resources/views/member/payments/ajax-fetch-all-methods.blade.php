<script type="text/javascript">




        /*
                This function will get all the payments records
            */
            function showAllMethods()
            {
                let url = $('meta[name=app-url]').attr("content") + "/member/methods";
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $("#methods-table-body").html("");
                        let methods = response.methods;
                        for (var i = 0; i < methods.length; i++) 
                        {
                          
                            let editBtn =  '<button ' +
                                ' class="btn btn-secondary" ' +
                                ' onclick="editMethod(' + methods[i].id + ')">Edit' +
                            '</button> ';
                            let deleteBtn =  '<button ' +
                                ' class="btn btn-danger" ' +
                                ' onclick="destroyMethod(' + methods[i].id + ')">Delete' +
                            '</button>';
         
                            let projectRow = '<tr>' +
                                '<td>' + (1+i)+ '</td>' +
                                '<td>' + methods[i].name + '</td>' +
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