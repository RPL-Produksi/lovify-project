<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #3D0A05">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa-regular fa-rings-wedding"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Lovify</div>
    </a>

    <hr class="sidebar-divider my-0">

    @if ($user->role == 'mitra')
    <li class="nav-item">
        <a href="{{ route('mitra.home') }}" class="nav-link">
            <i class="fa-regular fa-fw fa-house"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Kelola</div>

    <li class="nav-item">
        <a href="{{ route('mitra.kelola.produk') }}" class="nav-link">
            <i class="fa-regular fa-cart-shopping"></i>
            <span>Kelola Produk</span>
        </a>
    </li>
    @endif

    @if ($user->role == 'admin')
    <li class="nav-item">
        <a href="{{ route('admin.home') }}" class="nav-link">
            <i class="fa-regular fa-fw fa-house"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Kelola</div>

    <li class="nav-item">
        <a href="{{ route('admin.kelola.kategori') }}" class="nav-link">
            <i class="fa-regular fa-icons"></i>
            <span>Kelola Kategori</span>
        </a>
    </li>
    @endif

    @if ($user->role == 'superadmin')
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
            <a href="{{ route('superadmin.kelola.mitra') }}" class="nav-link">
                <i class="fa-light fa-users"></i>
                <span>Kelola Mitra</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('superadmin.kelola.client') }}" class="nav-link">
                <i class="fa-light fa-users"></i>
                <span>Kelola Client</span>
            </a>
        </li>
    @endif

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
