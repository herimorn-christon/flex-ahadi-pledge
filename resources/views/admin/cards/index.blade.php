@extends('layouts.master')

@section('title','Manage Cards')


@section('content')


<div class="row mb-1">
    <div class="col-sm-5" id="alert-div">
      @if (session('status'))
      <div class="alert disabled" style="background-color: rgb(198, 253, 216)" role="alert">
          {{ session('status') }}
      </div>
      @endif
    </div><!-- /.col -->
    <div class="col-sm-7">
      <ol class="breadcrumb float-sm-right">
        <li class="">    
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="createPayment()">
            <i class="fa fa-dollar-sign"></i>
             Add Card Payment
        </button>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="showAllCards()">
            <i class="fa fa-envelope"></i>
             Available Cards
        </button>
        <button type="button" class="btn btn-primary btn-sm"  onclick="createCardMember()">
            <i class="fa fa-list"></i>
             Assign Card
        </button>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="createCard()">
        <i class="fa fa-plus"></i>
            Create Card
        </button>
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>

<div class="card mt-1">
    <div class="card-header bg-light">
        <h6 class="text-light">
            
        </h6>
    </div>
    <div class="card-body">

        <div class="row">
            <table  class="table table-bordered ">
                <thead>
                    <tr class="text-secondary">
                        <th>ID</th>
                        <th>Member</th>
                        <th>Card Number</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="members-table-body">
   
  
                </tbody>
            </table>
  
        </div>

{{-- Add Card modal --}}

<div class="modal fade" id="form-modal">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header bg-light">
      <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>
      <div class="modal-body">
        <div id="error-div"></div>
          <form >
            <input type="hidden" name="update_id" id="update_id">
              <div class="row mb-3">
               <div class="col-md-12">
                  <div class="form-group">
                      <label for="card_no" class="text-secondary">Card Number</label>
                      <input type="text" name="card_no" id="card" class="form-control" placeholder="Enter Card Number">
                  </div>
               </div>
               <div class="col-md-6"></div>
               <div class="col-md-6">
                  <div class="form-group">
                   
                      <button type="submit" class="btn btn-primary btn-block" id="save-card-btn">
                          <i class="fa fa-save"></i>
                          Create Card
                      </button>
                  </div>
               </div>
              </div>
          </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

    </div>
</div>

{{-- Add Card Payment modal --}}

<div class="modal fade" id="payment-modal">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header bg-light">
      <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>
      <div class="modal-body">
        <div id="error-div"></div>
          <form >
            <input type="hidden" name="update_id" id="update_id">
              <div class="row mb-3">
                @php
                $cardMember= App\Models\CardMember::where('status','')->get();
                @endphp
                <div class="col-md-12">
                    <label for="" class="text-secondary">Member Card</label>
                    <select name="card_member" id="card_member"  class="form-control">
                        <option value="">--Select Member Card --</option>
                        @foreach ( $cardMember as $item)
                         <option value="{{ $item->id}}">{{ $item->card->card_no}} / {{ $item->user->id}} </option>
                         @endforeach
                    </select>
                </div>
               <div class="col-md-12">
                  <div class="form-group">
                      <label for="amount" class="text-secondary">Paid Amount</label>
                      <input type="text" name="card_amount" id="card_amount" class="form-control" placeholder="Enter Paid Amount">
                  </div>
               </div>
               <div class="col-md-6"></div>
               <div class="col-md-6">
                  <div class="form-group">
                   
                      <button type="submit" class="btn btn-primary btn-block" id="save-payment-btn">
                          <i class="fa fa-save"></i>
                          Save Card Payment
                      </button>
                  </div>
               </div>
              </div>
          </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

    </div>
