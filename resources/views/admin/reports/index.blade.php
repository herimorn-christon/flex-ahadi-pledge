@extends('layouts.master')

@section('title','Announcements')


@section('content')

<section class="content">

  <div class="card  p-2 border-left-flex">
    <div class="row mb-1">
    {{-- start of statistics --}}
<div class="">
  <div class="row starts-border mt-2 mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">Total Announcements Made </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder"> 212</h6></div>
  </div>

  
</div>
{{-- end of statistics --}}

    <div class="col-sm-6" id="alert-div">

    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="float-sm-right" type="none">
        <li class="">    
        {{-- start of create purpose button --}}
        <button type="button" class="btn bg-flex text-light btn-sm" data-toggle="tooltip" data-placement="bottom" title="Click here to Register a New Purpose (Contribution)" onclick="createAnnouncement()">
        <i class="fa fa-plus"></i>
         Make New Announcement
        </button>
        {{-- end of create purpose button --}}

    
        
        {{-- start register purpose modal --}}
        @include('admin.reports.register-announcement-modal')
        {{-- end of register purpose modal --}}

        {{-- start of ajax register purpose method --}}
        @include('admin.reports.ajax-register-announcement')
        {{-- end of ajax register purpose method --}}

        {{-- start of ajax update purpose method --}}
        {{-- @include('admin.purposes.ajax-update-purpose') --}}
        {{-- end of ajax update purpose method --}}

        {{-- start of ajax delete purpose method --}}
        @include('admin.reports.ajax-delete-announcement')
        {{-- end of ajax delete purpose method --}}

    </li>
       
      </ol>
      
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
                        <th>Announcement Title</th>
                         <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="purposes-table-body">

                </tbody>
            </table>
        {{-- end of all purposes tables --}}

        {{-- start of ajax fetch all announcements method --}}
        @include('admin.reports.ajax-fetch-all-announcements')
        {{-- end of ajax fetch all announcements method --}}

        {{-- start of ajax view purpose details method --}}
        {{-- @include('admin.purposes.ajax-fetch-purpose-details') --}}
        {{-- end of ajax view purpose details method --}}

        {{-- start of ajax view purpose details modal --}}
        {{-- @include('admin.purposes.single-purpose-modal') --}}
        {{-- end of ajax view purpose details modal --}}
        </div>
</div>

</section>
    

  @endsection