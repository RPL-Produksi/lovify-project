@extends('template-dashboard.layouts.app-admin')
@section('title', 'Kelola Kategori')

@push('css')
@endpush

@section('content')

    <div class="card p-3 mb-5">
        <div class="d-flex justify-content-between">
            <h3 class="text-rose">Kelola Kategori</h3>
            <button type="button" class="btn text-white" style="background-color: #3D0A05" data-toggle="modal"
                data-target="#addKategoriModal">
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
                    <td>Gambar</td>
                    <td>Nama Kategori</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <div class="modal fade" id="addKategoriModal" tabindex="-1" role="dialog" aria-labelledby="addKategoriModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addKategoriModalLabel">Tambah Kategori</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('be.category.store') }}" method="POST" class="form-with-loading"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama Kategori</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Masukkan nama kategori" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Gambar</label>
                            <input type="file" class="form-control" name="image" id="image"
                                placeholder="Masukkan gambar kategori" required>
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

    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm" enctype="multipart/form-data" method="POST"
                        action="{{ route('be.category.store') }}">
                        @csrf
                        <input type="hidden" id="edit_id" name="id">
                        <div class="form-group">
                            <label for="edit_name">Nama Kategori</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_image">Image Kategori</label>
                            <br>
                            <img id="edit_image_preview" src="" alt="Image Kategori" width="100" height="100"
                                style="object-fit: cover; border-radius: 5px; margin-bottom: 10px;">
                            <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
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
                ajax: '{{ route('admin.kelola.kategori.data') }}',
                columns: [
                    { data: null, searchable: false, orderable: false, render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { 
                        data: 'image', 
                        name: 'image',
                        render: function(data) {
                            return `<img src="${data || 'https://via.placeholder.com/100'}" width="55" height="35" style="object-fit: cover;">`;
                        }
                    },
                    { data: 'name', name: 'name' },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            return `
                                <button class="btn text-white edit-btn" style="background-color: #3D0A05"
                                    data-id="${data}" data-name="${row.name}" data-image="${row.image}" 
                                    data-toggle="modal" data-target="#editCategoryModal">
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
                let image = $(this).data('image');
    
                $('#edit_id').val(id);
                $('#edit_name').val(name);
                $('#edit_image_preview').attr('src', image ? image : 'https://via.placeholder.com/100');
    
                $('#editCategoryModal').modal('show');
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
                            url: '{{ route('be.category.delete', ':id') }}'.replace(':id', id),
                            method: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Kategori berhasil dihapus.",
                                    icon: "success",
                                    confirmButtonText: "OK",
                                    confirmButtonColor: "#3D0A05"
                                });
                                table.ajax.reload();
                            },
                            error: function(xhr) {
                                Swal.fire("Error!", xhr.responseJSON.message || "Gagal menghapus kategori.", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>
    
@endpush
