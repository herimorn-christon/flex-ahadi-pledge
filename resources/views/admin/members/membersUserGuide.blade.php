@extends('layouts.member')

@section('title','userGuide')


@section('content')


<div class="card  p-1 border-left-flex">
  <div class="row mb-1 mx-1">

  {{-- start of statistics --}}
<div class="">
  <div class="row starts-border  mt-2" >
    <div class="col-md-6"> <h6 class="text-secondary">the members user guide </h6></div>
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
        <a href="{{ route('downloadLogic') }}" class="btn btn-sm bg-cyan mb-1">
          <i class="fa fa-file-pdf"></i>
          download userGuide
        </a> </li>
       
      </ul>
      
    </div><!-- /.col -->
  </div>
</div>



 


  {{-- start of single card modal --}}


@endsection