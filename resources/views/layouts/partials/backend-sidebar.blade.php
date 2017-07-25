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
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Admins</a>
                <ul class="nav-dropdown-items">
                    @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('employees_index') }}"><i class="icon-arrow-right-circle"></i> Employees <span class="badge badge-info">{{ $employee_count }}</span></a>
                    </li>
                    @endif
                    @if(Auth::user()->role_id == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('managers_index') }}"><i class="icon-arrow-right-circle"></i> Managers <span class="badge badge-info">{{ $manager_count }}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('partners_index') }}"><i class="icon-arrow-right-circle"></i> Partners <span class="badge badge-info">{{ $partner_count }}</span></a>
                    </li>                
                    @endif
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Membership </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="widgets.html"><i class="icon-key"></i> Accessibility </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customers_index') }}"><i class="icon-arrow-right-circle"></i> Customers <span class="badge badge-info">{{ $customer_count }}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('companies_index') }}"><i class="icon-arrow-right-circle"></i> Companies </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cards_index') }}"><i class="icon-arrow-right-circle"></i> Credit Cards </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-settings"></i> Setup</a>
                <ul class="nav-dropdown-items">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('fees_index') }}"><i class="icon-arrow-right-circle"></i> Fees </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('plans_index') }}"><i class="icon-arrow-right-circle"></i> Plans </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('services_index') }}"><i class="icon-arrow-right-circle"></i> Services </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vendors_index') }}"><i class="icon-arrow-right-circle"></i> Vendors </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('taxes_index') }}"><i class="icon-arrow-right-circle"></i> Sales Tax </a>
                    </li>
                </ul>
            </li>
            

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-screen-smartphone"></i> Assets</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('assets_index') }}"><i class="icon-arrow-right-circle"></i> Manage <span class="badge badge-info">{{ $asset_items_count }}</span> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('asset_items_deploy') }}"><i class="icon-arrow-right-circle"></i> Deploy </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('asset_items_return') }}"><i class="icon-arrow-right-circle"></i> Return </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('assets_issues') }}"><i class="icon-arrow-right-circle"></i> Issues <span class="badge {{ ($asset_issues > 0) ? 'badge-warning' : 'badge-success'  }}">{{ $asset_issues }}</span> </a>
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