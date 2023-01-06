
<form method="POST" action="{{ route('login') }}">
@csrf

<div class="row mb-2">

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
<i class="fa fa-lock" aria-hidden="true"></i>
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

<label class="form-check-label" for="remember">
    {{ __('Remember Me') }}
</label>
</div>
</div>
<div class="col-md-6 ">
<button type="submit" class="btn btn-primary btn-block col-lg-12">
{{ __('Login') }}

<i class="fa fa-sign-in-alt"></i>
</button>
</div>



</div>
</form>