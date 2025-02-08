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
                        <img src="{{ asset('asset/image/Lovify-NoBg.png') }}" alt="">
                    </div>
                    <div>
                        <h1 class="text-redlue text-6xl font-bold">Welcome</h1>
                    </div>

                    <div class="mt-7">
                        <form action="{{ route('be.register') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="" class="text-redlue text-xl font-medium">Full Name</label>
                                <input type="text" name="fullname" value="{{ old('fullname') }}" class="w-full bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your full name">    
                            </div>    
                            <div class="mt-5">
                                <label for="" class="text-redlue text-xl font-medium">Phone Number</label>
                                <input type="number" name="phone_number" value="{{ old('phone_number') }}" class="w-full bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your phone number">    
                            </div>    
                            <div class="mt-5">
                                <label for="" class="text-redlue text-xl font-medium">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your email">    
                            </div>    
                            <div class="mt-5">
                                <label for="" class="text-redlue text-xl font-medium">Username</label>
                                <input type="text" name="username" value="{{ old('username') }}" class="w-full bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your email">    
                            </div>    
                            <div class="mt-5">
                                <label for="" class="text-redlue text-xl font-medium">Password</label>
                                <input type="password" name="password" class="w-full bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your password">    
                            </div>    
                            <div class="mt-5">
                                <label for="" class="text-redlue text-xl font-medium">Password Confirmation</label>
                                <input type="password" name="password_confirmation" class="w-full bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your password">    
                            </div>    
                            <div class="mt-5" hidden>
                                <label for="" class="text-redlue text-xl font-medium"></label>
                                <input type="text" name="role" value="client" class="w-full bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your password">    
                            </div>    
                            <div class="mt-5 w-100">
                                <button type="submit" class="bg-rose w-full text-white text-center py-3 rounded-md">Sign In</button>
                            </div>
                            <div>
                                @if ($errors->any())
                                    <p>{{ $errors->first() }}</p>
                                @endif
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
