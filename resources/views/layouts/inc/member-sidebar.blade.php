<div class="sidebar">
 



    <!-- Sidebar Menu -->
    <nav class="mt-2">
      
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item ">
          <a href="{{ url('member/dashboard') }}" class="nav-link {{ Request::is('member/dashboard') ? 'current':'' }} {{ Request::is('member/my-notifications') ? 'current':'' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('member/my-pledges') }}" class="nav-link {{ Request::is('member/my-pledges') ? 'current':'' }}">
            <i class="nav-icon fas fa-balance-scale"></i>
            <p>
              My Pledges
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('member/my-payments') }}" class="nav-link {{ Request::is('member/my-payments') ? 'current':'' }}">
            <i class="nav-icon fas fa-credit-card"></i>
            <p>
              My Payments
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('member/my-cards') }}" class="nav-link  {{ Request::is('member/my-cards') ? 'current':'' }}">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
              My Cards
            </p>
          </a>
          
          <li class="nav-item">
            <a href="{{ url('member/my-announcements') }}" class="nav-link {{ Request::is('member/my-announcements') ? 'current':'' }}">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Announcement
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('member/my-reports') }}" class="nav-link {{ Request::is('member/my-reports') ? 'current':'' }}">
              <i class="nav-icon fas fa-file-pdf"></i>
              <p>
                My Reports
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('member/settings') }}" class="nav-link {{ Request::is('member/settings') ? 'current':'' }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('member/support') }}" class="nav-link {{ Request::is('member/support') ? 'current':'' }}">
              <i class="nav-icon fas fa-headset"></i>
              <p>
                Report a Problem
              </p>
            </a>
          </li>
        
          {{-- <li class="nav-item">
            <a href="{{ url('member/spiritual/') }}" class="nav-link {{ Request::is('member/spiritual') ? 'current':'' }}">
              <i class="nav-icon fas fa-headset"></i>
              <p>
                spiritual
              </p>
            </a>
          </li>

          <!--starting of the user guid manual sheet -->
          <li class="nav-item">
            <a href="{{ url('member/user-manual/') }}" class="nav-link {{ Request::is('member/user-manual') ? 'current':'' }}">
              <i class="nav-icon fas fa-headset"></i>
              <p>
                user guide
              </p>
            </a>
          </li> --}}
          <!--ending of the user guide manual sheet -->
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>