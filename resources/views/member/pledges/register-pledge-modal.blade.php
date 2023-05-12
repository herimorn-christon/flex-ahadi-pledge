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
                  
                  @php
                  $types= App\Models\PledgeType::get();
                  @endphp
                  <div class="col-md-12">
                      <label for="" class="text-secondary">Pledge Type</label>
                      <select name="type_id"  id="type_id" class="form-control">
                          <option value="">--Select Pledge Type --</option>
                          @foreach ( $types as $item)
                          <option value="{{ $item->id}}">{{ $item->title}}</option>
                          @endforeach
                      </select>
                  </div>
                  @php
                  $purpose= App\Models\Purpose::where('status','')->get();
                  @endphp
                  <div class="col-md-6" id="kidawa_form">
                      <label for="" class="text-secondary">Pledge Purpose</label>
                      <select name="purpose_id" id="purpose_id" class="form-control form-select">
                          <option value="">--Select Purpose --</option>
                          @foreach ( $purpose as $item)
                          <option value="{{ $item->id}}"> {{ $item->title}}</option>
                          @endforeach
                      </select>
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
  
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    console.log("hallooo");
    
        $('#purpose_id').select2({
        dropdownParent: $("#kidawa_form"), 
        placeholder: 'Select the parents',
   
      
    });

    $('#purpose_id').select2({
    dropdownParent: $('#kidawa_form'),
    theme: 'bootstrap-5',
   width: '100%',
   height:'20%',
    placeholder: '-- Select Purpuse --',
  
});


      </script>