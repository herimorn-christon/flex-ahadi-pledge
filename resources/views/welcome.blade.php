<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>AhadiPledge | Home</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
          <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-light bg-gradient-white static-top">
            <div class="container">
                <a class="navbar-brand" href="#!"> 
                
                    <img src="img/flex-logo.png" class="mt-2 " height="30px">
               
                </a>

                 <!-- Button trigger modal -->
        


            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Login To Your Account
                    </button>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead" style="background-image: url('{{ asset('img/undraw_posting_photo.svg') }}'    )">
            <div class="container position-relative">
                <div class="row ">
                    <div class="col-xl-6">
                        <div class=" text-white">
                            <!-- System Tiite -->
                            <h1 class="" style="font-weight: bold;text-shadow: rgb(255, 255, 255) 1px 0 10px;">
                             <span class="text-primary">Ahadi</span>
                             <span class="text-danger">Pledge</span>
                            </h1>
                        
                            <p class="mt-2" style="font-weight: bold;text-shadow: rgb(39 20 20 / 75%) 1px 0 10px;">
                                Will a mere mortal rob God? Yet you rob me. 'But you ask, 'How are we robbing you?' 'In tithes and offerings.
                            </p>
                            <p class="mt-3" style="font-weight: bold;text-shadow: rgb(39 20 20 / 75%) 1px 0 10px;">Malachi 3:8, NIV</p>
                  
                            <!-- Signup form-->
                          
                            <form class="form-subscribe" id="contactForm" data-sb-form-api-token="API_TOKEN">
                                <!-- Email address input-->
                                <div class="row">
                                    <div class="col-xl-8 mx-auto">
                                        <a data-bs-toggle="modal" data-bs-target="#registerModal" href="#myModal" class="btn btn-danger btn-block font-weight-bolder   mt-2">Join Us Now !</a>

                                  
                                        <a data-bs-toggle="modal" data-bs-target="#exampleModal" href="Member/dashboard.html" data-toggle="modal"  data-target="#loginModal"  class="btn btn-primary btn-block  mt-2 ">Login To Your Account</a>

                                    </div>
                                </div>
                               
                            </form>
                       
                        </div>

                    </div>
                </div>
            </div>
        </header>
        <!-- Icons Grid-->
        <section class="features-icons bg-light text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 ">
                        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-terminal m-auto text-primary"></i></div>
                            <h4 class="text-danger">Easy to Use</h4>
                            <p class="lead mb-0">Ready to use with your own content, or customize it!</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 ">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-clipboard-data m-auto text-primary"></i></div>
                            <h4 class="text-danger">Easy Management</h4>
                            <p class="lead mb-0">You can easily handle your daily Pledges.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 ">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-bell m-auto text-primary"></i></div>
                            <h4 class="text-danger">Daily Reminders</h4>
                            <p class="lead mb-0">Receive Daily Notifications of Your Pledges.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 ">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-headphones m-auto text-primary"></i></div>
                            <h4 class="text-danger">Full Support</h4>
                            <p class="lead mb-0">We Offer You Full Customer Support.</p>
                        </div>
                    </div>
          
                </div>
            </div>
        </section>

  
  <!--Login Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-light text-danger">
          <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="row mb-2">
                    <label for="email" class="col-md-1 col-form-label text-md-end text-primary">
                        <i class="fa fa-phone" aria-hidden="true"></i>
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
      </div>
    </div>
  </div>
  </div>

  <!-- Register Modal  -->

  <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:1250px;">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="fname" class="">{{ __('First Name') }}</label>

                    <div class="form-group">
                        <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="name" autofocus>

                        @error('fname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="mname" class="">{{ __('Middle Name') }}</label>

                    <div class="">
                        <input id="mname" type="text" class="form-control @error('mname') is-invalid @enderror" name="mname" value="{{ old('fname') }}" required autocomplete="name" autofocus>

                        @error('mname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lname" class="">{{ __('Last Name') }}</label>

                    <div class="form-group">
                        <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="name" autofocus>

                        @error('lname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="phone" class="form-label ">{{ __('phone') }}</label>

                    <div class="form-group">
                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="email" class="">{{ __('Email Address') }}</label>

                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                @php
                $jumuiya= App\Models\Jumuiya::get();
                @endphp
                <div class="col-md-6">
                    <label for="">Jumuiya (Community) </label>
                    <select name="jumuiya" class="form-control">
                        <option value="">--Select Jumuiya --</option>
                        @foreach ( $jumuiya as $item)
                         <option value="{{ $item->id}}">{{ $item->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="password" class="">{{ __('Password') }}</label>

                    <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>

                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="col-md-12 mb-0 ">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-block text-decoration-none text-light bg-primary col-lg-6">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    
      </div>
    </div>
  </div>
        <!-- Footer-->
        <footer class="footer bg-dark">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 h-100 text-center text-lg-start my-auto">
                        <ul class="list-inline mb-2">
                            <li class="list-inline-item "><a href="#!" class="text-decoration-none text-light">About</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!" class="text-decoration-none text-light">Contact</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!" class="text-decoration-none text-light">Terms of Use</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!" class="text-decoration-none text-light">Privacy Policy</a></li>
                        </ul>
                        <p class="text-muted small mb-4 mb-lg-0">&copy; AhadiPledge 2022. All Rights Reserved.</p>
                    </div>
                    <div class="col-lg-6 h-100 text-center text-lg-end my-auto">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item me-4">
                                <a href="#!" class="text-danger"><i class="bi-facebook fs-3"></i></a>
                            </li>
                            <li class="list-inline-item me-4">
                                <a href="#!" class="text-danger"><i class="bi-twitter fs-3"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!" class="text-danger"><i class="bi-instagram fs-3"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('js/scripts.js') }}"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

        <!-- Script for Modal -->
        <script>
            const myModal = document.getElementById('myModal')
            const myInput = document.getElementById('myInput')

            myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
            })

        </script>
    </body>
</html>
