    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
          <img src="{{ asset('assets/dist/img/w.png') }}" alt="ownerLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">HRM</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                  <a href="{{ route('owner.home') }}" class="nav-link {{ (request()->is('owner/dashboard')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-dashboard-alt"></i>
                    <p>Dashboard </p>
                  </a>
                </li>
              <li class="nav-item">
                <a href="{{ route('owner.manage.team-leader') }}" class="nav-link {{ (request()->is('owner/manage/team-leader*')) ? 'active' : '' }}">
                {{-- <a href="" class="nav-link"> --}}
                  <i class="nav-icon fas fa-users"></i>
                  <p> Manage Team Lead</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('owner.manage.employee') }}" class="nav-link {{ (request()->is('owner/manage/employee*')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-users"></i>
                  <p> Manage Employee</p>
                </a>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
</aside>
