
<div class="col-md-9 mx-auto">
  <div class="p-2">
    
      <div class="col-md-12">
        @if (session('status'))
        <div class="btn btn-danger disabled btn-block"  role="alert">
            {{ session('status') }}
        </div>
        @endif
           {{--displaying all the errors  --}}
           @if ($errors->any())
           <div class="alert alert-danger">
               @foreach ($errors->all() as $error)
                   <div>{{$error}}</div>
               @endforeach
           </div>
           @endif
           <form action="{{ url('member/cards-payment-report') }}" method="GET">
              @csrf
              <div class="row">
              <div class="mb-3">
              <h5 class="text-secondary text-center">
                  <small>
                      Generate Card Payments Made Report From the Given Start Date To the given End Date
                  </small>
              </h5>
              </div>
              @php
              $user=Auth::User()->id;
              $purpose= App\Models\CardMember::where('user_id',$user)
                                              ->orderBy('created_at')
                                              ->get();
              @endphp
              <div class="mb-3 col-md-6">
                  <label for="" class="text-secondary">Choose Your Card</label>
                  <select name="card_no" id="card_no" class="form-control bg-light text-navy">
                      <option value="">--Select Card --</option>
                      @foreach ( $purpose as $item)
                      <option value="{{ $item->id}}">{{ $item->card->card_no}} / {{ $item->user_id }}   </option>
                      @endforeach
                  </select>
              </div>
              <div class="mb-3 col-md-6">
                <label for="message-text" class="text-secondary">From Date:</label>
                 <input type="date" class="form-control" id="from_date" name="from_date" placeholder="Enter Start Date">
              </div>
              <div class="mb-3 col-md-6">
                <label for="message-text" class="text-secondary">To Date:</label>
                 <input type="date" class="form-control" id="to_date" name="to_date" placeholder="Enter End Date">
              </div>
              <div class="mb-3 col-md-6">
                  <label for="message-text" class="text-secondary">Sort By:</label>
                  <select name="sort_by" id="sort_by" class="bg-light text-navy form-control">
                      <option value="created_at">Created Date</option>
                      <option value="amount">Amount Paid</option>
                  </select>
                </div>
              <div class="row">
                <div class="col-md-9">
    
                </div>
                <div class="mb-3 col-md-3">
                   <button type="submit" class="btn bg-flex text-light btn-block " id="save-purpose-btn">
                    <i class="fa fa-download"></i>
                    Download Report
                  </button>
                </div>
              </div>
            </div>
         
            </form>
      
      </div>
  </div>
</div>
                