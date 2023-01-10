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
      <ol class="float-sm-right" type="none">
        <li class="">    
        <button type="button" class="btn bg-flex text-light btn-sm" data-toggle="modal" onclick="createPayment()">
            <i class="fa fa-dollar-sign"></i>
             Add Card Payment
        </button>
        <button type="button" class="btn bg-flex text-light btn-sm" data-toggle="modal" onclick="showAllCards()">
            <i class="fa fa-envelope"></i>
             Available Cards
        </button>
        <button type="button" class="btn bg-flex text-light btn-sm"  onclick="createCardMember()">
            <i class="fa fa-list"></i>
             Assign Card
        </button>
        <button type="button" class="btn bg-flex text-light btn-sm" data-toggle="modal" onclick="createCard()">
        <i class="fa fa-plus"></i>
            Create Card
        </button>
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>

<div class="card mt-1">

    <div class="">

        <div class="p-1 mt-2">
            <table id="example1"  class="table table-bordered cell-border">
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
                   
                      <button type="submit" class="btn bg-navy btn-block" id="save-card-btn">
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
                   
                      <button type="submit" class="btn bg-navy btn-block" id="save-payment-btn">
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






  <script type="text/javascript">
  
        
       
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
              delete record function
          */
          function destroyCardPayment(id)
          {
              let url = $('meta[name=app-url]').attr("content") + "/admin/card-payments/" + id;
              let data = {
                  card_member: $("#card_member").val(),
                  amount: $("#card_amount").val(),
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