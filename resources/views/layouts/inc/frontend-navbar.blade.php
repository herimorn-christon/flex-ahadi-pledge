<div class="gloabal-navbar">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark " id="nav">
            <a class="navbar-brand px-1" href="{{ url('/')}}" style="font-weight:bold;">

            <img src="{{ asset('assets/images/logo.png') }}" width="24px" height="24px" alt="logo here">
            <i>Tazpedia</i> <i class="text-danger">.com</i>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="form-inline my-2 my-lg-0 d-none d-md-block mx-auto  " method="get" action="result.php">
                    <input class="form-control mr-sm-2" name="item" type="search" placeholder="Search here.." aria-label="Search" hidden>
                    <button class="btn btn-danger my-2 my-sm-0" type="submit" hidden >Search</button>
                  </form>
                <ul class="navbar-nav  px-2">
                  <li class="nav-item ">
                    <a class="nav-link {{ Request::is('/') ? 'active':'' }}" href="{{ url('/')}}">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link {{ Request::is('courses') ? 'active':'' }}" href="{{ url('courses')}}">Courses</a>
                  </li>

                  <li class="nav-item ">
                    <a class="nav-link {{ Request::is('faqs') ? 'active':'' }}" href="{{ url('faqs')}}">FAQs</a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link {{ Request::is('books') ? 'active':'' }}" href="{{ url('books')}}">Books </a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link {{ Request::is('encyclopedia') ? 'active':'' }}" href="{{ url('encyclopedia')}}">Encyclopedia </a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link {{ Request::is('biographies') ? 'active':'' }}" href="{{ url('biographies')}}">Biographies </a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link {{ Request::is('about') ? 'active':'' }}" href="{{ url('about')}}"> About </a>
                  </li>



                </ul>

                <!-- <form class="form-inline my-2 my-lg-0 d-none d-md-block " method="get" action="result.php">
                    <input class="form-control mr-sm-2" name="item" type="search" placeholder="Search here.." aria-label="Search">
                    <button class="btn btn-danger my-2 my-sm-0" type="submit">Search</button>
                  </form> -->

        </nav>

</div>
