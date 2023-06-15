{{-- view payment modal --}}

<div class="modal fade" id="view-modalObjects">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-light">
         <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>
          
          <b class="text-secondary">Payment Pledge:</b>   <span id="purpose-infos" class="text-dark"></span>
          <hr>
          <b class="text-secondary">object Name:</b>   <span id="purpose-object" class="text-dark"></span>
          <hr>
          <b class="text-secondary">object Quantity:</b>   <span id="purpose-quantity" class="text-dark"></span>
          <hr>
          <b class="text-secondary">Total Object Cost:</b>   <span id="amount-infosObject" class="text-dark"></span>
          <hr>
          <b class="text-secondary">Amount Paid for object:</b>   <span id="amount-infos" class="text-dark"></span>
          <hr>
        
          {{-- <b class="text-secondary">Remained Object Cost :</b>   <span id="Remained_amount-infos" class="text-dark"></span>
          <hr> --}}
          <b class="text-secondary">Quantity Paid:</b>   <span id="amountQuantity-infos" class="text-dark"></span>
          <hr>
          <b class="text-secondary">Previous Pledge Amount:</b>   <span id="previously" class="text-dark"></span>
          <hr>
          <b class="text-secondary">Amount remained:</b>   <span id="amount_remain" class="text-dark"></span>
          <hr>
         
          <b class="text-secondary">Payment Date:</b>   <span id="date-infos" class="text-dark"></span>
          <hr>
      </p>       
     
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>