<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand px-1" href="{{ url('admin/dashboard')}}" style="font-weight:bold;">

        <img src="{{ asset('assets/images/logo.png') }}" width="24px" height="24px" alt="logo here">
        <i>Tazpedia</i> <i class="text-danger">.com</i>
        </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <a href="{{ url('admin/messages') }}" class="text-decoration-none nav-item text-light px-4">
        <i class="fa fa-envelope text-danger" aria-hidden="true"></i>

    </a>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-danger" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">

        <li class="nav-item ">

            <form action="{{ route('logout') }}" id="logout-form" method="post" class="me-lg-4">
                @csrf
                <button type="submit" class="btn btn-sm text-light">
                     <i class="fa fa-power-off text-danger" aria-hidden="true"></i>
                     </button>
            </form>
        </li>

    </ul>
</nav>
