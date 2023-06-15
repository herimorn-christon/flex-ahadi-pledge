{{-- register new pledge  modal--}}
@php
$userss=App\Models\User::whereHas('roles', function ($query) {
        $query->where('name', 'member');
    })->get();
$pledges=App\Models\PledgeType::get();
$purpose=App\Models\Purpose::get();
@endphp

<div class="modal fade" id="ourModelExample" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
             <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                  <div id="#error-div-pledge"></div>
               <form action={{ route("admin_register_pledge") }} method="POST">
                @csrf
               {{-- <input type="hidden" name="update_id" id="update_id"> --}}
                  <div class="row mb-3">
                    <div class="col-md-6 d-flex flex-column" id="userdrops">
                        <label for="" class="text-secondary">Pledge Owner (Pledger/Member)</label>
                        <select name="user_ids" id="user_ids" class="custom-select form-select">
                            @foreach ($userss as $user )
                        <option value={{ $user->id }}>{{$user->fname }}-{{$user->lname}}</option>
                              @endforeach
                        </select>
                        
                    </div>
          

                 
                  <div class="col-md-6 d-flex flex-column" id="typedrops">
                    <label for="" class="text-secondary">Pledge Type</label>
                    <select name="type_ids" id="type_ids" class="custom-select form-select type_id ">
                      <option disabled selected>Select Pledge type</option>
                        @foreach ($pledges as $user )
                        <option value={{ $user->id }}>{{$user->title }}</option>
                              @endforeach
                    </select>
                    
                </div>

                    <div class="col-md-6 d-flex flex-column" id="purposedrops">
                        <label for="" class="text-secondary">Pledge Purpose</label>
                        <select name="purpose_ids" id="purpose_ids" class="custom-select form-select">
                            @foreach ($purpose as $user )
                            <option value={{ $user->id }}>{{$user->title }}</option>
                                  @endforeach
                            </select>
                        </select>
                        
                    </div>
                
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="name" class="text-secondary">Name</label>
                          <input type="text" name="names" id="names" class="form-control" placeholder="Enter Pledge Name">
                      </div>
                  </div>
               
                  <div class="col-md-6" id="money-pledge-fieldss" style="display:none;">
                  <div class="form-group">
                      <label for="amount" class="text-secondary">Amount</label>
                      <input type="text" name="amounts" id="amounts" class="form-control" placeholder="Enter Pledge Amount">
                  </div>
                  </div>
                  <div id="object-pledge-fieldss" style="display:none;">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="amount" class="text-secondary">Object Name</label>
                        <input type="text" name="object_names" id="objectNames" class="form-control" placeholder="Enter Pledge Amount">
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amounts" class="text-secondary">Object Cost</label>
                            <input type="text" name="object_costs" id="objectCosts" class="form-control" placeholder="Enter Pledge Amount">
                        </div>
                        </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount" class="text-secondary">Object Quantity</label>
                            <input type="text" name="object_quantitys" id="objectQuantitys" class="form-control" placeholder="Enter Pledge Amount">
                        </div>
                        </div>
                        
                  </div>


                 
                  
                
              
              
                </div>
                 
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="deadline" class="text-secondary">Deadline</label>
                    <input type="date" name="deadlines" id="deadlines" class="form-control" placeholder="Enter Pledge Deadline">
                </div>
            </div>
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="description" class="text-secondary">Description</label>
                      <textarea name="descriptions" class="form-control" id="descriptions" rows="3"></textarea>
                  </div>
              </div>
             
                  <div class="col-md-12" style="padding-bottom:2rem">
  
                  <div class="row mt-2">
  
                      <div class="col-md-6 ">
                        <label for="" class="text-secondary"> Pledge Status</label>
                        <select name="statuss" id="statuss" class="custom-select form-control bg-light">
                          <option value="0">Not Fullfilled</option> 
                          <option value="1">Fullfilled</option>
                        </select>
                      </div>
  
                      <div class="col-md-6 ">
                        <label for="" class="text-white">.</label>
                          <button class="btn bg-flex text-light btn-block" type="submit">
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
  
    $('#type_ids').on('change', function() {
      var selectedPledgeTypes = $(this).val();
       console.log(selectedPledgeTypes);
      
      if (selectedPledgeTypes === '9') {
        $('#money-pledge-fieldss').show();
        $('#object-pledge-fieldss').hide();
      } else if (selectedPledgeTypes === '1') {
        $('#money-pledge-fieldss').hide(); 
        $('#object-pledge-fieldss').css({
    'display': 'flex',
    'flex-wrap': 'wrap'
  });
        $('#object-pledge-fieldss').show();
      } else {
        $('#money-pledge-fieldss').hide();
        $('#object-pledge-fieldss').hide();
      }
    });
  });
</script>
{{-- starting of select2 --}}
<script>
 $('#user_ids').select2({
    dropdownParent: $("#userdrops"),
    theme: 'bootstrap-5',
    placeholder: '-- Select Member --',
    
});



$('#purpose_ids').select2({
    dropdownParent: $("#purposedrops"),
    theme: 'bootstrap-5',
    placeholder: '-- Select Purpose --',

});

</Script>

{{-- ending of select2 --}}
<!-- Script for Modal -->