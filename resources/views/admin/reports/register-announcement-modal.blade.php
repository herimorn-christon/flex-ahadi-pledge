{{--Register Purpose modal Page--}}
<div class="modal fade" id="form-modal" tabindex="-1" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{--start of displaying errors --}}
            <div id="error-div"></div>
            {{--end of displaying errors --}}
          <form enctype="multipart/form-data">
            <input type="hidden" name="update_id" id="update_id">
         
            <div class="mb-3">
              <label for="title" class=" text-secondary">Announcement Title:</label>
              <input type="text" class="form-control" id="title"  name="title" placeholder="Enter Purpose Title">
            </div>

            <div class="mb-3">
              <label for="body" class=" text-secondary">Announcement Body:</label>
             <textarea name="body" id="body" class="form-control" rows="5">

             </textarea>
            </div>

            <div class="mb-3">
              <label for="message-text" class="text-secondary">Attachment:</label>
               <input type="file" class="form-control" id="attachment" name="attachment" >
            </div>
            
            <div class="row">
              <div class="col-md-9">
  
              </div>
              <div class="mb-3 col-md-3">
                 <button type="submit" class="btn bg-flex text-light btn-block " id="save-announcement-btn">
                  <i class="fa fa-save"></i>
                  Post Announcement
                </button>
              </div>
            </div>
      
          </form>
        </div>
      </div>
    </div>
  </div>