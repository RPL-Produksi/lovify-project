@extends('template-dashboard.layouts.app-admin')
@section('title', 'Kelola Mitra')

@push('css')
@endpush

@section('content')

    <div class="card p-3 mb-5">
        <div class="d-flex justify-content-between">
            <h3 class="text-rose">Kelola Mitra</h3>
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
        <div class="table-responsive-xl">
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
    </div>

    <div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="addAdminModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAdminModalLabel">Tambah Admin</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('superadmin.store.mitra') }}" method="POST" class="form-with-loading"
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
            let table = $('#kategoriTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('superadmin.kelola.mitra.data') }}',
                    type: 'GET',
                },
                columns: [
                    { data: null, searchable: false, orderable: false, render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: 'fullname', name: 'fullname' },
                    { data: 'username', name: 'username' },
                    { data: 'email', name: 'email' },
                    { data: 'phone_number', name: 'phone_number' },
                    { 
                        data: 'id',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <td class="d-flex d-xl-block">
                                    <button class="btn text-white edit-btn" data-target="#editAdminModal" data-toggle="modal"  style="background-color: #3D0A05" 
                                        data-id="${row.id}" data-fullname="${row.fullname}" data-username="${row.username}" data-email="${row.email}" data-phone_number="${row.phone_number}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button class="btn ml-xl-0 ml-1 text-white btn-delete" data-id="${row.id}" style="background-color: #3D0A05">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <a class="btn text-white ml-xl-0 ml-1" href="/user/change/password/${row.id}" style="background-color: #3D0A05">
                                        <i class="fa-solid fa-key"></i>
                                    </a>
                                </td>
                            `;
                        }
                    }
                ]
            });
    
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
                            url: '{{ route('superadmin.delete.admin', ':id') }}'.replace(':id', id),
                            method: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Mitra berhasil dihapus.",
                                    icon: "success",
                                    confirmButtonText: "OK",
                                    confirmButtonColor: "#3D0A05"
                                });
                                table.ajax.reload();
                            },
                            error: function(xhr) {
                                Swal.fire("Error!", xhr.responseJSON.message || "Gagal menghapus mitra.", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>
    
@endpush
