{{--Register Purpose modal Page--}}
<div class="modal fade" id="form-modal" tabindex="-1" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <input type="hidden" name="update_id" id="update_id">
         
            <div class="mb-3">
              <label for="title" class=" text-secondary">Purpose Title:</label>
              <input type="text" class="text-capitalize form-control" id="title"  name="title" placeholder="Enter Purpose Title">
            </div>
            <div class="mb-3">
              <label for="message-text" class="text-secondary">Start Date:</label>
               <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Enter Start Date">
            </div>
            <div class="mb-3">
              <label for="message-text" class="text-secondary">End Date:</label>
               <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Enter End Date">
            </div>
            <div class="mb-3">
              <label for="message-text" class=" text-secondary">Purpose Description:</label>
               <textarea class="form-control" id="description" rows="3" name="description"></textarea>
            </div>
            <div class="row">
              <div class="col-md-9">
  
              </div>
              <div class="mb-3 col-md-3">
                 <button type="submit" class="btn bg-flex text-light btn-block " id="save-purpose-btn">
                  <i class="fa fa-save"></i>
                  Save Purpose
                </button>
              </div>
            </div>
  
       
          </form>
        </div>
      </div>
    </div>
  </div>