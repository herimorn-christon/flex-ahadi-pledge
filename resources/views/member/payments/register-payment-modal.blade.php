{{-- Register Payment Modal --}}

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
           <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <div id="error-div"></div>
          <div class="row">
            <form action={{ route("test_payment") }} method="POST">
              @csrf
              <input type="hidden" name="update_id" id="update_id">
              <div class="row mb-3">
                <div class="col-md-12">
                  <label for="" class="text-secondary">Payment Pledge</label>
                   <select id='pledge' name='pledge_id' class="form-control">
                  <option value='0'>-- Select Payment Pledge Here --</option>
                  @php
                   $new_user=Auth::user()->church_id;
                  $pledge= App\Models\Pledge::with('type')->where('user_id',Auth::user()->id)->where('status','')
                  ->where('church_id',$new_user)
                  ->get();
                  
                  @endphp

                  @foreach($pledge as $item)
                    <option value='{{ $item->id }}'   data-type="{{ $item->type->title}}">{{ $item->name }} </option>
                  @endforeach
  
              </select>
                </div>
            
              </div>

              <div id="pledge_details" style="display: none;">
                <label for="pledge_type" class="text-secondary">Pledge Type:</label>
                <span id="pledge_type" name="pledge_type"></span>
                 <input type="text" id="pledge_types"  name="pledge_types"/>
                 
               
                <div id="object_details" style="display: none;">
                  {{-- <div class="form-group">
                    <label for="object_name" class="text-secondary" >Object Name:</label>
                    <span id="object_name"></span>
                  </div>
                  <div class="form-group">
                    <label for="object_name" class="text-secondary" >Object Name:</label>
                    <span id="object_quantity"></span>
                  </div> --}}
                  
                  <div class="form-group" class="text-secondary">
                    <label for="object_cost" class="text-secondary">Object Cost:</label>
                    <input type="text" name="object_cost" id="object_cost" class="form-control">
                  </div>
                  <div class="form-group" class="text-secondary">
                    <label for="object_quantity" class="text-secondary">Object Quantity:</label>
                    <input type="text" name="object_quantity" id="object_quantity" class="form-control">
                  </div>
                </div>
        
                {{-- <div id="money_details" style="display: none;">
                    <label for="payment_method">Payment Method:</label>
                    <input type="text" name="payment_method" id="payment_method">
        
                    <label for="amount">Amount:</label>
                    <input type="text" name="amount" id="amount">
                </div> --}}
            </div>

                   {{-- handling the pledge type --}}
                    
                   {{-- end of handling the pledge type --}}

                   
           <div class="row mb-2">
                    @php
                    $purpose= App\Models\PaymentType::get();
                    @endphp
                   <div id="money_details" style="display: none;">
                    <div class="col-md-6">
                        <label for="" class="text-secondary">Payment Method</label>
                        <select name="type_id" id="type" class="form-control">
                            <option value="">--Select Payment Method --</option>
                            @foreach ( $purpose as $item)
                             <option value="{{ $item->id}}"> {{ $item->name}}</option>
                            @endforeach
                        </select>
                    </div>


                 <div class="col-md-6" style="float:right;margin-top:-4rem">
                    <div class="form-group">
                        <label for="amount" class="text-secondary">Paid Amount </label>
                        <input type="text" name="amount" id="pamount" class="form-control" placeholder="Enter Payment Amount">
                    </div>
                 </div>
                </div>
  
                 <div class="col-md-12">
                  <div class="form-group">
                      <label for="amount" class="text-secondary">Payment Receipt </label>
                     <textarea name="receipt" id="receipt" placeholder="Enter Receipt Here.." class="form-control" rows="4"></textarea>
                  </div>
               </div>

                </div>
                <div class="row">
                  <div class="col-md-6"></div>
                  <div class="col-md-6">
                     <div class="form-group">
                      
                         <button type="submit" class="btn btn-sm bg-flex text-light btn-block">
                             <i class="fa fa-save"></i>
                             Add Payment
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
    
    <script>
      $(document).ready(function() {
          $('#pledge').on('change', function() {
              var selectedOption = $(this).find(':selected');
              var pledgeType = selectedOption.data('type');

              if (pledgeType) {
                  $('#pledge_details').show();
                  $('#pledge_type').text(pledgeType);
                  $('#pledge_types').val(pledgeType);

                  if (pledgeType === 'Object') {
                   
                    $('#object_name_input').val(pledgeType );
                      $('#object_details').show();
                      $('#money_details').hide();
                  } else if (pledgeType === 'money') {
                      $('#object_details').hide();
                      $('#money_details').show();
                  } else {
                      $('#object_details').hide();
                      $('#money_details').hide();
                  }
              } else {
                  $('#pledge_details').hide();
              }
          });
      });
  </script>
  
  