@extends('layouts.member')

@section('title','My Cards')


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
   
       
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>

<div class="card mt-1">
 
    <div class="mt-2">

        <div class="responsive p-1">
            <table id="example1" class="table">
                <thead>
                    <tr class="text-secondary">
                        <th>ID</th>
                        <th>Notification Name</th>
                        <th>Received At</th>
                        <th>Actions</th>
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
        <b class="text-secondary"><i class="fa fa-bell text-danger"></i> <span id="name-info" class="text-secondary"></span>  </b> 
        <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
        <div class="row">
          
            <span id="message-info" class="text-dark"></span>
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
              let url = $('meta[name=app-url]').attr("content") + "/member/announcements";
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                      $("#members-table-body").html("");
                      let members = response.members;
                      for (var i = 0; i < members.length; i++) 
                      {
                          let showBtn =  '<button ' +
                                ' class="btn bg-flex text-light  btn-sm " ' +
                                ' onclick="showCardMember(' + members[i].id + ')"><i class="fa fa-eye"></i>' +
                            '</button> ';
                            let deleteBtn =  '<button ' +
                              ' class="btn btn-danger btn-sm" ' +
                              ' onclick="destroyCardMember(' + members[i].id + ')"><i class="fa fa-trash"></i>' +
                          '</button>';

                          let status= members[i].status == '0' ? 'Active':'InActive';
       
                          let projectRow = '<tr>' +
                              '<td>' + members[i].id +  '</td>' +
                              '<td class="">' + members[i].title +'</td>' +
                              '<td>' + members[i].created_at +  '</td>' +
                              '<td>'  +showBtn+   '</td>' +
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
              get and display the record info on modal
          */
          function showCardMember(id)
          {
              $("#fname-info").html("");
              $("#mname-info").html("");
              let url = $('meta[name=app-url]').attr("content") + "/member/announcements/" + id +"";
              $.ajax({
                  url: url,
                  type: "GET",
                  success: function(response) {
                         let notification = response.member;
                       $("#name-info").html(notification.title );
                       $("#date-info").html(notification.created_at );
                       $("#message-info").html(notification.body );
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
          function destroyCardMember(id)
          {
              let url = $('meta[name=app-url]').attr("content") + "/member/notifications/" + id;
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
       
      </script>
@endsection