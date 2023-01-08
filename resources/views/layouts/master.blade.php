<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <meta name="csrf-token" content="{{ csrf_token() }}">

   
     <meta name="app-url" content="{{ url('/') }}">
  

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  {{-- <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"> --}}
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  
  <!-- JQVMap -->
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
  

  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <!-- DataTables -->
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Theme style -->
    {{-- for autosearch --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css"> --}}
    {{--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <link href="{{ asset('assets/css/datatables.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/datatables.js') }}" ></script>
<script src="{{ asset('assets/js/datatables-simple-demo.js') }}" ></script>
    <style>
      .page-item.active .page-link{
          color: whitesmoke !important;
          background-color: #1888cb  !important; 
          border: none;
      }
  
       .page-link {
        
          text-decoration: none !important;
          color:#1888cb  !important;
      }
      .bg-flex{
        background-color: #1888cb;
      }
      .bg-navy{
        background-color: #1888cb !important;
      }
   
      .paginate_button.disabled{
        color: gainsboro !important;
      }
      .dataTables_paginate .paginate_button:hover{
        /* border: 1px solid transparent !important; */
        background: transparent !important;
      }

      .current {
          border-left: 0.45rem solid #1888cb !important;
          background-color:#f2f3f4 !important;
        }
      .bg-teal{
        background-color: #01b4f2 !important;
      }
      
        .border-bottom-navy {
          border-bottom: 0.25rem solid #001f3f !important;
        }

        .nav-tabs .nav-link.active{
          background-color: #1888cb  !important;
          font-weight:light;
          color: #e5e9ec !important;
        }
        table.#example {
        border-collapse: collapse !important;
        width: 100% !important;
        
        }
        .dataTable-selector{
          background-color:  white  !important;
        }
        .dt-buttons .button-group{
          margin: 1px !important;
          background-color: #001f3f;
        }
        button.btn-secondary:nth-child(3){
          border: 1px solid  #01b4f2  !important;
          background-color: white  !important;
          margin: 1px !important;
          color: #1888cb  !important;
        }
        button.btn-secondary:nth-child(2){
          border: 1px solid #1888cb  !important;
          background-color: white  !important;
          margin: 1px !important;
          color: #1888cb  !important;
        }
        button.btn-secondary:nth-child(1){
          border: 1px solid #1888cb  !important;
          background-color: white  !important;
          margin: 1px !important;
          color: #1888cb  !important;
        }
        button.btn-secondary:nth-child(1):hover{
          border: 1px solid #01b4f2  !important;
          background-color: #01b4f2  !important;
          margin: 1px !important;
          color: white  !important;
        }
        button.btn-secondary:nth-child(2):hover{
          border: 1px solid #01b4f2  !important;
          background-color: #01b4f2  !important;
          margin: 1px !important;
          color: white  !important;
        }
        button.btn-secondary:nth-child(3):hover{
          border: 1px solid #01b4f2 !important;
          background-color:#01b4f2  !important;
          margin: 1px !important;
          color: white  !important;
        }
  </style>
  {{-- for flex theme --}}
    <link href="{{ asset('css/flex.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  

  <!-- Navbar -->
  @include('layouts.inc.admin-navbar')
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-navy elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('admin/dashboard') }}" class="text-decoration-none brand-link">
      <img src="{{ asset('img/flex.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text text-white font-weight-light">AhadiPledge</span>
    </a>

    <!-- Sidebar -->
    @include('layouts.inc.admin-sidebar')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="">
 
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      
      <div class=" mt-3">
        
        @yield('content')

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer mt-4">
    <strong>Copyright &copy; {{ date('Y')}} <a href="#" class="text-decoration-none text-flex">AhadiPledge</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 0.0.1
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<script>
  // for enabling tooltips
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(document).ready( function () {
$('#modaltable').DataTable(
  {
      autoWidth:true,
      rowReorder: {
            selector: 'tr'
        },
        columnDefs: [
            { targets: 0, visible: true }
        ]
  }
);
} );

</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["csv", "excel", "pdf"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  $(function () {
    $("#mytable").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["csv", "excel", "pdf"]
    }).buttons().container().appendTo('#mytable_wrapper .col-md-6:eq(0)');
    $('#table').DataTable({
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
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

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
{{-- end --}}
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["csv", "excel", "pdf", "colvis"]
    }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
    $('mytable1').DataTable({
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
<script src="{{ asset('assets/js/datatables.js') }}" ></script>
<script src="{{ asset('assets/js/datatables-simple-demo.js') }}" ></script>
 @yield('scripts')
</body>
</html>
