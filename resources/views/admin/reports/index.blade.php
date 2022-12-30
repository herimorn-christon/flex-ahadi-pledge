@extends('layouts.master')

@section('title','Reports')


@section('content')


<section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-white">
            <div class="inner">
              <h5 class="text-center">
                {{-- <i class="fa fa-users"></i> --}}
              </h5>

              <p class="text-secondary">Registered Members Report</p>
            </div>
            <div class="icon text-center">
              <i class="fa fa-file-pdf text-danger"></i>
            </div>
            <br>
            <a href="{{ url('admin/registered-members') }}" class="mt-2 small-box-footer   ">Generate Report <i class="fas fa-download text-primary"></i></a>
          </div>
        </div>




      </div>
    </div>
</section>
    





@endsection