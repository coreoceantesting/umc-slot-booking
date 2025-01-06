<style>
    .nav-item.active {
    color: #fff!important;
    }

.nav-item.active .nav-link {
    color: #fff; 
}
.nav-item-sub.active a.nav-link {
    color: #fff !important;
}



</style>
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ route('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('admin/images/logo1.png') }}" alt="" height="22" />
            </span>
            <span class="logo-lg">
                <img src="{{ asset('admin/images/logo1.png') }}" alt="" height="70" />
            </span>
        </a>
        <a href="{{ route('dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('admin/images/logo1.png') }}" alt="" height="22" />
            </span>
            <span class="logo-lg">
                <img src="{{ asset('admin/images/logo1.png') }}" alt="" height="70" />
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title">
                    <span data-key="t-menu">Menu</span>
                </li>

                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a class="nav-link menu-link" href="{{ route('dashboard') }}">
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                @canany(['propertytype.view', 'property.view','wards.view','slot.view','department.view','propertydetails.view','adhaardetail.view'])
                <li class="nav-item {{ request()->routeIs('propertytype.index') || request()->routeIs('property.index') || request()->routeIs('wards.index') || request()->routeIs('propertydetails.index') || request()->routeIs('department.index') || request()->routeIs('slot.index') || request()->routeIs('adhaardetail.index') ? 'active' : '' }}">
                    <a class="nav-link menu-link" href="#mastersDropdown" data-bs-toggle="collapse" role="button" 
                       aria-expanded="{{ request()->routeIs('propertytype.index') || request()->routeIs('property.index') || request()->routeIs('wards.index') || request()->routeIs('propertydetails.index') || request()->routeIs('department.index') || request()->routeIs('slot.index') || request()->routeIs('adhaardetail.index') ? 'true' : 'false' }}" 
                       aria-controls="mastersDropdown">
                        <i class="ri-layout-3-line"></i>
                        <span data-key="t-layouts">Masters</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs('propertytype.index') || request()->routeIs('property.index') || request()->routeIs('wards.index') || request()->routeIs('propertydetails.index') || request()->routeIs('department.index') || request()->routeIs('slot.index') || request()->routeIs('adhaardetail.index') ? 'show' : '' }}" id="mastersDropdown">
                        <ul class="nav nav-sm flex-column">
                            @can('propertytype.view')
                            <li class="nav-item-sub {{ request()->routeIs('propertytype.index') ? 'active' : '' }}">
                                <a href="{{ route('propertytype.index') }}" class="nav-link" data-key="t-horizontal">PropertyTypes</a>
                            </li>
                            @endcan
                            @can('property.view')
                            <li class="nav-item-sub {{ request()->routeIs('property.index') ? 'active' : '' }}">
                                <a href="{{ route('property.index') }}" class="nav-link" data-key="t-horizontal">Property</a>
                            </li>
                            @endcan
                            @can('wards.view')
                            <li class="nav-item-sub {{ request()->routeIs('wards.index') ? 'active' : '' }}">
                                <a href="{{ route('wards.index') }}" class="nav-link" data-key="t-horizontal">Wards</a>
                            </li>
                            @endcan
                            @can('slot.view')
                            <li class="nav-item-sub {{ request()->routeIs('slot.index') ? 'active' : '' }}">
                                <a href="{{ route('slot.index') }}" class="nav-link" data-key="t-horizontal">Slots</a>
                            </li>
                            @endcan
                            @can('department.view')
                            <li class="nav-item-sub {{ request()->routeIs('department.index') ? 'active' : '' }}">
                                <a href="{{ route('department.index') }}" class="nav-link" data-key="t-horizontal">Department</a>
                            </li>
                            @endcan
                            @can('propertydetails.view')
                            <li class="nav-item-sub {{ request()->routeIs('propertydetails.index') ? 'active' : '' }}">
                                <a href="{{ route('propertydetails.index') }}" class="nav-link" data-key="t-horizontal">Property Details</a>
                            </li>
                            @endcan
                            @can('adhaardetail.view')
                            <li class="nav-item-sub {{ request()->routeIs('adhaardetail.index') ? 'active' : '' }}">
                                <a href="{{ route('adhaardetail.index') }}" class="nav-link" data-key="t-horizontal">Aadharcard Master</a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcanany

                @canany(['users.view', 'roles.view'])
                <li class="nav-item {{ request()->routeIs('users.index') || request()->routeIs('roles.index') ? 'active' : '' }}">
                    <a class="nav-link menu-link" href="#userManagementDropdown" data-bs-toggle="collapse" role="button" 
                       aria-expanded="{{ request()->routeIs('users.index') || request()->routeIs('roles.index') ? 'true' : 'false' }}" 
                       aria-controls="userManagementDropdown">
                        <i class="bx bx-user-circle"></i>
                        <span data-key="t-layouts">User Management</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs('users.index') || request()->routeIs('roles.index') ? 'show' : '' }}" id="userManagementDropdown">
                        <ul class="nav nav-sm flex-column">
                            @can('users.view')
                            <li class="nav-item-sub {{ request()->routeIs('users.index') ? 'active' : '' }}">
                                <a href="{{ route('users.index') }}" class="nav-link" data-key="t-horizontal">Users</a>
                            </li>
                            @endcan
                            @can('roles.view')
                            <li class="nav-item-sub {{ request()->routeIs('roles.index') ? 'active' : '' }}">
                                <a href="{{ route('roles.index') }}" class="nav-link" data-key="t-horizontal">Roles</a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcanany

                @can('slotbooking.view')
                <li class="nav-item {{ request()->routeIs('slotbooking.index') ? 'active' : '' }}">
                    <a class="nav-link menu-link" href="{{ route('slotbooking.index') }}">
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-slotbooking">Slot Booking</span>
                    </a>
                </li>  
                @endcan

                @can(['pendinglist.pending_list'])
                <li class="nav-item {{ request()->routeIs('pendinglist') ? 'active' : '' }}">
                    <a class="nav-link menu-link" href="{{ route('pendinglist') }}">
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-slotbooking">Pending Slots</span>
                    </a>
                </li>
                @endcan
                @can(['approvelist.approve_list'])
                <li class="nav-item {{ request()->routeIs('approvelist') ? 'active' : '' }}">
                    <a class="nav-link menu-link" href="{{ route('approvelist') }}">
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-slotbooking">Approve Slots</span>
                    </a>
                </li>
                @endcan
                @can(['returnlist.return_list'])
                <li class="nav-item {{ request()->routeIs('returnlist') ? 'active' : '' }}">
                    <a class="nav-link menu-link" href="{{ route('returnlist') }}">
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-slotbooking">Return Slots</span>
                    </a>
                </li>
                @endcan
                @can(['reportsearch.report_search'])
                <li class="nav-item {{ request()->routeIs('report') ? 'active' : '' }}">
                    <a class="nav-link menu-link" href="{{ route('report') }}">
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-slotbooking">Report Slots</span>
                    </a>
                </li>
                @endcan
                
            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>

