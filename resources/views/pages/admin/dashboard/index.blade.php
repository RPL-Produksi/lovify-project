@extends('template-dashboard.layouts.app-admin')
@section('title', 'Dashboard')

@push('css')
    <style>
        bg-rose {
            background-color: #3D0A05;
        }
    </style>
@endpush

@section('content')

    @if (session('success'))
        <div class="alert alert-success mb-3 border-left-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card p-3 border-left-rose">
        <h3 class="text-rose">Dashboard Admin</h1>
    </div>

    <div class="row mt-4">
        <div class="col-xl-3 col-lg-4 col-md-12">
            <div class="card bg-rose p-3">
                <h3 class="text-white">Total Kategori :</h3>
                <h3 class="text-white" style="font-size: 3rem"><i class="fa fa-box"></i> {{ $totalKategori }}</h1>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-12 mt-lg-0 mt-3">
            <div class="card bg-rose p-3 ">
                <h3 class="text-white">Total Lokasi :</h3>
                <h3 class="text-white" style="font-size: 3rem"><i class="fa fa-map"></i> {{ $totalLokasi }}</h3>
            </div>
        </div>
    </div>


@endsection

@push('js')
    {{-- JS Only For This Page --}}
@endpush
