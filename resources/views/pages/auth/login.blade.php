@extends('template.master')
@section('title', 'Login')
@push('css')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush
@section('content')
   <section class="login-section">
        <div class="grid grid-cols-5">
            <div class="col-span-2 col-a">
                
            </div>
            <div class="col-span-3 col-b shadow-2xl" style="height: 100vh; background-color: #f7f0f0;">
                <div class="px-48">
                    <div class="flex justify-end">
                        <img src="{{ asset('asset/image/Lovify-NoBg.png') }}" alt="">
                    </div>
                    <div>
                        <h1 class="text-redlue text-6xl font-bold">Welcome Back !</h1>
                    </div>
                    <div class="mt-16">
                        <form action="" method="" enctype="multipart/form-data">
                            <div>
                                <label for="" class="text-redlue text-xl font-medium">Email</label>
                                <input type="text" class="w-full bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your email">    
                            </div>    
                            <div class="mt-5">
                                <label for="" class="text-redlue text-xl font-medium">Password</label>
                                <input type="password" class="w-full bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your password">    
                            </div>    
                            <div class="mt-3 flex justify-between">
                                <div>
                                    <input type="checkbox">
                                    <label for="" class="text-redlue font-medium">Remember me</label>
                                </div>
                                <div>
                                    <a href="" class="text-redlue font-medium">Forgot Password</a>
                                </div>
                            </div>
                            <div class="mt-3 w-full">
                                <a href="" class="bg-rose block text-white text-center py-3 rounded-md">Sign In</a>
                            </div>
                        </form>
                        <div class="mt-3">
                            <p class="text-center text-redlue">Don't Have an Account? <a href="{{ route('register') }}" class="font-bold underline">Sign Up</a></p>
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
