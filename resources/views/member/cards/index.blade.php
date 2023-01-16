@extends('layouts.member')

@section('title','My Cards')


@section('content')


<div class="card  p-2 border-left-flex">
  <div class="row mb-1">

  {{-- start of statistics --}}
<div class="">
  <div class="row starts-border mx-1 mt-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Card Payments Made in {{ date('Y')}} </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="payments"></h6></div>
  </div>
  <div class="row starts-border mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Current Card Member </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="current"></h6></div>
  </div>
  

</div>
{{-- end of statistics --}}
    <div class="col-sm-5" id="alert-div">
      @if (session('status'))
      <div class="alert disabled" style="background-color: rgb(198, 253, 216)" role="alert">
          {{ session('status') }}
      </div>
      @endif
      
    </div><!-- /.col -->
    <div class="col-sm-7">
      <ol class="float-sm-right" type="none">
        <li class="">  
          <form action="{{ url('member/request-card') }}" method="post">
            @csrf 
                <input type="text" name="user_id" value="{{ Auth::User()->id; }}" hidden>
                 
        
          <button  type="submit"  class="btn bg-flex text-light  btn-sm mb-1" >
            <i class="fa fa-envelope"></i>
             Request New Card
        </button>
        <a href="" class="btn btn-sm bg-cyan mb-1">
          <i class="fa fa-file-pdf"></i>
          Generate Report
        </a>
      </form> 
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>
</div>

<div class="card mt-1">
    <div class="mt-2">

        <div class="responsive mx-1 mt-2">
            <table id="example" class="table table-bordered cell-border">
                <thead>
                    <tr class="text-secondary">
                        <th>ID</th>
                        <th>Card Number</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody id="members-table-body">
   
  
                </tbody>
            </table>
  
        </div>


