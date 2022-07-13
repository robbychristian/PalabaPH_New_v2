@if (Auth::user()->user_role === '1')
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">PalabaPH</div>
        </a>



        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Route::is('home') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>


        <!-- Nav Item - Client Management -->
        <li class="nav-item {{ Route::is('admin.clientmanagement.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.clientmanagement.index') }}">
                <i class="fas fa-fw fa-building"></i>
                <span>Client Management</span></a>
        </li>

        <!-- Nav Item - User Management -->
        <li class="nav-item {{ Route::is() ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.usermanagement') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>User Management</span></a>
        </li>


        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
@else
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">PalabaPH</div>
        </a>



        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Route::is('home') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Store Manage</span></a>
        </li>

        <!-- Nav Item - Order Management -->
        <li class="nav-item {{ Route::is('client.manageorder') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('client.manageorder') }}">
                <i class="fas fa-calendar-alt"></i>
                <span>Order Management</span></a>
        </li>

        <!-- Nav Item - Client Management -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('client.manageriders') }}">
                <i class="fas fa-fw fa-building"></i>
                <span>Rider Management</span></a>
        </li>

        <!-- Nav Item - User Management -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('client.managesales') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Sales Management</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('client.managereservation') }}">
                <i class="fas fa-fw fa-calendar"></i>
                <span>Reservation Management</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('client.managecomplaints') }}">
                <i class="fas fa-fw fa-comment"></i>
                <span>Complaints Management</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('client.managefeedbacks') }}">
                <i class="fas fa-fw fa-star"></i>
                <span>Feedbacks Management</span></a>
        </li>


        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
@endif
