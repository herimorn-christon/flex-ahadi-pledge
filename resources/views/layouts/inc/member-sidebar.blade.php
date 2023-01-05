<div class="sidebar">
 



    <!-- Sidebar Menu -->
    <nav class="mt-2">
      
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item ">
          <a href="{{ url('member/dashboard') }}" class="nav-link {{ Request::is('member/dashboard') ? 'active':'' }} {{ Request::is('member/my-notifications') ? 'active':'' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('member/my-pledges') }}" class="nav-link {{ Request::is('member/my-pledges') ? 'active':'' }}">
            <i class="nav-icon fas fa-balance-scale"></i>
            <p>
              My Pledges
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('member/my-payments') }}" class="nav-link {{ Request::is('member/my-payments') ? 'active':'' }}">
            <i class="nav-icon fas fa-credit-card"></i>
            <p>
              My Payments
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('member/my-cards') }}" class="nav-link  {{ Request::is('member/my-cards') ? 'active':'' }}">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
              My Cards
            </p>
          </a>
          
          <li class="nav-item">
            <a href="{{ url('member/my-reports') }}" class="nav-link {{ Request::is('member/my-reports') ? 'active':'' }}">
              <i class="nav-icon fas fa-file-pdf"></i>
              <p>
                My Reports
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('member/dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
              </p>
            </a>
          </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>