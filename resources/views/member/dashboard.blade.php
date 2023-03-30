@extends('layouts.member')

@section('title','My dashboad')


@section('content')

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

                  <!--debugging the progress-->


                 <!--end of the debugging process-->
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


              
             

               {{-- start --}}
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
                        total Paid Pledges
                      </h6>
      
                      <h3 class="text-secondary">
                        {{$payment_total}}
                        <small>Tsh</small>
                      </h3>
                    </div>
                  
                    
                    <a href="{{ url('admin/all-pledges') }}" class="small-box-footer bg-navy" style="background-color: #fafcfd  !important;">More info <i class="fas fa-arrow-circle-right "></i></a>
                  </div>
                </div>


               {{-- ends --}}


                      {{-- -start here  --}}

                       {{-- start  --}}
         



                      {{-- ends here --}}



    
                   {{-- start  --}}
                   
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
                              <?php 
                              if($total_amount==0){
                                $progress=0;
                              }
                              ?>
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
                           $payment=App\Models\Payment::where('user_id',$user)->where('pledge_id',$purpose)->where('verified',1)->whereYear('created_at', date('Y'))->sum('amount');
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
                  $events=App\Models\Todo::where('date',$date)->orderBy('created_at','Asc')->limit(3)->get();
                  @endphp

                  @forelse($events as $item)
                  <h5>
                    <span class="badge bg-light">
                      <i class="fa fa-clock text-flex"></i>
                      {{ $item->title}}
                    </span>
                    
                  </h5>
               
                  <small class="ml-4 pl-2 text-secondary">
                    {{ $item->description}} 
                  </small>
                  <hr>
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
  @endsection

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