</div>


  {{-- Assign Card  Modal --}}

  

  <div class="modal fade" id="member-modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="error-div"></div>
               <form>
               <input type="hidden" name="update_id" id="update_id">
    
               <div class="row mb-3">
                  @php
                  $members= App\Models\User::where('role','member')->get();
                  @endphp
                  <div class="col-md-12">
                      <label for="" class="text-secondary">All Members</label>
                      <select name="user_id" id="user_id"  class="form-control">
                          <option value="">--Select Member --</option>
                          @foreach ( $members as $item)
                           <option value="{{ $item->id}}">{{ $item->fname}} {{ $item->mname}} {{ $item->lname}}</option>
                           @endforeach
                      </select>
                  </div>
      
                  @php
                  
                  $purpose= App\Models\Card::where('status','')->get();
                  @endphp
                  <div class="col-md-12 mb-3">
                      <label for="" class="text-secondary">Available Cards</label>
                      <select name="card_no" id="card_no" class="form-control">
                          <option value="">--Select  Card --</option>
                          @foreach ( $purpose as $item)
                           <option value="{{ $item->id}}"> {{ $item->card_no}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-12">
  
                  <div class="row mt-2">
  
                      <div class="col-md-6 mb-3">
                          {{-- <label for="" class="text-secondary">Status</label>
                          <input type="checkbox" name="status" id=""> --}}
                      </div>
  
                      <div class="col-md-6 ">
                          <button class="btn btn-primary btn-block " id="save-member-btn" type="submit">
                          <i class="fa fa-save"></i>
                          Assign Card
                          </button>
                      </div>
                  </div>
                  </div>
                  </div>
              </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  






{{-- All card modal --}}
<div class="modal fade" id="cards">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
        <div class="row">
          <table id="modaltable" class="table table-bordered ">
              <thead>
                  <tr class="text-secondary">
                      <th>ID</th>
                      <th>Card Number</th>
                      <th>Card Status</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody id="cards-table-body">
         

              </tbody>
          </table>

      </div>
      </div>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
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
                      <th>Actions</th>
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
              let url = $('meta[name=app-url]').attr("content") + "/admin/card-member";
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                      $("#members-table-body").html("");
                      let members = response.members;
                      for (var i = 0; i < members.length; i++) 
                      {
                            let showBtn =  '<button ' +
                                ' class="btn btn-primary    " ' +
                                ' onclick="showCardMember(' + members[i].id + ')">Show' +
                            '</button> ';
                          let editBtn =  '<button ' +
                              ' class="btn btn-secondary" ' +
                              ' onclick="editCardMember(' + members[i].id + ')">Edit' +
                          '</button> ';
                          let deleteBtn =  '<button ' +
                              ' class="btn btn-danger" ' +
                              ' onclick="destroyCardMember(' + members[i].id + ')">Delete' +
                          '</button>';
                          let status= members[i].status == '0' ? 'Active':'InActive';
       
                          let projectRow = '<tr>' +
                              '<td>' + members[i].id +  '</td>' +
                              '<td>' + members[i].user.fname + '&nbsp;' + members[i].user.mname +  '&nbsp;' + members[i].user.lname +   '</td>' +
                              '<td>' + members[i].card.card_no + ' /'+ members[i].user.id + '</td>' +
                              '<td class="text-success">' + status +'</td>' +
                              '<td>'  + showBtn+ editBtn + deleteBtn + '</td>' +
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
              check if form submitted is for creating or updating
          */
          $("#save-member-btn").click(function(event ){
              event.preventDefault();
              if($("#update_id").val() == null || $("#update_id").val() == "")
              {
                  storeCardMember();
              } else {
                  updateCardMember();
              }
          })
       

   
       
          /*
              show modal for creating a record and 
              empty the values of form and remove existing alerts
          */
          function createCard()
          {
              $("#alert-div").html("");
              $("#error-div").html("");   
              $("#update_id").val("");
              $("#card").val("");
              $("#form-modal").modal('show'); 
          }


          /*
              submit the form and will be stored to the database
          */
          function storeCard()
          {   
              $("#save-card-btn").prop('disabled', true);
              let url = $('meta[name=app-url]').attr("content") + "/admin/cards";
              let data = {
                  card_no: $("#card").val(),
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
     

   function createPayment()
          {
              $("#alert-div").html("");
              $("#error-div").html("");   
              $("#update_id").val("");
              $("#card_member").val("");
              $("#card_amount").val("");
              $("#payment-modal").modal('show'); 
          }
       
     
        /*
              check if form submitted is for creating or updating
          */
          $("#save-payment-btn").click(function(event ){
              event.preventDefault();
              if($("#update_id").val() == null || $("#update_id").val() == "")
              {
                  storePayment();
              } else {
                  updatePayment();
              }
          })
       

     

  

         /*
              submit the form and will be stored to the database
          */
          function storePayment()
          {   
              $("#save-payment-btn").prop('disabled', true);
              let url = $('meta[name=app-url]').attr("content") + "/admin/card-payments";
              let data = {
                  card_member: $("#card_member").val(),
                  card_amount: $("#card_amount").val(),
              };
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: url,
                  type: "POST",
                  data: data,
                  success: function(response) {
                      $("#save-payment-btn").prop('disabled', false);
                      let successHtml = '<div class="alert alert-success" role="alert">Payment Was Recorded Successfully</div>';
                      $("#alert-div").html(successHtml);
                      $("#card_member").val("");
                      $("#card_amount").val("");
  //                     showAllCards();
                      $("#payment-modal").modal('hide');
                  },
                  error: function(response) {
                      $("#save-payment-btn").prop('disabled', false);
       
                      /*
          show validation error
                      */
                      if (typeof response.responseJSON.errors !== 'undefined') 
                      {
          let errors = response.responseJSON.errors;
          let amountValidation = "";
          if (typeof errors.card_amount !== 'undefined') 
                          {
                              amountValidation = '<li>' + errors.card_amount[0] + '</li>';
                          }
          let cardValidation = "";
          if (typeof errors.card_member !== 'undefined') 
                          {
                              cardValidation = '<li>' + errors.card_member[0] + '</li>';
                          }
          let errorHtml = '<div class="alert alert-danger" role="alert">' +
              '<b>Validation Error!</b>' +
              '<ul>' + amountValidation  + cardValidation  +'</ul>' +
          '</div>';
          $("#error-div").html(errorHtml);        
      }
                  }
              });
          }
       
          /*
              edit record function
              it will get the existing value and show the purpose form
          */
          function editCard(id)
          {
              let url = $('meta[name=app-url]').attr("content") + "/admin/cards/" + id ;
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                      let card = response.card;
                      $("#alert-div").html("");
                      $("#error-div").html("");   
                      $("#update_id").val(card.id);
                      $("#card").val(card.card_no);
                      $("#form-modal").modal('show'); 
                      $("#cards").modal('hide'); 
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }
       
          /*
              sumbit the form and will update a record
          */
          function updateCard()
          {
              $("#save-card-btn").prop('disabled', true);
              let url = $('meta[name=app-url]').attr("content") + "/admin/cards/" + $("#update_id").val();
              let data = {
                  card_no: $("#card").val(),
              };
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: url,
                  type: "PUT",
                  data: data,
                  success: function(response) {
                      $("#save-card-btn").prop('disabled', false);
                      let successHtml = '<div class="alert alert-success" role="alert">Card Was Updated Successfully !</div>';
                      $("#alert-div").html(successHtml);
                      $("#card").val("");  
  //                     showAllCards();
                      $("#form-modal").modal('hide');
                  },
                  error: function(response) {
                      /*
          show validation error
                      */
                      $("#save-card-btn").prop('disabled', false);
                      if (typeof response.responseJSON.errors !== 'undefined') 
                      {
                          console.log(response)
          let errors = response.responseJSON.errors;
          let descriptionValidation = "";
          if (typeof errors.description !== 'undefined') 
                          {
                              descriptionValidation = '<li>' + errors.description[0] + '</li>';
                          }
          let nameValidation = "";
          if (typeof errors.name !== 'undefined') 
                          {
                              nameValidation = '<li>' + errors.name[0] + '</li>';
                          }
          let deadlineValidation = "";
          if (typeof errors.deadline !== 'undefined') 
                          {
                              deadlineValidation = '<li>' + errors.deadline[0] + '</li>';
                          }
            
          let amountValidation = "";
          if (typeof errors.amount !== 'undefined') 
                          {
                              amountValidation = '<li>' + errors.amount[0] + '</li>';
                          }
           
          let errorHtml = '<div class="alert alert-danger" role="alert">' +
              '<b>Validation Error!</b>' +
              '<ul>' + nameValidation + descriptionValidation + deadlineValidation + amountValidation +'</ul>' +
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
              let url = $('meta[name=app-url]').attr("content") + "/admin/card-payments/" + id +"";
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
                         
                          let editBtn =  '<button ' +
                              ' class="btn btn-secondary" ' +
                              ' onclick="editPayment(' + payment[i].id + ')">Edit' +
                          '</button> ';
                          let deleteBtn =  '<button ' +
                              ' class="btn btn-danger" ' +
                              ' onclick="destroyCardPayment(' + payment[i].id + ')">Delete' +
                          '</button>';
       
                          let projectRow = '<tr>' +
                              '<td>' + payment[i].id + '</td>' +
                              '<td>' + payment[i].created_at+ '</td>' +
                              '<td>' + payment[i].amount + '</td>' +
                              '<td>'  + editBtn + deleteBtn + '</td>' +
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

          /*
              delete record function
          */
          function destroyCard(id)
          {
              let url = $('meta[name=app-url]').attr("content") + "/admin/cards/" + id;
              let data = {
                  name: $("#card_no").val(),
              };
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: url,
                  type: "DELETE",
                  data: data,
                  success: function(response) {
                      let successHtml = '<div class="alert alert-danger" role="alert">Card Was Deleted Successfully </div>';
                      $("#alert-div").html(successHtml);
                      showAllCards();
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }
       
          /*
              delete record function
          */
          function destroyCardMember(id)
          {
              let url = $('meta[name=app-url]').attr("content") + "/admin/card-member/" + id;
              let data = {
                  card_no: $("#card_no").val(),
                  user_id: $("#user_id").val(),
              };
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: url,
                  type: "DELETE",
                  data: data,
                  success: function(response) {
                      let successHtml = '<div class="alert alert-danger" role="alert">Assigned Card Was Deleted Successfully </div>';
                      $("#alert-div").html(successHtml);
                      showAllCardMembers();
                      showAllCards();
                   
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }

   /*
              delete record function
          */
          function destroyCardPayment(id)
          {
              let url = $('meta[name=app-url]').attr("content") + "/admin/payments/" + id;
              let data = {
                  card_member: $("#card_member").val(),
                  card_amount: $("#card_amount").val(),
              };
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: url,
                  type: "DELETE",
                  data: data,
                  success: function(response) {
                      let successHtml = '<div class="alert alert-danger" role="alert">Card Payment Was Deleted Successfully </div>';
                      $("#alert-div").html(successHtml);
                      showAllCardMembers();
                      $("#view-modal").modal('hide'); 
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }
       
      </script>
@endsection