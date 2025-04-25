<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('dashboard') }}" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                {{-- <img src="{{ asset('admin_assets/images/logo-dark.svg') }}" class="img-fluid logo-lg" alt="logo"> --}}
                <img src="{{ asset('admin_assets/images/logo-dark.svg') }}" class="img-fluid logo-lg" alt="logo">

            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item">
                    <a href="{{ route('dashboard') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>
                @canany(['view permissions', 'view users', 'view roles'])

                    <li class="pc-item pc-caption">
                        <label>System</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="javascript:void(0);" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-typography"></i></span>
                            <span class="pc-mtext">Access Management</span>
                            <span class="pc-arrow"><i class="ti ti-chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu">
                            @can('view users')
                                <li class="pc-item">
                                    <a href="{{ route('users.index') }}" class="pc-link">
                                        <span class="pc-micon"><i class="ti ti-users"></i></span>
                                        <span class="pc-mtext">User Management</span>
                                    </a>
                                </li>
                            @endcan
                            
                            @can('view permissions')
                                <li class="pc-item">
                                    <a href="{{ route('permissions.index') }}" class="pc-link">
                                        <span class="pc-micon"><i class="ti ti-lock"></i></span>
                                        <span class="pc-mtext">Permissions</span>
                                    </a>
                                </li>
                            @endcan

                            @can('view roles')
                                <li class="pc-item">
                                    <a href="{{ route('roles.index') }}" class="pc-link">
                                        <span class="pc-micon"><i class="ti ti-shield"></i></span>
                                        <span class="pc-mtext">Role Management</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany


                {{-- <li class="pc-item pc-caption">
                    <label>Pages</label>
                    <i class="ti ti-news"></i>
                </li>
                <li class="pc-item">
                    <a href="{{ route('login') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-lock"></i></span>
                        <span class="pc-mtext">Login</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('register') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-user-plus"></i></span>
                        <span class="pc-mtext">Register</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Other</label>
                    <i class="ti ti-brand-chrome"></i>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-menu"></i></span>
                        <span class="pc-mtext">Menu Levels</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="#!">Level 2.1</a></li>
                        <li class="pc-item pc-hasmenu">
                            <a href="#!" class="pc-link">Level 2.2
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu">
                                <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                                <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                                <li class="pc-item pc-hasmenu">
                                    <a href="#!" class="pc-link">Level 3.3
                                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                                    </a>
                                    <ul class="pc-submenu">
                                        <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                                        <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="pc-item pc-hasmenu">
                            <a href="#!" class="pc-link">Level 2.3
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu">
                                <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                                <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                                <li class="pc-item pc-hasmenu">
                                    <a href="#!" class="pc-link">Level 3.3
                                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                                    </a>
                                    <ul class="pc-submenu">
                                        <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                                        <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="pc-item">
                    <a href="{{ route('login') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-brand-chrome"></i></span>
                        <span class="pc-mtext">Sample Page</span>
                    </a>
                </li>
            </ul> --}}

                <div class="card text-center">
                    <div class="card-body">
                        <img src="{{ asset('admin_assets/images/img-navbar-card.png') }}" alt="images"
                            class="img-fluid mb-2">
                        <h5>Template Made by</h5>
                        <p>Jackdev🧡</p>
                        {{-- <a href="https://codedthemes.com/item/berry-bootstrap-5-admin-template/" target="_blank" class="btn btn-success">Buy Now</a> --}}
                    </div>
                </div>
        </div>
    </div>
</nav>
