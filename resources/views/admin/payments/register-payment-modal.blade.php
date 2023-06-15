<!-- Register Payment Modal -->
@php

    $new_user=Auth::user()->church_id;
    // dd($new_user);
    $users = App\Models\User::join('pledges', 'users.id', '=', 'pledges.user_id')
    ->join('churches', 'users.church_id', '=', 'churches.id')
    ->where('churches.id', '=', 1)
    ->whereHas('roles', function ($query) {
        $query->where('name', 'member');
    })
    ->select('users.*')
    ->distinct()
    ->get();

    $pledges = App\Models\Pledge::all();
   $purpose= App\Models\PaymentType::get();
   $purposes=App\Models\Purpose::where('church_id',$new_user)->get();
                  
@endphp

<div class="modal fade" id="form-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="error-div"></div>
                    <form>
                        <div class="row">
                            <input type="hidden" name="update_id" id="update_id">
                      
                            <div class="col-md-6" class="form-control" id="UserpledgeDrop">
                              <label for="" class="text-secondary">Select User</label> 
                            <select id="userSelect" name="user_id"  style="width:100%">
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->fname }} {{ $user->lname }}</option>
                                @endforeach
                            </select>

                            </div>
                            <div class="col-md-6" class="form-control"id="pledgeDrop">
                         <label for="" class="text-secondary">select pledge</label>     
                            <select id="pledgeSelect" name="pledge_id" style="display: none; width:100%;height:4rem" >
                                <option value="" class="form-control">Select Pledge</option>
                            </select>
                            </div>

                        </div>
                       
                       
                         <br>
                         <br>
                        <div class="row mb-3">
                            
                        <div class="col-md-6">
                             <div class="mb-3" class="form-control">
                            <input id="objectQuantity" type="text" name="object_quantity" style="display: none;" placeholder="Object Quantity" class="form-control">
                             </div>
                        </div>
                         <div class="col-md-6" class="form-control">
                            <input id="objectCost" type="number" name="object_cost" style="display: none;" placeholder="Cost/metrics" class="form-control">
                         </div>

                        </div>
                 
                      
                        <div class="mb-3" style="display:flex">
                        <div class="col-md-6" id="moneyInput" style="display: none;">
                        <!-- Money Input -->
                        <label for="" class="text-secondary">inter the amount </label>   
                        <input type="number"
                        id="amount" name="money"  placeholder="Money" class="form-control">
                        </div>

                        {{-- handling the payment method --}}
                       
                        <div class="col-md-6" id="payment_drop" style="display:none">
                            <label for="" class="text-secondary" class="form-control">Payment Method</label>
                            <select name="type_id" id="type_id" class="form-control">
                                <option value="">--Select Payment Method --</option>
                                @foreach ( $purpose as $item)
                                 <option value="{{ $item->id}}"> {{ $item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                     
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6" id="itspurpose_drop">
                                <label for="" class="text-secondary" class="form-control">Select Purpose</label>
                                <select name="purpose_id" id="purpose_id" class="form-control">
                                    <option value="">--Select Purposes --</option>
                                    @foreach ($purposes as $item)
                                     <option value="{{ $item->id}}"> {{ $item->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount" class="text-secondary">Payment Receipt </label>
                                <textarea name="receipt" id="receipt" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </form>
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
        </div>
    </div>
</div>


{{-- auto search scripts --}}
<script>
    $(document).ready(function() {
        var users = @json($users);
        var pledges = @json($pledges);
        $('#userSelect').select2({
    dropdownParent: $('#UserpledgeDrop'),
    theme: 'bootstrap-5',
   width: '100%',
   height:'20%',
    placeholder: '-- Select Pledge--',
  
});

        // Handle user selection change event
        $('#userSelect').on('change', function() {
            var userId = $(this).val();

            if (userId) {
                // Filter pledges based on user selection
                var filteredPledges = pledges.filter(function(pledge) {
                    return pledge.user_id == userId;
                });

                $('#pledgeSelect').empty();
                $('#pledgeSelect').append('<option value="">Select Pledge</option>');

                filteredPledges.forEach(function(pledge) {
                    $('#pledgeSelect').append('<option value="' + pledge.id + '">' + pledge.name + '</option>');
                });
                $('#pledgeSelect').css('width', '100%');
                $('#pledgeSelect').show();
            } else {
                resetPledgeSelect();
                hideAllFields();
            }
        });
        $('#pledgeSelect').select2({
    dropdownParent: $('#pledgeDrop'),
    theme: 'bootstrap-5',
   width: '100%',
   height:'20%',
    placeholder: '-- Select Pledge--',
  
});
        // Handle pledge selection change event
        $('#pledgeSelect').on('change', function() {
            var pledgeId = $(this).val();

            if (pledgeId) {
                var pledge = pledges.find(function(pledge) {
                    return pledge.id == pledgeId;
                });

                var pledgeTypeId = pledge.type_id;
                  console.log(pledgeTypeId);

                if (pledgeTypeId) {
                    var pledgeType = getPledgeTypeById(pledgeTypeId);
                     console.log(pledgeType);

                    if (pledgeType === 'Object') {
                        $('#objectQuantity').show();
                        $('#objectCost').show();
                        $('#moneyInput').hide();
                    } else if (pledgeType === 'Money') {
                        $('#moneyInput').show();
                        $('#type_id').select2({
                            dropdownParent: $('#payment_drop'),
                            theme: 'bootstrap-5',
                        width: '100%',
                        height:'20%',
                            placeholder: '-- Select Purpuse --',
                        
                        });
                         //putting the select2 on the payment drop
                        $('#payment_drop').show();
                        $('#objectQuantity').hide();
                        $('#objectCost').hide();
                    } else {
                        hideAllFields();
                    }
                }
            } else {
                hideAllFields();
            }
        });

        // Helper function to reset pledge select and hide all fields
        function resetPledgeSelect() {
            $('#pledgeSelect').val('');
            $('#pledgeSelect').hide();
        }

        // Helper function to hide all fields
        function hideAllFields() {
            $('#objectQuantity').hide();
            $('#objectCost').hide();
            $('#moneyInput').hide();
        }

        // Helper function to get pledge type by ID
        function getPledgeTypeById(pledgeTypeId) {
            var pledgeType = '';
            // Replace with the logic to fetch pledge type by ID from the pledge_type table
            // For now, assuming pledge type with ID 1 is 'Object' and ID 2 is 'Money'
            switch (pledgeTypeId) {
                case 1:
                    pledgeType = 'Object';
                    break;
                case 9:
                    pledgeType = 'Money';
                    break;
            }
            return pledgeType;
        }
    });
    //select2 for the purpose
    // $('#itspurpose_drop').select2();
    $('#purpose_id').select2({
    dropdownParent: $('#itspurpose_drop'),
    theme: 'bootstrap-5',
   width: '100%',
   height:'20%',
    placeholder: '-- Select Purpuse --',
  
});
</script>


