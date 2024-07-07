<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-sync"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SupplyFlow</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    {{--  <!-- Divider -->  --}}
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <span>Orders</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <span>Products</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.showRetailer') }}">
            <span>Retailers</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.showManufacturer') }}">
            <span>Manufacturers</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <span>Distributors</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.showUnit') }}">
            <span>Units</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.showCategory') }}">
            <span>Categorys</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.showArea') }}">
            <span>Areas</span></a>
    </li>
    {{--  <!-- Divider -->  --}}
    <hr class="sidebar-divider d-none d-md-block">

    {{--  <!-- Sidebar Toggler (Sidebar) -->  --}}
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
