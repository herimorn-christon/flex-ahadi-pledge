 {{-- Assign Card Member Modal --}}
 <div class="modal fade" id="member-modal">
  <div class="modal-dialog ">
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
                $members= App\Models\User::where('role','member')->get();
                @endphp
                <div class="col-md-12">
                    <label for="" class="text-secondary">All Members</label>
                    <select name="user_id" id="user_id"  class="custom-select form-control">
                        <option value="">--Select Member --</option>
                        @foreach ( $members as $item)
                         <option value="{{ $item->id}}">{{ $item->fname}} {{ $item->mname}} {{ $item->lname}}</option>
                         @endforeach
                    </select>
                </div>
    
                @php
                
                $purpose= App\Models\Card::where('status','')->get();
                @endphp
                <div class="col-md-12 mb-3">
                    <label for="" class="text-secondary">Available Cards</label>
                    <select name="card_no" id="card_no" class="custom-select form-control">
                        <option value="">--Select  Card --</option>
                        @foreach ( $purpose as $item)
                         <option value="{{ $item->id}}"> {{ $item->card_no}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">

                <div class="row mt-2">

                    <div class="col-md-6 mb-3">
                        <label for="" class="text-secondary">Status</label>
                        <input type="checkbox" name="status" id="">
                    </div>

                    <div class="col-md-6 ">
                        <button class="btn bg-navy btn-block " id="save-member-btn" type="submit">
                        <i class="fa fa-save"></i>
                        Assign Card
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
