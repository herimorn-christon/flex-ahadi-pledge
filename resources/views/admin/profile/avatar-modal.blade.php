{{-- user profile image  modal --}}
<div class="modal fade" id="avatar-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
            <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
      
        </div>
        <div class="modal-body">
            <div id="error-div"></div>
            {{-- start of current image --}}
            <div class="row">
              <div class="text-center col-md-5 mx-auto" >
                <img class="profile-user-img img-fluid img-circle"
                     src="{{ asset('img/user.png') }}"
                     alt="User profile picture" width="100%">
                     <br>
                     <small class="text-secondary">
                      Current Image
                     </small>
              </div>
            </div>
            {{--  end of current image --}}
            {{-- start of update image form --}}
            <form>
             
                <input type="hidden" name="update_id" id="{{Auth::User()->id;}}">
                <div class="row">
           
            <div class="col-lg-12">
                    <label for="file" class="text-secondary font-weight-light">Upload New Image</label>
                    <input type="file" name="profile_img" id="profile_img" class="form-control">
               
            </div>
  
             
                <div class="col-md-6">
                 
                  
                </div>
  
                <div class="col-md-6 mb-0 ">
                        <label for="" class="text-white">.</label>
                            <button type="submit" class="btn text-light bg-flex btn-block col-lg-12" id="save-profile-btn">
                               <i class="fa fa-save"></i>
                                {{ __('Update Image') }}
                            </button>
                        </div>
             
            </div>
          </form>
  
          {{-- end of edit profile form --}}
        </div>
    
      </div>
    </div>
  </div>