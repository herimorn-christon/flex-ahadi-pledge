<div class="sidebar">
 



    <!-- Sidebar Menu -->
    <nav class="mt-2">
      
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item ">
          <a href="{{ url('admin/dashboard') }}" class="nav-link  {{ Request::is('admin/dashboard') ? 'current':'' }} {{ Request::is('admin/my-profile') ? 'current':'' }}" 
          data-toggle="tooltip" data-placement="right" title="Click here to View the admin homepage "
          >
            <i class="nav-icon fas fa-tachometer-alt "></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('admin/all-members') }}" class="nav-link  {{ Request::is('admin/all-members') ? 'current':'' }}"
            data-toggle="tooltip" data-placement="right" title="Click here to Manage all congregation members "
            >
              <i class="nav-icon fas fa-user-tie "></i>
              <p>
                Manage Members
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/all-communities') }}" class="nav-link  {{ Request::is('admin/all-communities') ? 'current':'' }}">
              <i class="nav-icon fas fa-users "></i>
              <p>
                Manage Communities
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/all-purposes') }}" class="nav-link  {{ Request::is('admin/all-purposes') ? 'current':'' }}">
              <i class="nav-icon fas fa-calendar "></i>
              <p>
                Manage Purposes
              </p>
            </a>
          </li>
        <li class="nav-item">
          <a href="{{ url('admin/all-pledges') }}" class="nav-link  {{ Request::is('admin/all-pledges') ? 'current':'' }}">
            <i class="nav-icon fas fa-balance-scale "></i>
            <p>
              Manage Pledges
            </p>
          </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('admin/all-payments') }}" class="nav-link {{ Request::is('admin/all-payments') ? 'current':'' }}">
              <i class="nav-icon fas fa-credit-card "></i>
              <p>
                Manage Payments
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/all-cards') }}" class="nav-link {{ Request::is('admin/all-cards') ? 'current':'' }}">
              <i class="nav-icon fas fa-envelope "></i>
              <p>
                Manage Cards
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/all-announcements') }}" class="nav-link {{ Request::is('admin/all-announcements') ? 'current':'' }}"  >
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Announcements
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/settings') }}" class="nav-link {{ Request::is('admin/settings') ? 'current':'' }}">
              <i class="nav-icon fas fa-cog "></i>
              <p>
                Settings
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/support') }}" class="nav-link {{ Request::is('admin/support') ? 'current':'' }}">
              <i class="nav-icon fas fa-headset"></i>
              <p>
                Member Support
              </p>
            </a>
          </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>