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
      
    </div><!-- /.col -->
    <div class="col-sm-7">
      <ul class="float-sm-right" type="none">
        <li class="">  
              
          <button  type="submit"  class="btn bg-flex text-light  btn-sm mb-1"  class="btn btn-success "data-bs-toggle="modal" 
          data-bs-target="#myModal">
            <i class="bi bi-plus-circle-fill"></i>
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
                       <button type="submit"><i class="fa fa-recycle" class="text-danger" aria-hidden="true"></i></button>
                      </form>
                     <button> <a href={{ route('member_dependant.edit',$dependant->id) }}>
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
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
<form action="{{route('member_dependant.weka')}}" method="POST">
  @csrf

 <div class="modal" id="myModal">
        <div class="modal-dialog" >
            <div class="modal-content" style="width:40rem">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">please enter your dependant</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                  <div class="card">
                    <div class="card-body">
                      
                        <div class="form-group">
                          <label for="title" class='form-label'>dependant Name</label>
                          <input type="text" class="form-control" placeholder="inter dependant Name"
                          name="fullName"/>
                        </div>
                        <div class="form-group">
                          <label for="description" class='form-label'>birthdate</label>
                          <input type="date" class="form-control" placeholder="inter the title"
                          name="birth_date"/>
                        </div>
                        <div class="form-group">
                          <label for="description" class='form-label'>relationship</label>
                          <input type="text" class="form-control" placeholder="inter the rletionship"
                          name="relationship"/>
                        </div>
                        <div class="form-group">
                        
                          <input type="hidden" class="form-control" value="{{$user}}"
                          name="users_id"/>
                        </div>
                     
                    </div>
                  </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">save date</button>
                </div>
            </div>
        </div>
    </div>
  </form>




<!--closing the model -->
<script>
  //make an ajax call ro send the data to the database
    

</script>



@endsection