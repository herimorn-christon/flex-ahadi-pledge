{{-- This is the main view of Admin- Manage Communities --}}
@extends('layouts.master')

@section('title','All Communities (Jumuiya)')


@section('content')

<div class="card  p-2 border-left-flex">
  <div class="row mb-1">

  {{-- start of statistics --}}
<div class="">
  <div class="row starts-border mt-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Communities  (Jumuiya) </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder"> 212</h6></div>
  </div>
  <div class="row starts-border" >
    <div class="col-md-6"> <h6 class="text-secondary">Largest Community(Jumuiya) </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder"> 212</h6></div>
  </div>
  <div class="row starts-border mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">smallest Community (Jumuiya)</h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder"> 212</h6></div>
  </div>
</div>
{{-- end of statistics --}}

      {{-- start of activities notifications i.e registration,deletion and update status --}}
        <div class="col-sm-6" id="alert-div">
        </div>
      {{-- end of activities notifications --}}

    <div class="col-sm-6">
      <ol class=" float-sm-right" type="none">
        <li class="">    

        <button type="button" class="btn  bg-flex  text-light btn-sm" data-toggle="tooltip" data-placement="bottom" title="Click here to Register a New Community"  onclick="createCommunity()">
        <i class="fa fa-plus"></i>
         Add New Community
        </button>

      {{-- start of generate report button --}}
      <a href="" class="btn bg-cyan btn-sm" type="button"  data-bs-toggle="modal" data-bs-target="#registeredModal">
        <i class="fa fa-download text-light" ></i>
        Generate Report
      </a>
        {{-- end of generate report button --}}

        {{-- start of ajax add community modal --}}
        @include('admin.jumuiya.register-community-modal')
        {{--  end of ajax add community modal --}}


        {{-- start of ajax add community method --}}
        @include('admin.jumuiya.ajax-register-community')
        {{--  end of ajax add community method --}}

        {{-- start of ajax edit community method --}}
        @include('admin.jumuiya.ajax-update-community')
        {{--  end of ajax edit community method --}}

        {{-- start of ajax edit community method --}}
        @include('admin.jumuiya.ajax-delete-community')
        {{--  end of ajax edit community method --}}

    </li>
       
      </ol>
      
    </div>
</div>
</div>


 
<div class="card mt-1">
    <div>
        <div class="mt-3 p-1">
           {{-- start of view all communities table --}}
             <table id="example1" class="table table-bordered " >
                <thead>
                    <tr class="text-secondary">
                        <th>SN</th>
                        <th>Jumuiya Name</th>
                        <th>Abbreviation</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="communities-table-body">

                </tbody>
                <tfoot>
                 
              </tfoot>
            </table>
             {{-- end of view all communities table --}}
        </div>

        {{-- start of ajax fetch all communities method --}}
        @include('admin.jumuiya.ajax-fetch-all-communities')
        {{--  end of ajax fetch all communities method --}}

        {{-- start of ajax view community details modal --}}
        @include('admin.jumuiya.view-community-detail-modal')
        {{--  end of ajax view community details modal --}}


        {{-- start of ajax fetch community details method --}}
        @include('admin.jumuiya.ajax-fetch-community-details')
        {{--  end of ajax fetch  community details method --}}


    </div>
</div>

@endsection