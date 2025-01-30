@extends('template.master')
@section('title', 'Home')
@section('content')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    <div class="login-section min-h-screen flex-col flex justify-center items-center md:px-0 px-7">
        <div class="bg-transparent p-8 rounded-xl shadow-xl w-full max-w-md backdrop-blur-lg">
            <div class="w-full flex justify-center mb-5">
                <img src="{{ asset('asset/image/name_icon1.png') }}" class="mb-5" alt="">
            </div>
            <form action="{{ route('post.login') }}" method="POST">
                @csrf
                @if ($isAdmin)
                    <input type="hidden" name="admin" value="true">
                @endif
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-white">Username</label>
                    <input type="text" id="username" name="login"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-white">Password</label>
                    <input type="password" id="password" name="password"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div class="flex items-center mb-6">
                    <input type="checkbox" id="remember-me" name="remember-me"
                        class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="remember-me" class="ml-2 text-sm text-white">Remember Me</label>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="w-full btn py-2 px-4 text-white font-semibold rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 hover:text-black hover:bg-white bg-rose2">
                        Login
                    </button>
                </div>
                <div class="mt-3">
                    <small class="text-white">don't have an account yet? <a href="" class="text-blue-500">register now</a></small>
                </div>
            </form>
        </div>
    </div>

    <style>
        .login-section {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .login-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('../asset/image/wedding_placeholder1.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.4;
            z-index: -1;
        }

        .bg-rose2 {
            background-color: #3D0A05;
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
