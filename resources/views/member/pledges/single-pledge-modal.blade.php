{{-- view single pledge info--}}
<div class="modal fade" id="view-modal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>
           
            <b class="text-secondary">Pledge Name:</b>   <span id="title-info" class="text-dark"></span>
            <hr>
            <b class="text-secondary">Pledge Type:</b>   <span id="type-info" class="text-dark"></span>
            <hr>
            <b class="text-secondary">Pledge Purpose:</b>   <span id="purpose-info" class="text-dark"></span>
            <hr>    
            <b class="text-secondary">Pledge Status:</b>   <span id="status-info" class="text-success"></span>
            <hr>        
            <b class="text-secondary">Deadline:</b>   <span id="start-info" class="text-dark"></span>
            <hr>
            <b class="text-secondary">Amount:</b>   <span id="end-info" class="text-dark"></span>
            <hr>
            <b class="text-secondary">Description:</b> <br><span id="description-info" class="text-dark"></span>
        </p>
        <hr>
        <h6 class="text-secondary "> Pledge Payments</h6>
        <hr>
        <div class="col-md-12">
          <table class="table table-bordered" id="example">
            <tr>
              <thead>
                <th>SN</th>
                <th>Payment Date</th>
                <th>Method</th>
                <th>Amount</th>
                <th>Payment Status</th>
              </thead>
              <tbody id="payments-table-body">

              </tbody>
            </tr>
          </table>
        </div>
                  
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>