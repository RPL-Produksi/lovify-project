@extends('template-dashboard.layouts.app-admin')
@section('title', 'Kelola Kategori')

@push('css')
@endpush

@section('content')

    <div class="card p-3">
        <div class="d-flex justify-content-between">
            <h3 class="text-rose">Kelola Kategori</h3>
            <button type="button" class="btn text-white" style="background-color: #3D0A05" data-toggle="modal"
                data-target="#addKategoriModal">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
        <hr>
        <table class="table table-bordered table-striped" id="example">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Gambar</td>
                    <td>Nama Kategori</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategori as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img width="70" height="50" style="object-fit: cover" src="{{ $item->image }}"
                                alt=""></td>
                        <td vertical>{{ $item->name }}</td>
                        <td>
                            <button type="button" class="btn text-white" style="background-color: #3D0A05"><i
                                    class="fa-solid fa-pen-to-square" data-toggle="modal" data-target="#editCategoryModal"
                                    onclick="setEditCategoryData('{{ $item->id }}', '{{ $item->name }}', '{{ $item->image }}')"></i></button>
                            <a style="background-color: #3D0A05" href="{{ route('be.category.delete', $item->id) }}" class="btn text-white btn-delete" data-id="{{ $item->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- modal tambah kategori --}}
    <div class="modal fade" id="addKategoriModal" tabindex="-1" role="dialog" aria-labelledby="addKategoriModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addKategoriModalLabel">Tambah Admin</h5>
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

    <!-- modal edit kategori -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Produk</h5>
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
                            <img id="edit_image_preview" src="" alt="Image Kategori" width="100"
                                height="100" style="object-fit: cover; border-radius: 5px; margin-bottom: 10px;">
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
            $('#example').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                pageLength: 10
            });
        });
    </script>

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            });
        </script>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".btn-delete").forEach(button => {
                button.addEventListener("click", function(event) {
                    event.preventDefault();

                    let url = this.getAttribute("href");

                    Swal.fire({
                        title: "Yakin ingin menghapus?",
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                });
            });
        });
    </script>

    <script>
        function setEditCategoryData(id, name, image) {
            const editUrl = '{{ route('be.category.store', ':id') }}'

            console.log(id);

            document.getElementById('editCategoryForm').action = editUrl.replace(':id', id);
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_name').value = name;
    
            document.getElementById('edit_image_preview').src = image ? image : 'https://via.placeholder.com/100';
        }
    </script>
@endpush
