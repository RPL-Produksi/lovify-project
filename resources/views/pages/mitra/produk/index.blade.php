@extends('template-dashboard.layouts.app-admin')
@section('title', 'Kelola Produk')

@push('css')
@endpush

@section('content')

    <div class="card p-3">
        <div class="d-flex justify-content-between">
            <h3 class="text-rose">Kelola Produk</h3>
            <button type="button" class="btn text-white" style="background-color: #3D0A05" data-toggle="modal"
                data-target="#addProdukModal">
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
                    <td>Kategori</td>
                    <td>Nama</td>
                    <td>Harga</td>
                    <td>Status</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <div class="modal fade" id="addProdukModal" tabindex="-1" role="dialog" aria-labelledby="addProdukModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProdukModalLabel">Tambah Produk</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addProductForm" enctype="multipart/form-data" class="p-3" method="POST"
                    action="{{ route('mitra.store.produk') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="cover" class="form-label">Gambar Cover</label>
                        <input type="file" class="form-control" id="cover" name="cover" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="draft">Draft</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="attachments" class="form-label">Lampiran (Opsional)</label>
                        <input type="file" class="form-control" id="attachments" name="attachments[]" accept="image/*"
                            multiple>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" id="edit_id" name="id">
                        <div class="form-group">
                            <label for="edit_name">Nama Produk</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_description">Deskripsi</label>
                            <textarea class="form-control" id="edit_description" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_price">Harga</label>
                            <input type="number" class="form-control" id="edit_price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_cover">Gambar Cover</label>
                            <br>
                            <img id="edit_cover_preview" src="" alt="Cover Produk" width="100"
                                height="100" style="object-fit: cover; border-radius: 5px; margin-bottom: 10px;">
                            <input type="file" class="form-control" id="edit_cover" name="cover" accept="image/*">
                        </div>

                        <div class="form-group">
                            <label for="edit_status">Status</label>
                            <select class="form-control" id="edit_status" name="status" required>
                                <option value="draft">Draft</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group" hidden>
                            <label for="edit_category_id">Kategori</label>
                            <select class="form-control" id="edit_category_id" name="category_id" required>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
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
                    url: '{{ route('mitra.kelola.produk.data') }}',
                    method: 'GET',
                    success: function(response) {
                        let rows = '';
                        response.produk.forEach((item, index) => {
                            rows += `<tr>
                                <td>${index + 1}</td>
                                <td><img src="${item.cover}" width="55" height="35" style="object-fit: cover;"></td>
                                <td>${item.name}</td>
                                <td>${item.description}</td>
                                <td>${item.price}</td>
                                <td>${item.status}</td>
                                <td>
                                    <button class="btn text-white edit-btn" style="background-color: #3D0A05"
                                        data-id="${item.id}" data-cover="${item.cover}" data-name="${item.name}"
                                        data-description="${item.description}" data-price="${item.price}" data-status="${item.status}">
                                        <i class="fa-solid fa-pen-to-square" data-target="#editProductModal" data-toggle="modal"></i>
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
                console.log("Edit button clicked, ID:", id); // Debugging

                let cover = $(this).data('cover');
                let name = $(this).data('name');
                let description = $(this).data('description');
                let price = $(this).data('price');
                let status = $(this).data('status');

                $('#edit_id').val(id);
                $('#edit_name').val(name);
                $('#edit_description').val(description);
                $('#edit_price').val(price);
                $('#edit_status').val(status);
                $('#edit_cover_preview').attr('src', cover ? cover : 'https://via.placeholder.com/100');

                let updateUrl = '{{ route('mitra.store.produk', ':id') }}'.replace(':id', id);
                $('#editProductForm').attr('action', updateUrl);
                console.log("Update URL:", updateUrl);

                $('#editProductModal').modal('show');
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
                            url: '{{ route('mitra.delete.produk', ':id') }}'.replace(':id',
                                id),
                            method: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Produk berhasil dihapus.",
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
