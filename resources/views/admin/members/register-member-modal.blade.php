<!-- Register User Modal Page -->

<div class="modal fade" id="form-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:1250px;">
      <div class="modal-content">
        <div class="modal-header bg-light">
            <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
      
        </div>
        <div class="modal-body">
            {{--start of displaying errors --}}
            <div id="error-div"></div>
            {{--end of displaying errors --}}

            {{--start of user registration form --}}
            <form >
                   <input type="hidden" name="update_id" id="update_id">
                <div class="row">
                <div class="mb-2 col-md-6">
                    <label for="fname" class="text-secondary">{{ __('First Name') }}</label>

                    <div class="form-group">
                        <input id="fname" type="text" placeholder="Enter First Name" class="text-capitalize form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="name" autofocus type="required">

                        @error('fname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-2 col-md-6">
                    <label for="mname" class="text-secondary">{{ __('Middle Name') }}</label>

                    <div class="">
                        <input id="mname" type="text" placeholder="Enter Middle Name" class="text-capitalize  form-control @error('mname') is-invalid @enderror" name="mname" value="{{ old('fname') }}" required autocomplete="name" autofocus type="required">

                        @error('mname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="lname" class="text-secondary">{{ __('Last Name') }}</label>

                    <div class="form-group">
                        <input id="lname" type="text" placeholder="Enter Last Name" class="text-capitalize  form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="name" autofocus type="required">

                        @error('lname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 mb-2">
                    <label for="phone" class="form-label text-secondary ">{{ __('phone') }}</label>

                    <div class="form-group">
                        <input id="phone" type="text" maxlength="10" placeholder="Enter Phone Number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus type="required">

        
                    </div>
                </div>
                <div class="col-lg-6 mb-2">
                    <label for="email" class="text-secondary">{{ __('Email Address') }}</label>

                    <div class="form-group">
                        <input id="email" type="email" placeholder="Enter Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" type="required">

        
                    </div>
                </div>

                @php
                $jumuiya= App\Models\Jumuiya::get();
                @endphp
                <div class="col-md-6">
                    <label for="" class="text-secondary">Jumuiya (Community) </label>
                    <select name="jumuiya" id="jumuiya" class="form-control">
                        <option value="">--Select Community (Jumuiya) --</option>
                        @foreach ( $jumuiya as $item)
                         <option value="{{ $item->id}}">{{ $item->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-6">
                    <label for="card_no" class="text-secondary">Birthdate</label>
                    <div class="form-group form-primary mb-2"> 
                        <input id="date_of_birth" type="date" class="form-control" name="date_of_birth" placeholder="" > </div>
                </div>

            <div class="col-lg-6">
                    <label for="gender" class="text-secondary">Gender</label>
                    <select name="gender" id="gender" class="form-control">
                            <option value="">--Select Gender --</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                    </select>
               
            </div>

                <div class="col-md-6 mb-2">
                    <label for="password" class="text-secondary">{{ __('Password') }}</label>

                    <div class="form-group">
                        <input id="password" placeholder="Enter Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-2 text-secondary">
                    <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>

                    <div class="form-group">
                        <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                {{-- start of member status select --}}
                <div class="col-md-6">
                    <label for="" class="text-secondary"> Member Status</label>
                    <select name="status" id="status" class="form-control bg-light">
                      <option value="0">Enabled</option>
                      <option value="1">Disabled</option>
                    </select>
                  
                </div>
                {{-- end of member status select --}}
                <div class="col-md-3"></div>
                <div class="col-md-3 mb-0 ">
                        <label for="" class="text-white">.</label>
                            <button type="submit" class="btn  text-decoration-none text-light bg-flex btn-block col-lg-12" id="save-member-btn">
                               <i class="fa fa-save"></i>
                                {{ __('Save Member') }}
                            </button>
                        </div>
             
            </div>
            </form>

            {{--end of user registration form --}}
        </div>
    
      </div>
    </div>
  </div>