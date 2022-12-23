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
  
        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#types">
            <i class="fa fa-list"></i>
             Payment Methods
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
                        <th>ID</th>
                        <th>Payment Date</th>
                        <th>Payment Purpose</th>
                        <th>Amount</th>
                        <th>Method</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->purpose->title }}</td>
                        <td>{{ $item->amount }}</td>
                        <td>{{ $item->payment->name }}</td>
                     
                    </tr>
                    @endforeach
  
                </tbody>
            </table>

        </div>



    </div>
</div>



{{-- All Pledge Types Modal --}}

<div class="modal fade" id="types">
  <div class="modal-dialog ">
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
                  </tr>
              </thead>
              <tbody>
                  @foreach ($types as $item)
                  <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->name }}</td>
                      
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

@endsection