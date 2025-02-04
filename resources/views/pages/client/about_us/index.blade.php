@extends('template.master')
@section('title', 'Detail Paket')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/about-us.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail-packet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    @include('components.navbar_rose')

    <section class="about-us-section relative" style="background-color: #f7f0f0">
        <div class="px-40 py-24">
            <div>
                <img src="{{ asset('asset/image/wedding_placeholder1.jpg') }}" class="w-full object-cover" style="height: 630px" alt="">
            </div>
            <div class="px-80 mt-10">
                <p class="text-redlue font-semibold text-xl text-center">“At Lovify, we believe every love story deserves to be celebrated in a way that is as unique and beautiful as the couple at its heart. What started as a passion for curating unforgettable moments has blossomed into a full-fledged wedding planning service, trusted by couples to bring their dream weddings to life.”</p>
            </div>

            <div class="grid grid-cols-2 mt-32">
                <div class="pr-20">
                    <h1 class="text-redlue font-bold text-9xl">Our Story.</h1>
                    <p class="text-redlue font-semibold text-2xl mt-16">From the very beginning, our mission has been simple,  to transform the often overwhelming task of wedding planning into a seamless, stress-free experience. We are a team of dedicated planners, designers, and coordinators, each with a deep love for romance and a knack for turning visions into reality.</p>
                </div>
                <div>
                    <img src="{{ asset('asset/image/decoration_placeholder5.jpg') }}" alt="" class="object-cover" style="height: 800px">
                </div>
            </div>
        </div>

    </section>

    @include('components.footer')
@endsection
@push('js')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endpush
