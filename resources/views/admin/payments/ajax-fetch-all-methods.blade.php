{{-- This is the page for ajax to fetch all registered Payment Methods --}}
{{-- This is the page for ajax to fetch all registered Purposes/Contributions --}}


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
        let toggleBtn = '<input type="checkbox" class="toggles-payments" style="width:6rem" data-id="' +  methods[i].id + '" ' +
                        ( methods[i].is_active ? 'checked' : '') + ' data-toggle="toggle" ' +
                        'data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" ' +
                        'data-size="small" onchange="togglePaymentMethod(' +  methods[i].id + ')">';
                         
                          
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
                                '<td>' + editBtn + toggleBtn+ '</td>' +
                            '</tr>';
                            $("#methods-table-body").append(projectRow);
                            $("#types").modal('show'); 
                        }
                  $('.toggles-payments').bootstrapToggle();
         
                         
                    },
                    error: function(response) {
                        console.log(response.responseJSON)
                    }
                });
            }
         

</script>