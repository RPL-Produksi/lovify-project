@extends('template.master')
@section('title', 'Home')
@include('components.navbar')
@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <section class="hero-section relative">
        <div class="flex justify-center items-center" style="height: 100vh">
            <div>
                <h1 class="text-center text-white text-6xl font-semibold" data-aos="fade-up" data-aos-duration="1000">Plan Your Perfect Day With Ease!</h1>
                <h3 class="text-center text-white text-2xl mt-6" data-aos="fade-up" data-aos-duration="1500" style="font-weight: 400">Your Dream Wedding, Tailored to You
                </h3>
                <div class="flex justify-center mt-7">
                    <a href="" class="border border-white text-white rounded-3xl px-7 py-3 book-btn" data-aos="fade-up" data-aos-duration="2000"
                        style="background-color: #3D0A05">Book Now!</a>
                </div>
            </div>
        </div>
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2">
            <a href="#service-section"
                class="w-7 h-7 flex items-center justify-center border-2 border-white text-white rounded-full hover:bg-white hover:text-black">
                <i class="fa-solid fa-arrow-down"></i>
            </a>
        </div>
    </section>

    <section class="service-section py-20" id="service-section" style="background-color: #f7f0f0">
        <div class=" px-40">
            <h1 class="text-5xl font-semibold text-redlue" data-aos="fade-up" data-aos-duration="1000">Our Services</h1>
            <div class=" grid grid-cols-4 mt-14 gap-5 justify-center items-center">
                <div class=" shadow-2xl py-4 px-5 border-redlue justify-center" data-aos="fade-up" data-aos-duration="1000">
                    <h1 class="text-redlue text-4xl font-semibold">Plannings</h1>
                    <p class="text-redlue text-xl mt-2 mb-6">With careful planning, your wedding is set to unfold
                        seamlessly, creating a beautiful moment for everyone involved.</p>
                    <a href="" class="text-redlue">Learn More <i class="fa-sharp fa-light fa-arrow-right"></i></a>
                </div>
                <div class=" shadow-2xl py-4 px-5 border-redlue justify-center" data-aos="fade-up" data-aos-duration="1500">
                    <h1 class="text-redlue text-4xl font-semibold">Plannings</h1>
                    <p class="text-redlue text-xl mt-2 mb-6">With careful planning, your wedding is set to unfold
                        seamlessly, creating a beautiful moment for everyone involved.</p>
                    <a href="" class="text-redlue">Learn More <i class="fa-sharp fa-light fa-arrow-right"></i></a>
                </div>
                <div class=" shadow-2xl py-4 px-5 border-redlue justify-center" data-aos="fade-up" data-aos-duration="2000">
                    <h1 class="text-redlue text-4xl font-semibold">Plannings</h1>
                    <p class="text-redlue text-xl mt-2 mb-6">With careful planning, your wedding is set to unfold
                        seamlessly, creating a beautiful moment for everyone involved.</p>
                    <a href="" class="text-redlue">Learn More <i class="fa-sharp fa-light fa-arrow-right"></i></a>
                </div>
                <div class=" shadow-2xl py-4 px-5 border-redlue justify-center" data-aos="fade-up" data-aos-duration="2500">
                    <h1 class="text-redlue text-4xl font-semibold">Plannings</h1>
                    <p class="text-redlue text-xl mt-2 mb-6">With careful planning, your wedding is set to unfold
                        seamlessly, creating a beautiful moment for everyone involved.</p>
                    <a href="" class="text-redlue">Learn More <i class="fa-sharp fa-light fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section pt-10 pb-20" id="about-section" style="background-color: #f7f0f0">
        <div class="px-40">
            <div class=" grid grid-cols-2">
                <div class="a">
                    <h3 class=" text-3xl text-redlue" data-aos="fade-up" data-aos-duration="1000">ABOUT US</h3>
                    <p class=" text-5xl text-redlue mt-5 leading-tight" data-aos="fade-up" data-aos-duration="1500">We Realized Preparing Your <br>Big Day Isn’t Always
                        Easy. At <span class="font-semibold">Lovify</span>, <span style="color: #9A7D7A;">We Specialized In <br>Making Your Big Day
                            Unforgettable.</span></p>
                </div>
                <div class="grid grid-cols-2 justify-items-center b gap-5">
                    <img src="{{ asset('asset/image/decoration_placeholder3.jpg') }}" class="about-image" alt="" data-aos="fade-up" data-aos="fade-up" data-aos-duration="1000">
                    <img src="{{ asset('asset/image/venue_placeholder1.jpg') }}" class="about-image" alt="" data-aos="fade-up" data-aos="fade-up" data-aos-duration="1500">
                    <img src="{{ asset('asset/image/decoration_placeholder2.jpg') }}" class="about-image" alt="" data-aos="fade-up" data-aos="fade-up" data-aos-duration="1000">
                    <img src="{{ asset('asset/image/decoration_placeholder4.jpg') }}" class="about-image" alt="" data-aos="fade-up" data-aos="fade-up" data-aos-duration="1500">
                    <img src="{{ asset('asset/image/decoration_placeholder5.jpg') }}" class="about-image" alt="" data-aos="fade-up" data-aos="fade-up" data-aos-duration="1000">
                    <img src="{{ asset('asset/image/wedding_placeholder2_bg.jpg') }}" class="about-image" alt="" data-aos="fade-up" data-aos="fade-up" data-aos-duration="1500">
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

    h1, h3, a, p {
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
        overflow: hidden;
    }

    .text-redlue {
        color: #3D0A05;
    }

    .border-redlue {
        border: solid #3D0A05 2px;
    }

    .about-section {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    .about-image {
        width: 400px;
        height: 400px;
        object-fit: cover
    }
</style>