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
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->

  <!-- Navbar -->
  @include('layouts.inc.member-navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-navy elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('member/dashboard') }}" class="brand-link">
      <img src="{{ asset('img/flex.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light text-navy">AhadiPledge</span>
    </a>

    <!-- Sidebar -->
    @include('layouts.inc.member-sidebar')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <div class="content-header ">
      <div class="">
        <div class="row mb-0">
          <div class="col-sm-6 col-6">
            <h5 class="m-0 text-white">
              {{-- <span class="btn badge bg-navy disabled" >
                Hello, {{ Auth::User()->fname}}  {{ Auth::User()->mname}}  {{ Auth::User()->lname}}
              </span> --}}
            </h5>
          </div><!-- /.col -->
          <div class="col-sm-6 col-6">
            <ol class="float-sm-right" type="none">
              <h5 class="float-end">
                <span class=" badge bg-navy ">
                  <i class="fa fa-clock"></i> &nbsp;
                  {{ date(('D, d M, Y'))}}
                </span>
               </h5>
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
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-lightblue">
              <div class="inner">
                <h5 class=" font-weight-bolder"> 
                  {{$pledges}}
                  <small>Tsh</small>              
                </h5>

                <p>Pledges Amount</p>
              </div>
              <div class="icon">
                <i class="fa fa-dollar-sign"></i>
              </div>
              <a href="#" class="small-box-footer ">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-cyan">
              <div class="inner">
                <h5 class=" font-weight-bolder"> 
                  {{$payments}}
                  <small>Tsh</small>
                </h5>

                <p>Paid Pledges</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h5 class=" font-weight-bolder"> 
                  {{$remaining}}
                  <small>Tsh</small>
                </h5>

                <p>Remaining Amount</p>
              </div>
              <div class="icon">
                <i class="fa fa-credit-card"></i>
              </div>
              <a href="#" class="small-box-footer ">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
                <h5 class=" font-weight-bolder"> 
                  {{$pledges_no}}
                </h5>

                <p>Pledges Made</p>
              </div>
              <div class="icon mb-1">
                <i class="fa fa-balance-scale"></i>
              </div>
              <a href="#" class="small-box-footer ">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row ">
        {{--start of Goal Progress  --}}

          <div class="col-md-12">
            <div class="">
              <div class="p-2">
                <h6 class="text-secondary font-weight-bolder">
                <span class="btn bg-white disabled text-navy">
                  Overall Goal Progress in {{ date('Y')}}
                </span>
               </h6>
              </div>
              <div class="">

               
                <div class="col-md-12 py-2">
                <div class="progress"  style="height:25px;">
                  <div class="progress-bar 
                  progress-bar-striped 
                  progress-bar-animated
                  @if($progress<=25)
                  bg-danger
                  @elseif($progress>25 && $progress<=50)
                  bg-warning
                  @elseif($progress>50 && $progress<=75)
                  bg-primary
                  @else
                  bg-success
                  @endif
                  "

                  role="progressbar" style="width: {{ $progress}}%" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100">{{$progress}}%</div>
                </div>
                </div>

             
              </div>
            </div>
          </div>

          <div class="p-2 col-md-12">
            <h6 class="text-secondary font-weight-bolder">
            <span class="btn bg-white disabled text-navy">
              Daily Statistics and Activities in {{ date('Y')}}
            </span>
           </h6>
          </div>

          {{-- stats --}}
         
            <div class="col-md-6 mb-2">
              <div id="container"></div>
            </div>
            <div class="col-md-6 mb-2">
              <div class="card">
              <div class="card-header bg-light">
                <h6 class="text-secondary font-weight-bolder">Latest Pledges Progress</h6>
              </div>
              <div class="row">
              @foreach($mypledges as $item)
              
              
                <div class="col-md-12 mt-2">
                  <div class="card">
                    <div class="card-header">
                      <h6 class="text-secondary ">
                        {{ $item->id }}
                        {{ $item->name }}
                      </h6>
                    </div>
                    <div class="">
      
                      @php
                         $purpose= "{$item->id}" ; 
                         
                         $user=Auth::User()->id;
                         $payment=App\Models\Payment::where('user_id',$user)->where('pledge_id',$purpose)->whereYear('created_at', date('Y'))->sum('amount');
                         $amount="{$item->amount}";
                         $number=($payment/$amount)*100;//progress formular
                         $progress=number_format((float)$number, 2, '.', '');
                      @endphp
                      <div class="col-md-12 py-2">
                      <div class="progress"  style="height:20px;">
                        <div class="progress-bar 
                        progress-bar-striped 
                        progress-bar-animated
                        @if($progress<=25)
                        bg-danger
                        @elseif($progress>25 && $progress<=50)
                        bg-warning
                        @elseif($progress>50 && $progress<=75)
                        bg-primary
                        @else
                        bg-success
                        @endif
                        "
      
                        role="progressbar" style="width: {{ $progress}}%" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100">{{$progress}}%</div>
                      </div>
                      </div>
      
                   
                    </div>
                  </div>
                </div>
              
               @endforeach
              </div>
            </div>
            </div>
       
        </div>

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('layouts.inc.member-footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

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
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<script type="text/javascript">

  var users =  <?php echo json_encode($payrate) ?>;
  
  
  
  Highcharts.chart('container', {
  
      title: {
  
          text: 'Pledge Payments Trend'
  
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
