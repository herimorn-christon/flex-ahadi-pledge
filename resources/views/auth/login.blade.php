@extends('layouts.app')

@section('content')

<div class="row my-5 py-5">
    <div class="col-md-4 mx-auto my-5">
        <div class="card">

            <div class="card-body">
                <div class="py-4 mt-4">
                    <h2 class="text-center text-navy py-2">
                        <span class="font-weight-bolder">Flèx</span>  <span class="text-danger">AhadiPledge</span> 
                    </h2>
                </div>

                <form method="POST" class="form" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="row mb-3">
                        <label for="password" class="text-primary col-md-1 col-form-label text-md-end">
                  
                        </label>
                    <div class="col-md-10">
                     
                    <input id="phone" placeholder="Phone Number/Nambari ya Simu" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                    
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    </div>
                    </div>
                    
                    <div class="row mb-3">
                    <label for="password" class="text-primary col-md-1 col-form-label text-md-end">
                  
                    </label>
                    
                    <div class="col-md-10">
                    <input id="password" placeholder="Password/Neno siri" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    
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
                    
                    <label class="form-check-label text-navy" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                    </div>
                    </div>
                    <div class="col-md-6 ">
                    <button type="submit" class="btn bg-navy btn-block col-lg-12">
                    {{ __('Login') }}
                    
                    <i class="fa fa-sign-in-alt"></i>
                    </button>
                    </div>
                    
                    
                    
                    </div>
                    </form>
            </div>
           <div class="card-footer bg-navy">

           </div>
        </div>
      
            
    </div>
</div>

@endsection