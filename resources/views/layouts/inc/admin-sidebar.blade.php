<div class="sidebar">
 



    <!-- Sidebar Menu -->
    <nav class="mt-2">
      
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item ">
          <a href="{{ url('admin/dashboard') }}" class="nav-link  {{ Request::is('admin/dashboard') ? 'active':'' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('admin/all-members') }}" class="nav-link  {{ Request::is('admin/all-members') ? 'active':'' }}">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Manage Members
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/all-communities') }}" class="nav-link  {{ Request::is('admin/all-communities') ? 'active':'' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manage Communities
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/all-purposes') }}" class="nav-link  {{ Request::is('admin/all-purposes') ? 'active':'' }}">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Manage Purposes
              </p>
            </a>
          </li>
        <li class="nav-item">
          <a href="{{ url('admin/all-pledges') }}" class="nav-link  {{ Request::is('admin/all-pledges') ? 'active':'' }}">
            <i class="nav-icon fas fa-balance-scale"></i>
            <p>
              Manage Pledges
            </p>
          </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('admin/all-payments') }}" class="nav-link {{ Request::is('admin/all-payments') ? 'active':'' }}">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>
                Manage Payments
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/all-cards') }}" class="nav-link {{ Request::is('admin/all-cards') ? 'active':'' }}">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Manage Cards
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/all-reports') }}" class="nav-link {{ Request::is('admin/all-reports') ? 'active':'' }}">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Reports
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('member/settings') }}" class="nav-link">
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