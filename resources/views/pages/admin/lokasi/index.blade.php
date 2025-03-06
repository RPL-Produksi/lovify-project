@extends('template-dashboard.layouts.app-admin')
@section('title', 'Kelola Lokasi')

@push('css')
@endpush

@section('content')

    <div class="card p-3 mb-5">
        <div class="d-flex justify-content-between">
            <h3 class="text-rose">Kelola Lokasi</h3>
            <button type="button" class="btn text-white" style="background-color: #3D0A05" data-toggle="modal"
                data-target="#addLokasi">
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
                    <td>Nama Lokasi</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <div class="modal fade" id="addLokasi" tabindex="-1" role="dialog" aria-labelledby="addLokasiLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLokasiLabel">Tambah Lokasi</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.lokasi.store') }}" method="POST" class="form-with-loading"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama Lokasi</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Masukkan nama lokasi" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-link text-primary text-decoration-none" type="button"
                            data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editLokasi" tabindex="-1" role="dialog" aria-labelledby="editLokasiLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLokasiLabel">Edit Lokasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editLokasiForm" enctype="multipart/form-data" method="POST"
                        action="{{ route('admin.lokasi.store') }}">
                        @csrf
                        <input type="hidden" id="edit_id" name="id">
                        <div class="form-group">
                            <label for="edit_name">Nama Lokasi</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
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
                ajax: '{{ route('admin.kelola.lokasi.data') }}',
                columns: [
                    { data: null, searchable: false, orderable: false, render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: 'name', name: 'name' },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            return `
                                <button class="btn text-white edit-btn" 
                                    style="background-color: #3D0A05"
                                    data-id="${data}" data-name="${row.name}"
                                    data-toggle="modal" data-target="#editLokasi">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button class="btn text-white btn-delete" data-id="${data}" style="background-color: #3D0A05">
                                    <i class="fa-solid fa-trash"></i>
                                </button>`;
                        }
                    }
                ]
            });
    
            $(document).on('click', '.edit-btn', function() {
                let id = $(this).data('id');
                let name = $(this).data('name');
    
                $('#edit_id').val(id);
                $('#edit_name').val(name);
    
                $('#editLokasi').modal('show');
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
                            url: '{{ route('admin.lokasi.delete', ':id') }}'.replace(':id', id),
                            method: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Lokasi berhasil dihapus.",
                                    icon: "success",
                                    confirmButtonText: "OK",
                                    confirmButtonColor: "#3D0A05"
                                });
                                table.ajax.reload();
                            },
                            error: function(xhr) {
                                Swal.fire("Error!", xhr.responseJSON.message || "Gagal menghapus lokasi.", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>
    
@endpush
