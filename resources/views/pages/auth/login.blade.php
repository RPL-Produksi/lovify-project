@extends('template.master')
@section('title', 'Login')
@section('css')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection
@section('content')
<div class="container-login">
<div class="box-image">
    <img src="{{ asset('asset/image/bg-login.png') }}" alt="    ">
</div>
<div class="box-input-reg">
    <div class="img-logo">
        <img src="{{ asset('asset/image/Lovify-NoBg.png')}}" alt="">
    </div>
    <div class="box-form"></div>
</div>
</div>
@endsection
@section('js')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
@endsection

