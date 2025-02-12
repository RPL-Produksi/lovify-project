@extends('template-dashboard.layouts.app-admin')
@section('title', 'Kelola Produk')

@push('css')
@endpush

@section('content')

    <div class="card p-3">
        <div class="d-flex justify-content-between">
            <h3 class="text-rose">Kelola Produk</h3>
            <button type="button" class="btn text-white" style="background-color: #3D0A05" data-toggle="modal"
                data-target="#modalStore">
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
                    <td>Vendor</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                @isset($produk)
                @foreach ($produk as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img width="70" height="50" style="object-fit: cover" src="{{ $item->image }}" alt=""></td>
                    <td vertical>{{ $item->name }}</td>
                    <td vertical>{{ $item->name }}</td>
                    <td vertical>{{ $item->name }}</td>
                    <td vertical>{{ $item->name }}</td>
                    <td vertical>{{ $item->name }}</td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="" class="btn btn-primary"><i
                            class="fa-solid fa-pen-to-square"></i></button>
                            <a href="" class="btn btn-danger btn-delete" data-id="{{ $item->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                @endisset
            </tbody>
        </table>
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
@endpush
