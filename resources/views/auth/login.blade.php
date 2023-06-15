<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <title>flex-ahadiPledge</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('img/logoshorts.png') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
</head>
@php
    $languages = config('app.languages');
@endphp
<body class="auth-body-bg">
    <div class="bg-overlay"></div>
    <div class="wrapper-page">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mt-4">
                        <div class="mb-3">
                            <a href="index.html" class="auth-logo">
                                <img src="{{ asset('img/logoshorts.png') }}" height="90" class="logo-dark mx-auto" alt="">
                                <img src="{{ asset('backend/assets/images/logo-light.png') }}" height="30" class="logo-light mx-auto" alt="">
                            </a>
                        </div>
                    </div>
                    <div>
                        {{-- <label for="language">Language:</label> --}}
                        <select name="language" id="language" onchange="changeLanguage(this)" class="form-control" 
                        style="margin-left:20px;width:90%">
                           <option value="">{{ __("select language") }}</option>
                            <option value="en" {{ session('locale') === 'en' ? 'selected' : '' }}>English</option>
                            <option value="sw" {{ session('locale') === 'sw' ? 'selected' : '' }}>Swahili</option>
                        </select>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="p-3">
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" type="text" name="phone" id="phone" placeholder="{{__('Phone Number')  }}">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" type="password" required="" placeholder="{{ __('Password') }}" id="password" name="password">
                                </div>
                            </div>

                        

                            <div class="row mb-3">
                                {{-- Display errors --}}
                                @if ($errors->any())
                                    <div class="btn btn-danger disabled btn-block mb-3">
                                        @foreach ($errors->all() as $error)
                                            <div>{{ $error }}</div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="form-group mb-3 text-center row mt-3 pt-1">
                                <div class="col-12">
                                    <button class="btn btn-info w-100 waves-effect waves-light" type="submit">{{ __('Log In')}}</button>
                                </div>
                            </div>

                            <div class="form-group mb-0 row mt-2" style="display:flex;justify-content:space-between">
                                <div class="col-sm-5 mt-3">
                                    <a href="{{ route('register') }}" class="text-muted"><i class="mdi mdi-account-circle"></i> {{ __('Create an account') }}</a>
                                </div>
                                <div class="col-sm-5 mt-3">
                                    <a href="{{ route('password.request') }}" class="text-muted"><i class="fa fa-key" aria-hidden="true"></i> {{ __('Forget Password') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        function changeLanguage(select) {
            const language = select.value;
            window.location.href = '{{ route('language.switch') }}?language=' + language;
        }
    </script>
    <script>
        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type','info') }}";
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
</body>
</html>
