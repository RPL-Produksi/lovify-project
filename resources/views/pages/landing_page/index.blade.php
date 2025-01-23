@extends('template.master')
@section('title', 'Home')
@include('components.navbar')
@section('css')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
@endsection
@section('content')
    @include('pages.client.landing_page.hero')
    @include('pages.client.landing_page.service')

    <section class="about-section pt-10 pb-20" id="about-section" style="background-color: #f7f0f0">
        <div class="Prem10rl">
            <div class="gridtemcol" style="width: 100%">
                <div class="text-a" style="width:100%;">
                    <h3 class=" text-3xl text-redlue" data-aos="fade-up" data-aos-duration="1000">ABOUT US</h3>
                    <p class=" p-48-res text-redlue mt-5 leading-tight" data-aos="fade-up" data-aos-duration="1500">We
                        Realized Preparing Your <br>Big Day Isn’t Always
                        Easy. At <span class="font-semibold">Lovify</span>, <span style="color: #9A7D7A;">We Specialized In
                            <br>Making Your Big Day
                            Unforgettable.</span></p>
                </div>
            <div class="right">
                <div class="grid grid-cols-2 b gap-5 " style="width:fit-content;">
                    <!-- Slider main container -->
                    <div class="swiper swiperone">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide"><img src="{{ asset('asset/image/decoration_placeholder1.jpg') }}"
                                    alt=""></div>
                            <div class="swiper-slide"><img src="{{ asset('asset/image/decoration_placeholder2.jpg') }}"
                                    alt=""></div>
                            <div class="swiper-slide"><img src="{{ asset('asset/image/decoration_placeholder3.jpg') }}"
                                    alt=""></div>
                            <div class="swiper-slide"><img src="{{ asset('asset/image/decoration_placeholder4.jpg') }}"
                                    alt=""></div>
                            <div class="swiper-slide"><img src="{{ asset('asset/image/decoration_placeholder5.jpg') }}"
                                    alt=""></div>
                        </div>
                        <!-- If we need pagination -->
                    </div>
                    <div class="swiper swipertwo">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide"><img src="{{ asset('asset/image/decoration_placeholder1.jpg') }}"
                                    alt=""></div>
                            <div class="swiper-slide"><img src="{{ asset('asset/image/decoration_placeholder2.jpg') }}"
                                    alt=""></div>
                            <div class="swiper-slide"><img src="{{ asset('asset/image/decoration_placeholder3.jpg') }}"
                                    alt=""></div>
                            <div class="swiper-slide"><img src="{{ asset('asset/image/decoration_placeholder4.jpg') }}"
                                    alt=""></div>
                            <div class="swiper-slide"><img src="{{ asset('asset/image/decoration_placeholder5.jpg') }}"
                                    alt=""></div>
                        </div>
                        <!-- If we need pagination -->
                </div>

                </div>
            </div>
            </div>
        </div>
    </section>

    <section class="plannings-section pt-10 pb-20" id="plannings-section" style="background-color: #f7f0f0">
        <div class="Prem10rl">
            <h1 class="template-h1 font-semibold text-redlue" data-aos="fade-up" data-aos-duration="1000">Plannings</h1>
            <di class="box-grid-plannings mt-5">
                <div class="box-plannings">

                </div>
        </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endsection
