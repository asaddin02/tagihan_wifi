<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link text-decoration-none">
        <img src="{{ asset('template/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (isset(Auth::user()->photo_profile))
                    <img src="{{ asset('storage/' . Auth::user()->photo_profile) }}" class="img-circle elevation-2"
                        alt="User Image">
                @else
                    <img src="{{ asset('photo/default.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                @endif

            </div>
            <div class="info">
                <a href="{{ url('profile') }}" class="d-block text-decoration-none">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="cari menu"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar" title="cari">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('/') }}"
                        class="nav-link @if ($title == 'Home') {{ 'active' }} @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dasbor
                        </p>
                    </a>
                </li>
                @if (Auth::user()->role == 'Admin')
                    <li class="nav-item">
                        <a href="#" class="nav-link @if ($title == 'Pendapatan' || $title == 'Pengeluaran') {{ 'active' }} @endif">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Keuangan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('income') }}" class="nav-link @if ($title == 'Pendapatan') {{ 'active' }} @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pendapatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('spending') }}" class="nav-link @if ($title == 'Pengeluaran') {{ 'active' }} @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pengeluaran</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link @if ($title == 'Teknisi' || $title == 'Customer Service') {{ 'active' }} @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Pegawai
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('technic') }}"
                                class="nav-link @if ($title == 'Teknisi') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Teknisi</p>
                            </a>
                        </li>
                        @if (Auth::user()->role == 'Admin')
                            <li class="nav-item">
                                <a href="{{ url('cs') }}" class="nav-link @if ($title == 'Customer Service') {{ 'active' }} @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Customer Service</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                @if (Auth::user()->role == 'Admin')
                    <li class="nav-item">
                        <a href="{{ url('/package') }}" class="nav-link @if ($title == 'Paket') {{ 'active' }} @endif">
                            <p>
                                Paket Wifi
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ url('/installation') }}" class="nav-link @if ($title == 'Instalasi') {{ 'active' }} @endif">
                        <p>
                            Instalasi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/customer') }}" class="nav-link @if ($title == 'Customer' || $title == 'Tagihan') {{ 'active' }} @endif">
                        <p>Customer</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
