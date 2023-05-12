{{-- This is the main Admin manage purposes page --}}
@extends('layouts.master')

@section('title','All Purposes')


@section('content')

<div class="card  p-2 border-left-flex">
<div class="row mb-1">




  <div class="row" style="display:flex;justify-content:space-around">
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><img src="{{asset('icons/sigma.png')}}"/></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Registered Purposes  (Contributions)</span>
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
          <img src="{{asset('icons/check.png')}}"/>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">accomplished Purposes (Contributions) </span>
          <span class="info-box-number"  id="accomplished" > </span>
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
          <img src="{{asset('icons/cancel.png')}}"/>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">Unaccomplished Purposes (Contributions)</span>
          <span class="info-box-number"  id="unaccomplished"> </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- /.col -->
  </div>

{{-- start of statistics --}}
{{-- <div class="">
  <div class="row starts-border mt-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Registered Purposes  (Contributions) </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="total"> </h6></div>
  </div>

  <div class="row starts-border" >
    <div class="col-md-6"> <h6 class="text-secondary">Accomplished Purposes (Contributions) </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="accomplished"> </h6></div>
  </div>

  <div class="row starts-border mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Unaccomplished Purposes (Contributions)</h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="unaccomplished"> </h6></div>
  </div>

  <div class="row starts-border mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Leading Pledged Purpose (Contributions)</h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder"> </h6></div>
  </div>

  <div class="row starts-border mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Lowest Pledged Purposes (Contributions)</h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder"> </h6></div>
  </div>

</div> --}}
{{-- end of statistics --}}

    <div class="col-sm-6" id="alert-div2">

    </div><!-- /.col -->
    <div class="col-sm-6">
      <ul class="float-sm-right" type="none">
        <li class="">    
        {{-- start of create purpose button --}}
        <button type="button" class="btn bg-flex text-light btn-sm" data-toggle="tooltip" data-placement="bottom" title="Click here to Register a New Purpose (Contribution)" onclick="createPurpose()">
        <i class="fa fa-plus"></i>
         Add New Purpose
        </button>
        {{-- end of create purpose button --}}

        
      {{-- start of generate report button --}}
      <a href="{{ route("purpousePdf") }}" class="btn bg-cyan  btn-sm" type="button">
        <i class="fa fa-download text-light" ></i>
        Generate Report
      </a>
        {{-- end of generate report button --}}
        
        {{-- start register purpose modal --}}
        @include('admin.purposes.register-purpose-modal')
        {{-- end of register purpose modal --}}

        {{-- start of ajax register purpose method --}}
        @include('admin.purposes.ajax-register-purpose')
        {{-- end of ajax register purpose method --}}

        {{-- start of ajax update purpose method --}}
        @include('admin.purposes.ajax-update-purpose')
        {{-- end of ajax update purpose method --}}

        {{-- start of ajax delete purpose method --}}
        @include('admin.purposes.ajax-delete-purpose')
        {{-- end of ajax delete purpose method --}}

    </li>
       
      </ul>
      
    </div>
  </div>
</div>
<div class="card mt-1">
        <div class="responsive p-1">
          {{-- start of all purposes table --}}
            <table id="example1" class="table table-bordered ">
                <thead>
                    <tr class="text-secondary">
                        <th>SN</th>
                        <th>Purpose Title</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                         <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="purposes-table-body">

                </tbody>
            </table>
        {{-- end of all purposes tables --}}

        {{-- start of ajax fetch all purposes method --}}
        @include('admin.purposes.ajax-fetch-all-purposes')
        {{-- end of ajax fetch all purposes method --}}

        {{-- start of ajax view purpose details method --}}
        @include('admin.purposes.ajax-fetch-purpose-details')
        {{-- end of ajax view purpose details method --}}

        {{-- start of ajax view purpose details modal --}}
        @include('admin.purposes.single-purpose-modal')
        {{-- end of ajax view purpose details modal --}}
        </div>
</div> 
@endsection