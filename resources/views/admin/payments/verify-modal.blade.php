{{-- Register Payment Modal --}}

<div class="modal fade" id="verify-modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
           <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
          <div class="row">
            <p>
                <b class="text-secondary">Payer's Fullname:  <span id="fname-info" class="text-dark"></span> <span id="mname-info" class="text-dark"></span> <span id="lname-info" class="text-dark"></span></b>
                <hr>
                <b class="text-secondary">Payment Pledge:  <span id="purpose-info" class="text-dark"></span> </b> 
                <hr>
                <b class="text-secondary">Payment Amount:  <span id="amount-info" class="text-dark"></span> </b> 
                <hr>
                <b class="text-secondary">Payment Method:  <span id="method-info" class="text-dark"></span> </b> 
                <hr>
                <b class="text-secondary">Payment Date:  <span id="date-info" class="text-dark"></span> </b> 
                <hr>
                <b class="text-secondary">Payment Receipt: <br>  <span id="receipt-info" class="text-dark"></span> </b> 
                <hr>
            </p>    
            <form>
                 <div id="error-div"></div>
              <input type="hidden" name="vupdate_id" id="vupdate_id">
                
             
                <div class="row">
                  <div class="col-md-9"></div>
                  <div class="col-md-3">
                     <div class="form-group">
                      
                         <button type="submit" class="btn btn-sm bg-flex text-light btn-block" id="save-verification-btn">
                             <i class="fa fa-check"></i>
                             Confirm Payment
                         </button>
                     </div>
                </div>
  
                 </div>
                </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  
  