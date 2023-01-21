{{-- Register Payment Modal --}}

<div class="modal fade" id="form-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-light">
         <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <div id="error-div"></div>
        <div class="row">
          <form>
            <input type="hidden" name="update_id" id="update_id">

            <div class="row mb-3">
              <div class="col-md-6">
                <label for="" class="text-secondary">Payment Owner</label>
                 <select id='user_id' name='sel_depart' class="custom-select form-control">
                <option value='0'>-- Select Member Here --</option>
                @php
                $departmentData= App\Models\User::where('role','member')->get();
                @endphp
                <!-- Read Departments -->
                @foreach($departmentData as $department)
                  <option value='{{ $department->id }}'>{{ $department->fname }} {{ $department->mname }} {{ $department->lname }} ({{ $department->community->abbreviation}} /{{ $department->id }} ) </option>
                @endforeach

            </select>
              </div>
            <div class="col-md-6">
            <!-- Department Employees Dropdown -->
            <label for="" class="text-secondary">Payment Pledge</label>
            <select id='pledge_id' name='sel_emp' class="custom-select form-control">
                <option value='0'>-- Select Member's Pledge --</option>
            </select>
            
            </div>
            </div>
   
         <div class="row mb-2">
                  @php
                  $purpose= App\Models\PaymentType::get();
                  @endphp
                  <div class="col-md-6">
                      <label for="" class="text-secondary">Payment Method</label>
                      <select name="type_id" id="type_id" class="custom-select form-control">
                          <option value="">--Select Payment Method --</option>
                          @foreach ( $purpose as $item)
                           <option value="{{ $item->id}}"> {{ $item->name}}</option>
                          @endforeach
                      </select>
                  </div>
               <div class="col-md-6">
                  <div class="form-group">
                      <label for="amount" class="text-secondary">Paid Amount </label>
                      <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Payment Amount">
                  </div>
               </div>

               <div class="col-md-12">
                <div class="form-group">
                    <label for="amount" class="text-secondary">Payment Receipt </label>
                   <textarea name="receipt" id="receipt" class="form-control" rows="4"></textarea>
                </div>
             </div>
              </div>
              <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                   <div class="form-group">
                    
                       <button type="submit" class="btn btn-sm bg-flex text-light btn-block" id="save-payment-btn">
                           <i class="fa fa-save"></i>
                           Save Payment
                       </button>
                   </div>
              </div>

               </div>
              </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->

