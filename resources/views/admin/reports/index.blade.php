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
        <button type="button" class="btn bg-flex text-light btn-sm" data-toggle="tooltip" data-placement="bottom" title="Click here to Register a New Purpose (Contribution)" onclick="createPurpose()">
        <i class="fa fa-plus"></i>
         Make New Announcement
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

</section>
    
{{-- Register Member modal --}}
<div class="modal fade" id="registeredModal" tabindex="-1" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ url('admin/registered-members') }}" method="GET">
            @csrf
    
            <div class="mb-3">
            <h5 class="text-secondary">
                Generate Registered Member Report From the Given Start Date To the given End Date
            </h5>
            </div>
            <div class="mb-3">
              <label for="message-text" class="text-secondary">From Date:</label>
               <input type="date" class="form-control" id="from_date" name="from_date" placeholder="Enter Start Date">
            </div>
            <div class="mb-3">
              <label for="message-text" class="text-secondary">To Date:</label>
               <input type="date" class="form-control" id="to_date" name="to_date" placeholder="Enter End Date">
            </div>
            <div class="mb-3">
                <label for="message-text" class="text-secondary">Sort By:</label>
                <select name="sort_by" id="sort_by">
                    <option value="created_at">Registered Date</option>
                    <option value="fname">First Name</option>
                    <option value="date_of_birth">Birthdate</option>
                </select>
              </div>
            <div class="row">
              <div class="col-md-6">
  
              </div>
              <div class="mb-3 col-md-6">
                 <button type="submit" class="btn btn-primary btn-block " id="save-purpose-btn">
                  <i class="fa fa-download"></i>
                  Download Report
                </button>
              </div>
            </div>
  
       
          </form>
        </div>
      </div>
    </div>
  </div>
  


  


  @endsection