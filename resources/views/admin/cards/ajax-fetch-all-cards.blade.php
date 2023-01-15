{{-- This is the page for ajax to fetch all created Cards Methods --}}

<script type="text/javascript">
    /*
              This function will get all the Available Cards records
          */
          function showAllCards()
          {
              let url = $('meta[name=app-url]').attr("content") + "/admin/cards";
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                      $("#cards-table-body").html("");
                      let cards = response.cards;
                    
                      for (var i = 0; i < cards.length; i++) 
                      {
                         
                          let editBtn =  '<button ' +
                              ' class="btn btn-sm bg-flex text-light" ' +
                              ' onclick="editCard(' + cards[i].id + ')"><i class="fa fa-eye"></i>' +
                          '</button> ';
                          let deleteBtn =  '<button ' +
                              ' class="btn btn-sm btn-danger" ' +
                              ' onclick="destroyCard(' + cards[i].id + ')"><i class="fa fa-trash"></i>' +
                          '</button>';
                          let status= cards[i].status == '0' ? 'Available':'NotAvailable';
       
                          let projectRow = '<tr>' +
                              '<td>' + (i+1) + '</td>' +
                              '<td>' + cards[i].card_no + ' /'+ '</td>' +
                              '<td class="text-success">' + status +'</td>' +
                              '<td>'  + editBtn + deleteBtn + '</td>' +
                          '</tr>';
                          $("#cards-table-body").append(projectRow);
                          $("#cards").modal('show'); 
                      }
                
       
                       
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }
         

</script>