@extends('layouts.member')

@section('title','All Communities')


@section('content')


<div class="row mb-1">
    <div class="col-sm-6">
      @if (session('status'))
      <div class="alert disabled" style="background-color: rgb(198, 253, 216)" role="alert">
          {{ session('status') }}
      </div>
      @endif
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="">  
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_pledge">
            <i class="fa fa-plus"></i>
             Register Pledge 
        </button>  
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#types">
            <i class="fa fa-list"></i>
            Purposes
        </button>
    
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>

<div class="card mt-1">
    <div class="card-header bg-light">
        <h6 class="text-light">
          {{-- All Pledges Made --}}
           
        </h6>
    </div>
    <div class="card-body">




        <div class="row">
 
          <table id="mytable"  class="table table-bordered ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pledge Name</th>
                    <th>Amount</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pledges as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>{{ $item->deadline }}</td>
                    <td class="text-success">{{ $item->status=='1'? 'Inactive':'Active' }}</td>

                    <td>
                       <a href="{{ url('admin/view-pledge/'.$item->id)}}" class="btn btn-primary btn-sm mx-1">
                          <i class="fa fa-eye" aria-hidden="true"></i>
                       </a>
                        <a href="{{ url('admin/edit-pledge/'.$item->id)}}" class="btn btn-secondary btn-sm mx-1">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
                @endforeach

            </tbody>
         </table>
        </div>



    </div>
</div>



{{-- All Pledge Types Modal --}}

<div class="modal fade" id="types">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
        <div class="row">
          <table id="mytable"  class="table table-bordered ">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Purpose</th>
                      <th>Details</th>
                      <th>Start date</th>
                      <th>End date</th>
                      <th>Status</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($purposes as $item)
                  <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->title }}</td>
                      <td>{{ $item->description }}</td>
                      <td>{{ $item->start_date }}</td>
                      <td>{{ $item->end_date }}</td>
                      <td class="text-success">{{ $item->status=='1'? 'Hidden':'Active' }}</td>
                   
                  </tr>
                  @endforeach

              </tbody>
          </table>

      </div>
      </div>
      <div class="modal-footer justify-content-between">
        {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      --}}
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

{{-- register new pledge  modal--}}

<div class="modal fade" id="add_pledge">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <h4 class="modal-title">Large Modal</h4> --}}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{ url('member/save-pledge') }}" method="post">
              @csrf
              <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name" class="text-secondary">Pledge Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Pledge Name">
                    </div>
                 </div>
                <div class="col-md-6">
                    <label for="" class="text-secondary">Pledge Type</label>
                    <select name="type_id" class="form-control">
                        <option value="">--Select Pledge Type --</option>
                        @foreach ( $types as $item)
                         <option value="{{ $item->id}}">{{ $item->title}}</option>
                        @endforeach
                    </select>
                </div>
                @php
                $purpose= App\Models\Purpose::where('status','')->get();
                @endphp
                <div class="col-md-6">
                    <label for="" class="text-secondary">Pledge Purpose</label>
                    <select name="purpose_id" class="form-control">
                        <option value="">--Select Purpose --</option>
                        @foreach ( $purpose as $item)
                         <option value="{{ $item->id}}"> {{ $item->title}}</option>
                        @endforeach
                    </select>
                </div>

               <div class="col-md-6">
                <div class="form-group">
                    <label for="amount" class="text-secondary">Amount</label>
                    <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Pledge Amount">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="deadline" class="text-secondary">Deadline</label>
                    <input type="date" name="deadline" id="deadline" class="form-control" placeholder="Enter Pledge Deadline">
                </div>
             </div>
             <div class="col-md-12">
              <div class="form-group">
                  <label for="description" class="text-secondary">Description</label>
                  <textarea name="description" class="form-control" id="deadline" rows="4"></textarea>
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
                        Save Pledge 
                      </button>
                  </div>
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

{{-- register new purpose --}}
<div class="modal fade" id="add_purpose">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <h4 class="modal-title">Large Modal</h4> --}}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{ url('admin/add-purpose') }}" method="post">
              @csrf
              <div class="row mb-3">
               <div class="col-md-12">
                  <div class="form-group">
                      <label for="title" class="text-secondary">Title</label>
                      <input type="text" name="title" id="title" class="form-control" placeholder="Enter Pledge Name">
                  </div>
               </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="start_date" class="text-secondary">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Enter Pledge Deadline">
                </div>
             </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="end_date" class="text-secondary">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" placeholder="Enter Pledge Deadline">
                </div>
             </div>
             <div class="col-md-12">
              <div class="form-group">
                  <label for="description" class="text-secondary">Description</label>
                  <textarea name="description" class="form-control" id="deadline" rows="4"></textarea>
              </div>
           </div>
               <div class="col-md-12">

                <div class="row">

                  <div class="col-md-6 mb-3">
                      {{-- <label for="" class="text-secondary">Status</label> --}}
                      <input type="checkbox" name="status" id="" hidden>
                  </div>

                  <div class="col-md-6 ">
                      <button class="btn btn-primary btn-block float-end" type="submit">
                        <i class="fa fa-save"></i>
                        Save Purpose
                      </button>
                  </div>
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

@section('scripts')

<script>
// for add pledges using ajax
  $(document).ready(
  function()
  {
    $(document).on('click','add_type',function(e)
    {
      e.preventDefault();

      var data= {
        'title':$('.title').val();
      }

      console.log("hello");
    }
    );
  }
  );
</script>

@endsection