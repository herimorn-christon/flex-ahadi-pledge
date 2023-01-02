<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laravel Project Manager</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ url('/') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</head>
<body>
  
    <div class="container">
        <h2 class="text-center mt-5 mb-3">Laravel Project Manager</h2>
        <div class="card">
            <div class="card-header bg-light">
                <button class="btn btn-primary btn-sm" onclick="createCard()"> 
                    Create New Card

                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <div class="card-body">
                <div id="alert-div">
                 
                </div>
                <table class="table table-bordered">
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
  
    <!-- modal for creating and editing function -->
    <div class="modal" tabindex="-1"  id="form-modal">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Project Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
        </div>
    </div>
 
  
    <!-- view record modal -->
    <div class="modal" tabindex="-1" id="view-modal">
        <div class="modal-dialog" >
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Project Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    <b class="text-secondary">Purpose Title:</b>   <span id="title-info" class="text-dark"></span>
                    <hr>
                    <b class="text-secondary">Start Date:</b>   <span id="start-info" class="text-dark"></span>
                    <hr>
                    <b class="text-secondary">End Date:</b>   <span id="end-info" class="text-dark"></span>
                    <hr>
                    <b class="text-secondary">Description:</b>   <span id="description-info" class="text-dark"></span>
                </p>
                
              
            </div>
            </div>
        </div>
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
       
  
//         showAllCards();
     
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
                    $("#projects-table-body").html("");
                    let cards = response.cards;
                    for (var i = 0; i < cards.length; i++) 
                    {
                        let showBtn =  '<button ' +
                            ' class="btn btn-primary    " ' +
                            ' onclick="showCard(' + cards[i].id + ')">Show' +
                        '</button> ';
                        let editBtn =  '<button ' +
                            ' class="btn btn-secondary" ' +
                            ' onclick="editCard(' + cards[i].id + ')">Edit' +
                        '</button> ';
                        let deleteBtn =  '<button ' +
                            ' class="btn btn-danger" ' +
                            ' onclick="destroyCard(' + cards[i].id + ')">Delete' +
                        '</button>';
     
                        let projectRow = '<tr>' +
                            '<td>' + cards[i].id + '</td>' +
                            '<td>' + cards[i].card_no + ' /'+ '</td>' +
                            '<td>' + cards[i].status +'</td>' +
                            '<td>' + showBtn + editBtn + deleteBtn + '</td>' +
                        '</tr>';
                        $("#projects-table-body").append(projectRow);
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
            show modal for creating a record and 
            empty the values of form and remove existing alerts
        */
        function createCard()
        {
            $("#alert-div").html("");
            $("#error-div").html("");   
            $("#update_id").val("");
            $("#card_no").val("");
            $("#user_id").val("");
            $("#form-modal").modal('show'); 
        }
     
        /*
            submit the form and will be stored to the database
        */
        function storeCard()
        {   
            $("#save-card-btn").prop('disabled', true);
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
                    let successHtml = '<div class="alert alert-success" role="alert">Card Was Created Successfully</div>';
                    $("#alert-div").html(successHtml);
                    $("#card_no").val("");
                     $("#user_id").val("");
                    showAllCardMembers();
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
                    showAllCards();
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
        function showCard(id)
        {
            $("#name-info").html("");
            $("#description-info").html("");
            let url = $('meta[name=app-url]').attr("content") + "/admin/pledges/" + id +"";
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    let purpose = response.purpose;
                    $("#title-info").html(purpose.name);
                    $("#start-info").html(purpose.deadline);
                    $("#end-info").html(purpose.amount);
                    $("#description-info").html(purpose.description);
                    $("#view-modal").modal('show'); 
     
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
     
    </script>
</body>
</html>