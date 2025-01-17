@extends('template.master')
@section('title', 'Home')
@include('components.navbar')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <section class="hero-section relative">
        <div class="flex justify-center items-center" style="height: 100vh">
            <div>
                <h1 class="text-center text-white text-6xl font-semibold">Plan Your Perfect Day With Ease!</h1>
                <h3 class="text-center text-white text-2xl mt-6" style="font-weight: 400">Your Dream Wedding, Tailored to You
                </h3>
                <div class="flex justify-center mt-7">
                    <a href="" class="border border-white text-white rounded-3xl px-7 py-3 book-btn"
                        style="background-color: #3D0A05">Book Now!</a>
                </div>
            </div>
        </div>
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2">
            <a href=""
                class="w-7 h-7 flex items-center justify-center border-2 border-white text-white rounded-full hover:bg-white hover:text-black">
                <i class="fa-solid fa-arrow-down"></i>
            </a>
        </div>
    </section>

    <section class="service-section" style="background-color: #f7f0f0">
        <div class=" px-64 container mt-20">
            <h1 class="text-5xl font-semibold text-redlue">Our Services</h1>
            <div class="grid grid-cols-4">
                <div class=" shadow-lg mt-20 border-redlue">
                    <h1 class="text-redlue text-4xl font-semibold">Plannings</h1>
                    <p class="text-redlue text-1xl">With careful planning, your wedding is set to unfold seamlessly, creating a beautiful moment for everyone involved.</p>
                </div>
                <div class=" shadow-lg mt-20 border-redlue">
                    <h1 class="text-redlue text-4xl font-semibold">Plannings</h1>
                    <p class="text-redlue text-1xl">With careful planning, your wedding is set to unfold seamlessly, creating a beautiful moment for everyone involved.</p>
                </div>
                <div class=" shadow-lg mt-20 border-redlue">
                    <h1 class="text-redlue text-4xl font-semibold">Plannings</h1>
                    <p class="text-redlue text-1xl">With careful planning, your wedding is set to unfold seamlessly, creating a beautiful moment for everyone involved.</p>
                </div>
                <div class=" shadow-lg mt-20 border-redlue">
                    <h1 class="text-redlue text-4xl font-semibold">Plannings</h1>
                    <p class="text-redlue text-1xl">With careful planning, your wedding is set to unfold seamlessly, creating a beautiful moment for everyone involved.</p>
                </div>
            </div>
        </div>
    </section>

@endsection

<style>
    .hero-section {
        position: relative;
        width: 100%;
        height: 100vh;
        overflow: hidden;
    }

    .hero-section::before {
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

    h1,h3, a, p {
        font-family: 'IBM Plex Serif', serif;
    }

    .book-btn:hover {
        background-color: white !important;
        color: black;
        transition: 0.3s;
    }

    .service-section {
        position: relative;
        width: 100%;
        height: 100vh;
        overflow: hidden;
    }

    .text-redlue {
        color: #3D0A05;
    }

    .border-redlue {
        border: solid #3D0A05 2px ;
    }
</style>
