<script type="text/javascript">

                function showAllMoneyRequests()
                {
                    let url = $('meta[name=app-url]').attr("content") + "/admin/prequests";
                    $.ajax({
                        url: url,
                        type: "GET",
                        success: function(response) {
                            $("#requests-table-body").html("");
                            let methods = response.myprequests;
                            //   console.log(request);
                            for (var i = 0; i < methods.length; i++) 
                            {
           
                              
                                let editBtn =  '<button ' +
                                    ' class="btn btn-sm bg-teal text-light" ' +
                                    ' onclick="verifyRequestMoney(' + methods[i].id + ')"><i class="fa fa-check"></i> Verify' +
                                '</button> ';
                                let deleteBtn =  '<button ' +
                                    ' class="btn btn-danger" ' +
                                    ' onclick="destroyMethod(' + methods[i].id + ')">Delete' +
                                '</button>';
             
                                let projectRow = '<tr>' +
                                    '<td>' + (1+i)+ '</td>' +
                                    '<td>' + methods[i].formattedDate + '</td>' +
                                    '<td>' + methods[i].payer.fname + '&nbsp;' + methods[i].payer.mname +  '&nbsp;' + methods[i].payer.lname +   '</td>' +
                                    '<td>' + methods[i].pledge.name + '</td>' +
                                    '<td>' + methods[i].amount + '</td>' +
                                     '<td>' + methods[i].money_transaction+ '</td>' +
                                    '<td>' + editBtn + '</td>' +
                                '</tr>';
                                $("#requests-table-body").append(projectRow);
                                $("#money_requests").modal('show'); 
                            }
             
                             
                        },
                        error: function(response) {
                            console.log(response.responseJSON)
                        }
                    });
                }
       
    
    </script>


<script type="text/javascript">




            /*
                    This function will get all the payments records
                */
                function showAllPaymentObjectRequests()
                {
                    let url = $('meta[name=app-url]').attr("content") + "/admin/prequests";
                    $.ajax({
                        url: url,
                        type: "GET",
                        success: function(response) {
                            $("#requests-table-bodyObject").html("");
                            let methods = response.prequests;
                            //   console.log(request);
                            for (var i = 0; i < methods.length; i++) 
                            {
                              
                                let editBtn =  '<button ' +
                                    ' class="btn btn-sm bg-teal text-light" ' +
                                    ' onclick="verifyObjectRequest(' + methods[i].id + ')"><i class="fa fa-check"></i> Verify' +
                                '</button> ';
                                let deleteBtn =  '<button ' +
                                    ' class="btn btn-danger" ' +
                                    ' onclick="destroyMethodObject(' + methods[i].id + ')">Delete' +
                                '</button>';
             
                                let projectRow = '<tr>' +
                                    '<td>' + (1+i)+ '</td>' +
                                    '<td>' + methods[i].formattedDate + '</td>' +
                                    '<td>' + methods[i].payer.fname + '&nbsp;' + methods[i].payer.mname +  '&nbsp;' + methods[i].payer.lname +   '</td>' +
                                    '<td>' + methods[i].pledge.name + '</td>' +
                                    '<td>' + methods[i].total_Paid_object + '</td>' +
                                    '<td>' + methods[i].object_transaction + '</td>' +
                                    '<td>' + methods[i].amount + '</td>' +
                                    '<td>' + editBtn + '</td>' +
                                '</tr>';
                                $("#requests-table-bodyObject").append(projectRow);
                                $("#object_request").modal('show'); 
                            }
             
                             
                        },
                        error: function(response) {
                            console.log(response.responseJSON)
                        }
                    });
                }
       
    
    </script>

{{--  --}}