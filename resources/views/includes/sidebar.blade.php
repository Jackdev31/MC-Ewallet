<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('dashboard') }}" class="b-brand text-primary">
                <img src="{{ asset('admin_assets/images/logo-dark.svg') }}" class="img-fluid logo-lg" alt="logo">
            </a>
        </div>

        <div class="navbar-content">
            <ul class="pc-navbar">
                <!-- Dashboard Link -->
                <li class="pc-item">
                    <a href="{{ route('dashboard') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                <!-- Access Management Section -->
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

                <!-- Product Management Section -->
                @canany(['view product category', 'view products'])
                    <li class="pc-item pc-caption">
                        <label>Product Management</label>
                        <i class="ti ti-package"></i>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="javascript:void(0);" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-box"></i></span>
                            <span class="pc-mtext">Product Management</span>
                            <span class="pc-arrow"><i class="ti ti-chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu">
                            @can('view product category')
                                <li class="pc-item">
                                    <a href="{{ route('product-categories.index') }}" class="pc-link">
                                        <span class="pc-micon"><i class="ti ti-package"></i></span>
                                        <span class="pc-mtext">Product Category</span>
                                    </a>
                                </li>
                            @endcan

                            @can('view products')
                                <li class="pc-item">
                                    <a href="{{ route('products.index') }}" class="pc-link">
                                        <span class="pc-micon"><i class="ti ti-lock"></i></span>
                                        <span class="pc-mtext">Products</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                <!-- POS System Section -->
                @can('sell products')
                    <li class="pc-item pc-caption">
                        <label>POS System</label>
                        <i class="ti ti-package"></i>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="javascript:void(0);" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-box"></i></span>
                            <span class="pc-mtext">POS System</span>
                            <span class="pc-arrow"><i class="ti ti-chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu">
                            @can('sell products')
                                <li class="pc-item">
                                    <a href="{{ route('cashierpos.index') }}" class="pc-link">
                                        <span class="pc-micon"><i class="ti ti-package"></i></span>
                                        <span class="pc-mtext">POS</span>
                                    </a>
                                </li>
                            @endcan

                            @can('view cashier sales')
                                <li class="pc-item">
                                    <a href="{{ route('sales.transactions') }}" class="pc-link">
                                        <span class="pc-micon"><i class="ti ti-package"></i></span>
                                        <span class="pc-mtext">Cashier Sales</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                <!-- E-wallet System Section -->
                @canany(['view e-wallets', 'load e-wallets', 'view load transactions'])
                    <li class="pc-item pc-caption">
                        <label>E-wallet System</label>
                        <i class="ti ti-wallet"></i>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="javascript:void(0);" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-wallet"></i></span>
                            <span class="pc-mtext">E-wallet System</span>
                            <span class="pc-arrow"><i class="ti ti-chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu">
                            @can('view e-wallets')
                                <li class="pc-item">
                                    <a href="{{ route('e-wallets.index') }}" class="pc-link">
                                        <span class="pc-micon"><i class="ti ti-wallet"></i></span>
                                        <span class="pc-mtext">E-wallet</span>
                                    </a>
                                </li>
                            @endcan

                            {{-- @can('load e-wallets')
                                <li class="pc-item">
                                    <a href="{{ route('e-wallets.load', ['user' => auth()->user()->id]) }}" class="pc-link">
                                        <span class="pc-micon"><i class="ti ti-wallet"></i></span>
                                        <span class="pc-mtext">Load E-wallet</span>
                                    </a>
                                </li>
                            @endcan --}}

                            {{-- @can('view load transactions')
                            <li class="pc-item">
                                <a href="{{ route('e-wallets.load-transactions') }}" class="pc-link">
                                    <span class="pc-micon"><i class="ti ti-package"></i></span>
                                    <span class="pc-mtext">Load Transactions</span>
                                </a>
                            </li>
                        @endcan --}}
                        </ul>
                    </li>
                @endcanany

                @can('view e-wallet balance')
                <li class="pc-item pc-caption">
                    <label>Payments</label>
                    <i class="ti ti-wallet"></i>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="javascript:void(0);" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-wallet"></i></span>
                        <span class="pc-mtext">E-wallet</span>
                        <span class="pc-arrow"><i class="ti ti-chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        @can('pay via e-wallets')
                            <li class="pc-item">
                                <a href="{{ route('e-walletpay.index') }}" class="pc-link">
                                    <span class="pc-micon"><i class="ti ti-wallet"></i></span>
                                    <span class="pc-mtext">Scan to Pay</span>
                                </a>
                            </li>
                        @endcan
                    @endcan           

                <!-- Sidebar Footer Card -->
                <div class="card text-center">
                    <div class="card-body">
                        <img src="{{ asset('admin_assets/images/img-navbar-card.png') }}" alt="images"
                            class="img-fluid mb-2">
                        <h5>Template Made by</h5>
                        <p>JackDev31🧡</p>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</nav>
