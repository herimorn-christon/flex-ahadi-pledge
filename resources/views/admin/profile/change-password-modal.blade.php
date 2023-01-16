{{-- edit profile modal --}}
<div class="modal fade" id="password-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
            <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
      
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                @if (session('status'))
                <div class="btn btn-danger disabled btn-block"  role="alert">
                    {{ session('status') }}
                </div>
                @endif
                   {{--displaying all the errors  --}}
                   @if ($errors->any())
                   <div class="alert alert-danger">
                       @foreach ($errors->all() as $error)
                           <div>{{$error}}</div>
                       @endforeach
                   </div>
                   @endif
                  <form action="{{ url('admin/change-password') }}" method="post"  enctype="multipart/form-data" >
                      @csrf
                      <div class="mb-3">
                          <label for="" class="text-secondary">Current Password</label>
                          <input name="current_password" placeholder="Enter Current Password" type="password" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label for="newPasswordInput" class="form-label text-secondary">New Password</label>
                        <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                            placeholder="New Password">
                        @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="confirmNewPasswordInput" class="form-label text-secondary">Confirm New Password</label>
                        <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
                            placeholder="Confirm New Password">
                    </div>                              
                       
                    <hr>
                      <div class="row">
                        
                          <div class="col-md-9"></div>
                          <div class="col-md-3">
                              <button class="btn bg-flex text-light btn-block float-end" type="submit">
                                <i class="fa fa-key"></i>
                                Change Password
                              </button>
                          </div>
                      </div>
                  </form>
          {{-- end of edit profile form --}}
        </div>
    
      </div>
    </div>
  </div>