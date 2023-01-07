@extends('layouts.app')

@section('content')
<style>
    .page-item.active .page-link{
        color: whitesmoke !important;
        background-color: #1888cb  !important; 
        border: none;
    }

     .page-link {
      
        text-decoration: none !important;
        color:#1888cb  !important;
    }
    .bg-flex{
      background-color: #1888cb;
    }
    .bg-navy{
      background-color: #1888cb !important;
    }
    .text-navy{
      color: #1888cb !important;
    }
    .paginate_button{
      margin: 1px !important;
    }
    .paginate_button.disabled{
      color: gainsboro !important;
    }
    .dataTables_paginate .paginate_button:hover{
      border: 1px solid transparent !important;
      background: transparent !important;
    }

    .current {
        border-left: 0.45rem solid #1888cb !important;
        background-color:#f2f3f4 !important;
      }
    .bg-teal{
      background-color: #01b4f2 !important;
    }
    
    .text-teal{
      color: #01b4f2 !important;
    }
      .border-bottom-navy {
        border-bottom: 0.25rem solid #1888cb !important;
      }
      .border-top-navy {
        border-top: 0.25rem solid #1888cb !important;
      }
      .nav-tabs .nav-link.active{
        background-color: #1888cb  !important;
        font-weight:bold;
        color: #e5e9ec !important;
      }

</style>
<div class="row my-2 py-5">
    <div class="col-md-4 mx-auto my-5">
        <div class="card border-top-navy">

            <div class="card-body">
                <div class="py-4 mt-2">
                    <div class="col-md-5 mx-auto">
                        <img src="{{ asset('img/logoshorts.png') }}" alt="Flex Logo" class="" width="100%" height="60px">
                    </div>
                    <h4 class="text-center text-navy py-2">
                        <span class="font-weight-bolder">AhadiPledge</span> 
                    </h4>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
    
                    <div class="row mb-2">
                       
                        <div class="input-group mb-3">
                           
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Phone Number/Nambari ya Simu" aria-label="Username" aria-describedby="basic-addon1">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
          
                    </div>
    
                    <div class="row mb-3">
                       
    
                        <div class="input-group mb-32">
                            
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password/Neno siri" aria-label="Password" aria-describedby="basic-addon1" required autocomplete="current-password">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="row mb-3">
    
                        <div class="col-md-5 offset-md-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <button type="submit" class="btn bg-navy btn-block col-lg-12 font-weight-bolder">
                                {{ __('Sign In') }}
                            </button>
                        </div>
                      
    
    
                    </div>
                </form>
            </div>
          
        </div>
      
            
    </div>
</div>

@endsection