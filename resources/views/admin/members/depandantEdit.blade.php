@extends('layouts.member')

@section('title','My dashboad')
@php
$user=Auth::User()->id;


@endphp




@section('content')
<br>
<br>
@if ($errors->any())
@foreach ($errors->all() as $error  )
<div class="alert alert-danger">
  {{ $error }}
</div>
@endforeach
@endif
<div class="card">
    <div class="card-body">
      
<form action="{{ route("member_dependant_update",$dependant->id) }}" method="POST">
    @csrf
    @method('PUT')
  
            <div class="form-group">
              <label for="title" class='form-label'>dependant Name</label>
              <input type="text" class="form-control" placeholder="inter dependant Name"
              name="fullName" value="{{$dependant->fullName}}" />
            </div>
            <div class="form-group">
              <label for="description" class='form-label'>birthdate</label>
              <input type="date" class="form-control" placeholder="inter the title"
              name="birth_date" value="{{$dependant->birth_date}}"/>
            </div>
            <div class="form-group">
              <label for="description" class='form-label'>relationship</label>
              <input type="text" class="form-control" placeholder="inter the rletionship"
              name="relationship" value="{{ $dependant->relationship }}" />
            </div>
            <div class="form-group">
            
              <input type="hidden" class="form-control" value="{{$user}}"
              name="users_id"/>
            </div>
            <div class="form-group">
            
                <button type="submit" class="btn btn-secondary">update</button>
               
              </div>

         
      

</form>
</div>
</div>
@endsection