{{-- register new pledge  modal--}}

<div class="modal fade" id="form-modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
             <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                  <div id="error-div"></div>
               <form>
               <input type="hidden" name="update_id" id="update_id">
                  <div class="row mb-3">
                    <div class="col-md-6 d-flex flex-column" id="userdrop">
                        <label for="" class="text-secondary">Pledge Owner (Pledger/Member)</label>
                        <select name="user_id" id="user_id" class="form-select"></select>
                        
                    </div>
          

                 
                  <div class="col-md-6 d-flex flex-column" id="typedrop">
                    <label for="" class="text-secondary">Pledge Type</label>
                    <select name="type_id" id="type_id" class="form-select"></select>
                    
                </div>

                    <div class="col-md-6 d-flex flex-column" id="purposedrop">
                        <label for="" class="text-secondary">Pledge Purpose</label>
                        <select name="purpose_id" id="purpose_id" class="form-select"></select>
                        
                    </div>
                
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="name" class="text-secondary">Name</label>
                          <input type="text" name="name" id="name" class="form-control" placeholder="Enter Pledge Name">
                      </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                      <label for="amount" class="text-secondary">Amount</label>
                      <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Pledge Amount">
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                      <label for="deadline" class="text-secondary">Deadline</label>
                      <input type="date" name="deadline" id="deadline" class="form-control" placeholder="Enter Pledge Deadline">
                  </div>
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="description" class="text-secondary">Description</label>
                      <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                  </div>
              </div>
                  <div class="col-md-12">
  
                  <div class="row mt-2">
  
                      <div class="col-md-6 ">
                        <label for="" class="text-secondary"> Pledge Status</label>
                        <select name="status" id="status" class="custom-select form-control bg-light">
                          <option value="0">Not Fullfilled</option> 
                          <option value="1">Fullfilled</option>
                        </select>
                      </div>
  
                      <div class="col-md-6 ">
                        <label for="" class="text-white">.</label>
                          <button class="btn bg-flex text-light btn-block " id="save-pledge-btn" type="submit">
                          <i class="fa fa-save"></i>
                          Save Pledge 
                          </button>
                      </div>
                  </div>
                  </div>
                  </div>
              </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  
   {{-- auto search scripts --}}

  

<script type="text/javascript">
    $('#user_id').select2({
    dropdownParent: $("#userdrop"),
    theme: 'bootstrap-5',
    placeholder: '-- Select Member --',
    ajax: {
        url: '/member/search',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.fname+' '+item.mname+' '+item.lname,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    }
});



$('#purpose_id').select2({
    dropdownParent: $("#purposedrop"),
    theme: 'bootstrap-5',
    placeholder: '-- Select Purpose --',
    ajax: {
        url: '/purpose/search',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.title,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    }
});

$('#type_id').select2({
    dropdownParent: $("#typedrop"),
    theme: 'bootstrap-5',
    placeholder: '-- Select Pledge Type --',
    ajax: {
        url: '/pledge-types/search',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.title,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    }
});
</script>
<!-- Script for Modal -->