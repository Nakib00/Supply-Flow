<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('manufactuer.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-sync"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SupplyFlow</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('manufactuer.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('manufactuer.sell.show') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Sells</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('manufacturer.orders.complain') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Complain</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
