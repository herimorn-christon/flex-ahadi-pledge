{{-- register new pledge  modal--}}
@php
$userss=App\Models\User::whereHas('roles', function ($query) {
        $query->where('name', 'member');
    })->get();
$pledges=App\Models\PledgeType::get();
$purpose=App\Models\Purpose::get();
@endphp

<div class="modal fade" id="form-modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
             <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                  <div id="#error-div-pledge"></div>
               <form>
               <input type="hidden" name="update_id" id="update_id">
                  <div class="row mb-3">
                    <div class="col-md-6 d-flex flex-column" id="userdrop">
                        <label for="" class="text-secondary">Pledge Owner (Pledger/Member)</label>
                        <select name="user_id" id="user_id" class="custom-select form-select">
                            @foreach ($userss as $user )
                        <option value={{ $user->id }}>{{$user->fname }}-{{$user->lname}}</option>
                              @endforeach
                        </select>
                        
                    </div>
          

                 
                  <div class="col-md-6 d-flex flex-column" id="typedrop">
                    <label for="" class="text-secondary">Pledge Type</label>
                    <select name="type_id" id="type_id" class="custom-select form-select">
                        @foreach ($pledges as $user )
                        <option value="{{ $user->id }}">  {{$user->title }}</option>
                              @endforeach
                    </select>
                    
                </div>

                    <div class="col-md-6 d-flex flex-column" id="purposedrop">
                        <label for="" class="text-secondary">Pledge Purpose</label>
                        <select name="purpose_id" id="purpose_id" class="custom-select form-select">
                            @foreach ($purpose as $user )
                            <option value={{ $user->id }}>{{$user->title }}</option>
                                  @endforeach
                            </select>
                        </select>
                        
                    </div>
                
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="name" class="text-secondary">Name</label>
                          <input type="text" name="name" id="name" class="form-control" placeholder="Enter Pledge Name">
                      </div>
                  </div>
                  <div class="col-md-6" id="money-pledge-fields" style="display:none;">
                  <div class="form-group">
                      <label for="amount" class="text-secondary">Amount</label>
                      <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Pledge Amount">
                  </div>
                  </div>
                  <div id="object-pledge-fields" style="display:none;">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="amount" class="text-secondary">Object Name</label>
                        <input type="text" name="tonobject_name" id="objectName" class="form-control" placeholder="Enter Pledge Amount">
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount" class="text-secondary">Object Cost</label>
                            <input type="text" name="tonobject_cost" id="objectCost" class="form-control" placeholder="Enter Pledge Amount">
                        </div>
                        </div>

                    <div class="col-md-6" style="margin-left:50%;top:-70%">
                        <div class="form-group">
                            <label for="amount" class="text-secondary">Object Quantity</label>
                            <input type="text" name="tonobject_quantity" id="objectQuantity" class="form-control" placeholder="Enter Pledge Amount">
                        </div>
                        </div>
                        
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
                          <button class="btn bg-flex text-light btn-block " id="save-type-btn" type="submit">
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


  
{{-- 

<script type="text/javascript">
    $('#user_id').select2({
    dropdownParent: $("#userdrop"),
    theme: 'bootstrap-5',
    placeholder: '-- Select Member --',
    
});



$('#purpose_id').select2({
    dropdownParent: $("#purposedrop"),
    theme: 'bootstrap-5',
    placeholder: '-- Select Purpose --',

});

$('#type_id').select2({
    dropdownParent: $("#typedrop"),
    theme: 'bootstrap-5',
    placeholder: '-- Select Pledge Type --',
  
});
</script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script> --}}
<script>
    // console.log("halooo");
    // console.log('iam testing');
  $(document).ready(function() {
  
    $('#type_id').on('change', function() {
      var selectedPledgeType = $(this).val();
       console.log(selectedPledgeType);
      
      if (selectedPledgeType === '9') {
        $('#money-pledge-fields').show();
        $('#object-pledge-fields').hide();
      } else if (selectedPledgeType === '1') {
        $('#money-pledge-fields').hide();
        $('#object-pledge-fields').show();
      } else {
        $('#money-pledge-fields').hide();
        $('#object-pledge-fields').hide();
      }
    });
  });
</script>
{{-- starting of select2 --}}
<script>
 $('#user_id').select2({
    dropdownParent: $("#userdrop"),
    theme: 'bootstrap-5',
    placeholder: '-- Select Member --',
    
});



$('#purpose_id').select2({
    dropdownParent: $("#purposedrop"),
    theme: 'bootstrap-5',
    placeholder: '-- Select Purpose --',

});

</Script>

{{-- ending of select2 --}}
<!-- Script for Modal -->