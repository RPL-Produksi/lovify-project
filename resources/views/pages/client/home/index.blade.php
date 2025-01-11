@extends('template.master')
@section('title', 'Home')
@include('components.navbar')
@section('content')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <section class="cover-section relative">
        <div class="flex justify-center items-center" style="height: 100vh">
            <div>
                <h1 class="text-center text-white text-6xl font-semibold">Plan Your Perfect Day With Ease!</h1>
                <h3 class="text-center text-white text-2xl mt-6" style="font-weight: 400">Your Dream Wedding, Tailored to You</h3>
                <div class="flex justify-center mt-7">
                    <a href="" class="border border-white text-white rounded-3xl px-7 py-3"
                        style="background-color: #3D0A05">Book Now!</a>
                </div>
            </div>
        </div>
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2">
            <a href="" class="w-7 h-7 flex items-center justify-center border-2 border-white text-white rounded-full">
                <i class="fa-solid fa-arrow-down"></i>
            </a>
        </div>
    </section>
    

@endsection

<style>
    .cover-section {
        position: relative;
        width: 100%;
        height: 100vh;
        overflow: hidden;
    }

    .cover-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url(asset/image/wedding_placeholder2_bg.jpg);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        opacity: 0.4;
        z-index: -1;
    }

    h1,
    h3,
    a {
        font-family: 'IBM Plex Serif', serif;
    }
</style>