{{-- view single card member info--}}
<div class="modal fade" id="view-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <b class="text-secondary">Member Name:</b>   <span id="fname-info" class="text-dark"></span> <span id="mname-info" class="text-dark"></span> <span id="lname-info" class="text-dark"></span>
        <hr>
        <div class="row">
          <table id="modaltable" class="table table-bordered ">
              <thead>
                  <tr class="text-secondary">
                      <th>ID</th>
                      <th>Payment Date</th>
                      <th>Amount</th>
                  </tr>
              </thead>
              <tbody id="payment-table-body">
         

              </tbody>
          </table>
      <hr>

      </div>
                
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>





  <script type="text/javascript">
  
          showAllCardMembers();
  
          /*
              This function will get all the Available Cards records
          */
          function showAllCardMembers()
          {
              let url = $('meta[name=app-url]').attr("content") + "/member/cards";
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                      $("#members-table-body").html("");
                      let members = response.members;
                      for (var i = 0; i < members.length; i++) 
                      {
                            let showBtn =  '<button ' +
                                ' class="btn bg-flex text-light btn-sm " ' +
                                ' onclick="showCardMember(' + members[i].id + ')"><i class="fa fa-eye"></i>' +
                            '</button> ';

                          let status= members[i].status == '0' ? 'Active':'InActive';
       
                          let projectRow = '<tr>' +
                              '<td>' + members[i].id +  '</td>' +
                              '<td>' + members[i].card.card_no + ' /'+ members[i].user.id + '</td>' +
                              '<td class="text-success">' + status +'</td>' +
                              '<td>' + members[i].created_at +  '</td>' +
                              '<td>'  + showBtn+  '</td>' +
                          '</tr>';
                          $("#members-table-body").append(projectRow);
                      
                      }
       
                       
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }
       
          /*
              This function will get all the Available Cards records
          */
          function showAllCards()
          {
              let url = $('meta[name=app-url]').attr("content") + "/member/cards";
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                      $("#cards-table-body").html("");
                      let cards = response.cards;
                      for (var i = 0; i < cards.length; i++) 
                      {
                         
                          let editBtn =  '<button ' +
                              ' class="btn btn-secondary" ' +
                              ' onclick="editCard(' + cards[i].id + ')">Edit' +
                          '</button> ';
                          let deleteBtn =  '<button ' +
                              ' class="btn btn-danger" ' +
                              ' onclick="destroyCard(' + cards[i].id + ')">Delete' +
                          '</button>';
                          let status= cards[i].status == '0' ? 'Available':'NotAvailable';
       
                          let projectRow = '<tr>' +
                              '<td>' + cards[i].id + '</td>' +
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
       
          /*
              check if form submitted is for creating or updating
          */
          $("#save-card-btn").click(function(event ){
              event.preventDefault();
              if($("#update_id").val() == null || $("#update_id").val() == "")
              {
                  storeCard();
              } else {
                  updateCard();
              }
          })
       
       
       

   
          /*
              submit the form and will be stored to the database
          */
          function storeCard()
          {   
              $("#save-card-btn").prop('disabled', true);
              let url = $('meta[name=app-url]').attr("content") + "/member/cards";
              let data = {
                  card_no: $("#card").val(  

                    ),
              };
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: url,
                  type: "POST",
                  data: data,
                  success: function(response) {
                      $("#save-card-btn").prop('disabled', false);
                      let successHtml = '<div class="alert alert-success" role="alert">Card Was Created Successfully</div>';
                      $("#alert-div").html(successHtml);
                      $("#card").val("");
  //                     showAllCards();
                      $("#form-modal").modal('hide');
                  },
                  error: function(response) {
                      $("#save-card-btn").prop('disabled', false);
       
                      /*
          show validation error
                      */
                      if (typeof response.responseJSON.errors !== 'undefined') 
                      {
          let errors = response.responseJSON.errors;
          let numberValidation = "";
          if (typeof errors.card_no !== 'undefined') 
                          {
                              numberValidation = '<li>' + errors.card_no[0] + '</li>';
                          }
           
          let errorHtml = '<div class="alert alert-danger" role="alert">' +
              '<b>Validation Error!</b>' +
              '<ul>' + numberValidation  +'</ul>' +
          '</div>';
          $("#error-div").html(errorHtml);        
      }
                  }
              });
          }


         /*
              check if form submitted is for creating or updating
          */
        /*
            show modal for creating a record and 
            empty the values of form and remove existing alerts
        */
        function createCardMember()
        {
            $("#alert-div").html("");
            $("#error-div").html("");   
            $("#update_id").val("");
            $("#card_no").val("");
            $("#user_id").val("");
            $("#member-modal").modal('show'); 
        }
     
        /*
            submit the form and will be stored to the database
        */
        function storeCardMember()
        {   
            $("#save-member-btn").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/admin/card-member";
            let data = {
                card_no: $("#card_no").val(),
                user_id: $("#user_id").val(),
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: data,
                success: function(response) {
                    $("#save-member-btn").prop('disabled', false);
                    let successHtml = '<div class="alert alert-success" role="alert">Card Was Assigned Successfully</div>';
                    $("#alert-div").html(successHtml);
                    $("#card_no").val("");
                     $("#user_id").val("");
                    showAllCardMembers();
                    showAllCards();
                    $("#member-modal").modal('hide');
                },
                error: function(response) {
                    $("#save-member-btn").prop('disabled', false);
     
                    /*
        show validation error
                    */
                    if (typeof response.responseJSON.errors !== 'undefined') 
                    {
        let errors = response.responseJSON.errors;
        let numberValidation = "";
        if (typeof errors.card_no !== 'undefined') 
                        {
                            numberValidation = '<li>' + errors.card_no[0] + '</li>';
                        }
        let userValidation = "";
        if (typeof errors.user_id !== 'undefined') 
                        {
                            userValidation = '<li>' + errors.user_id[0] + '</li>';
                        }        
        let errorHtml = '<div class="alert alert-danger" role="alert">' +
            '<b>Validation Error!</b>' +
            '<ul>' + numberValidation  +'</ul>' +
        '</div>';
        $("#error-div").html(errorHtml);        
    }
                }
            });
        }
     


          /*
              get and display the record info on modal
          */
          function showCardMember(id)
          {
              $("#fname-info").html("");
              $("#mname-info").html("");
              let url = $('meta[name=app-url]').attr("content") + "/member/cards/" + id +"";
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                    $("#payment-table-body").html("");

                       let card = response.card;
                       $("#fname-info").html(card.user.fname );
                       $("#mname-info").html(card.user.mname );
                       $("#lname-info").html(card.user.lname );
    //                      let addBtn =  '<button ' +
    //                             ' class="btn btn-primary    " ' +
    //                             ' onclick="addCardPayment(' + card[i].id + ')"> Create Payment' +
    //                         '</button> ';
    //                    $("#add_payment").append(addBtn);
                       let payment = response.payment;
                      for (var i = 0; i < payment.length; i++) 
                      {
                         
                     
       
                          let projectRow = '<tr>' +
                              '<td>' + payment[i].id + '</td>' +
                              '<td>' + payment[i].created_at+ '</td>' +
                              '<td>' + payment[i].amount + '</td>' +
                          '</tr>';
                          $("#payment-table-body").append(projectRow);
                       $("#view-modal").modal('show'); 
                      }
                    
       
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }

  
       
      </script>
@endsection