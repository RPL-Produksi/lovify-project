@extends('template-dashboard.layouts.app-admin')
@section('title', 'Kelola Produk')

@push('css')
@endpush

@section('content')

    <div class="card p-3">
        <div class="d-flex justify-content-between">
            <h3 class="text-rose">Kelola Produk</h3>
            <button type="button" class="btn text-white" style="background-color: #3D0A05" data-toggle="modal"
                data-target="#addProductModal">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
        <hr>
        <table class="table table-bordered table-striped" id="example">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Gambar</td>
                    <td>Kategori</td>
                    <td>Nama</td>
                    <td>Slug</td>
                    <td>Harga</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                @isset($produk)
                    @foreach ($produk as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img width="70" height="50" style="object-fit: cover" src="{{ $item->cover }}"
                                    alt=""></td>
                            <td vertical>{{ ucwords($item->vendor->category->name) }}</td>
                            <td vertical>{{ ucwords($item->name) }}</td>
                            <td vertical>{{ ucwords($item->slug) }}</td>
                            <td vertical>{{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>
                                <button type="button" class="btn text-white"
                                    style="background-color: #3D0A05"><i class="fa-solid fa-pen-to-square" data-toggle="modal"
                                    data-target="#editProductModal"
                                    onclick="setEditProductData('{{ $item->id }}', '{{ $item->name }}', '{{ $item->description }}', '{{ $item->slug }}', '{{ $item->price }}', '{{ $item->status }}', '{{ $item->category_id }}', '{{ $item->cover }}')"></i></button>
                               
                                

                                <a href="{{ route('mitra.delete.produk', $item->id) }}" class="btn text-white btn-delete"
                                    data-id="{{ $item->id }}" style="background-color: #3D0A05">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endisset
            </tbody>
        </table>
    </div>

    <!-- modal add produk -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProductForm" enctype="multipart/form-data" method="POST"
                        action="{{ route('mitra.tambah.produk') }}">
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
                            <label for="slug" class="form-label">slug</label>
                            <textarea class="form-control" id="slug" name="slug" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="cover" class="form-label">Gambar Cover</label>
                            <input type="file" class="form-control" id="cover" name="cover" accept="image/*"
                                required>
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
                        <div class="mb-3">
                            <label for="attachments" class="form-label">Lampiran (Opsional)</label>
                            <input type="file" class="form-control" id="attachments" name="attachments[]"
                                accept="image/*" multiple>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal edit produk -->
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
                    <form id="editProductForm" enctype="multipart/form-data" method="POST"
                        action="{{ route('mitra.tambah.produk') }}">
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
                            <label for="edit_slug">Slug</label>
                            <input type="text" class="form-control" id="edit_slug" name="slug" required>
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
                        <div class="form-group">
                            <label for="edit_category_id">Kategori</label>
                            <select class="form-control" id="edit_category_id" name="category_id" required>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
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
        function setEditProductData(id, name, description, slug, price, status, categoryId, cover) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_description').value = description;
            document.getElementById('edit_slug').value = slug;
            document.getElementById('edit_price').value = price;
            document.getElementById('edit_status').value = status;

            let categorySelect = document.getElementById('edit_category_id');
            for (let option of categorySelect.options) {
                if (option.value == categoryId) {
                    option.selected = true;
                }
            }

            // Tampilkan cover lama di preview
            document.getElementById('edit_cover_preview').src = cover ? cover : 'https://via.placeholder.com/100';
        }
    </script>
@endpush
