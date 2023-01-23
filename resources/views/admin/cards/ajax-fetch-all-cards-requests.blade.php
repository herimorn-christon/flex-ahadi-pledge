<script type="text/javascript">




            /*
                    This function will get all the payments records
                */
                function showAllRequests()
                {
                    let url = $('meta[name=app-url]').attr("content") + "/admin/crequests";
                    $.ajax({
                        url: url,
                        type: "GET",
                        success: function(response) {
                            $("#requests-table-body").html("");
                            let methods = response.crequests;
                            for (var i = 0; i < methods.length; i++) 
                            {
                              
                                let editBtn =  '<button ' +
                                    ' class="btn btn-sm bg-teal text-light" ' +
                                    ' onclick="verifyRequest(' + methods[i].id + ')"><i class="fa fa-check"></i> Verify' +
                                '</button> ';
                                let deleteBtn =  '<button ' +
                                    ' class="btn btn-danger" ' +
                                    ' onclick="destroyMethod(' + methods[i].id + ')">Delete' +
                                '</button>';
             
                                let projectRow = '<tr>' +
                                    '<td>' + (1+i)+ '</td>' +
                                    '<td>' + methods[i].formattedDate + '</td>' +
                                    '<td>' + methods[i].pledge.name + '</td>' +
                                    '<td>' + methods[i].amount + '</td>' +
                                    '<td>' + Btn + '</td>' +
                                '</tr>';
                                $("#requests-table-body").append(projectRow);
                                $("#requests").modal('show'); 
                            }
             
                             
                        },
                        error: function(response) {
                            console.log(response.responseJSON)
                        }
                    });
                }
       
    
    </script>