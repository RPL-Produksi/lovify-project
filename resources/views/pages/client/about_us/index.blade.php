@extends('template.master')
@section('title', 'About Us')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/about-us.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail-packet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    @include('components.navbar_rose')

    <section class="about-us-section relative" style="background-color: #f7f0f0">
        <div class="xl:px-40 px-4 py-24">
            <div>
                <img src="{{ asset('asset/image/wedding_placeholder1.jpg') }}" data-aos="fade-up" data-aos-duration="1500" class="w-full object-cover" style="height: 630px;" alt="">
            </div>
            <div class="xl:px-80 mt-7">
                <p class="text-redlue font-medium text-2xl text-center" data-aos="fade-up" data-aos-duration="1500">“At Lovify, we believe every love story deserves to be celebrated in a way that is as unique and beautiful as the couple at its heart. What started as a passion for curating unforgettable moments has blossomed into a full-fledged wedding planning service, trusted by couples to bring their dream weddings to life.”</p>
            </div>

            <div class="grid md:grid-cols-2 mt-36">
                <div class="xl:pr-20">
                    <h1 class="text-redlue font-bold xl:text-9xl text-5xl" data-aos="fade-up" data-aos-duration="1500">Our Story.</h1>
                    <p class="text-redlue font-medium text-2xl xl:mt-16 mt-10" data-aos="fade-up" data-aos-duration="1500">From the very beginning, our mission has been simple,  to transform the often overwhelming task of wedding planning into a seamless, stress-free experience. We are a team of dedicated planners, designers, and coordinators, each with a deep love for romance and a knack for turning visions into reality.</p>
                </div>
                <div class="xl:mt-0 mt-7">
                    <img src="{{ asset('asset/image/decoration_placeholder5.jpg') }}" alt="" class="object-cover" style="height: 780px" data-aos="fade-up" data-aos-duration="1500">
                </div>
            </div>

            <div class="grid xl:grid-cols-3 mt-40">
                <div>
                    <img src="{{ asset('asset/image/decoration_placeholder3.jpg') }}" alt="" class="object-cover" style="height: 780px" data-aos="fade-up" data-aos-duration="1500">
                </div>
                <div class="xl:pl-14 xl:col-span-2">
                    <h1 class="text-redlue font-bold xl:text-9xl text-5xl xl:mt-0 mt-7" data-aos="fade-up" data-aos-duration="1500">We Understand Your Needs !</h1>
                    <div class="xl:pr-52">
                        <p class="text-redlue font-medium text-2xl xl:mt-16 mt-7" data-aos="fade-up" data-aos-duration="1500">We understand that no two couples are the same, and neither should their weddings be. Our personalized approach ensures that every detail is thoughtfully designed to reflect your personality, style, and love story. Whether you're envisioning an intimate ceremony or a grand celebration, we’re here to help you create a day that will leave a lasting impression for years to come.</p>
                    </div>
                </div>
            </div>

            <div class="mt-40 pb-10 xl:px-64 px-4">
                <p class="text-redlue font-medium text-2xl mt-16 text-center" data-aos="fade-up" data-aos-duration="1500">“What sets us apart is our commitment to understanding your needs, guiding you through every step, and handling the details so you can focus on what truly matters : celebrating your love. We don’t just plan weddings; we create memories that last a lifetime.”</p>
            </div>

        </div>

    </section>

    <section class="hero-bottom-about-us relative">
        <div class="flex justify-center items-center" style="height: 65vh">
            <div>
                <h1 class="text-center text-white template-h1 font-semibold" data-aos="fade-up" data-aos-duration="1000">
                    Let us make your wedding day as <br>unforgettable as your love !</h1>
                <div class="flex justify-center mt-10">
                    <a href="" class="text-white rounded-3xl px-7 py-3 book-btn" data-aos="fade-up"
                        data-aos-duration="2000" style="background-color: #3D0A05">Book Now</a>
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
