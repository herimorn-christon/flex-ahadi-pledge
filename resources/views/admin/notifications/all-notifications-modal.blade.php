{{-- all user notifications  modal --}}
<div class="modal fade" id="avatar-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
            <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
      
        </div>
        <div class="modal-body">
            <div id="error-div"></div>
        {{-- start of notifications table --}}
        <div class="responsive p-1">
            <table id="example" class="table table-bordered cell-border">
                <thead>
                    <tr class="text-secondary">
                        <th>ID</th>
                        <th>Notification Name</th>
                        <th>Received At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="members-table-body">
   
  
                </tbody>
            </table>
  
        </div>
          {{-- end of notifications table --}}
        </div>
    
      </div>
    </div>
  </div>