<style>
    span {
        font-size: 14px;
    }
</style>
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




                @canany(['customer-create', 'customer-list'])

                <div class="nav-item dropdown custom-dropdown">
                    <a href="#" class="nav-link d-flex justify-content-between align-items-center" id="userDropdownToggle">
                        <span><i class="fas fa-tags me-2"></i>Customer Management</span>
                        <i class="fas fa-chevron-down ms-2"></i>
                    </a>
                    <div class="dropdown-menu-custom">
                        @can('customer-create')
                        <a href="{{route('customer.create')}}" class="dropdown-item">Create Customer</a>
                        @endcan
                        @can('customer-list')
                        <a href="{{route('customer.list')}}" class="dropdown-item">Customer List</a>
                        @endcan
                    </div>
                </div>
                @endcanany
                @canany(['bill-create', 'bill-list'])

                <div class="nav-item dropdown custom-dropdown">
                    <a href="#" class="nav-link d-flex justify-content-between align-items-center" id="userDropdownToggle">
                        <span><i class="fas fa-file-invoice-dollar me-2"></i>Bill Management</span>
                        <i class="fas fa-chevron-down ms-2"></i>
                    </a>
                    <div class="dropdown-menu-custom">
                        @can('bill-create')
                        <a href="{{route('bill.create')}}" class="dropdown-item">Create Bill</a>
                        @endcan
                        @can('bill-list')
                        <a href="{{route('bill.filter')}}" class="dropdown-item">Bill List</a>
                        @endcan
                    </div>
                </div>
                @endcanany
                @canany(['expenses-create', 'expenses-list'])

                <div class="nav-item dropdown custom-dropdown">
                    <a href="#" class="nav-link d-flex justify-content-between align-items-center" id="userDropdownToggle">
                        <span><i class="fas fa-file-invoice-dollar me-2"></i>Expenses Management</span>
                        <i class="fas fa-chevron-down ms-2"></i>
                    </a>
                    <div class="dropdown-menu-custom">
                        @can('expenses-create')
                        <a href="{{route('expenses.create')}}" class="dropdown-item">Create Expenses</a>
                        @endcan
                        @can('expenses-list')
                        <a href="{{route('expenses.filter')}}" class="dropdown-item">Expenses List</a>
                        @endcan
                    </div>
                </div>
                @endcanany
                @canany(['product-create', 'product-list'])

                <div class="nav-item dropdown custom-dropdown">
                    <a href="#" class="nav-link d-flex justify-content-between align-items-center" id="userDropdownToggle">
                        <span><i class="fas fa-file-invoice-dollar me-2"></i>Product Management</span>
                        <i class="fas fa-chevron-down ms-2"></i>
                    </a>
                    <div class="dropdown-menu-custom">
                        @can('product-create')
                        <a href="{{route('products.create')}}" class="dropdown-item">Create Product</a>
                        @endcan
                        @can('product-list')
                        <a href="{{route('products.index')}}" class="dropdown-item">Products</a>
                        @endcan
                      
                    </div>
                </div>
                @endcanany


            </div>
        </div>
    </nav>
</div>