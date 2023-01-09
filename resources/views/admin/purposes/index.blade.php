{{-- This is the main Admin manage purposes page --}}
@extends('layouts.master')

@section('title','All Purposes')


@section('content')


<div class="row mb-1">
    <div class="col-sm-6" id="alert-div">

    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="float-sm-right" type="none">
        <li class="">    
        {{-- start of create purpose button --}}
        <button type="button" class="btn bg-flex text-light btn-sm" data-toggle="tooltip" data-placement="bottom" title="Click here to Register a New Purpose (Contribution)" onclick="createPurpose()">
        <i class="fa fa-plus"></i>
         Add New Purpose
        </button>
        {{-- end of create purpose button --}}

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
       
      </ol>
      
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