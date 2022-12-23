@extends('layouts.master')

@section('title','Manage Cards')


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
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#cards">
            <i class="fa fa-envelope"></i>
             All Cards
        </button>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#types">
            <i class="fa fa-list"></i>
             Assign Card
        </button>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-lg">
        <i class="fa fa-plus"></i>
            Create Card
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
            <table id="mytable" class="table table-bordered ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Member</th>
                        <th>Card Number</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cards as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->user->fname }} {{ $item->user->mname }} {{ $item->user->lname }}</td>
                        <td>{{ $item->card->card_no }}/{{ $item->user->community->abbreviation }}/{{ $item->user->id }}</td>
                        <td class="text-success">{{ $item->status=='1'? 'Inactive':'Active' }}</td>
  
                        <td>
                           <a href="{{ url('admin/view-card/'.$item->id)}}" class="btn btn-primary btn-sm mx-1">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                           </a>
                            <a href="{{ url('admin/edit-card/'.$item->id)}}" class="btn btn-secondary btn-sm mx-1">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('admin/delete-card/'.$item->id)}}" class="btn btn-danger btn-sm">
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
            <form action="{{ url('admin/add-card') }}" method="post">
                @csrf
                <div class="row mb-3">
                 <div class="col-md-12">
                    <div class="form-group">
                        <label for="card_no" class="text-secondary">Card Number</label>
                        <input type="text" name="card_no" id="card_no" class="form-control" placeholder="Enter Card Number">
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                     
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i>
                            Create Card
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



  {{-- Assign Card  Modal --}}

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
       
        <form action="{{ url('admin/assign-card') }}" method="post">
          @csrf
          <div class="row mb-3">
            @php
            $jumuiya= App\Models\User::where('role','member')->get();
            @endphp
            <div class="col-md-12">
                <label for="" class="text-secondary">All Members</label>
                <select name="user_id" class="form-control">
                    <option value="">--Select Member --</option>
                    @foreach ( $jumuiya as $item)
                     <option value="{{ $item->id}}">{{ $item->fname}} {{ $item->mname}} {{ $item->lname}}</option>
                     @endforeach
                </select>
            </div>

            @php
            
            $purpose= App\Models\Card::where('status','')->get();
            @endphp
            <div class="col-md-12 mb-3">
                <label for="" class="text-secondary">Available Cards</label>
                <select name="card_no" class="form-control">
                    <option value="">--Select  Card --</option>
                    @foreach ( $purpose as $item)
                     <option value="{{ $item->id}}"> {{ $item->card_no}}</option>
                    @endforeach
                </select>
            </div>
           <div class="col-md-12">
              <div class="form-group">
               
                  <button type="submit" class="btn btn-primary">
                      <i class="fa fa-save"></i>
                      Assign Card
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


{{-- All card modal --}}
<div class="modal fade" id="cards">
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
          <table id="modaltable" class="table table-bordered ">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Member</th>
                      <th>Card Number</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($card as $item)
                  <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->card_no }}</td>
                      <td class="text-success">{{ $item->status=='1'? 'Not Available':'Available' }}</td>

                      <td>
                          <a href="{{ url('admin/edit-card/'.$item->id)}}" class="btn btn-primary btn-sm mx-1">
                              <i class="fa fa-edit" aria-hidden="true"></i>
                          </a>
                          <a href="{{ url('admin/delete-card/'.$item->id)}}" class="btn btn-danger btn-sm">
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