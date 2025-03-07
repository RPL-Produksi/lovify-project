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
            <div class="xl:col-span-3 col-b shadow-2xl pb-20" style="background-color: #f7f0f0;">
                <div class="xl:px-48 px-7 pb-16 xl:pb-0">
                    <div class="">
                        <a href="{{ route('client.home') }}">
                            <img src="{{ asset('asset/image/Lovify-NoBg.png') }}" alt="">
                        </a>
                    </div>
                    <div>
                        <h1 class="text-redlue text-6xl font-bold">Welcome</h1>
                    </div>

                    <div class="mt-7">
                        <form action="{{ route('be.register') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="" class="text-redlue text-xl font-medium"><i class="fa-regular fa-user"></i> Full Name</label>
                                <input required type="text" name="fullname" value="{{ old('fullname') }}" class="w-full text-redlue bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your full name">    
                            </div>    
                            <div class="mt-5">
                                <label for="" class="text-redlue text-xl font-medium"><i class="fa-regular fa-phone"></i> Phone Number</label>
                                <input required type="number" name="phone_number" value="{{ old('phone_number') }}" class="w-full text-redlue bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your phone number">    
                            </div>    
                            <div class="mt-5">
                                <label for="" class="text-redlue text-xl font-medium"><i class="fa-regular fa-envelope"></i> Email</label>
                                <input required type="email" name="email" value="{{ old('email') }}" class="w-full text-redlue bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your email">    
                            </div>    
                            <div class="mt-5">
                                <label for="" class="text-redlue text-xl font-medium"><i class="fa-regular fa-user"></i> Username</label>
                                <input required type="text" name="username" value="{{ old('username') }}" class="w-full text-redlue bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your email">    
                            </div>    
                            <div class="mt-5">
                                <label for="" class="text-redlue text-xl font-medium"><i class="fa-regular fa-lock"></i> Password</label>
                                <input required type="password" name="password" class="w-full text-redlue bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your password">    
                            </div>    
                            <div class="mt-5">
                                <label for="" class="text-redlue text-xl font-medium"><i class="fa-regular fa-lock"></i> Password Confirmation</label>
                                <input required type="password" name="password_confirmation" class="w-full text-redlue bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your password">    
                            </div>    
                            <div class="mt-5">
                                <label for="" class="text-redlue text-xl font-medium"><i class="fa-regular fa-user"></i> Acount Type</label>
                                <select name="role" class="w-full text-redlue bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5">
                                    <option value="client">Client</option>
                                    <option value="mitra">Mitra</option>
                                </select>
                            </div>    
                            <div class="mt-5 w-100">
                                <button type="submit" class="bg-rose w-full text-white text-center py-3 rounded-md">Sign Up</button>
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
