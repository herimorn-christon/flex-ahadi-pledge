@extends('layouts.member')

@section('title','My Reports')


@section('content')

<style>
        .active {
            color: green !important;
        }
</style>
<section class="content">
    
      <!-- Small boxes (Stat box) -->
      <div class="row">
    
        <div class="col-md-12">
          <div class="card">
            <div class="card-header p-2 bg-white">
              <ul class="nav nav-tabs nav-light">
                <li class="nav-item">
                  <a class="nav-link text-navy active" href="#pledges"  data-toggle="tab">Pledges Report</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-navy" href="#payments"  data-toggle="tab">Payments Report</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-navy" href="#announcements"  data-toggle="tab">Cards Payments Report</a>
                </li>
              </ul>
            </div><!-- /.card-header -->
            <div class="">
              <div class="tab-content">
                <div class="active tab-pane" id="pledges">
                  {{-- start of pledges  report --}}
                  @include('member.reports.pledges-report-form')
                  {{-- end of pledges  report --}}
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="payments">

                  {{-- start of payments reports --}}
                  @include('member.reports.payments-report-form')
                  {{-- start of payments reports --}}
                 
              
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="announcements">

               
                  {{-- start of card payments report form --}}
                  @include('member.reports.cards-report-form')
                  {{-- end of card payments report form --}}
               
              
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
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