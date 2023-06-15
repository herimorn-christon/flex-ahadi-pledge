{{-- view single pledge info--}}
<div class="modal fade" id="views-modal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>
           
            <b class="text-secondary">Pledge Name:</b>   <span id="title-info_show" class="text-dark"></span>
            <hr>
            <b class="text-secondary">Pledge Type:</b>   <span id="type-info_show" class="text-dark"></span>
            <hr>
            <b class="text-secondary">Pledge Purpose:</b>   <span id="purpose-info_show" class="text-dark"></span>
            <hr>    
            <b class="text-secondary">Pledge Status:</b>   <span id="status-info_show" class="text-success"></span>
            <hr>        
            <b class="text-secondary">Deadline:</b>   <span id="deadlines" class="text-dark"></span>
            <hr>
           
            <b class="text-secondary">Description:</b> <br><span id="description-info_show" class="text-dark"></span>
            <hr>
            <b class="text-secondary">Object Name:</b> <br><span id="myObject-show" class="text-dark"></span>
            <hr>
            <b class="text-secondary">Object Quantity:</b> <br><span id="myQuantity_show" class="text-dark"></span>
            <hr>
            <b class="text-secondary">Paid Quantity:</b> <br><span id="totalPayment_show" class="text-dark"></span>
            <hr>
            <b class="text-secondary">Remained Quantity:</b> <br><span id="myRemainQuantity_show" class="text-dark"></span>
            <hr>
            <b class="text-secondary">Object Cost:</b> <br><span id="myobject_cost" class="text-dark"></span>
            
            
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
                <th>Object Name</th>
                <th>Object remained </th>
                <th>Object  paid</th>
                <th>Object Cost</th>
                <th>Payment Status</th>
              </thead>
              <tbody id="payments-tableObject-body">

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