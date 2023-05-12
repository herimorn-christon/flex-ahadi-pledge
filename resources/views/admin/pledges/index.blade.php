@extends('layouts.master')

@section('title','Admin | Manage Pledges')


@section('content')


<div class="card  p-2 border-left-flex">
<div class="row mb-1">
    {{-- start of statistics --}}
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><img src="{{asset('icons/swear.png')}}"/></span>
  
          <div class="info-box-content">
            <span class="info-box-text">Total Pledges Made  (Ahadi)</span>
            <span class="info-box-number" id="total">
          
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1">
            <img src="{{asset('icons/salary.png')}}"/>
          </span>
  
          <div class="info-box-content">
            <span class="info-box-text">Total Money Pledges (Ahadi)</span>
            <span class="info-box-number"  id="total_amount" > </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
  
      <!-- fix for small devices only -->
     
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1">
            <img src="{{asset('icons/oath.png')}}"/>
          </span>
  
          <div class="info-box-content">
            <span class="info-box-text">Total Object Pledges (Ahadi)</span>
            <span class="info-box-number"  id="object"> </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1">
            <img src="{{asset('icons/check.png')}}"/>
          </span>
  
          <div class="info-box-content">
            <span class="info-box-text">Total Fulfilled Pledges</span>
            <span class="info-box-number"id="fullfilled"> </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1">
            <img src="{{asset('icons/cancel.png')}}"/>
          </span>
  
          <div class="info-box-content">
            <span class="info-box-text">Total Unfulfilled Pledges</span>
            <span class="info-box-number"  id="unfullfilled"> </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1">
              <img src="{{asset('icons/best.png')}}"/>
            </span>
    
            <div class="info-box-content">
              <span class="info-box-text">Best Pledge Maker</span>
              <span class="info-box-number"  id="best"> </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
  
      <!-- /.col -->
    </div>







{{-- <div class="">

  <div class="row starts-border mt-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Pledges Made  (Ahadi) </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="total"></h6></div>
  </div>

  <div class="row starts-border" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Money Pledges (Ahadi) </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="total_amount"></h6></div>
  </div>

  <div class="row starts-border mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Object Pledges (Ahadi)</h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="object"></h6></div>
  </div>
  <div class="row starts-border mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Fulfilled Pledges</h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="fullfilled"> </h6></div>
  </div>

  <div class="row starts-border mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Unfulfilled Pledges </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="unfullfilled"></h6></div>
  </div>

  <div class="row starts-border mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Best Pledge Maker</h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="best"></h6></div>
  </div>



</div> --}}
{{-- end of statistics --}}

    <div class="col-sm-5" id="alert-divw">
    </div><!-- /.col -->
    <div class="col-sm-7">
      <ul class="float-sm-right" type="none">
        <li class="">  
          {{-- start of create pledge button --}}
        <button type="button" class="btn bg-flex text-light btn-sm mb-2"  onclick="createPledge()">
            <i class="fa fa-plus"></i>
             Register Pledge 
        </button> 
          {{-- end of create purpose button --}}

          <button type="button" class="btn bg-flex text-light btn-sm mb-2" data-toggle="modal" onclick="createType()">
            <i class="fa fa-plus"></i>
             Add Pledge Type
            </button>
          {{-- End of create pledge button  --}}

        {{-- start of view all pledge types modal --}}
        <button type="button" class="btn bg-flex text-light btn-sm mb-2" data-toggle="modal" onclick="showAllTypes()">
            <i class="fa fa-list"></i>
            Pledge Types
        </button>
        {{-- end of button --}}

    
        
       

      {{-- start of generate report button --}}
      <a href="{{ route('myadmin_pledge') }}" class="btn bg-cyan  btn-sm mb-2" type="button">
        <i class="fa fa-download text-light" ></i>
        Generate Report
      </a>
        {{-- end of generate report button --}}
    </li>
       
      </ul>
      
    </div><!-- /.col -->
  </div>
</div>

<div class="card mt-1">
        <div class="responsive p-1">
          {{--  start of alll pledges table --}}
          <table id="example1" class="table table-bordered cell-border">
            <thead>
               <tr class="text-secondary">
                <th>SN</th>
                <th>Member Name</th>
                <th>Pledge(Ahadi)</th>
                <th>Purpose</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Actions</th>
               </tr>
            </thead>
            <tbody id="pledges-table-body">
            </tbody>
          </table>
          {{--  end of all pledges table --}}
        </div>

           {{-- start of ajax view purpose details modal --}}
@include('admin.pledges.single-pledge-modal')
{{-- end of ajax view purpose details modal --}}

{{-- start register pledge modal --}}
@include('admin.pledges.register-pledge-modal')
{{-- end of register pledge modal --}}

{{-- start register pledge type modal --}}
@include('admin.pledges.register-pledge-type-modal')
{{-- end of register pledge type modal --}}


 {{-- start of ajax fetch all pledges method --}}
 @include('admin.pledges.ajax-fetch-all-pledges')
 {{-- end of ajax fetch all pleges method --}}
  {{-- start of ajax register pledge method --}}
  @include('admin.pledges.ajax-register-pledge')
  {{-- end of ajax register pledge method --}}

 {{-- start of ajax view pledge details method --}}
 @include('admin.pledges.ajax-fetch-pledge-details')
 {{-- end of ajax view purpose details method --}}



{{-- start all pledge types modal --}}
@include('admin.pledges.all-pledge-types-modal')
{{-- end of all pledge types modal --}}

{{-- start of ajax fetch all pledges method --}}
@include('admin.pledges.ajax-fetch-all-types')
{{-- end of ajax fetch all pleges method --}}


{{-- start of ajax update pledge types method --}}
@include('admin.pledges.ajax-update-type')
{{-- end of ajax update pledge types method --}}

{{-- start of ajax update pledge types method --}}
@include('admin.pledges.ajax-update-pledge')
{{-- end of ajax update pledge types method --}}

{{-- start of ajax register pledge method --}}
@include('admin.pledges.ajax-register-type')
{{-- end of ajax register pledge method --}}

{{-- start of ajax delete Pledge type method --}}
@include('admin.pledges.ajax-delete-type')
{{-- end of ajax delete Pledge type method --}}


@include('admin.pledges.ajax-delete-pledge')
{{-- end of ajax delete Pledge t--}}
 

</div>


</div>

 
@endsection

