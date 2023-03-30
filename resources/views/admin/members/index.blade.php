{{-- This is the main Admin manage members page --}}
@extends('layouts.master')

@section('title','AhadiPledge Members')


@section('content')

<div class="card p-2 border-left-flex">
<div class="row mb-1"> 
  @php
       $users=App\Models\User::get();
  @endphp


 
{{-- start of statistics --}}
<div class="">
  <div class="row starts-border" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Registered Members </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="members"> </h6></div>
  </div>
  <div class="row starts-border" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Active Members </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="active"> </h6></div>
  </div>
  
  <div class="row starts-border mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Inactive Members </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="inactive"> </h6></div>
  </div>
  
  <div class="row starts-border" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Female Members </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="female"> </h6></div>
  </div>

  <div class="row starts-border mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Male Members </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="male"> </h6></div>
  </div>


</div>
{{-- end of statistics --}}

<div class="col-sm-6" id="alert-div">

</div><!-- /.col -->
<div class="col-sm-6 col-12">
  <ul class="float-sm-right" type="none">
    <li class="">  

      {{-- start of register member button --}}
    <button type="button" class="btn bg-flex text-light btn-sm" data-toggle="tooltip" data-placement="bottom" title="Click here to Register a New Member" onclick="createMember()">
        <i class="fa fa-user-plus"></i>
         Register New Member
    </button>  
     <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa fa-user-plus"></i>
         Add dependants
    </button>  
   
      {{-- end of register member button --}}

       {{-- start of generate report button --}}
      <a href="" class="btn bg-cyan  btn-sm" type="button"  data-bs-toggle="modal" data-bs-target="#registeredModal" data-toggle="tooltip" data-placement="top" title="Click here to Generate Member reports">
        <i class="fa fa-download text-light" ></i>
        Generate Report
      </a>
        {{-- start of generate report button --}}

      {{-- start of register member modal --}}
      @include('admin.members.register-member-modal')
      {{-- end of register member modal --}}
      @include('admin.members.spiritual-member-modal')
  
      {{-- start of ajax register new mwmber method --}}
      @include('admin.members.ajax-register-member')
      {{-- end of ajax register new mwmber method --}}

      
      {{-- start of ajax register new mwmber method --}}
      @include('admin.members.ajax-update-member')
      @include('admin.members.ajax-update-Spiritualmember')
      {{-- end of ajax register new mwmber method --}}
      {{-- start of the model of dependants --}}
      <!-- Button trigger modal -->


<!-- Modal -->
<form  id="form1">
<div class="modal fade" id="exampleModal"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">add dependant</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group mb-1" style="height:4rem">
          <label for="">parent name</label>

          <div class="form-group">
              <select id="select_2" name="users_dependant" class="form-control"> 
                @foreach ($users as $user )
                    <option value={{ $user->id }}>{{$user->fname }}-{{$user->lname}}</option>
                @endforeach
                {{--   
            <input type="hidden" class="form-control" value="{{$user}}"
            name="users_dependant"/>
            --}} 
              </select>

          </div>
        
      <span id="parent" class="text-danger error_messages"></span>
        </div>
        <div class="form-group mb-3">
          <label for="">dependant name</label>
          <input type="text" name="dependant_name" class="form-control">
          <span id="dependants" class="text-danger error_messages"></span>
        </div>
        <div class="form-group mb-3">
          <label for="">relationship</label>
          <input type="text" name="relationship" class="form-control">
          <span id="relationship" class="text-danger error_messages"></span>
        </div>
        <div class="form-group mb-3">
          <label for="">birthdate</label>
          <input type="date" name="birth_date" class="form-control">
          <span id="birthdate" class="text-danger error_messages"></span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saving">Save dependant</button>
      </div>
    </div>
  </div>
</div>
</form>

      {{-- ends of the model of dependants --}}


      {{-- start of generate member report modal --}}
      @include('admin.announcements.member-report-modal')
      {{-- end of generate member report modal --}}
</li>
   
</ul>
  
</div><!-- /.col -->
</div>

</div>


{{-- start of all members card --}}
<div class="card mt-1">
    <div class="">
        <div class="p-1">
         
            {{-- <livewire:user-table/> --}}
            <table id="example1" class="table table-bordered " >
                <thead>
                     <tr class="text-secondary ">
                            <th>SN</th>
                            <th>Member ID</th>
                            <th>Member Name</th>
                            <th>Community </th>
                            <th>Birthdate</th>
                            <th>Gender</th>
                            <th>Actions</th>
                        </tr>
                </thead>
                <tbody id="members-table-body">
                 
                </tbody>
            </table>

        {{-- start of ajax fetch all members method --}}
        @include('admin.members.ajax-fetch-all-members')
        {{-- end of ajax fetch all members method --}}
  
        {{-- start of single member modal --}}
        @include('admin.members.single-member-modal')
        {{-- end of single member modal --}}

        {{-- start of ajax fetch all members method --}}
        @include('admin.members.ajax-fetch-member-details')
        {{-- end of ajax fetch all members method --}}

        {{-- start of ajax delete members method --}}
        @include('admin.members.ajax-delete-member')
        {{-- end of ajax delete members method --}}
        <script>
          //implimenting the select2 logic
          $('#select_2').select2({
            width: '100%',
            height:'20%',
            placeholder:'select the parents',
           dropdownParent: $("#exampleModal")
             })
        </script>
        <script>
          //ajax call to send the data to the database
          $("#saving").click(function(){
             var forms=$('#form1')[0];
              var formData=new FormData(forms); 
              $('.error_messages').html('');
             // console.log(formData);
            //console.log(formData);
            $.ajaxSetup({
                headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                    });


                    $.ajax({
                      url:"{{ route('adminAddDependant.store')}}",
                      method:'POST',
                      processData:false,
                       contentType:false,
                      data:formData,
                      success: function (response) {
                        $("#exampleModal").modal("hide");
                        $("#exampleModal").modal("hide");
                      swal("welldon!",response.success, "success", {
                          button: "ok",
                           });
                      },
                      error:function(error){
                        //console.log(error);
                        
                          $('#parent').html(error.responseJSON.errors.users_dependant);
                          $('#dependants').html(error.responseJSON.errors.dependant_name);
                          $('#relationship').html(error.responseJSON.errors.relationship);
                          $('#birthdate').html(error.responseJSON.errors.birth_date);
                          
                        //console.log(error.responseJSON.errors.users_dependant);
                        //console.log(error.responseJSON.errors.dependant_name);
                        //console.log(error.responseJSON.errors.relationship);
                        // console.log(error.responseJSON.errors.birth_date);
                         
                    }
                    });

          })

          //sending the data through ajax call
        
          </script>
    </div>
</div>


    

@endsection