@extends('template-dashboard.layouts.app-admin')
@section('title', 'Kelola Pesanan')

@push('css')
@endpush

@section('content')

    <div class="card p-3 mb-5">
        <div class="d-flex justify-content-between">
            <h3 class="text-rose">Kelola Pesanan</h3>
        </div>
        <hr>
        <div>
            @if ($errors->any())
                <p class="alert alert-danger border-left-danger">{{ $errors->first() }}</p>
            @endif
        </div>
        <table id="orderProgressTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Marry Date</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Product Name</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
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
                            <label for="edit_status">Status</label>
                            <select class="form-control" id="edit_status" name="status" required>
                                <option value="" disabled selected>Ubah Status</option>
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
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
            $('#orderProgressTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("mitra.kelola.pesanan.data") }}', // Sesuaikan dengan route yang benar
                    type: 'GET'
                },
                columns: [
                    { data: null, searchable: false, orderable: false, render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: 'marry_date', name: 'marry_date' },
                    { data: 'user_fullname', name: 'user_fullname' },
                    { data: 'user_email', name: 'user_email' },
                    { data: 'user_phone_number', name: 'user_phone_number' },
                    { data: 'product_name', name: 'product_name' },
                    { data: 'status', name: 'status' },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            return `
                                <button class="btn text-white edit-btn" style="background-color: #3D0A05"
                                    data-id="${data}" data-cover="${row.cover}" data-name="${row.name}"
                                    data-description="${row.description}" data-price="${row.price}"
                                    data-status="${row.status}" data-toggle="modal" data-target="#editProductModal">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>`;
                        }
                    }
                ],
                order: [[0, 'desc']]
            });

            $(document).on('click', '.edit-btn', function() {
                let id = $(this).data('id');
                let status = $(this).data('status');

                $('#edit_id').val(id);
                $('#edit_status').val(status);

                let updateUrl = '{{ route('mitra.update.product.progress', ':id') }}'.replace(':id', id);
                $('#editProductForm').attr('action', updateUrl);

                $('#editProductModal').modal('show');
            });

        });
    </script>

@endpush
