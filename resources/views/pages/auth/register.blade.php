@extends('template.master')
@section('title', 'Login')
@push('css')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush
@section('content')
   <section class="register-section">
        <div class="grid xl:grid-cols-5">
            <div class="xl:col-span-3 col-b shadow-2xl" style="background-color: #f7f0f0;">
                <div class="xl:px-48 px-7 pb-16 xl:pb-0">
                    <div class="">
                        <img src="{{ asset('asset/image/Lovify-NoBg.png') }}" alt="">
                    </div>
                    <div>
                        <h1 class="text-redlue text-6xl font-bold">Welcome</h1>
                    </div>
                    <div class="mt-7">
                        <form action="" method="" enctype="multipart/form-data">
                            <div>
                                <label for="" class="text-redlue text-xl font-medium">Full Name</label>
                                <input type="text" class="w-full bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your full name">    
                            </div>    
                            <div class="mt-5">
                                <label for="" class="text-redlue text-xl font-medium">Phone Number</label>
                                <input type="password" class="w-full bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your phone number">    
                            </div>    
                            <div class="mt-5">
                                <label for="" class="text-redlue text-xl font-medium">Email</label>
                                <input type="password" class="w-full bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your email">    
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
                            <p class="text-center text-redlue">Already Have an Account? <a href="{{ route('login') }}" class="font-bold underline">Sign In</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="xl:col-span-2 col-a hidden xl:block">
                
            </div>
        </div>
   </section>
@endsection
@push('js')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endpush
