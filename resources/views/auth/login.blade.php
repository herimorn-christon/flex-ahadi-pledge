<!--This is the view for user login page -->
@extends('layouts.app')

@section('content')

<div class="row my-5 py-5">
    <div class="col-md-4 mx-auto my-5 col-sm-8 col-11">
        <div class="card border-top-flex">

            <div class="card-body">
            
                <div class="py-4 mt-2">
                  {{-- start of flex logo --}} 
                   <div class="col-md-5 col-sm-5 col-5 mx-auto">
                        <img src="{{ asset('img/logoshorts.png') }}" alt="Flex Logo" class="" width="100%" height="60px">
                    </div>
                  {{-- start of flex logo --}} 

                    <h4 class="text-center text-flex py-2">
                        <span class="font-weight-bolder">AhadiPledge</span> 
                    </h4>
                </div>
                  {{-- start of login form  --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf
    
                  
                    <div class="row mb-2">
                       
                        <div class="input-group mb-3">
                           
                            <input type="text" class="form-control " name="phone" id="phone" placeholder="Phone Number/Nambari ya Simu" aria-label="Username" aria-describedby="basic-addon1" required>
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
                        
                        </div>
          
                    </div>
    
                    <div class="row mb-3">
                       
    
                        <div class="input-group mb-32">
                            
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password/Neno siri" aria-label="Password" aria-describedby="basic-addon1" required  required>
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                      
                        </div>
                    </div>
    
                    <div class="row mb-3">
                      {{-- start displaying errors --}}
                      @if ($errors->any())
                      <div class="btn btn-danger disabled btn-block mb-3">
                          @foreach ($errors->all() as $error)
                              <div>{{$error}}</div>
                          @endforeach
                      </div>
                      @endif
                       {{--end  displaying errors --}}
                        <div class="col-md-5 offset-md-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <button type="submit" class="btn bg-flex text-light btn-block col-lg-12 font-weight-bolder">
                                {{ __('Sign In') }}
                            </button>
                        </div>
                      
    
    
                    </div>
                </form>
                  {{-- end of login form  --}}
            </div>
          
        </div>
      
            
    </div>
</div>

@endsection