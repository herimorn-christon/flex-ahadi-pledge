@extends('layouts.master')

@section('title','All Communities')


@section('content')


<div class="row mb-1">
    <div class="col-sm-6">
      {{-- <h1 class="m-0">Dashboard</h1> --}}
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="">    

        <a href="{{ url('admin/all-pledges') }}" class="btn btn-primary btn-sm"> 
        <i class="fa fa-list"></i>
        All Pledges
        </a>
        
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>
  @if (session('status'))
  <div class="alert disabled" style="background-color: rgb(198, 253, 216)" role="alert">
      {{ session('status') }}
  </div>
  @endif



        <div class="row">

            <div class="col-md-10 mx-auto">
                <div class="card mt-1">
                    <div class="card-header bg-light">
                        <h6 class="text-light">
                            {{-- <a href="{{url('admin/add-course')}}" class="btn btn-danger btn-sm float-end"> Add Course</a> --}}
                        </h6>
                    </div>
                    <div class="card-body">
                
                
                    {{--displaying all the errors  --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    </div>
                    @endif
                <form action="{{ url('admin/edit-purpose/'.$purpose->id) }}" method="post">
                    @csrf
                    @method('PUT')
                        @csrf
                        <div class="row mb-3">
                         <div class="col-md-12">
                            <div class="form-group">
                                <label for="title" class="text-secondary">Title</label>
                                <input type="text"  value="{{ $purpose->title}}" name="title" id="title" class="form-control" placeholder="Enter Pledge Name">
                            </div>
                         </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="start_date" class="text-secondary">Start Date</label>
                              <input type="date"  value="{{ $purpose->start_date}}" name="start_date" id="start_date" class="form-control" placeholder="Enter Pledge Deadline">
                          </div>
                       </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="end_date" class="text-secondary">End Date</label>
                              <input type="date" name="end_date"  value="{{ $purpose->end_date}}" id="end_date" class="form-control" placeholder="Enter Pledge Deadline">
                          </div>
                       </div>
                       <div class="col-md-12">
                        <div class="form-group">
                            <label for="description" class="text-secondary">Description</label>
                            <textarea name="description" class="form-control" id="deadline" rows="4">{{ $purpose->description}}</textarea>
                        </div>
                     </div>
                         <div class="col-md-12">
          
                          <div class="row">
          
                            <div class="col-md-6 mb-3">
                                <label for="" class="text-secondary">Status</label>
                                <input type="checkbox" name="status" id="">
                            </div>
          
                            <div class="col-md-6 ">
                                <button class="btn btn-primary btn-block float-end" type="submit">
                                  <i class="fa fa-save"></i>
                                  Update Purpose
                                </button>
                            </div>
                        </div>
                         </div>
                        </div>
                   
                </form>
            </div>
        </div>



    </div>
</div>



@endsection