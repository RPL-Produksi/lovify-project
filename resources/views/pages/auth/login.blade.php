@extends('template.master')
@section('title', 'Login')
@push('css')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush
@section('content')
    <section class="login-section">
        <div class="grid xl:grid-cols-5">
            <div class="xl:col-span-2 col-a hidden md:block">

            </div>
            <div class="xl:col-span-3 col-b shadow-2xl md:pb-0 pb-16" style="background-color: #f7f0f0;">
                <div class="xl:px-48 px-7">
                    <div class="flex xl:justify-end">
                        <a href="{{ route('client.home') }}">
                            <img src="{{ asset('asset/image/Lovify-NoBg.png') }}" alt="">
                        </a>
                    </div>
                    <div>
                        <h1 class="text-redlue text-6xl font-bold">Welcome Back !</h1>
                    </div>
                    <div class="mt-16">
                        <form action="{{ route('be.login') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($isAdmin)
                                <div>
                                    <input hidden type="text" name="admin"
                                        value="true"class="w-full bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5"
                                        placeholder="Enter your email">
                                </div>
                            @endif
                            <div>
                                <label for="" class="text-redlue text-xl font-medium"><i class="fa-regular fa-user"></i> Username/email</label>
                                <input type="text" name="login"
                                    class="w-full bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5"
                                    placeholder="Enter your email">
                            </div>
                            <div class="mt-5">
                                <label for="" class="text-redlue text-xl font-medium"><i class="fa-regular fa-lock"></i> Password</label>
                                <input type="password" name="password"
                                    class="w-full bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5"
                                    placeholder="Enter your password">
                            </div>
                            <div class="mt-3 flex justify-between">
                                <div>
                                    <input name="remember" type="checkbox">
                                    <label for="" class="text-redlue font-medium">Remember me</label>
                                </div>
                                <div>
                                    <a href="" class="text-redlue font-medium">Forgot Password</a>
                                </div>
                            </div>
                            <div class="mt-3 w-100">
                                <button type="submit"
                                    class="bg-rose block text-white text-center py-3 w-full rounded-md">Sign In</button>
                            </div>
                        </form>
                        <div class="mt-3">
                            <p class="text-center text-redlue">Don't Have an Account? <a href="{{ route('register') }}"
                                    class="font-bold underline">Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endpush
