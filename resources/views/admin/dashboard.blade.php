<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AhadiPledge| Dashboard</title>

  @php
  $setting= App\Models\Setting::get()->first();
  @endphp
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
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
      
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
      body {
          font-family: 'Nunito', sans-serif;
      }
  </style>
  
     <!-- Styles -->
   @livewireStyles
   @powerGridStyles
   <!-- Theme style -->
   <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
 {{-- for flex theme --}}
{{-- for flex theme --}}
@if($setting->theme=="light") 
<link href="{{ asset('css/flex.css') }}" rel="stylesheet">
@endif

@if($setting->theme=="dark") 

<link href="{{ asset('css/navy.css') }}" rel="stylesheet">

@endif


</head>
<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed">
<div class="wrapper">

  <!-- Preloader -->

  <!-- Navbar -->
  @include('layouts.inc.admin-navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar  @if($setting->theme=="light")  sidebar-light-navy @endif @if($setting->theme=="dark")  sidebar-dark-navy bg-flex @endif elevation-4">
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
          <div class="col-lg-3 col-6 col-sm-6 col-md-3" style="margin:0px !important;" data-toggle="tooltip" data-placement="bottom" title="This is the total of money pledges in {{ date('Y') }}">
            <!-- small box -->
            <div class="small-box bg-white border-top-flex">
              <div class="mx-auto text-center pt-4">
                {{-- <i class="fa fa-dollar-sign"></i> --}}
                {{-- <img src="{{ asset('icons/pledge.png') }}" alt="Flex Logo" class="" width="20%" height=""> --}}
              </div>
              <div class="text-center">
                <h6 class=""> 
                    Pledges Amount

                </h6>

                <h3 class="text-secondary">
                <img src="{{asset('icons/oath.png')}}" style="width:50px" height="50px"/>    
                  {{$pledges}}
                  <small>Tsh</small>
                </h3>
              </div>
              
              <a href="{{ url('admin/all-pledges') }}" class="small-box-footer bg-navy" style="background-color: #fafcfd  !important;">More info <i class="fas fa-arrow-circle-right "></i></a>
            </div>
          </div>
          {{-- end  --}}
          <div class="col-lg-3 col-6 col-sm-6 col-md-3" style="margin:0px !important;" data-toggle="tooltip" data-placement="bottom" title="This is the sum of pledge payments made in {{ date('Y')}}">
            <!-- small box -->
            <div class="small-box bg-white border-top-flex">
              <div class="mx-auto text-center pt-4">
                {{-- <i class="fa fa-dollar-sign"></i> --}}
                {{-- <img src="{{ asset('icons/salary.png') }}" alt="Flex Logo" class="" width="20%" height=""> --}}
              </div>
              <div class="text-center">
                <h6>                  
                  Pledges Payments  
                </h6>

                <h3 class="text-secondary">
                  <img src="{{asset('icons/money-bag.png')}}" style="width:50px" height="50px"/> 
                  {{$payments}}
                  <small>Tsh</small>
                </h3>
              </div>
              
              <a href="{{ url('admin/all-payments') }}" class="small-box-footer" style="background-color: #fafcfd  !important;">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

      

          {{-- start --}}
          <div class="col-lg-3 col-6 col-sm-6 col-md-3" style="margin:0px !important;" data-toggle="tooltip" data-placement="bottom" title="This is the total amount of money for unpaid pledges in {{ date('Y') }}">
            <!-- small box -->
            <div class="small-box bg-white border-top-flex">
              <div class="mx-auto text-center pt-4">
                {{-- <i class="fa fa-dollar-sign"></i> --}}
                {{-- <img src="{{ asset('icons/card.png') }}" alt="Flex Logo" class="" width="20%" height=""> --}}
              </div>
              <div class="text-center">
                <h6>                  
                  Remaining Payments
                </h6>

                <h3 class="text-secondary">
                  <img src="{{asset('icons/coins.png')}}" style="width:50px" height="50px"/> 
                  {{$remaining}}
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
            <div class="small-box bg-white border-top-flex">
              <div class="mx-auto text-center pt-4">
                {{-- <i class="fa fa-dollar-sign"></i> --}}
                {{-- <img src="{{ asset('icons/team.png') }}" alt="Flex Logo" class="" width="20%" height=""> --}}
              </div>
              <div class="text-center">
                <h6 >      
                               
                  Card Payments
                </h6>

                <h3 class="text-secondary">
                  <img src="{{asset('icons/debit-card.png')}}" style="width:50px" height="50px"/> 
                  {{$cards}}
                  <small>Tsh</small>
                </h3>
              </div>
              
              <a href="{{ url('admin/all-pledges') }}" class="small-box-footer" style="background-color: #fafcfd  !important;">More info <i class="fas fa-arrow-circle-right "></i></a>
            </div>
          </div>
     
          <!-- ./col -->

          <div class="col-md-12">
            <div class="card p-2 border-left-flex">
              <div class="row mb-1">
                <div class="row">
                  <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ url('admin/all-members')}}" style="color:black"class="text-decoration-none" data-toggle="tooltip" data-placement="bottom" title="This is the total number of the members of the congregation">
                    <div class="info-box">
                      <span class="info-box-icon bg-info elevation-1"><img src="{{asset('icons/hired.png')}}"/></span>
              
                      <div class="info-box-content">
                        <span class="info-box-text">Total Registered members</span>
                        <span class="info-box-number">
                          {{ $members }}
                        </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    </a>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ url('admin/all-members')}}" style="color:black"class="text-decoration-none" data-toggle="tooltip" data-placement="bottom" title="This is the total number of the members of the congregation">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-danger elevation-1">
                        <img src="{{asset('icons/avatar.png')}}"/>
                      </span>
              
                      <div class="info-box-content">
                        <span class="info-box-text">Total Male Members </span>
                        <span class="info-box-number">{{ $male }} </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    </a>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
              
                  <!-- fix for small devices only -->
                 
                  <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ url('admin/all-members')}}" style="color:black"class="text-decoration-none" data-toggle="tooltip" data-placement="bottom" title="This is the total number of the members of the congregation">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-success elevation-1">
                        <img src="{{asset('icons/female.png')}}"/>
                      </span>
              
                      <div class="info-box-content">
                        <span class="info-box-text">Total Female Members</span>
                        <span class="info-box-number"> {{ $female }} </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    </a>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ url('admin/all-communities')}}" 
                    style="color:black" class="text-decoration-none" data-toggle="tooltip" data-placement="bottom" title="This is the total number  of communities (Jumuiya) found in the congregation">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-success elevation-1">
                        <img src="{{asset('icons/epidemiology.png')}}" />
                      </span>
              
                      <div class="info-box-content">
                        <span class="info-box-text">Total Communities</span>
                        <span class="info-box-number">
                          {{ $communities}}
                           </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    </a>
                    <!-- /.info-box -->
                  </div>
                  <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ url('admin/all-pledges')}}" style="color:black" class="text-decoration-none" data-toggle="tooltip" data-placement="bottom" title="This is the total number of pledges that have been made in {{ date('Y')}}">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-success elevation-1">
                        <img src="{{asset('icons/swear.png')}}"/>
                      </span>
              
                      <div class="info-box-content">
                        <span class="info-box-text"> Total Pledges Made</span>
                        <span class="info-box-number">{{ $total_pledges}}</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    </a>
                    <!-- /.info-box -->
                  </div>
                  <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ url('admin/all-cards')}}" class="text-decoration-none" 
                    style="color:black" data-toggle="tooltip" data-placement="bottom" title="This is the total number of card members that have been created and issued">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-success elevation-1">
                        <img src="{{asset('icons/debit-card.png')}}"/>
                      </span>
              
                      <div class="info-box-content">
                        <span class="info-box-text">Total Member Cards Created</span>
                        <span class="info-box-number">{{ $total_cards}} </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    </a>
                    <!-- /.info-box -->
                  </div>
                  <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ url('admin/all-purposes')}}" 
                    style="color:black" class="text-decoration-none" data-toggle="tooltip" data-placement="bottom" title="This the amount of money that has been collected from both pledges and cards in {{ date('Y')}}">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-success elevation-1">
                        <img src="{{asset('icons/contribution.jpg')}}"/>
                      </span>
              
                      <div class="info-box-content">
                        <span class="info-box-text">Total Contributions in {{ date('Y')}}</span>
                        <span class="info-box-number">{{ $contributions}} </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    </a>
                    <!-- /.info-box -->
                  </div>
              
                  <!-- /.col -->
                </div>
               
              {{-- start of statistics --}}
              {{-- <div class="col-md-12">
                <a href="{{ url('admin/all-members')}}" class="text-decoration-none" data-toggle="tooltip" data-placement="bottom" title="This is the total number of the members of the congregation">
                  <div class="row starts-border"  >
                    <div class="col-md-6"> <h6 class="text-secondary">Total Registered Members </h6></div>
                    <div class="col-md-6 text-right"><h6 class="font-weight-bolder text-dark"> {{ $members}}</h6></div>
                  </div>
                </a>
                <a href="{{ url('admin/all-members')}}" class="text-decoration-none" data-toggle="tooltip" data-placement="bottom" title="This is the total number of members of the congregation who are male">
                  <div class="row starts-border" >
                    <div class="col-md-6"> <h6 class="text-secondary">Total Male Members </h6></div>
                    <div class="col-md-6 text-right"><h6 class="font-weight-bolder text-dark"> {{ $male}}</h6></div>
                  </div>
                </a>
                <a href="{{ url('admin/all-members')}}" class="text-decoration-none" data-toggle="tooltip" data-placement="bottom" title="This is the total number of members of the congregation who are female">
                  <div class="row starts-border" >
                    <div class="col-md-6"> <h6 class="text-secondary">Total Female Members </h6></div>
                    <div class="col-md-6 text-right"><h6 class="font-weight-bolder text-dark"> {{ $female}}</h6></div>
                  </div>
                </a>
                 <a href="{{ url('admin/all-communities')}}" class="text-decoration-none" data-toggle="tooltip" data-placement="bottom" title="This is the total number  of communities (Jumuiya) found in the congregation">
                  <div class="row starts-border">
                    <div class="col-md-6"> <h6 class="text-secondary"> Total Communities</h6></div>
                    <div class="col-md-6 text-right"><h6 class="font-weight-bolder text-dark" >{{ $communities}}</h6></div>
                  </div>
                 </a>

                 <a href="{{ url('admin/all-pledges')}}" class="text-decoration-none" data-toggle="tooltip" data-placement="bottom" title="This is the total number of pledges that have been made in {{ date('Y')}}">
                  <div class="row starts-border">
                    <div class="col-md-6"> <h6 class="text-secondary"> Total Pledges Made</h6></div>
                    <div class="col-md-6 text-right"><h6 class="font-weight-bolder text-dark" >{{ $total_pledges}}</h6></div>
                  </div>
                 </a>
                 <a href="{{ url('admin/all-cards')}}" class="text-decoration-none" data-toggle="tooltip" data-placement="bottom" title="This is the total number of card members that have been created and issued">
                  <div class="row starts-border">
                    <div class="col-md-6"> <h6 class="text-secondary"> Total Member Cards Created</h6></div>
                    <div class="col-md-6 text-right"><h6 class="font-weight-bolder text-dark">{{ $total_cards}}</h6></div>
                  </div>
                 </a>
                 <a href="{{ url('admin/all-purposes')}}" class="text-decoration-none" data-toggle="tooltip" data-placement="bottom" title="This the amount of money that has been collected from both pledges and cards in {{ date('Y')}}">
                  <div class="row starts-border">
                    <div class="col-md-6"> <h6 class="text-secondary">Total Contributions in {{ date('Y')}}</h6></div>
                    <div class="col-md-6 text-right"><h6 class="font-weight-bolder text-dark" >{{ $contributions}}</h6></div>
                  </div>
                 </a>
              
                </div>
              end of statistics --}}
              
           
              </div>
              
              </div>
              
          </div>

        </div>
        <!-- /.row -->
       
        <!-- Main row -->
        <div class="row">
          <div class="col-md-6">
              <div class="card">
                  <div class="card-body">
                      <h4>Registered Users</h4>

                      <div class="mt-3 chartjs-chart">
                          <canvas id="myChart">

                          </canvas>
                          

                      </div>
                      
                  </div> <!-- end card-body-->
              </div> <!-- end card-->
          </div> <!-- end col -->

          <div class="col-xl-6">
              <div class="card">
                  <div class="card-body">
                      
                      <h4>Pledge payment graph</h4>
                      
                      <div class="mt-3 chartjs-chart">
                          <canvas id="graphs"></canvas>
                      </div>
                  </div>
              </div> <!-- end card-->
          </div> <!-- end col -->
      </div>

 
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- ChartJS -->
{{-- end --}}
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<!-- Page specific script -->
<script>
  @if(Session::has('message'))
  var type = "{{ Session::get('alert-type','info') }}"
  switch(type){
     case 'info':
     toastr.info(" {{ Session::get('message') }} ");
     break;
 
     case 'success':
     toastr.success(" {{ Session::get('message') }} ");
     break;
 
     case 'warning':
     toastr.warning(" {{ Session::get('message') }} ");
     break;
 
     case 'error':
     toastr.error(" {{ Session::get('message') }} ");
     break; 
  }
  @endif 
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
     
            
<script>
  const ctx = document.getElementById('myChart');
     console.log("halooo");
      
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels:{!!json_encode($pmonths) !!},
        datasets: [{
          label: 'the number of new registered users',
          data: {!!json_encode($counts) !!},
          backgroundColor: [
          'rgb(60, 179, 113)',
      
      ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            title: {
            display: true,
            text: 'our registered member',
          }
       
          }
  
          //the x axis title graph setups
          
        }
      }
    });
    
    
  </script>
  
          {{-- end of starting bar chart --}}
      {{-- ending of chart estimation --}}
      <script type="text/javascript">
          const graphs = document.getElementById('graphs');
         
        
          new Chart(graphs, {
            type: 'line',
            data: {
              labels:{!!json_encode($months) !!},
              datasets: [{
                label: 'pledge payment graph',
                data: {!!json_encode($sums) !!},
                backgroundColor: [
                  'rgb(60, 179, 113)',
            
            ],
            fill: false,
            borderColor: 'rgb(60, 179, 113)',
            tension: 0.1,
        
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true,
                  title: {
                  display: true,
                  text: 'plege per payment',
                }
             
                }
        
                //the x axis title graph setups
                
              }
            }
          });
          
        </script>

</body>
</html>
