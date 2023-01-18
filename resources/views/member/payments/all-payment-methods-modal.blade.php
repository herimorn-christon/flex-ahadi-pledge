{{-- All Payment Methods Modal --}}

<div class="modal fade" id="types">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
           <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
  
        </div>
        <div class="modal-body">
          <div class="col-sm-12" id="alert-div">
          </div>
          <div class="row">
            <table   class="table table-bordered ">
                <thead>
                    <tr class="text-secondary">
                        <th>SN</th>
                        <th>Method Name</th>
                    </tr>
                </thead>
                <tbody id="methods-table-body">
  
                </tbody>
            </table>
  
        </div>
        </div>
        <div class="modal-footer justify-content-between">
          {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        --}}
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  