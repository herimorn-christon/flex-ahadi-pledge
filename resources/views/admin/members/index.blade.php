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
      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_pledge">
          <i class="fa fa-user-plus"></i>
           Register Member
      </button>  
  </li>
     
    </ol>
    
  </div><!-- /.col -->
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
                        <th>Community (Jumuiya)</th>
                        <th>Phone Number</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                    <tr>
                        <td>{{ $item->community->abbreviation }}/{{ $item->id }}</td>
                        <td>{{ $item->fname }} &nbsp; {{ $item->mname }} &nbsp;  {{ $item->lname }}</td>
                       
                        <td>
                            {{ $item->community->name }}
                        </td>
                        <td>
                            {{ $item->phone }}
                        </td>
                        <td>
                            {{ $item->gender }}
                        </td>
                        <td class="text-success">{{ $item->status=='1'? 'Disabled':'Active' }}</td>
                        <td>
                            <a 

                            href="javascript:void(0)" 
    
                            id="show-user" 
    
                            data-url="{{ route('users.show', $item->id) }}" 
    
                            class="btn btn-primary btn-sm"
                            data-toggle="modal" data-target="#userShowModal"
                            >
                        <i class="fa fa-eye"></i>
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



<!--View User Modal -->

<div class="modal fade" id="userShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">
  
      <div class="modal-content">
  
        <div class="modal-header">
  
          <h5 class="modal-title" id="exampleModalLabel">Show User</h5>
  
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
  
        </div>
  
        <div class="modal-body">
  
          <p><strong>ID:</strong> <span id="user-id"></span></p>
  
          <p><strong>Full Name:</strong> <span id="user-fname"></span>  <span id="user-mname"></span></p>
  
          <p><strong>Birthdate:</strong> <span id="user-dob"></span></p>
  
        </div>
  
        <div class="modal-footer">
  
          <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
  
        </div>
  
      </div>
  
    </div>
  
  </div>


  <script type="text/javascript">

      

    $(document).ready(function () {

       

       /* When click show user */

        $('body').on('click', '#show-user', function () {

          var userURL = $(this).data('url');

          $.get(userURL, function (data) {

              $('#userShowModal').modal('show');

              $('#user-id').text(data.id);

              $('#user-fname').text(data.fname);
              $('#user-mname').text(data.mname);

              $('#user-dob').text(data.date_of_birth);

          })

       });

       

    });

  

</script>
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