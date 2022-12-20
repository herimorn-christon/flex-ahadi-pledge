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
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-lg">
        <i class="fa fa-plus"></i>
         Add Pledge
        </button>
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
                <form action="{{ url('admin/edit-pledge/'.$pledge->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                      <div class="col-md-6">
                          <label for="" class="text-secondary">Pledge Type</label>
                          <select name="type_id" class="form-control">
                              <option value="">--Select Pledge Type --</option>
                              @foreach ( $types as $item)
                               <option value="{{ $item->id}}"  {{ $pledge->type_id == $item->id ? 'selected':'' }}>{{ $item->title}} </option>
                              @endforeach
                              
                          </select>
                      </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="text-secondary">Name</label>
                            <input type="text" name="name" id="name" value="{{ $pledge->name}}" class="form-control" placeholder="Enter Pledge Name">
                        </div>
                     </div>
                     <div class="col-md-6">
                      <div class="form-group">
                          <label for="amount" class="text-secondary">Amount</label>
                          <input type="text" name="amount" id="amount" value="{{ $pledge->amount}}" class="form-control" placeholder="Enter Pledge Amount">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="deadline" class="text-secondary">Deadline</label>
                          <input type="date" name="deadline" id="deadline" value="{{ $pledge->deadline}}" class="form-control" placeholder="Enter Pledge Deadline">
                      </div>
                   </div>
                   <div class="col-md-12">
                    <div class="form-group">
                        <label for="description" class="text-secondary">Description</label>
                        <textarea name="description" class="form-control" value="{{ $pledge->description}}" id="deadline" rows="4">{{ $pledge->description}}</textarea>
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
                              Update Pledge 
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


{{-- Add Community modal --}}

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          {{-- <h4 class="modal-title">Large Modal</h4> --}}
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ url('admin/edit-community') }}" method="post">
                @csrf
                <div class="row mb-3">
                 <div class="col-md-12">
                    <div class="form-group">
                        <label for="name" class="text-secondary">Pledge Type Title</label>
                        <input type="text" name="" id="name" class="form-control" placeholder="Enter Community Name">
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                     
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i>
                            Update Pledge Type
                        </button>
                    </div>
                 </div>
                </div>
            </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


@endsection