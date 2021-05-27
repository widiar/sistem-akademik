<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                @if (Auth::user()->role_id == 3)
                <li class="nav-item">
                    <a href="{{ route('admin.banner.index') }}"
                        class="nav-link{{request()->is('admin/banner') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            Banner
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.news.index') }}"
                        class="nav-link{{request()->is('admin/news') ? ' active' : '' }}">
                        <i class="nav-icon far fa-newspaper"></i>
                        <p>
                            News
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link{{request()->is('admin/news') ? ' active' : '' }}">
                        <i class="nav-icon far fa-newspaper"></i>
                        <p>
                            Intensif Marketing
                        </p>
                    </a>
                </li>
                @elseif(Auth::user()->role_id == 1)
                <li class="nav-item">
                    <a href="#" class="nav-link{{request()->is('admin/dosen') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Data Dosen
                        </p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>