{{-- view single card member info--}}
<div class="modal fade" id="view-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <b class="text-secondary">Member Name:</b>   <span id="fname-info" class="text-dark"></span> <span id="mname-info" class="text-dark"></span> <span id="lname-info" class="text-dark"></span>
        <hr>
        <div class="row">
          <table id="modaltable" class="table table-bordered ">
              <thead>
                  <tr class="text-secondary">
                      <th>ID</th>
                      <th>Payment Date</th>
                      <th>Amount</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody id="payment-table-body">
         

              </tbody>
          </table>
      <hr>

      </div>
                
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
