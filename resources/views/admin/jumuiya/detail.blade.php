@extends('layouts.master')

@section('title','Dashboard')


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
      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#registerModal">
          <i class="fa fa-user-plus"></i>
           Register Member
      </button>  
  </li>
     
    </ol>
    
  </div><!-- /.col -->
</div>


<div class="card mt-1 card-light">
    <div class="card-header"></div>
    <div class="card-body">
        <table class="table">
            @foreach ($community as $item)
            <tr>
                <th class="text-secondary">Community Name &nbsp;</th>
                <td>
                    {{ $item->name }}
                </td>
            </tr>
            <tr>
                <th class="text-secondary">Abbreviation </th>
                <td>{{ $item->abbreviation }}</td>
            </tr>
            <tr>
                <th class="text-secondary">Location </th>
                <td>{{ $item->location }}</td>
            </tr>

             @endforeach
        </table>
    </div>
</div>

<div class="card mt-1">
    <div class="card-header bg-light">
        <h6 class="text-light">
            {{-- All Members --}}
          
        </h6>
    </div>
    <div class="card-body">




        <div class="row">
            <table id="mytable" class="table table-bordered table-datatable ">
                <thead>
                    <tr>
                        <th>Member ID</th>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $item)
                    <tr>
                        <td>{{ $item->community->abbreviation }}/{{ $item->id }}</td>
                        <td>{{ $item->fname }} &nbsp; {{ $item->mname }} &nbsp;  {{ $item->lname }}</td>
                        <td>
                            {{ $item->phone }}
                        </td>
                        <td>
                            {{ $item->gender }}
                        </td>
                        <td class="text-success">{{ $item->status=='1'? 'Disabled':'Active' }}</td>
                        <td>
                            <a 

                            href="{{ url('admin/view-member/'.$item->id)}}" 
    
                            class="btn btn-primary btn-sm"
                            >
                        <i class="fa fa-eye"></i>
                          </a>
                            <a href="{{ url('admin/edit-member/'.$item->id)}}" class="btn btn-secondary btn-sm mx-1">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('admin/delete-member/'.$item->id)}}" class="btn btn-danger btn-sm">
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