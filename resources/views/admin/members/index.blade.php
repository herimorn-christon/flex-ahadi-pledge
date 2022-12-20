@extends('layouts.master')

@section('title','Dashboard')


@section('content')
<div class="card mt-4">
    <div class="card-header bg-light">
        <h6 class="text-light">
            {{-- All Members --}}
          
        </h6>
    </div>
    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
            @endif



        <div class="row">
            <table id="datatablesSimple" class="table table-bordered ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Community (Jumuiya)</th>
                        <th>Phone Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->fname }} &nbsp; {{ $item->mname }} &nbsp;  {{ $item->lname }}</td>
                       
                        <td>
                            {{ $item->community->name }}
                        </td>
                        <td>
                            {{ $item->phone }}
                        </td>
                        <td>
                            <a href="{{ url('admin/view-course/'.$item->id)}}" class="btn btn-primary btn-sm mx-1">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('admin/edit-course/'.$item->id)}}" class="btn btn-secondary btn-sm mx-1">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('admin/delete-course/'.$item->id)}}" class="btn btn-danger btn-sm">
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