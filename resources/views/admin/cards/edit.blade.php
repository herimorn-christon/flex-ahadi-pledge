@extends('layouts.master')

@section('title','Manage Cards')


@section('content')


<div class="row mb-1">
    <div class="col-sm-6">
      {{-- <h1 class="m-0">Dashboard</h1> --}}
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="">    

        <a href="{{ url('admin/all-cards') }}" class="btn btn-primary btn-sm"> 
        <i class="fa fa-list"></i>
        All Cards
        </a>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-lg">
        <i class="fa fa-plus"></i>
         Add Card
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
<div class="card mt-1">
    <div class="card-header bg-light">
        <h6 class="text-light">
            {{-- <a href="{{url('admin/add-course')}}" class="btn btn-danger btn-sm float-end"> Add Course</a> --}}
        </h6>
    </div>
    <div class="card-body">




        <div class="row">


                    {{--displaying all the errors  --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    </div>
                    @endif
                <form action="{{ url('admin/edit-card/'.$card->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-12 mb-3">
                        <div class="form-group">
                            <label for="">Card Number</label>
                            <input name="card_no" type="text" value="{{ $card->card_no}}" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-lg-12 mb-3">
                        <div class="form-group">
                            <label for="">Member Number</label>
                            <input name="membership_no" type="text" value="{{ $card->membership_no}}" class="form-control">
                        </div>
                    </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-block" type="submit">
                                <i class="fa fa-save"></i>
                                Update Card
                            </button>
                        </div>
                    </div>
                </form>

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
                        <label for="card_no" class="text-secondary">Card No</label>
                        <input type="text" name="card_no" id="card_no" class="form-control" placeholder="Enter Card Number">
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                        <label for="card_no" class="text-secondary">Member No</label>
                        <input type="text" name="member_no" id="member_no" class="form-control" placeholder="Enter Member Number">
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                     
                        <button type="submit" class="btn btn-primary ">
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