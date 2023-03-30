@extends('layouts.member')

@section('title','My dependants')


@section('content')

@php
$user=Auth::User()->id;
$i=1;
//$dependants=App\Models\User::find($user)->dependant;
@endphp
<div class="card  p-1 border-left-flex">
  <div class="row mb-1 mx-1">
    @if (session()->has('msg2'))
  <div class="alert alert-success">
          {{ session()->get('msg2') }}
  </div>
@endif
  {{-- start of statistics --}}
<div class="">
  <div class="row starts-border  mt-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Card Payments Made in {{ date('Y')}} </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="card-payments"></h6></div>
  </div>
  <div class="row starts-border mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Current Card Member </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="current-card"></h6></div>
  </div>
  

</div>
{{-- end of statistics --}}
    <div class="col-sm-5" id="alert-div">
      @if (session('status'))
      <div class="alert alert-success"  role="alert">
          {{ session('status') }}
      </div>
      @endif
      
    </div>
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
                        <form action="{{ route('member.force-delete',$dependant->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button style="background:blue"> 
                              <i class="fa fa-trash" aria-hidden="true" style="color:black" ></i>
                            </button>
                           </form>
                        
                        
                       <button style="background:grey">
                          <a class="" href={{ route('member.restore',$dependant->id) }} >
                            <i class='fas fa-trash-restore-alt' style='color:red'>r
                            </i>
                            </a>
                       </button>
                        
                    </div>
                 
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



@endsection