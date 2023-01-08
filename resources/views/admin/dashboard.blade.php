<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AhadiPledge| Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
  {{-- datatables --}}
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
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
    .text-navy{
      color: #1888cb !important;
    }
    .paginate_button{
      margin: 1px !important;
    }
    .paginate_button.disabled{
      color: gainsboro !important;
    }
    .dataTables_paginate .paginate_button:hover{
      border: 1px solid transparent !important;
      background: transparent !important;
    }

    .current {
        border-left: 0.45rem solid #1888cb !important;
        background-color:#f2f3f4 !important;
      }
    .bg-teal{
      background-color: #01b4f2 !important;
    }
    
    .text-teal{
      color: #01b4f2 !important;
    }
      .border-bottom-navy {
        border-bottom: 0.25rem solid #1888cb !important;
      }
      .border-top-navy {
        border-top: 0.25rem solid #1888cb !important;
      }
      .nav-tabs .nav-link.active{
        background-color: #1888cb  !important;
        font-weight:bold;
        color: #e5e9ec !important;
      }
      .marginRow{
   margin-bottom:0px !important; 
   }

   
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->

  <!-- Navbar -->
  @include('layouts.inc.admin-navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-navy elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('admin/dashboard') }}" class="brand-link">
      <img src="{{ asset('img/flex.png') }}" alt="Flex Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-secondary"></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"></a></li>
              <li class="breadcrumb-item active"></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="">
        <!-- Small boxes (Stat box) -->
        <div class="row g-1"  >

          {{-- start  --}}
          <div class="col-lg-3 col-6 col-sm-6 col-md-3" style="margin:0px !important;">
            <!-- small box -->
            <div class="small-box bg-white border-top-navy">
              <div class="mx-auto text-center pt-4">
                {{-- <i class="fa fa-dollar-sign"></i> --}}
                <img src="{{ asset('icons/pledge.png') }}" alt="Flex Logo" class="" width="20%" height="">
              </div>
              <div class="text-center">
                <h6 class="">                  
                  Pledges Amount
                </h6>

                <h3 class="text-secondary">
                  {{$pledges}}
                  <small>Tsh</small>
                </h3>
              </div>
              
              <a href="{{ url('admin/all-pledges') }}" class="small-box-footer bg-navy" style="background-color: #fafcfd  !important;">More info <i class="fas fa-arrow-circle-right "></i></a>
            </div>
          </div>
          {{-- end  --}}
          <div class="col-lg-3 col-6 col-sm-6 col-md-3" style="margin:0px !important;">
            <!-- small box -->
            <div class="small-box bg-white border-top-navy">
              <div class="mx-auto text-center pt-4">
                {{-- <i class="fa fa-dollar-sign"></i> --}}
                <img src="{{ asset('icons/salary.png') }}" alt="Flex Logo" class="" width="20%" height="">
              </div>
              <div class="text-center">
                <h6>                  
                  Pledges Payments  
                </h6>

                <h3 class="text-secondary">
                  {{$payments}}
                  <small>Tsh</small>
                </h3>
              </div>
              
              <a href="{{ url('admin/all-payments') }}" class="small-box-footer" style="background-color: #fafcfd  !important;">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

      

          {{-- start --}}
          <div class="col-lg-3 col-6 col-sm-6 col-md-3" style="margin:0px !important;">
            <!-- small box -->
            <div class="small-box bg-white border-top-navy">
              <div class="mx-auto text-center pt-4">
                {{-- <i class="fa fa-dollar-sign"></i> --}}
                <img src="{{ asset('icons/card.png') }}" alt="Flex Logo" class="" width="20%" height="">
              </div>
              <div class="text-center">
                <h6>                  
                  Card Payments
                </h6>

                <h3 class="text-secondary">
                  {{$pledges}}
                  <small>Tsh</small>
                </h3>
              </div>
              
              <a href="{{ url('admin/all-pledges') }}" class="small-box-footer" style="background-color: #fafcfd  !important;">More info <i class="fas fa-arrow-circle-right "></i></a>
            </div>
          </div>

          {{--  start --}}

          <!-- ./col -->

          <div class="col-lg-3 col-6 col-sm-6 col-md-3" style="margin:0px !important;">
            <!-- small box -->
            <div class="small-box bg-white border-top-navy">
              <div class="mx-auto text-center pt-4">
                {{-- <i class="fa fa-dollar-sign"></i> --}}
                <img src="{{ asset('icons/team.png') }}" alt="Flex Logo" class="" width="20%" height="">
              </div>
              <div class="text-center">
                <h6 >                   
                  Total Members
                </h6>

                <h3 class="text-secondary">
                  {{$members}}
                </h3>
              </div>
              
              <a href="{{ url('admin/all-pledges') }}" class="small-box-footer" style="background-color: #fafcfd  !important;">More info <i class="fas fa-arrow-circle-right "></i></a>
            </div>
          </div>
     
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row mx-auto">
          <div class="col-md-6 mt-1 mb-1 ">
            <div id="container"></div>
          </div>
          <div class="col-md-6 mt-1 mb-1">
            <div id="container1"></div>
          </div>
      </div><!-- /.container-fluid -->

 
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('layouts.inc.admin-footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->


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
<script type="text/javascript">

    var users =  <?php echo json_encode($users) ?>;

   

    Highcharts.chart('container', {

        title: {

            text: 'New Members Growth'

        },

 

         xAxis: {

            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

        },

        yAxis: {

            title: {

                text: 'Number of New Users'

            }

        },

        legend: {

            layout: 'vertical',

            align: 'right',

            verticalAlign: 'middle'

        },

        plotOptions: {

            series: {

                allowPointSelect: true

            }

        },

        series: [{

            name: 'New Members',

            data: users

        }],

        responsive: {

            rules: [{

                condition: {

                    maxWidth: 500

                },

                chartOptions: {

                    legend: {

                        layout: 'horizontal',

                        align: 'center',

                        verticalAlign: 'bottom'

                    }

                }

            }]

        }

});


</script>

<script type="text/javascript">

var users =  <?php echo json_encode($payrate) ?>;



Highcharts.chart('container1', {

    title: {

        text: 'Payments Growth'

    },



     xAxis: {

        categories: ['Mon', 'Tue', 'Wed', 'Thurs', 'Fri', 'Sat', 'Sun']

    },

    yAxis: {

        title: {

            text: 'Payment Amount (TSH)'

        }

    },

    legend: {

        layout: 'vertical',

        align: 'right',

        verticalAlign: 'middle'

    },

    plotOptions: {

        series: {

            allowPointSelect: true

        }

    },

    series: [{

        name: 'Amount',

        data: users

    }],

    responsive: {

        rules: [{

            condition: {

                maxWidth: 500

            },

            chartOptions: {

                legend: {

                    layout: 'horizontal',

                    align: 'center',

                    verticalAlign: 'bottom'

                }

            }

        }]

    }

});

</script>

</body>
</html>
