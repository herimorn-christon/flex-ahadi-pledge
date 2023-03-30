@extends('layouts.member')

@section('title','My dashboad')
@php
$user=Auth::User()->id;


@endphp
 
@section('content')
@if ($errors->any())
@foreach ($errors->all() as $error  )
<div class="alert alert-danger">
  {{ $error }}
</div>
@endforeach
@endif
@if (Session::has('message'))

   <div class="alert alert-info">{{ Session::get('message') }}</div>

@endif
<form action="{{ route('spiritual.update',$user) }}" method="POST">
    @method('PUT')
    @csrf
  <div class="card" style="width:50%;margin:auto">
    <div class="card-body">
        <h1>fill the spiritual service form </h1>
        <div class="card">
            <label for=""> have you get baptism?</label>
            <select name="baptism" id="" class="form-control">
                <option value="0">No</option>
                <option value="1">Yes</option>
              </select>
        </div>

  <!--second raadio !-->
  <div class="card">
    <label for=""> have you get confirmation?</label>
    <select name="confirmation" id="" class="form-control">
        <option value="0">No</option>
        <option value="1">Yes</option>
      </select>
</div>

  <!--end of second radio-->
  <!--the date for the confirmation -->
  <div class="card">
    please inter buptism date if your baptised
    <input type="date" class="form-control" name="kipaimara_date">
  </div>
  <div class="card">
    please inter confirmation date 
    <input type="date" class="form-control" name="baptization_date">
  </div>
  <!--end tof the confimation-->

    <!--second raadio !-->
    <div class="card">
        <label for=""> have you get table of christ?</label>
    <div class="form-check">
       <select name="table_christ" id="" class="form-control">
         <option value="0">No</option>
         <option value="1">Yes</option>
       </select>
      </div>
    </div>
    
      <!--end of second radio-->

      <div class="card">
        <label for=""> are you voluntier in fellowship mass?</label>
        <select name="volontier" id="" class="form-control">
            <option value="0">No</option>
            <option value="1">Yes</option>
          </select>
    </div>
    <input type="hidden" value={{ $user}} name="users_id">
    <button type="submit" class="btn btn-danger">save</button>
    

</div>
</div>
@endsection