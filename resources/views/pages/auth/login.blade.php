@extends('template.master')
@section('title', 'Home')
@section('content')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    <div class="login-section min-h-screen flex-col flex justify-center items-center md:px-0 px-7">
        <div class="grid grid-cols-3">
            <div class="column-a">

            </div>
            <div class="col-span-2">

            </div>
        </div>
    </div>

    <style>
        .login-section {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .bg-rose2 {
            background-color: #3D0A05;
        }

        .columm-a {
            background-image: url('../asset/image/decoration_placeholder4.jpg');
        }
    </style>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection


{{-- @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
