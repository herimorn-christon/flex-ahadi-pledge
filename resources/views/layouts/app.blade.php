<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')</title>
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keyword')">
    <meta name="author" content="Flex">

    <link rel="shortcut icon" href="#" type="image/x-icon">


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
    
      .border-bottom-navy {
        border-bottom: 0.25rem solid #001f3f !important;
      }

      .nav-tabs .nav-link.active{
        background-color: #1888cb  !important;
        font-weight:bold;
        color: #e5e9ec !important;
      }

</style>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
      <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="bg-light">
    <div id="app" class="bg-light">

        {{-- including navbar --}}
        @include('layouts.inc.frontend-navbar')
        @yield('top')
        <main class="">
            @yield('content')
        </main>


<!-- end of move to the top -->

  
    </div>
   <!-- Scripts -->

   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}" ></script>
   <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/scripts.js') }}" ></script>
</body>
</html>
