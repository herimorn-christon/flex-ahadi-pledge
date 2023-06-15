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
                            <h2 class="text-center">Forgot Password?</h2>
                            <p>Please Enter Your Email To get Reset Link</p>
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                       
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                        <input type="email" id="typeEmail" class="form-control my-3" name="email" placeholder="Your email address"/>
                                    
                                    </div>
                                </div>
                               
                                <div class="form-group"> 
                                    <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
                                    <div class="d-flex justify-content-between mt-4">
                                        <a class="" href="{{ url('/') }}">Login</a>
                                        <a class="" href="{{ url("/register") }}">Register</a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
</body>
</html>