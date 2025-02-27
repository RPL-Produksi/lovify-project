@extends('template.master')
@section('title', 'Change Password')
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
            <div class="xl:col-span-3 col-b shadow-2xl md:pb-0 pb-20" style="background-color: #f7f0f0;">
                <div class="xl:px-48 px-7">
                    <div class="flex xl:justify-end">
                        <a href="{{ route('client.home') }}">
                            <img src="{{ asset('asset/image/Lovify-NoBg.png') }}" alt="">
                        </a>
                    </div>
                    <div>
                        <h1 class="text-redlue text-6xl font-bold">Change Password</h1>
                    </div>
                    <div class="mt-16">
                        <form action="{{ route('client.update.password') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="old_password" class="text-redlue text-xl font-medium"><i class="fa-regular fa-lock"></i> Old Password</label>
                                <input type="password" name="old_password"
                                    class="w-full bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5"
                                    placeholder="Enter your old password">
                            </div>
                            <div class="mt-5">
                                <label for="new_password" class="text-redlue text-xl font-medium"><i class="fa-regular fa-lock"></i> New Password</label>
                                <input type="password" name="new_password"
                                    class="w-full bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5"
                                    placeholder="Enter your new password">
                            </div>
                            <div class="mt-5">
                                <label for="new_password_confirmation" class="text-redlue text-xl font-medium"><i class="fa-regular fa-lock"></i> Confirmation New Password</label>
                                <input type="password" name="new_password_confirmation"
                                    class="w-full bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5"
                                    placeholder="Confirmation your new password">
                            </div>
                            <div class="mt-3 w-100">
                                <button type="submit"
                                    class="bg-rose block text-white text-center py-3 w-full rounded-md">Submit</button>
                            </div>
                        </form>
                        <div class="mt-3">
                            <p class="text-center text-redlue">Don't know your old password? <a href="{{ route('register') }}"
                                    class="font-bold underline">Forgot Password</a></p>
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
