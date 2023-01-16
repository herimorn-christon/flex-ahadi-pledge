{{-- register new pledge  modal--}}


  <div class="modal fade" id="formsw-modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <button type="button" class="btn-close btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         {{-- start of error displaying message --}}
                         <div id="error-div"></div>
         {{-- start of error displaying message --}}

         {{-- start of add message pledge--}}
             <form>
          <input type="hidden" name="update_id" id="update_id">
             <div class="row ">
             @php
             $jumuiya= App\Models\User::where('role','member')->get();
             @endphp
             <div class="col-md-6">
                 <label for="" class="text-secondary">Pledge Owner</label>
                 <select name="user_id" id="user_id" class="form-control">
                     <option value="">--Select Member --</option>
                     @foreach ( $jumuiya as $item)
                     <option value="{{ $item->id}}">{{ $item->fname}} {{ $item->mname}} {{ $item->lname}}</option>
                     @endforeach
                 </select>
             </div>
             @php
             $types= App\Models\PledgeType::get();
             @endphp
             <div class="col-md-6">
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
             <div class="col-md-6">
                 <label for="" class="text-secondary">Pledge Purpose</label>
                 <select name="purpose_id" id="purpose_id" class="form-control">
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
                     <label for="" class="text-secondary"> Pledge Status</label>
                     <select name="status" id="status" class="form-control bg-light">
                       <option value="0">Not Fullfilled</option> 
                       <option value="1">Fullfilled</option>
                     </select>
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
        {{-- end of add pledge form --}}
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  <div class="modal fade" id="form-modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <button type="button" class="btn-close btn-sm btn-danger " data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form >
              <input type="hidden" name="update_id" id="update_id">
                <div class="row mb-3">
                    @php
                    $jumuiya= App\Models\User::where('role','member')->get();
                    @endphp
                    <div class="col-md-6">
                        <label for="" class="text-secondary">Pledge Owner</label>
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="">--Select Member --</option>
                            @foreach ( $jumuiya as $item)
                            <option value="{{ $item->id}}">{{ $item->fname}} {{ $item->mname}} {{ $item->lname}}</option>
                            @endforeach
                        </select>
                    </div>
                    @php
                    $types= App\Models\PledgeType::get();
                    @endphp
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                        <label for="" class="text-secondary">Pledge Purpose</label>
                        <select name="purpose_id" id="purpose_id" class="form-control">
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
                            <label for="" class="text-secondary"> Pledge Status</label>
                            <select name="status" id="status" class="form-control bg-light">
                              <option value="0">Not Fullfilled</option> 
                              <option value="1">Fullfilled</option>
                            </select>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3 ">
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
