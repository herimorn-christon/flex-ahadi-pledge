{{-- Assign Card Member Modal --}}
 <div class="modal fade" id="edit-modal">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div id="errors-div"></div>
             <form>
             <input type="hidden" name="update_Id" id="update_Id">
  
             <div class="row mb-3">
                @php
                 $new_user=Auth::user()->church_id;
                $members = App\Models\User::whereHas('roles', function ($query) {
                        $query->where('name', 'member');
                    })
                ->where('church_id', $new_user)
                ->get()
                @endphp
                <div class="col-md-12">
                    <label for="" class="text-secondary">All Members</label>
                    <select name="user_Id" id="user_Id"  disabled  class="form-control" >
                        <option value="">--Select Member --</option>
                        @foreach ( $members as $item)
                         <option value="{{ $item->id}}">{{ $item->fname}} {{ $item->mname}} {{ $item->lname}}</option>
                         @endforeach
                    </select>
                </div>
    
                @php
                
                $purpose= App\Models\Card::get();
                @endphp
                <div class="col-md-12 mb-3">
                    <label for="" class="text-secondary">Available Cards</label>
                    <select name="card_No" id="card_No" disabled class="form-control" >
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
                       <select name="card_status" id="card_status" class="select form-control">
                        <option value="0">Active</option>
                        <option value="1">Inactive</option>
                       </select>
                    </div>

                    <div class="col-md-6 ">
                      <label for="" class="text-white">.</label>
                        <button class="btn bg-flex text-light btn-block " id="edit-member-btn" type="submit">
                        <i class="fa fa-save"></i>
                        Change Card Status
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
