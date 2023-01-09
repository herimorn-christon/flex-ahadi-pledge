{{-- All Pledge Types Modal Page --}}

<div class="modal fade" id="types">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <button type="button" class="btn-close btn-sm btn-danger " data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">      
          <div class="row">
            {{-- start of all user types table --}}
            <table   class="table table-bordered ">
                <thead>
                 <tr class="text-secondary">
                    <th>SN</th>
                    <th>Pledge Type</th>
                     <th width="240px">Actions</th>
                 </tr>
                </thead>
                <tbody id="types-table-body">
                </tbody>
            </table>
            {{-- end of all user types table --}}
        </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  