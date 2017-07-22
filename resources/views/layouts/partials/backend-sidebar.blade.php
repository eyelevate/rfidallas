<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admins_index') }}"><i class="icon-speedometer"></i> Dashboard</a>
            </li>

            <li class="nav-item">
                <form class="form-horizontal" method="POST" action="{{ route('customers_search') }}">
                    {{ csrf_field() }}
                    <input id="" placeholder="search.." type="text" class="form-control" name="search" value="{{ old('search') }}" required autofocus>
                </form>
            </li>

            <li class="nav-title">
                Menu
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Users</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customers_index') }}"><i class="icon-user"></i> Customers</a>
                    </li>
                    
                    @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('employees_index') }}"><i class="icon-user"></i> Employees</a>
                    </li>
                    @endif
                    @if(Auth::user()->role_id == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('managers_index') }}"><i class="icon-user"></i> Managers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('partners_index') }}"><i class="icon-user"></i> Partners</a>
                    </li>                
                    @endif
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-settings"></i> Setup</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cards_index') }}"><i class="icon-puzzle"></i> Credit Cards </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('fees_index') }}"><i class="icon-puzzle"></i> Fees </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('plans_index') }}"><i class="icon-puzzle"></i> Plans </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('services_index') }}"><i class="icon-puzzle"></i> Services </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vendors_index') }}"><i class="icon-puzzle"></i> Vendors </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('taxes_index') }}"><i class="icon-puzzle"></i> Sales Tax </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="widgets.html"><i class="icon-key"></i> Accessibility </a>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-screen-smartphone"></i> Assets</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('assets_index') }}"><i class="icon-puzzle"></i> Manage </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('asset_items_deploy') }}"><i class="icon-puzzle"></i> Deploy </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('asset_items_return') }}"><i class="icon-puzzle"></i> Return </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="charts.html"><i class="icon-pie-chart"></i> Reports</a>
            </li>
            <li class="divider"></li>
            <li class="nav-title">
                Extras
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-star"></i> Pages</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="pages-login.html" target="_top"><i class="icon-star"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages-register.html" target="_top"><i class="icon-star"></i> Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages-404.html" target="_top"><i class="icon-star"></i> Error 404</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages-500.html" target="_top"><i class="icon-star"></i> Error 500</a>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>
</div>