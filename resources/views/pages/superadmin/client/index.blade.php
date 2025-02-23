@extends('template-dashboard.layouts.app-admin')
@section('title', 'Kelola Client')

@push('css')
@endpush

@section('content')

    <div class="card p-3">
        <div class="d-flex justify-content-between">
            <h3 class="text-rose">Kelola Client</h3>
            <button type="button" class="btn text-white" style="background-color: #3D0A05" data-toggle="modal"
                data-target="#addAdminModal">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
        <hr>
        <div>
            @if ($errors->any())
                <p class="alert alert-danger border-left-danger">{{ $errors->first() }}</p>
            @endif
        </div>
        <table class="table table-bordered" id="kategoriTable">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <td>Username</td>
                    <td>Email</td>
                    <td>Nomor Telepon</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="addAdminModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAdminModalLabel">Tambah Client</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('superadmin.make.client') }}" method="POST" class="form-with-loading"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fullname">Nama</label>
                            <input type="text" class="form-control" name="fullname" id="fullname"
                                placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username"
                                placeholder="Masukkan username" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email"
                                placeholder="Masukkan email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Nomor Telepon</label>
                            <input type="text" class="form-control" name="phone_number" id="phone_number"
                                placeholder="Masukkan nomor telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Masukkan password" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                id="password_confirmation" placeholder="Masukkan password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-link" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog" aria-labelledby="editAdminModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAdminModalLabel">Edit Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editAdminForm" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" id="edit_id" name="id">
                        <div class="form-group">
                            <label for="edit_fullname">Nama</label>
                            <input type="text" class="form-control" name="fullname" id="edit_fullname"
                                placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_username">Username</label>
                            <input type="text" class="form-control" name="username" id="edit_username"
                                placeholder="Masukkan username" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_email">Email</label>
                            <input type="text" class="form-control" name="email" id="edit_email"
                                placeholder="Masukkan email" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_phone_number">Nomor Telepon</label>
                            <input type="text" class="form-control" name="phone_number" id="edit_phone_number"
                                placeholder="Masukkan nomor telepon" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('vendor/DataTables/datatables.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            function loadKategori() {
                $.ajax({
                    url: '{{ route('superadmin.kelola.client.data') }}',
                    method: 'GET',
                    success: function(response) {
                        let rows = '';
                        response.forEach((item, index) => {
                            rows += `<tr>
                        <td>${index + 1}</td>
                        <td>${item.fullname}</td>
                        <td>${item.username}</td>
                        <td>${item.email}</td>
                        <td>${item.phone_number}</td>
                        <td>
                            <button class="btn text-white edit-btn" style="background-color: #3D0A05" data-id="${item.id}" data-fullname="${item.fullname}" data-username="${item.username}" data-email="${item.email}" data-phone_number="${item.phone_number}">
                                <i class="fa-solid fa-pen-to-square" data-target="#editAdminModal" data-toggle="modal" ></i>
                            </button>
                            <button class="btn text-white btn-delete" data-id="${item.id}" style="background-color: #3D0A05">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>`;
                        });
                        if ($.fn.DataTable.isDataTable('#kategoriTable')) {
                            $('#kategoriTable').DataTable().destroy();
                        }

                        $('#kategoriTable tbody').html(rows);

                        $('#kategoriTable').DataTable({
                            paging: true,
                            searching: true,
                            ordering: true,
                            pageLength: 10
                        });
                    }
                });
            }

            loadKategori();

            $(document).on('click', '.edit-btn', function() {
                let id = $(this).data('id');
                let fullname = $(this).data('fullname');
                let username = $(this).data('username');
                let email = $(this).data('email');
                let phone_number = $(this).data('phone_number');

                $('#edit_id').val(id);
                $('#edit_fullname').val(fullname);
                $('#edit_username').val(username);
                $('#edit_email').val(email);
                $('#edit_phone_number').val(phone_number);

                let updateUrl = '{{ route('superadmin.update.admin', ':id') }}'.replace(':id', id);
                $('#editAdminForm').attr('action', updateUrl);

                $('#editAdminModal').modal('show');
            });

            $(document).on('click', '.btn-delete', function() {
                let id = $(this).data('id');

                Swal.fire({
                    title: "Yakin ingin menghapus?",
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3D0A05",
                    cancelButtonColor: "#3D0A05",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('superadmin.delete.admin', ':id') }}'.replace(':id',
                                id),
                            method: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Client berhasil dihapus.",
                                    icon: "success",
                                    confirmButtonText: "OK",
                                    confirmButtonColor: "#3D0A05"
                                });
                                loadKategori();
                            },
                            error: function(xhr) {
                                Swal.fire("Error!", xhr.responseJSON.message ||
                                    "Gagal menghapus kategori.", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#kategoriTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                pageLength: 10
            });
        });
    </script>
@endpush
