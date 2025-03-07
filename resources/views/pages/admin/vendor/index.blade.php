@extends('template-dashboard.layouts.app-admin')
@section('title', 'Kelola Vendor')

@push('css')
@endpush

@section('content')

    <div class="card p-3 mb-5">
        <div class="d-flex justify-content-between">
            <h3 class="text-rose">Kelola Vendor</h3>
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
                    <td>Nama Vendor</td>
                    <td>Email</td>
                    <td>Nomor Telepon</td>
                    <td>Terverifikasi</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
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
                ajax: '{{ route('admin.kelola.vendor.data') }}',
                columns: [
                    { data: null, searchable: false, orderable: false, render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone_number', name: 'phone_number' },
                    { data: 'is_verified', name: 'is_verified', render: function(data) {
                            return data ? 'Terverifikasi' : 'Belum Verifikasi';
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            return `
                                <button class="btn text-white btn-verify" data-id="${data}" style="background-color: #3D0A05">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                                <button class="btn text-white btn-delete" data-id="${data}" style="background-color: #3D0A05">
                                    <i class="fa-solid fa-trash"></i>
                                </button>`;
                        }
                    }
                ]
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
                            url: '{{ route('admin.kelola.vendor.delete', ':id') }}'.replace(':id', id),
                            method: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire("Deleted!", "Vendor berhasil dihapus.", "success");
                                table.ajax.reload();
                            },
                            error: function(xhr) {
                                Swal.fire("Error!", xhr.responseJSON.message || "Gagal menghapus vendor.", "error");
                            }
                        });
                    }
                });
            });
    
            $(document).on('click', '.btn-verify', function() {
                let id = $(this).data('id');
    
                Swal.fire({
                    title: "Yakin ingin memverifikasi vendor ini?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3D0A05",
                    cancelButtonColor: "#3D0A05",
                    confirmButtonText: "Ya, verifikasi!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('admin.verify.vendor', ':id') }}'.replace(':id', id),
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire("Berhasil!", response.message, "success");
                                table.ajax.reload();
                            },
                            error: function(xhr) {
                                Swal.fire("Error!", xhr.responseJSON.message || "Gagal memverifikasi vendor.", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>
    
@endpush
