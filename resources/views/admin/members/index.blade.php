@extends('layouts.master')

@section('title','All Courses')


@section('content')
<div class="card mt-4">
    <div class="card-header bg-primary">
        <h6 class="text-light">All Members
            {{-- <a href="{{url('admin/add-course')}}" class="btn btn-danger btn-sm float-end"> Add Course</a> --}}
        </h6>
    </div>
    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
            @endif



        <div class="row">
            <table id="datatablesSimple" class="table ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Member No.</th>
                        <th>Community</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }} &nbsp; {{ $item->email }} </td>
                        <td>
                            {{-- <img src="{{asset('uploads/course/'.$item->image) }}" width="40px" height="40px"> --}}
                         </td>
                        <td>
                            {{-- {{ $item->status=='1'? 'Hidden':'Shown' }}</td> --}}

                        <td>
                            <a href="{{ url('admin/view-course/'.$item->id)}}" class="btn btn-primary btn-sm mx-1">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('admin/edit-course/'.$item->id)}}" class="btn btn-success btn-sm mx-1">
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
@endsection