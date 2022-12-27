<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laravel Project Manager</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ url('/') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  
  <!-- JQVMap -->
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
  <!-- Navbar -->
  @include('layouts.inc.admin-navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('admin/dashboard') }}" class="text-decoration-none brand-link">
      <img src="{{ asset('img/flex.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text text-primary font-weight-light">AhadiPledge</span>
    </a>

    <!-- Sidebar -->
    @include('layouts.inc.admin-sidebar')
    <!-- /.sidebar -->
  </aside>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row ">
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
                      <button class="btn btn-primary btn-sm" onclick="createProject()"> 
                        <i class="fa fa-user-plus"></i>
                         Register New Member
                       </button>
            </li>
               
              </ol>
              
            </div><!-- /.col -->
          </div>
     
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content"> 
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered" id="mytable">
                    <thead>
                        <tr class="text-secondary">
                            <th>Full Name</th>
                            <th>Phone number</th>
                            <th>Gender</th>
                            <th width="240px">Action</th>
                        </tr>
                    </thead>
                    <tbody id="projects-table-body">
                         
                    </tbody>
                     
                </table>
            </div>
        </div>
    </div>
  

    </section>
  </div>
  </div>
  <footer class="main-footer mt-4">
    <strong>Copyright &copy; 2022 <a href="#">AhadiPledge</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 0.0.1
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    
  </aside>
</div>
</div>

    <!-- modal for creating and editing function -->
    <div class="modal" tabindex="-1"  id="form-modal">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
            <div class="modal-header">
{{--                 <h5 class="modal-title">Project Form</h5> --}}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="error-div"></div>
            <form>
                 <input type="hidden" name="update_id" id="update_id">
                <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="fname" class="text-secondary">{{ __('First Name') }}</label>

                    <div class="form-group">
                        <input id="fname" type="text" placeholder="Enter First Name" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="name" autofocus>

                        @error('fname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="mname" class="text-secondary">{{ __('Middle Name') }}</label>

                    <div class="">
                        <input id="mname" type="text" placeholder="Enter Middle Name" class="form-control @error('mname') is-invalid @enderror" name="mname" value="{{ old('fname') }}" required autocomplete="name" autofocus>

                        @error('mname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lname" class="text-secondary">{{ __('Last Name') }}</label>

                    <div class="form-group">
                        <input id="lname" type="text" placeholder="Enter Last Name" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="name" autofocus>

                        @error('lname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="phone" class="form-label text-secondary ">{{ __('phone') }}</label>

                    <div class="form-group">
                        <input id="phone" type="text" placeholder="Enter Phone Number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

        
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="email" class="text-secondary">{{ __('Email Address') }}</label>

                    <div class="form-group">
                        <input id="email" type="email" placeholder="Enter Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

        
                    </div>
                </div>

                @php
                $jumuiya= App\Models\Jumuiya::get();
                @endphp
                <div class="col-md-6 form-group">
                    <label for="" class="text-secondary">Jumuiya (Community) </label>
                    <select name="jumuiya" id="jumuiya"  class="form-control">
                        <option value="">--Select Community (Jumuiya) --</option>
                        @foreach ( $jumuiya as $item)
                         <option value="{{ $item->id}}">{{ $item->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-6">
                    <label for="card_no" class="text-secondary">Birthdate</label>
                    <div class="form-group form-primary mb-3"> 
                        <input id="date_of_birth" type="date" class="form-control" name="date_of_birth" placeholder="" > </div>
                </div>

            <div class="col-lg-6">
                <label for="gender" class="text-secondary">Gender</label>
                <div class="row mx-1 ">
                    
                  <div class="col-md-4 form-check form-check-inline"><input type="radio" id="male"   name="gender" value="male" class="form-check-input">
                    <label class="form-check-label" for="male" >Male</label></div>
                  <div class="col-md-4 form-check form-check-inline"><input type="radio" id="female"  name="gender" value="female" class="form-check-input">
                    <label class="form-check-label" for="female">Female</label></div>
                </div>
            
            </div>

                <div class="col-md-6 mb-3">
                    <label for="password" class="text-secondary">{{ __('Password') }}</label>

                    <div class="form-group">
                        <input id="password" placeholder="Enter Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-3 text-secondary">
                    <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>

                    <div class="form-group">
                        <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="col-md-12 mb-0 ">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                              <button type="submit" class="btn btn-primary btn-block mt-3" id="save-project-btn">Save Member</button>
                        </div>
                    </div>
     
                </div>
            </div>
            </form>
            </div>
            </div>
        </div>
    </div>
 
  
    <!-- view record modal -->
    <div class="modal" tabindex="-1" id="view-modal">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
            <div class="modal-header">
{{--                 <h6 class="modal-title">Member Information</h6> --}}
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <p>
                    <b class="text-secondary">Full Name:</b>   <span id="name-info" class="text-dark"></span>
                </p>                --}}
                <p>
                    <b class="text-secondary">Full Name:</b>   <span id="name-info" class="text-dark"></span>
                </p>
                <p>
                    <b class="text-secondary">Gender:</b>   <span id="gender-info" class="text-dark"></span>
                </p>
                <p>
                    <b class="text-secondary">Phone:</b>   <span id="phone-info" class="text-dark"></span>
                </p>
                <p>
                    <b class="text-secondary">Email:</b>   <span id="email-info" class="text-dark"></span>
                </p>
                
              
            </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
  
        showAllProjects();
     
        /*
            This function will get all the project records
        */
        function showAllProjects()
        {
            let url = $('meta[name=app-url]').attr("content") + "/admin/projects";
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    $("#projects-table-body").html("");
                    let projects = response.projects;
                    for (var i = 0; i < projects.length; i++) 
                    {
                        let showBtn =  '<button ' +
                            ' class="btn btn-primary    " ' +
                            ' onclick="showProject(' + projects[i].id + ')">Show' +
                        '</button> ';
                        let editBtn =  '<button ' +
                            ' class="btn btn-secondary" ' +
                            ' onclick="editProject(' + projects[i].id + ')">Edit' +
                        '</button> ';
                        let deleteBtn =  '<button ' +
                            ' class="btn btn-danger" ' +
                            ' onclick="destroyProject(' + projects[i].id + ')">Delete' +
                        '</button>';
     
                        let projectRow = '<tr>' +
                            '<td>' + projects[i].fname + '&nbsp;' +projects[i].mname +  '&nbsp;' +projects[i].lname + '</td>' +
                            '<td>' + projects[i].phone + '</td>' +
                            '<td>' + projects[i].gender + '</td>' +
                            '<td>' + showBtn + editBtn + deleteBtn + '</td>' +
                        '</tr>';
                        $("#projects-table-body").append(projectRow);
                    }
     
                     
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }
     
        /*
            check if form submitted is for creating or updating
        */
        $("#save-project-btn").click(function(event ){
            event.preventDefault();
            if($("#update_id").val() == null || $("#update_id").val() == "")
            {
                storeProject();
            } else {
                updateProject();
            }
        })
     
        /*
            show modal for creating a record and 
            empty the values of form and remove existing alerts
        */
        function createProject()
        {
            $("#alert-div").html("");
            $("#error-div").html("");   
            $("#update_id").val("");
            $("#fname").val("");
            $("#mname").val("");
            $("#lname").val("");
            $("#gender").val("");
            $("#date_of_birth").val("");
            $("#jumuiya").val("");
            $("#email").val("");
            $("#password").val("");
            $("#phone").val("");
            $("#form-modal").modal('show'); 
        }
     
        /*
            submit the form and will be stored to the database
        */
        function storeProject()
        {   
            $("#save-project-btn").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/admin/projects";
            let data = {
                fname: $("#fname").val(),
                mname: $("#mname").val(),
                lname: $("#lname").val(),
                date_of_birth: $("#date_of_birth").val(),
                gender: $("#gender").val(),
                jumuiya: $("#jumuiya").val(),
                phone: $("#phone").val(),
                email: $("#email").val(),
                password: $("#password").val(),
                
                
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: data,
                success: function(response) {
                    $("#save-project-btn").prop('disabled', false);
                    let successHtml = '<div class="alert alert-success" role="alert"><b>Project Created Successfully</b></div>';
                    $("#alert-div").html(successHtml);
                    $("#alert-div").html("");
                    $("#error-div").html("");   
                    $("#update_id").val("");
                    $("#fname").val("");
                    $("#mname").val("");
                    $("#lname").val("");
                    $("#gender").val("");
                    $("#phone").val("");
                    $("#date_of_birth").val("");
                    $("#jumuiya").val("");
                    $("#email").val("");
                    $("#password").val("");
                    showAllProjects();
                    $("#form-modal").modal('hide');
                },
                error: function(response) {
                    $("#save-project-btn").prop('disabled', false);
     
                    /*
        show validation error
                    */
                    if (typeof response.responseJSON.errors !== 'undefined') 
                    {
        let errors = response.responseJSON.errors;
        let fnameValidation = "";
        if (typeof errors.fname !== 'undefined') 
                        {
                            fnameValidation = '<li>' + errors.fname[0] + '</li>';
                        }
         let mnameValidation = "";
        if (typeof errors.mname !== 'undefined') 
                        {
                            mnameValidation = '<li>' + errors.mname[0] + '</li>';
                        }
        let lnameValidation = "";
        if (typeof errors.lname !== 'undefined') 
                        {
                            lnameValidation = '<li>' + errors.lname[0] + '</li>';
                        }
        let emailValidation = "";
        if (typeof errors.email !== 'undefined') 
                        {
                            emailValidation = '<li>' + errors.email[0] + '</li>';
                        }
        let phoneValidation = "";
        if (typeof errors.phone !== 'undefined') 
                        {
                            phoneValidation = '<li>' + errors.phone[0] + '</li>';
                        }
         
        let errorHtml = '<div class="alert alert-danger" role="alert">' +
            '<b>Validation Error!</b>' +
            '<ul>' + fnameValidation + mnameValidation +lnameValidation + phoneValidation + '</ul>' +
        '</div>';
        $("#error-div").html(errorHtml);        
    }
                }
            });
        }
     
     
        /*
            edit record function
            it will get the existing value and show the project form
        */
        function editProject(id)
        {
            let url = $('meta[name=app-url]').attr("content") + "/admin/projects/" + id ;
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    let project = response.project;
                    $("#alert-div").html("");
                    $("#error-div").html("");   
                    $("#update_id").val(project.id);
                    $("#fname").val(project.fname);
                    $("#mname").val(project.mname);
                    $("#lname").val(project.lname);
                    $("#phone").val(project.phone);
                    $("#email").val(project.email);
                    $("#date_of_birth").val(project.date_of_birth);
                    $("#gender").val(project.gender);
                    $("#form-modal").modal('show'); 
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }
     
        /*
            sumbit the form and will update a record
        */
        function updateProject()
        {
            $("#save-project-btn").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/admin/projects/" + $("#update_id").val();
            let data = {
                id: $("#update_id").val(),
                name: $("#name").val(),
                description: $("#description").val(),
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "PUT",
                data: data,
                success: function(response) {
                    $("#save-project-btn").prop('disabled', false);
                    let successHtml = '<div class="alert alert-success" role="alert"><b>Project Updated Successfully</b></div>';
                    $("#alert-div").html(successHtml);
                    $("#name").val("");
                    $("#description").val("");
                    showAllProjects();
                    $("#form-modal").modal('hide');
                },
                error: function(response) {
                    /*
        show validation error
                    */
                    $("#save-project-btn").prop('disabled', false);
                    if (typeof response.responseJSON.errors !== 'undefined') 
                    {
                        console.log(response)
        let errors = response.responseJSON.errors;
        let descriptionValidation = "";
        if (typeof errors.description !== 'undefined') 
                        {
                            descriptionValidation = '<li>' + errors.description[0] + '</li>';
                        }
                        let nameValidation = "";
        if (typeof errors.name !== 'undefined') 
                        {
                            nameValidation = '<li>' + errors.name[0] + '</li>';
                        }
         
        let errorHtml = '<div class="alert alert-danger" role="alert">' +
            '<b>Validation Error!</b>' +
            '<ul>' + nameValidation + descriptionValidation + '</ul>' +
        '</div>';
        $("#error-div").html(errorHtml);        
    }
                }
            });
        }
     
        /*
            get and display the record info on modal
        */
        function showProject(id)
        {
            $("#name-info").html("");
            $("#description-info").html("");
            let url = $('meta[name=app-url]').attr("content") + "/admin/projects/" + id +"";
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    let project = response.project;
                    $("#name-info").html(project.fname+'&nbsp;'+project.mname+'&nbsp;'+project.lname);
                    $("#description-info").html(project.mname);
                    $("#gender-info").html(project.gender);
                    $("#phone-info").html(project.phone);
                    $("#email-info").html(project.email);

                    $("#view-modal").modal('show'); 
     
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }
     
        /*
            delete record function
        */
        function destroyProject(id)
        {
            let url = $('meta[name=app-url]').attr("content") + "/admin/projects/" + id;
            let data = {
                fname: $("#fname").val(),
                mname: $("#mname").val(),
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "DELETE",
                data: data,
                success: function(response) {
                    let successHtml = '<div class="alert alert-success" role="alert">Member was  Deleted Successfully</div>';
                    $("#alert-div").html(successHtml);
                    showAllProjects();
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }
     
    </script>
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
{{-- datatables --}}
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }} "></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script>
    $(document).ready( function () {
  $('#mytable').DataTable(
    {
      ordering:  false,
      searching:  true,
      autoWidth: false,
      responsive: true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }
  );
  } );
  </script>
</body>
</html>