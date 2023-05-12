@extends('layouts.member')

@section('title','My dependants')


@section('content')


<div class="main-content mt-5">
  @if ($errors->any())
  @foreach ($errors->all() as $error  )
  <div class="alert alert-danger">
    {{ $error }}
  </div>
    
  @endforeach
    
  @endif


<div class="card  p-1 border-left-flex">
  <div class="row mb-1 mx-1">

  {{-- start of statistics --}}
<div class="">
  @php
$user=Auth::User()->id;
$i=1;
$dependants=App\Models\User::find($user)->dependant;
@endphp
  <div class="row starts-border  mt-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total number of dependants {{ $dependants->count()}} </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="card-payments"></h6></div>
  </div>


</div>
{{-- end of statistics --}}
    <div class="col-sm-5" id="alert-div">
      @if (session('status'))
      <div class="alert alert-success"  role="alert">
          {{ session('status') }}
      </div>
      @endif
      @if (session()->has('msg'))
      <div class="alert alert-success">
              {{ session()->get('msg') }}
      </div>
  @endif
  @if (session()->has('msg1'))
  <div class="alert alert-success">
          {{ session()->get('msg1') }}
  </div>
@endif
  
    </div><!-- /.col -->
    <div class="col-sm-7">
      <ul class="float-sm-right" type="none">
        <li class="">  
              
          <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa fa-user-plus"></i>
             create dependants
        </button>  
        <a href="{{ route('trash')}}" class="btn btn-sm bg-cyan mb-1">
          <i class="fa fa-recycle" class="text-danger" aria-hidden="true"></i>
          go to trash
        </a>
     
    </li>
       
      </ul>
      
    </div><!-- /.col -->
  </div>
</div>

<div class="card mt-1">
    <div class="mt-2">

        <div class="responsive mx-1 mt-2">
            <table id="example1" class="table table-bordered cell-border">
                <thead>
                    <tr class="text-secondary">
                        <th>SN</th>
                        <th>username</th>
                        <th>birthdate</th>
                        <th>relationship</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody id="members-table-body"> 
                  @foreach ($dependants as $dependant )
                  <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $dependant->fullName }}</td>
                    <td>{{ $dependant->birth_date }}</td>
                    <td>{{ $dependant->relationship }}</td>
                    <td>
                      <div style="display:flex;">
                      <form action="{{ route('member_dependant.destroy',$dependant->id) }}" method="POST">
                       @csrf
                       <button type="submit" style="background:blue"><i class="fa fa-recycle" style="color:white" aria-hidden="true" ></i></button>
                      </form>
                     <button style="background:grey"> <a href={{ route('member_dependant.edit',$dependant->id) }}>
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"  class="bi bi-pencil-square text-danger" viewBox="0 0 16 16" style="color:white">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                      </svg>
                    </a>
                  </button>
                     </td>
                    </div>
                  </tr>
                  @endforeach
  
                </tbody>
            </table>
  
        </div>


<!--now lets open the model-->
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
            <input type="hidden" class="form-control" value="{{$user}}"
              name="users_dependant"/>
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
          <button type="button" class="btn btn-primary" id="save">Save dependant</button>
        </div>
      </div>
    </div>
  </div>
  </form>




<!--closing the model -->
<script>
//fetching fata with the ajax call without the page reloding




  $("#save").click(function(){
   // console.log("button-clicked");
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
                           location.reload() 
                        //$("#exampleModal").modal("hide");
                      swal("welldon!",response.success, "success", {
                          button: "ok",
                           });
                      },
                      error:function(error){
                          console.log(error);
                        
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

          //sending th

</script>



@endsection