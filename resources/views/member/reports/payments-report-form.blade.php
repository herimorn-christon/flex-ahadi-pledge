<div class="col-md-12">
    <div class="p-2">
      
        <div class="col-md-9 mx-auto">
            <form action="{{ url('member/pledges-payment-report') }}" method="GET">
                @csrf
                <div class="row">
                <div class="mb-3">
                <h5 class="text-secondary text-center">
                    <small>
                        Generate Pledge Payments Made Report From the Given Start Date To the given End Date
                    </small>
                </h5>
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
                    <select name="sort_by" id="sort_by" class="form-control bg-light text-navy">
                        <option value="created_at">Payment Date</option>
                        <option value="pledge_id">Pledge</option>
                        <option value="type_id">Payment Method</option>
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
      
           
              </form>
</div>
</div>
</div>
</div>

