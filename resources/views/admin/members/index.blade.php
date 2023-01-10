{{-- This is the main Admin manage members page --}}
@extends('layouts.master')

@section('title','AhadiPledge Members')


@section('content')


<div class="card p-2 border-left-flex">
<div class="row mb-1">
 
{{-- start of statistics --}}
<div class="">
  <div class="row starts-border" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Registered Members </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder"> 212</h6></div>
  </div>
  <div class="row starts-border" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Active Members </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder"> 212</h6></div>
  </div>
  <div class="row starts-border" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Inactive Members </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder"> 212</h6></div>
  </div>

     <hr class="bg-light font-weight-borfer">
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
      {{-- end of register member button --}}

       {{-- start of generate report button --}}
      <a href="" class="btn bg-flex text-light btn-sm">
        <i class="fa fa-download text-light"></i>
        Generate Report
      </a>
        {{-- start of generate report button --}}

      {{-- start of register member modal --}}
      @include('admin.members.register-member-modal')
      {{-- end of register member modal --}}
  
      {{-- start of ajax register new mwmber method --}}
      @include('admin.members.ajax-register-member')
      {{-- end of ajax register new mwmber method --}}
      
      {{-- start of ajax register new mwmber method --}}
      @include('admin.members.ajax-update-member')
      {{-- end of ajax register new mwmber method --}}
</li>
   
</ul>
  
</div><!-- /.col -->
</div>

</div>


{{-- start of all members card --}}
<div class="card mt-1">
    <div class="">
        <div class="p-1">
            <table id="example1"  class="table  responsive table-bordered " width=""  >
                <thead>
                     <tr class="text-secondary ">
                            <th>SN</th>
                            <th>Member ID</th>
                            <th>Member Name</th>
                            <th>Community </th>
                            <th>Gender</th>
                            <th>Actions</th>
                        </tr>
                </thead>
                <tbody id="members-table-body">
                 
                </tbody>
            </table>

        </div>

        {{-- start of ajax fetch all members method --}}
        @include('admin.members.ajax-fetch-all-members')
        {{-- end of ajax fetch all members method --}}


    </div>
</div>
  
        {{-- start of single member modal --}}
        @include('admin.members.single-member-modal')
        {{-- end of single member modal --}}

        {{-- start of ajax fetch all members method --}}
        @include('admin.members.ajax-fetch-member-details')
        {{-- end of ajax fetch all members method --}}

        {{-- start of ajax delete members method --}}
        @include('admin.members.ajax-delete-member')
        {{-- end of ajax delete members method --}}

    

@endsection