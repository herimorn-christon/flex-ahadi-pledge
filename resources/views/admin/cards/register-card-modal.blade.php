{{-- Add Card modal --}}
<div class="modal fade" id="form-modal">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header bg-light">
      <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>
      <div class="modal-body">
        <div id="error-div"></div>
          <form >
            <input type="hidden" name="update_id" id="update_id">
              <div class="row mb-3">
               <div class="col-md-12">
                  <div class="form-group">
                      <label for="card_no" class="text-secondary">Card Number</label>
                      <input type="text" name="card_no" id="card" class="form-control" placeholder="Enter Card Number">
                  </div>
               </div>
               <div class="col-md-6"></div>
               <div class="col-md-6">
                  <div class="form-group">
                   
                      <button type="submit" class="btn bg-flex text-light btn-block" id="save-card-btn">
                          <i class="fa fa-save"></i>
                          Create Card
                      </button>
                  </div>
               </div>
              </div>
          </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

 
