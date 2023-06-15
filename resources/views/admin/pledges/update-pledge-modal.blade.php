{{-- register new pledge  modal--}}
@php
$userss=App\Models\User::where('role','member')->get();
$pledges=App\Models\PledgeType::get();
$purpose=App\Models\Purpose::get();
@endphp

<div class="modal fade" id="form-modals-pledge">
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
                    <div class="col-md-6 d-flex flex-column" id="usersdrop">
                        <label for="" class="text-secondary">Pledge Owner (Pledger/Member)</label>
                        <select name="myuser_id" id="myusers_id" class="custom-select form-select">
                            @foreach ($userss as $user )
                        <option value={{ $user->id }}>{{$user->fname }}-{{$user->lname}}</option>
                              @endforeach
                        </select>
                        
                    </div>
          

                 
                  <div class="col-md-6 d-flex flex-column" id="typedrop">
                    <label for="" class="text-secondary">Pledge Type</label>
                    <select name="mytype_id" id="mytype_id" class="custom-select form-select type_id ">
                        @foreach ($pledges as $user )
                        <option value={{ $user->id }}>{{$user->title }}</option>
                              @endforeach
                    </select>
                    
                </div>

                    <div class="col-md-6 d-flex flex-column" id="purposesdrop">
                        <label for="" class="text-secondary">Pledge Purpose</label>
                        <select name="mypurposes_id" id="purposes_id" class="custom-select form-select">
                            @foreach ($purpose as $user )
                            <option value={{ $user->id }}>{{$user->title }}</option>
                                  @endforeach
                            </select>
                        </select>
                        
                    </div>
                
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="name" class="text-secondary">Name</label>
                          <input type="text" name="myname" id="myName" class="form-control" placeholder="Enter Pledge Name">
                      </div>
                  </div>
                  <div class="col-md-6" id="money-pledge-fields" style="display:none;">
                  <div class="form-group">
                      <label for="amount" class="text-secondary">Amount</label>
                      <input type="text" name="myamount" id="myamount" class="form-control" placeholder="Enter Pledge Amount">
                  </div>
                </div>
              </div>
                  <div class="col-md-6">
                  <div class="form-group">
                      <label for="deadline" class="text-secondary">Deadline</label>
                      <input type="date" name="mydeadline" id="mydeadline" class="form-control" placeholder="Enter Pledge Deadline">
                  </div>
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="description" class="text-secondary">Description</label>
                      <textarea name="mydescription" class="form-control" id="mydescription" rows="3"></textarea>
                  </div>
              </div>
                  <div class="col-md-12">
  
                  <div class="row mt-2">
  
                      <div class="col-md-6 ">
                        <label for="" class="text-secondary"> Pledge Status</label>
                        <select name="mystatus" id="mystatus" class="custom-select form-control bg-light">
                          <option value="0">Not Fullfilled</option> 
                          <option value="1">Fullfilled</option>
                        </select>
                      </div>
  
                      <div class="col-md-6 ">
                        <label for="" class="text-white">.</label>
                          <button class="btn bg-flex text-light btn-block " id="saved-pledge-btn" type="submit">
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


{{-- starting of select2 --}}
<script>
    $('#myusers_id').select2({
       dropdownParent: $("#usersdrop"),
       theme: 'bootstrap-5',
       placeholder: '-- Select Member --',
       
   });
   
   
   
   $('#purposes_id').select2({
       dropdownParent: $("#purposesdrop"),
       theme: 'bootstrap-5',
       placeholder: '-- Select Purpose --',
   
   });
   
   </Script>

{{-- ending of select2 --}}
<!-- Script for Modal -->