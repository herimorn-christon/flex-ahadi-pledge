@extends('layouts.member')

@section('title','Announcements')


@section('content')


<div class="row mb-1">
    <div class="col-sm-5" id="alert-div">
      @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
      @endif
    </div><!-- /.col -->
    <div class="col-sm-7">
      <ol class="float-sm-right" type="none">
        <li class="">    
   
       
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>

<div class="card mt-1">
 
    <div class="mt-2">

        <div class=" p-1">
            <table id="example1" class="table table-bordered cell-border">
                <thead>
                    <tr class="text-secondary">
                        <th>SN</th>
                        <th>Posted Date</th>
                        <th>Announcement Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="announcements-table-body">
   
  
                </tbody>
            </table>
  
        </div>

{{-- start of single announcemnt modal --}}
@include('member.announcements.single-announcement-modal')
{{-- end of single announcement modal --}}

 {{-- start of ajax fetch all announcemets --}}
 @include('member.announcements.ajax-fetch-announcements')
 {{-- end of ajax fetch all announcements --}}

  {{-- start of ajax fetch announcement details --}}
  @include('member.announcements.ajax-fetch-announcement-details')
  {{-- end of ajax fetch member announcement details --}}
  
@endsection