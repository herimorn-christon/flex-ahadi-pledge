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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>--}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.7/fullcalendar.min.js"></script> 
  {{-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
  {{-- <link rel="stylesheet" ref="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/> --}}
    {{-- for flex theme --}}
    <link href="{{ asset('css/flex.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed">
<div class="wrapper">

  <!-- Preloader -->

  <!-- Navbar -->
  @include('layouts.inc.member-navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-navy elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('member/dashboard') }}" class="text-decoration-none brand-link">
      <img src="{{ asset('img/flex.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light text-white">AhadiPledge</span>
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
        <div class="row mb-0 g-1">
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

              {{-- start  --}}
              <div class="col-lg-3 col-6 col-sm-6 col-md-3" style="margin:0px !important;">
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
                      {{$total_amount}}
                      <small>Tsh</small>
                    </h3>
                  </div>
                  
                  <a href="{{ url('admin/all-pledges') }}" class="small-box-footer bg-navy" style="background-color: #fafcfd  !important;">More info <i class="fas fa-arrow-circle-right "></i></a>
                </div>
              </div>
              {{-- end  --}}

                   {{-- start  --}}
                   <div class="col-lg-3 col-6 col-sm-6 col-md-3" style="margin:0px !important;">
                    <!-- small box -->
                    <div class="small-box bg-white border-top-flex">
                      <div class="mx-auto text-center pt-4">
                        {{-- <i class="fa fa-dollar-sign"></i> --}}
                        {{-- <img src="{{ asset('icons/pledge.png') }}" alt="Flex Logo" class="" width="20%" height=""> --}}
                      </div>
                      <div class="text-center">
                        <h6 class="">                  
                          Paid Pledges
                        </h6>
        
                        <h3 class="text-secondary">
                          {{$payments}}
                          <small>Tsh</small>
                        </h3>
                      </div>
                      
                      <a href="{{ url('admin/all-pledges') }}" class="small-box-footer bg-navy" style="background-color: #fafcfd  !important;">More info <i class="fas fa-arrow-circle-right "></i></a>
                    </div>
                  </div>
                  {{-- end  --}}

    
                   {{-- start  --}}
                   <div class="col-lg-3 col-6 col-sm-6 col-md-3" style="margin:0px !important;">
                    <!-- small box -->
                    <div class="small-box bg-white border-top-flex">
                      <div class="mx-auto text-center pt-4">
                        {{-- <i class="fa fa-dollar-sign"></i> --}}
                        {{-- <img src="{{ asset('icons/pledge.png') }}" alt="Flex Logo" class="" width="20%" height=""> --}}
                      </div>
                      <div class="text-center">
                        <h6 class="">                  
                          Remaining Amount
                        </h6>
        
                        <h3 class="text-secondary">
                          {{$remaining}}
                          <small>Tsh</small>
                        </h3>
                      </div>
                      
                      <a href="{{ url('admin/all-pledges') }}" class="small-box-footer bg-navy" style="background-color: #fafcfd  !important;">More info <i class="fas fa-arrow-circle-right "></i></a>
                    </div>
                  </div>
                  {{-- end  --}}

                  
                   {{-- start  --}}
                   <div class="col-lg-3 col-6 col-sm-6 col-md-3" style="margin:0px !important;">
                    <!-- small box -->
                    <div class="small-box bg-white border-top-flex">
                      <div class="mx-auto text-center pt-4">
                        {{-- <i class="fa fa-dollar-sign"></i> --}}
                        {{-- <img src="{{ asset('icons/pledge.png') }}" alt="Flex Logo" class="" width="20%" height=""> --}}
                      </div>
                      <div class="text-center">
                        <h6 class="">                  
                          Total Card Payments
                        </h6>
        
                        <h3 class="text-secondary">
                          {{$cardpayments}}
                          <small>Tsh</small>
                        </h3>
                      </div>
                      
                      <a href="{{ url('admin/all-pledges') }}" class="small-box-footer bg-navy" style="background-color: #fafcfd  !important;">More info <i class="fas fa-arrow-circle-right "></i></a>
                    </div>
                  </div>
                  {{-- end  --}}

     
                  <div class="col-md-12">
                    <div class="card border-left-flex">
                      <div class="row mb-1 m-2">
                       
                      {{-- start of statistics --}}
                      <div class="col-md-12">
                          <div class="row starts-border" >
                            <div class="col-md-6"> <h6 class="text-secondary">Total Pledges Made in {{ date('Y')}} </h6></div>
                            <div class="col-md-6 text-right"><h6 class="font-weight-bolder"> {{ $total_pledges}}</h6></div>
                          </div>
                          <div class="row starts-border">
                            <div class="col-md-6"> <h6 class="text-secondary">Total Money Pledges in {{ date('Y')}}</h6></div>
                            <div class="col-md-6 text-right" ><h6 class="font-weight-bolder">({{$total_amount.' Tsh'}}) {{ $cash_pledges}}</h6></div>
                          </div>
                          <div class="row starts-border">
                            <div class="col-md-6"> <h6 class="text-secondary"> Total Object Pledges in {{ date('Y')}} </h6></div>
                            <div class="col-md-6 text-right"><h6 class="font-weight-bolder" >{{ $object_pledges}}</h6></div>
                          </div>
                          <div class="row starts-border">
                            <div class="col-md-6"> <h6 class="text-secondary"> Total Amount Contributed in {{date('Y')}}</h6></div>
                            <div class="col-md-6 text-right"><h6 class="font-weight-bolder">{{ $cardpayments+$payments}} Tsh</h6></div>
                          </div>
                          
                          
        
                      
                        </div>
                      {{-- end of statistics --}}
                      
                      <div class="col-md-12 mt-1">
                        <div class="">
                          <div class="p-2">
                            <h6 class="text-secondary font-weight-bolder">
                            <span class="bg-white disabled text-navy">
                              Overall Goal Progress in {{ date('Y')}}
                            </span>
                           </h6>
                          </div>
                          <div class="">
            
                           
                            <div class="col-md-12 py-2">
                            <div class="progress"  style="height:15px;">
                              <div class="progress-bar 
                              {{-- progress-bar-striped  --}}
                              progress-bar-animated
                              @if($progress<=25)
                              bg-flex
                              @elseif($progress>25 && $progress<=50)
                              bg-flex
                              @elseif($progress>50 && $progress<=75)
                              bg-flex
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
                   
                      </div>
                      
                      </div>
                      
                  </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row ">
         <div class="col-md-6" >
          <div class="card" style="height:400px !important;">

            <div class="card-header bg-white text-secondary">
              <i class="fa fa-balance-scale"></i>
              Latest Pledges Progress
            </div>
            <div id="container7">
           
                <div class="row px-2">
                @foreach($mypledges as $item)
                
                
                  <div class="col-md-12 mt-2">
                    <div class="row p-1">
                    <div class="col-md-6">
                        <h6 class="text-secondary ">
                          {{ $item->name }}
                        </h6>
                      </div>
                      <div class="col-md-6">
        
                        <?php
  
                           $purpose= "{$item->id}" ; 
                           
                           $user=Auth::User()->id;
                           $payment=App\Models\Payment::where('user_id',$user)->where('pledge_id',$purpose)->whereYear('created_at', date('Y'))->sum('amount');
                           $amount="{$item->amount}";
                           if ($amount<=0) {
                            $progress=0;
                            ?>
                        <div class="col-md-12 py-2">
                        <div class="progress"  style="height:14px;">
                          <div class="progress-bar 
                          {{-- progress-bar-striped  --}}
                          progress-bar-animated
                          @if($progress<=25)
                          bg-flex
                          @elseif($progress>25 && $progress<=50)
                          bg-flex
                          @elseif($progress>50 && $progress<=75)
                          bg-flex
                          @else
                          bg-success
                          @endif
                          "
        
                          role="progressbar" style="width: {{ $progress}}%" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100">{{$progress}}%</div>
                        </div>
                        </div> 
                        <?php
                           }
                           else {
                            $number=($payment/$amount)*100;//progress formular
                           $progress=number_format((float)$number, 2, '.', ''); ?>
                         
                        <div class="col-md-12 py-2">
                        <div class="progress"  style="height:14px;">
                          <div class="progress-bar 
                          {{-- progress-bar-striped  --}}
                          progress-bar-animated
                          @if($progress<=25)
                          bg-flex
                          @elseif($progress>25 && $progress<=50)
                          bg-flex
                          @elseif($progress>50 && $progress<=75)
                          bg-flex
                          @else
                          bg-success
                          @endif
                          "
        
                          role="progressbar" style="width: {{ $progress}}%" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100">{{$progress}}%</div>
                        </div>
                        </div>
  
                        <?php } ?>
                        
                        
                      
        
                      </div>
                      </div>
                    </div>
                
                 @endforeach
                </div>
            </div>
       
        </div>
        </div>
            {{-- start of upcoming events --}}
            <div class="col-md-6 mb-2 ">
              <div class="card" style="height:400px !important;">
                <div class="card-header bg-white text-secondary">
                  <i class="fa fa-calendar"></i>
                  Today's Events
                </div>
                {{-- <div class="card-body" id='calend' style="height:540px !important;"></div> --}}

                <div class="card-body">
                  @php
                  $date=date('Y-m-d');
                  $events=App\Models\Todo::where('date',$date)->get();
                  @endphp

                  @forelse($events as $item)
                  <p>
                    {{ $item->date}} {{ $item->title}}
                  </p>
                  @empty
                  <p class="py-5 my-5">There is no Events Today !</p>

                  @endforelse
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
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script>
    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar2').fullCalendar({
            // put your options and callbacks here
            events : [
                @foreach($events as $event)
                {
                    title : '{{ $event->event_name }}',
                    start : '{{ $event->start_date }}',
                    end : '{{ $event->end_date }}',
                    url : ''
                },
                @endforeach
            ]
        })
    });
</script>

<script>
    $(document).ready(function () {
        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            navLinks: false,
            editable: true,
            events: [
                @foreach($events as $event)
                {
                    title : '{{ $event->event_name }}',
                    start : '{{ $event->start_date }}',
                    end : '{{ $event->end_date }}'
                },
                @endforeach
            ],           
            displayEventTime: false,
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
            var title = prompt('Event Title:');
            if (title) {
                var start = moment(start, 'DD.MM.YYYY').format('YYYY-MM-DD');
                var end = moment(end, 'DD.MM.YYYY').format('YYYY-MM-DD');
                $.ajax({
                    url: 'createevent',
                    data: 'title=' + title + '&start=' + start + '&end=' + end +'&_token=' +"{{ csrf_token() }}",
                    type: "post",
                    success: function (data) {
                        alert("Added Successfully");
                    }
                });
                calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                true
                        );
            }
            calendar.fullCalendar('unselect');
        },
        eventClick: function (event) {
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
                $.ajax({
                    type: "POST",
                    url: "delete",
                    data: "&id=" + event.id+'&_token=' +"{{ csrf_token() }}",
                    success: function (response) {
                        if(parseInt(response) > 0) {
                            $('#calendar').fullCalendar('removeEvents', event.id);
                            alert("Deleted Successfully");
                        }
                    }
                });
            }
        }
        });
    });
</script>
</body>
</html>
