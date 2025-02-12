<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #3D0A05">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa-regular fa-rings-wedding"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Lovify</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a href="{{ route('superadmin.home') }}" class="nav-link">
            <i class="fa-regular fa-fw fa-house"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Kelola</div>

    <li class="nav-item">
        <a href="{{ route('superadmin.kelola.admin') }}" class="nav-link">
            <i class="fa-light fa-users"></i>
            <span>Kelola Admin</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="" class="nav-link">
            <i class="fa-light fa-users"></i>
            <span>Kelola Vendor</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="" class="nav-link">
            <i class="fa-light fa-users"></i>
            <span>Kelola Client</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
