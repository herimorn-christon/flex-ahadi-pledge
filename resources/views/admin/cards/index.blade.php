@extends('layouts.master')

@section('title','Manage Cards')


@section('content')


<div class="row mb-1">
    <div class="col-sm-6" id="alert-div">
      @if (session('status'))
      <div class="alert disabled" style="background-color: rgb(198, 253, 216)" role="alert">
          {{ session('status') }}
      </div>
      @endif
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="">    
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="showAllCards()">
            <i class="fa fa-envelope"></i>
             Available Cards
        </button>
        <button type="button" class="btn btn-primary btn-sm"  onclick="createMember()">
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



    </div>
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
                        <input type="text" name="card_no" id="card_no" class="form-control" placeholder="Enter Card Number">
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



  {{-- Assign Card  Modal --}}

  

<div class="modal fade" id="types-modal">
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
                        <button class="btn btn-primary btn-block " id="assign-card-btn" type="submit">
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
          $("#assign-card-btn").click(function(event ){
              event.preventDefault();
              if($("#update_id").val() == null || $("#update_id").val() == "")
              {
                  storeMember();
              } else {
                  updateMember();
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
              $("#card_no").val("");
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
                  card_no: $("#card_no").val(),
              };
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: url,
                  type: "POST",
                  data: data,
                  success: function(response) {
                      $("#save-ledge-btn").prop('disabled', false);
                      let successHtml = '<div class="alert alert-success" role="alert">Card Was Created Successfully</div>';
                      $("#alert-div").html(successHtml);
                      $("#card_no").val("");
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
              show modal for creating a record and 
              empty the values of form and remove existing alerts
          */
          function createMember()
          {
              $("#alert-div").html("");
              $("#error-div").html("");   
              $("#update_id").val("");
              $("#card_no").val("");
              $("#user_id").val("");
              $("#types-modal").modal('show'); 
          }
       
          /*
              submit the form and will be stored to the database
          */
          function storeMember()
          {   
      $("#assign-card-btn").prop('disabled', true);
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
                    $("#save-ledge-btn").prop('disabled', false);
                    let successHtml = '<div class="alert alert-success" role="alert">Card Was Assigned Successfully</div>';
                    $("#alert-div").html(successHtml);
                    $("#card_no").val("");
                     $("#user_id").val("");
                    showAllCardMembers();
                    $("#types-modal").modal('hide');
                },
                error: function(response) {
                    $("#assign-card-btn").prop('disabled', false);
     
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
                      $("#card_no").val(card.card_no);
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
                  card_no: $("#card_no").val(),
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
                      $("#card_no").val("");  
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
  //                     showAllCards();
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
                  },
                  error: function(response) {
                      console.log(response.responseJSON)
                  }
              });
          }
       
      </script>
@endsection