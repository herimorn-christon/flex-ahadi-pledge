@extends('layouts.master')

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
        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#add_payment">
            <i class="fa fa-plus"></i>
            Register Payment
        </button>   
        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#types">
            <i class="fa fa-list"></i>
             Payment Methods
        </button>
        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#modal-lg">
        <i class="fa fa-plus"></i>
         Add Payment Method
        </button>
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>

<div class="card mt-1">
    <div class="card-header bg-light">
        <h6 class="text-light">
          
        </h6>
    </div>
    <div class="card-body">




        <div class="row">
            <table id="mytable"  class="table table-bordered responsive">
                <thead>
                    <tr>
                        <th>Member Name</th>
                        <th>Member ID</th>
                        <th>Payment Purpose</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Payment Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $item)
                    <tr>
                        <td>{{ $item->payer->fname }} {{ $item->payer->mname }} {{ $item->payer->lname }}</td>
                        <td>{{ $item->payer->community->abbreviation }}/{{ $item->payer->id }}</td>
                        <td>{{ $item->purpose->title}}</</td>
                        <td>{{ $item->amount }}</td>
                        <td>{{ $item->payment->name }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ url('admin/edit-method/'.$item->id)}}" class="btn btn-primary btn-sm mx-1">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('admin/delete-payment/'.$item->id)}}" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
  
                </tbody>
            </table>

        </div>



    </div>
</div>


{{-- Add Payment Type modal --}}

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
            <form action="{{ url('admin/add-method') }}" method="post">
                @csrf
                <div class="row mb-3">
                 <div class="col-md-12">
                    <div class="form-group">
                        <label for="name" class="text-secondary">Payment Method</label>
                        <input type="text" name="name" id="title" class="form-control" placeholder="Enter Payment Method Name">
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                     
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i>
                            Save Payment Method
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
                      <th>Method Name</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($types as $item)
                  <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->name }}</td>
                      

                      <td>
                          <a href="{{ url('admin/edit-method/'.$item->id)}}" class="btn btn-primary btn-sm mx-1">
                              <i class="fa fa-edit" aria-hidden="true"></i>
                          </a>
                          <a href="{{ url('admin/delete-method/'.$item->id)}}" class="btn btn-danger btn-sm">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                          </a>
                      </td>
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

{{-- Register Payment Modal --}}

<div class="modal fade" id="add_payment">
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
            <form action="{{ url('admin/add-payment') }}" method="post">
                @csrf
                <div class="row mb-3">
                    @php
                    $jumuiya= App\Models\User::where('role','member')->get();
                    @endphp
                    <div class="col-md-6">
                        <label for="" class="text-secondary">Payer</label>
                        <select name="user_id" class="form-control">
                            <option value="">--Select Member --</option>
                            @foreach ( $jumuiya as $item)
                             <option value="{{ $item->id}}">{{ $item->fname}} {{ $item->mname}} {{ $item->lname}}</option>
                             @endforeach
                        </select>
                    </div>

                    @php
                    
                    $purpose= App\Models\Purpose::where('status','')->get();
                    @endphp
                    <div class="col-md-6">
                        <label for="" class="text-secondary">Payment Purpose</label>
                        <select name="pledge_id" class="form-control">
                            <option value="">--Select Purpose --</option>
                            @foreach ( $purpose as $item)
                             <option value="{{ $item->id}}"> {{ $item->title}}</option>
                            @endforeach
                        </select>
                    </div>

     
                    @php
                    $purpose= App\Models\PaymentType::get();
                    @endphp
                    <div class="col-md-6">
                        <label for="" class="text-secondary">Payment Method</label>
                        <select name="type_id" class="form-control">
                            <option value="">--Select Payment Method --</option>
                            @foreach ( $purpose as $item)
                             <option value="{{ $item->id}}"> {{ $item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="amount" class="text-secondary">Paid Amount </label>
                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Payment Amount">
                    </div>
                 </div>
                 <div class="col-md-6"></div>
                 <div class="col-md-6">
                    <div class="form-group">
                     
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fa fa-save"></i>
                            Save Payment
                        </button>
                    </div>
                 </div>
                </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
@endsection