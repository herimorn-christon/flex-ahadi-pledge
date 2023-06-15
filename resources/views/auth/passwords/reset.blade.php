<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<style>
    body{
     background-image: url("backend/assets/images/auth-bg.jpg");
     background-attachment:fixed;
     background-size:cover;
     background-repeat:no-repeat;
     background-position:center;
}
.forget-pwd > a{
    color: #dc3545;
    font-weight: 500;
}
.forget-password .panel-default{
    padding: 31%;
    margin-top: -27%;
}
.forget-password .panel-body{
    padding: 15%;
    margin-bottom: -50%;
    background: #fff;
    border-radius: 5px;
    -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
img{
    width:40%;
    margin-bottom:10%;
}
.btnForget{
    background: #c0392b;
    border:none;
}
.forget-password .dropdown{
    width: 100%;
    border: 1px solid #ced4da;
    border-radius: .25rem;
}
.forget-password .dropdown button{
    width: 100%;
}
.forget-password .dropdown ul{
    width: 100%;
}
 </style>
<body>
    @php
   $company=App\Models\Company::first();
@endphp
<br>
<br>
<br>
    <div class="container forget-password">
        <div class="row">
            <div class="col-md-12 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <img src="{{ url('img/flex.png') }}" alt="car-key" border="0">
                            <h2 class="text-center">Reset password</h2>
                           
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                               
                                <label for="email" class="">{{ __('E-Mail Address') }}</label>
                                <div class="form-group row">
                
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus style="width:20rem">
                
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <label for="password" class="">{{ __('Password') }}</label> 
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" style="width:18rem">
                
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>
                                <div class="form-group row">
                                   <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"
                                        style="width:18rem">
                                    </div>
                                </div>
                
                                <div class="form-group row mb-0" style="display:flex;justify-content:center:align-items:center">
                                    <div class="col-md-6 offset-md-4" style="position:relative;left:-10rem">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Reset Password') }}
                                        </button>
                                    </div>
                                    <div class="col-md-6 offset-md-4" style="position:relative;left:30%;top:-40px;">
                                        <a href={{ url("/") }} class="btn btn-secondary">
                                            {{ __('Back Login') }}
                                        </a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
</body>
</html>