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
                    <a href="{{ route('admin.intensif-marketing.index') }}"
                        class="nav-link{{request()->is('admin/intensif-marketing') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-money-check"></i>
                        <p>
                            Intensif Marketing
                        </p>
                    </a>
                </li>
                @elseif(Auth::user()->role_id == 1)
                <li class="nav-item">
                    <a href="{{ route('admin.dosen') }}"
                        class="nav-link{{request()->is('admin/dosen*') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Data Dosen
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.matakuliah.index') }}"
                        class="nav-link{{request()->is('admin/mata-kuliah*') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>
                            Mata Kuliah
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.rekap.dosen') }}"
                        class="nav-link{{request()->is('admin/rekap-dosen') ? ' active' : '' }}">
                        <i class="nav-icon far fa-file-alt"></i>
                        <p>
                            Rekap Dosen
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.absen.dosen') }}"
                        class="nav-link{{request()->is('admin/absen-dosen') ? ' active' : '' }}">
                        <i class="nav-icon far fa-folder-open"></i>
                        <p>
                            Absen Dosen
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.rekap.absen.dosen') }}"
                        class="nav-link{{request()->is('admin/rekap/absen-dosen') ? ' active' : '' }}">
                        <i class="nav-icon far fa-folder-open"></i>
                        <p>
                            Rekap Absen Dosen
                        </p>
                    </a>
                </li>
                @elseif(Auth::user()->role_id == 2)
                <li class="nav-item">
                    <a href="{{ route('admin.rekap.dosen') }}"
                        class="nav-link{{request()->is('admin/rekap-dosen') ? ' active' : '' }}">
                        <i class="nav-icon far fa-file-alt"></i>
                        <p>
                            Rekap Dosen
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-archive"></i>
                        <p>
                            Rekap Absensi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('admin.rekap.absen.dosen') }}"
                                class="nav-link{{request()->is('admin/rekap-absen-dosen') ? ' active' : '' }}">
                                <i class="fas fa-folder-open nav-icon"></i>
                                <p>Dosen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.rekap.absen.staff') }}"
                                class="nav-link{{request()->is('admin/rekap/absen-staff') ? ' active' : '' }}">
                                <i class="fas fa-folder-open nav-icon"></i>
                                <p>Staff</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.penggajian') }}"
                        class="nav-link{{request()->is('admin/penggajian') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                            Penggajian
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.laporan-gaji') }}"
                        class="nav-link{{request()->is('admin/laporan-gaji') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Laporan Gaji
                        </p>
                    </a>
                </li>
                @elseif(Auth::user()->role_id == 4)
                <li class="nav-item">
                    <a href="{{ route('admin.staff.index') }}"
                        class="nav-link{{request()->is('admin/staff*') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Data Staff
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.absen.staff') }}"
                        class="nav-link{{request()->is('admin/absen-staff') ? ' active' : '' }}">
                        <i class="nav-icon far fa-folder-open"></i>
                        <p>
                            Absen Staff
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.rekap.absen.staff') }}"
                        class="nav-link{{request()->is('admin/rekap/absen-staff') ? ' active' : '' }}">
                        <i class="nav-icon far fa-folder-open"></i>
                        <p>
                            Rekap Absen Staff
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