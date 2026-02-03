<div class="sidebar" id="sidebar">
    <!-- Sidebar Header with Logo -->
    <div class="sidebar-header">
        <div class="logo-section">
            <img src="{{asset('dashboard\img\logo.png')}}" alt="HRU Logo" style="background: white;">
            <div>
                <h1 class="logo-text" style="color: white;">Invoice Portal</h1>
                <small style="opacity: 0.8; color: white;"></small>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-light">
        <div class="sidebar-content">
            <div class="navbar-nav w-100">
                <!-- Dashboard -->
                <a href="{{route('show.dashboard')}}" class="nav-item nav-link">
                    <i class="fa fa-tachometer-alt"></i>Dashboard
                </a>
                @canany(['user-create', 'user-list'])

                <div class="nav-item dropdown custom-dropdown">
                    <a href="#" class="nav-link d-flex justify-content-between align-items-center" id="userDropdownToggle">
                        <span><i class="fa fa-users me-2"></i>User Management</span>
                        <i class="fas fa-chevron-down ms-2"></i>
                    </a>
                    <div class="dropdown-menu-custom">
                        @can('user-create')
                        <a href="{{route('users.create')}}" class="dropdown-item">Create User</a>
                        @endcan
                        @can('user-list')
                        <a href="{{route('users.index')}}" class="dropdown-item">User List</a>
                        @endcan
                    </div>
                </div>
                @endcanany
                {{--
                @canany(['role-create', 'role-list'])

                <div class="nav-item dropdown custom-dropdown">
                    <a href="#" class="nav-link d-flex justify-content-between align-items-center" id="userDropdownToggle">
                        <span><i class="fa fa-shield-alt me-2"></i>Role Management</span>
                        <i class="fas fa-chevron-down ms-2"></i>
                    </a>
                    <div class="dropdown-menu-custom">
                        @can('role-create')
                        <a href="{{route('roles.create')}}" class="dropdown-item">Create Role</a>
                        @endcan
                        @can('role-list')
                        <a href="{{route('roles.index')}}" class="dropdown-item">Role List</a>
                        @endcan
                    </div>
                </div>
                @endcanany
                --}}
                
                @canany(['invoice-create', 'invoice-list'])

                <div class="nav-item dropdown custom-dropdown">
                    <a href="#" class="nav-link d-flex justify-content-between align-items-center" id="userDropdownToggle">
                        <span><i class="fas fa-file-invoice-dollar me-2"></i>Invoice Management</span>
                        <i class="fas fa-chevron-down ms-2"></i>
                    </a>
                    <div class="dropdown-menu-custom">
                        @can('invoice-create')
                        <a href="{{route('invoice.create')}}" class="dropdown-item">Create invoice</a>
                        @endcan
                        @can('invoice-list')
                        <a href="{{route('invoice.filter')}}" class="dropdown-item">Invoice List</a>
                        @endcan
                    </div>
                </div>
                @endcanany
                @canany(['brand-create', 'brand-list'])

                <div class="nav-item dropdown custom-dropdown">
                    <a href="#" class="nav-link d-flex justify-content-between align-items-center" id="userDropdownToggle">
                        <span><i class="fas fa-tags me-2"></i>Brand Management</span>
                        <i class="fas fa-chevron-down ms-2"></i>
                    </a>
                    <div class="dropdown-menu-custom">
                        @can('brand-create')
                        <a href="{{route('brand.create')}}" class="dropdown-item">Create Brand</a>
                        @endcan
                        @can('brand-list')
                        <a href="{{route('brand.list')}}" class="dropdown-item">Brand List</a>
                        @endcan
                    </div>
                </div>
                @endcanany

            </div>
        </div>
    </nav>
</div>