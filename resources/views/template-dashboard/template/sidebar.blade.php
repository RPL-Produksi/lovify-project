<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #fff">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa-regular fa-rings-wedding text-primary"></i>
        </div>
        <div class="sidebar-brand-text mx-3 text-primary">Lovify</div>
    </a>

    <hr class="sidebar-divider my-0">

    @if ($user->role == 'mitra')
    <hr class="sidebar-divider">
        <li class="nav-item {{ request()->routeIs('mitra.home') ? 'active' : '' }}">
            <a href="{{ route('mitra.home') }}" class="nav-link text-primary">
                <i class="fa-regular fa-fw fa-house text-primary"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('mitra.kelola.produk') ? 'active' : '' }}">
            <a href="{{ route('mitra.kelola.produk') }}" class="nav-link text-primary">
                <i class="fa-regular fa-cart-shopping text-primary"></i>
                <span>Produk</span>
            </a>
        </li>
    @endif

    @if ($user->role == 'admin')
        <hr class="sidebar-divider">
        <li class="nav-item {{ request()->routeIs('admin.home') ? 'active' : '' }}">
            <a href="{{ route('admin.home') }}" class="nav-link text-primary">
                <i class="fa-regular fa-fw fa-house text-primary"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('admin.kelola.kategori') ? 'active' : '' }}">
            <a href="{{ route('admin.kelola.kategori') }}" class="nav-link text-primary">
                <i class="fa-regular fa-icons text-primary"></i>
                <span>Kategori</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('admin.kelola.lokasi') ? 'active' : '' }}">
            <a href="{{ route('admin.kelola.lokasi') }}" class="nav-link text-primary">
                <i class="fa-regular fa-map text-primary"></i>
                <span>Lokasi</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('admin.kelola.vendor') ? 'active' : '' }}">
            <a href="{{ route('admin.kelola.vendor') }}" class="nav-link text-primary">
                <i class="fa-regular fa-shop text-primary"></i>
                <span>Vendor</span>
            </a>
        </li>
    @endif

    @if ($user->role == 'superadmin')
    <hr class="sidebar-divider">
        <li class="nav-item {{ request()->routeIs('superadmin.home') ? 'active' : '' }}">
            <a href="{{ route('superadmin.home') }}" class="nav-link text-primary">
                <i class="fa-regular fa-fw fa-house text-primary"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('superadmin.kelola.admin') ? 'active' : '' }}">
            <a href="{{ route('superadmin.kelola.admin') }}" class="nav-link text-primary">
                <i class="fa-light fa-users text-primary"></i>
                <span>Admin</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('superadmin.kelola.mitra') ? 'active' : '' }}">
            <a href="{{ route('superadmin.kelola.mitra') }}" class="nav-link text-primary">
                <i class="fa-light fa-users text-primary"></i>
                <span>Mitra</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('superadmin.kelola.client') ? 'active' : '' }}">
            <a href="{{ route('superadmin.kelola.client') }}" class="nav-link text-primary">
                <i class="fa-light fa-users text-primary"></i>
                <span>Client</span>
            </a>
        </li>
    @endif
    {{-- <hr class="sidebar-divider">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0 bg-rose" id="sidebarToggle"></button>
    </div> --}}
</ul>

<style>
    .nav-item.active {
        background-color: #f2f2f2 !important;
        border-right: 0.25rem solid #3D0A05 !important;
    }

    .bg-rose {
        background-color: #3D0A05 !important;
    }
</style>
