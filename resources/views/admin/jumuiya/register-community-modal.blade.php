<!-- Register Community Modal Page -->

<div class="modal fade" id="form-modal" tabindex="-1" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        {{-- start of close modal button --}}
        <div class="modal-header bg-light">
          <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {{-- end of close modal button --}}
        <div class="modal-body">

        {{-- start of add community form  --}}
          <form>
            <input type="hidden" name="update_id" id="update_id">
         
            <div class="mb-3">
              <label for="recipient-name" class=" text-secondary">Community Name:</label>
              <input type="text" class="text-capitalize form-control" id="name"  name="name" placeholder="Enter Community Name">
            </div>
            <div class="mb-3">
              <label for="message-text" class="text-secondary">Community Abbreviation:</label>
               <input type="text" class="text-uppercase form-control" id="abbreviation" name="abbreviation" placeholder="Enter Community Abbreviation">
            </div>
            <div class="mb-3">
              <label for="message-text" class=" text-secondary">Community Location:</label>
              <input type="text" class="text-capitalize form-control" id="location" name="location" placeholder="Enter Community Location">
            </div>
            <div class="row">
              <div class="col-md-6">
  
              </div>
              <div class="mb-3 col-md-6">
                 <button type="submit" class="btn bg-flex text-light btn-block " id="save-community-btn">
                  <i class="fa fa-save"></i>
                  Save Community
                </button>
              </div>
            </div>       
          </form>

          {{-- end of add community form  --}}
        </div>
      </div>
    </div>
  </div>