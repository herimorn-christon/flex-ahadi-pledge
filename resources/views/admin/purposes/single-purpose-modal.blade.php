{{-- View Single Purpose --}}
<div class="modal fade" id="view-modal" tabindex="-1" >
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <p>
              <b class="text-secondary">Purpose Title:</b>   <span id="title-info" class="text-dark"></span>
              <hr>
              <b class="text-secondary">Start Date:</b>   <span id="start-info" class="text-dark"></span>
              <hr>
              <b class="text-secondary">End Date:</b>   <span id="end-info" class="text-dark"></span>
              <hr>
              <b class="text-secondary">Description:</b> <br><span id="description-info" class="text-dark"></span>
          </p>
              <hr>
         <div class="">
              <div class="card">
                <div class="card-header p-2">
                 
                <ul class="nav nav-tabs nav-light">
                  <li class="nav-item">
                    <a class="nav-link text-navy active" href="#timeline"  data-toggle="tab">Purpose Pledges</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-navy" href="#pledges"  data-toggle="tab">Payments Made</a>
                  </li>
                </ul>
                </div><!-- /.card-header -->
                <div class="">
                  <div class="tab-content">
                    <div class=" tab-pane" id="pledges">
                      {{-- start of member payments --}}
                      <table id="example1"  class="table display responsive table-bordered pt-2" width=""  >
                          <thead>
                              <tr class="text-secondary">
                                  <th>ID</th>
                                  <th>Member Fullname</th>
                                  <th>Payment Date</th>
                                  <th>Amount</th>
                                  <th>Method</th>
                              </tr>
                          </thead>
                          <tbody id="payments-table-body">
                          </tbody>
                          <tfoot></tfoot>
                      </table>
          
                    </div>
                    <!-- /.tab-pane -->
                    <div class="active tab-pane" id="timeline">
                   
                      {{-- start of pledges --}}
   
                      <table id=""  class="table table-bordered mt-2 p-2">
                          <thead>
                              <tr class="text-secondary">
                                  <th>ID</th>
                                  <th>Pledge Name</th>
                                  <th>Amount</th>
                                  <th>Deadline</th>
                                  <th>Status</th>
                              </tr>
                          </thead>
                          <tbody id="pledges-table-body">
                           
                          </tbody>
                       </table>
                      {{-- end of pledges --}}                
                  
                  </div>
                    <!-- /.tab-pane --> 
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
      </div>
    </div>
  </div>
</div>
