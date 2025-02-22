@extends('template-dashboard.layouts.app-admin')
@section('title', 'Dashboard')

@push('css')
    {{-- CSS Only For This Page --}}
@endpush

@section('content')

    @if (session('success'))
        <div class="alert alert-success mb-3 border-left-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="card p-3 border-left-rose">
        <h3 class="text-rose">Dashboard Superadmin</h1>
    </div>

@endsection

@push('js')
    {{-- JS Only For This Page --}}
@endpush
