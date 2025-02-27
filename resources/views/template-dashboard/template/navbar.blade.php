<!-- Navbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa-regular fa-bars" style="color: #3D0A05 !important"></i>
    </button>

    <h5 class="d-none d-md-block text-rose">Lovify | Wedding</h5>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hi, {{ $user->username }}</span>
                <img src="{{ $user->avatar ?? asset('avatars/default.png') }}"
                    class="img-profile rounded-circle font-weight-bold" style="object-fit: cover"></img>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('user.profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    My Profile
                </a>
                <a class="dropdown-item mt-2" href="{{ route('user.change.password') }}">
                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                    Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>

<!-- Modal Konfirmasi Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Yakin Ingin Keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Keluar" di bawah jika Anda siap mengakhiri sesi Anda saat ini.</div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
                <form id="logoutForm" action="{{ route('be.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <span class="btn-text">Keluar</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
