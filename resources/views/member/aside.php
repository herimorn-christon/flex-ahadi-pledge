<div class="col-md-6 mb-2">
              <div class="card">
              <div class="card-header bg-white">
                <h6 class="">Pledges Progress</h6>
              </div>
              <div class="row">
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

                      <?php } ?>
                      
                      
                    
      
                    </div>
                    </div>
                  </div>
              
               @endforeach
              </div>
            </div>