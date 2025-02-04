@extends('template.master')
@section('title', 'Login')
@push('css')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush
@section('content')
    <div class="container-login">
        <div class="box-image">
            <img src="{{ asset('asset/image/bg-login.png') }}" alt="    ">
        </div>
        <div class="box-input-reg">
            <div class="img-logo">
                <img src="{{ asset('asset/image/Lovify-NoBg.png') }}" alt="">
            </div>
            <div class="box-form">
                <h1>Welcome Back!</h1>
                <form action="" method="POST">
                <div class="box-input-lg">
                    <p>Email</p>
                    <input type="email" placeholder="Enter Your Email">
                </div>
                <div class="box-input-lg">
                    <p>Password</p>
                    <input type="password" placeholder="Enter Your Password">
                </div>
                @csrf
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endpush
