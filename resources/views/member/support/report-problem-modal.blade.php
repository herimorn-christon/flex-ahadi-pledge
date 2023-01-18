{{-- Report Problem modal --}}
<div class="modal fade" id="reportModal" tabindex="-1" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h6 class="modal-title" id="exampleModalLabel">
            <i class="fa fa-file-pdf text-danger"></i>
            My Pledges Report
          </h6>
          <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
              {{--displaying all the errors  --}}
              @if ($errors->any())
              <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                      <div>{{$error}}</div>
                  @endforeach
              </div>
              @endif
             <form action="{{ url('member/report-problem') }}" method="post"  enctype="multipart/form-data" >
                 @csrf
                 <div class="mb-3">
                     <label for="" class="text-secondary">Your Issue</label>
                    <textarea name="problem" id="problem" cols="30" rows="5" class="form-control"></textarea>
                 </div>
                 <div class="mb-3">
                     <br>
                     <label for="" class="text-secondary">Attachment</label>
                     <p>
                         <small class="text-secondary">Upload Screenshots if you have any</small>
                     </p>
                     
                     <input type="file" class="form-control">
                 </div>
                
               <hr>
                 <div class="row">
                   
                     <div class="col-md-9"></div>
                     <div class="col-md-3 ">
                         <button class="btn bg-flex text-light btn-block float-end" type="submit">
                           <i class="fa fa-headset"></i>
                            Report Issue
                         </button>
                     </div>
                 </div>
             </form>
        </div>
      </div>
    </div>
  </div>