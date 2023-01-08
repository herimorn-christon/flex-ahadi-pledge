<!-- View User detail Modal-->


<div class="modal fade" id="view-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-xl" style="width:1250px;">
      <div class="modal-content">
        <div class="modal-header bg-light">
            <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
      
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
                <tr>
                    <td><b class="text-secondary">Full Member Name:</b></td>
                    <td><span id="name-info" class="text-dark"></span> <span id="mname-info" class="text-dark"></span> <span id="lname-info" class="text-dark"></span></td>
                </tr>
                <tr>
                    <td>  <b class="text-secondary">Community:</b></td>
                    <td><span id="community-info" class="text-dark"></span> </td>
                </tr>
                <tr>
                    <td><b class="text-secondary">Birthdate:</b> </td>
                    <td> <span id="date-info" class="text-dark"></span></td>
                </tr>
                <tr>
                    <td>  <b class="text-secondary">Gender:</b></td>
                    <td><span id="description-info" class="text-dark"></span> </td>
                </tr>
                <tr>
                    <td>  <b class="text-secondary">Phone Number:</b></td>
                    <td><span id="phone-info" class="text-dark"></span> </td>
                </tr>
                <tr>
                    <td>  <b class="text-secondary">Email:</b></td>
                    <td><span id="email-info" class="text-dark"></span> </td>
                </tr>
                <tr>
                    <td>  <b class="text-secondary">Member Status:</b></td>
                    <td><span id="status-info" class="text-success"></span> </td>
                </tr>
            </table>
        </div>
    
        <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active bg-light nav-light" href="#pledges" data-toggle="tab">Payments</a></li>
                  <li class="nav-item"><a class="nav-link bg-light" href="#timeline" data-toggle="tab">Pledges</a></li>
                  <li class="nav-item"><a class="nav-link bg-light" href="#settings" data-toggle="tab">Cards</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="">
                <div class="tab-content">
                  <div class="active tab-pane" id="pledges">
                    {{-- start of member payments --}}
                    <table id="mytable"   class="table table-bordered responsive ">
                        <thead>
                            <tr class="text-secondary">
                                <th>ID</th>
                                <th>Payment Date</th>
                                <th>Payment Purpose</th>
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
                  <div class="tab-pane" id="timeline">
                 
                    {{-- start of pledges --}}
 
                    <table id="my_table"  class="table table-bordered ">
                        <thead>
                            <tr class="text-secondary">
                                
                                <th>ID</th>
                                <th>Pledge Name</th>
                                <th>Amount</th>
                                <th>Purpose</th>
                                <th>Deadline</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="members-table-body">
                            
            
                        </tbody>
                     </table>
                    {{-- end of pledges --}}
                 
                
                
                </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">

                 
                    {{-- start of cards --}}
 
                    <table  class="table table-bordered ">
                        <thead>
                            <tr class="text-secondary">
                                <th>ID</th>
                                <th>Card Number</th>
                                <th>Status</th>
                                {{-- <th>Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody id="cards-table-body">

          
                        </tbody>
                    </table>
                    {{-- end of pledges --}}
                 
                
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
