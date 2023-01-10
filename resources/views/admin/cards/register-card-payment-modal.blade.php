{{-- Add Card Payment modal --}}

<div class="modal fade" id="payment-modal">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header bg-light">
      <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>
      <div class="modal-body">
        <div id="error-div"></div>
          <form >
            <input type="hidden" name="update_id" id="update_id">
              <div class="row mb-3">
                @php
                $cardMember= App\Models\CardMember::where('status','')->get();
                @endphp
                <div class="col-md-12">
                    <label for="" class="text-secondary">Member Card</label>
                    <select name="card_member" id="card_member"  class="form-control">
                        <option value="">--Select Member Card --</option>
                        @foreach ( $cardMember as $item)
                         <option value="{{ $item->id}}">{{ $item->card->card_no}} / {{ $item->user->id}} </option>
                         @endforeach
                    </select>
                </div>
               <div class="col-md-12">
                  <div class="form-group">
                      <label for="amount" class="text-secondary">Paid Amount</label>
                      <input type="text" name="card_amount" id="card_amount" class="form-control" placeholder="Enter Paid Amount">
                  </div>
               </div>
               <div class="col-md-6"></div>
               <div class="col-md-6">
                  <div class="form-group">
                   
                      <button type="submit" class="btn bg-navy btn-block" id="save-payment-btn">
                          <i class="fa fa-save"></i>
                          Save Card Payment
                      </button>
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

    </div>
</div>


 