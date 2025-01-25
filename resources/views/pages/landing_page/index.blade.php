@extends('template.master')
@section('title', 'Home')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    @include('components.navbar')

    <section class="hero-section relative">
        <div class="flex justify-center items-center" style="height: 100vh">
            <div>
                <h1 class="text-center text-white template-h1 font-semibold" data-aos="fade-up" data-aos-duration="1000">
                    Plan Your
                    Perfect Day With Ease!</h1>
                <h3 class="text-center text-white template-h3 mt-6" data-aos="fade-up" data-aos-duration="1500"
                    style="font-weight: 400">Your Dream Wedding, Tailored to You
                </h3>
                <div class="flex justify-center mt-7">
                    <a href="" class="border border-white text-white rounded-3xl px-7 py-3 book-btn"
                        data-aos="fade-up" data-aos-duration="2000" style="background-color: #3D0A05">Book Now!</a>
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
        <div class="px-4 sm:px-8 xl:px-40 lg:px-10">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-semibold text-redlue" data-aos="fade-up"
                data-aos-duration="1000">Our Services</h1>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 xl:grid-cols-4 mt-14 gap-5 justify-center items-center">
                <div class="shadow-2xl py-4 px-5 border-redlue justify-center" data-aos="fade-up" data-aos-duration="1000">
                    <h1 class="text-redlue text-2xl sm:text-3xl lg:text-4xl font-semibold">Plannings</h1>
                    <p class="text-redlue text-base sm:text-lg lg:text-xl mt-2 mb-6">With careful planning, your wedding is
                        set to unfold seamlessly, creating a beautiful moment for everyone involved.</p>
                    <a href="#plannings-section" class="text-redlue">See Plannings <i
                            class="fa-sharp fa-light fa-arrow-right"></i></a>
                </div>
                <div class="shadow-2xl py-4 px-5 border-redlue justify-center" data-aos="fade-up" data-aos-duration="1500">
                    <h1 class="text-redlue text-2xl sm:text-3xl lg:text-4xl font-semibold">Packets</h1>
                    <p class="text-redlue text-base sm:text-lg lg:text-xl mt-2 mb-6">Wedding packages are the perfect
                        solution for couples who want to celebrate their love without the stress of managing...
                    </p>
                    <a href="#packets-section" class="text-redlue">See Packets <i
                            class="fa-sharp fa-light fa-arrow-right"></i></a>
                </div>
                <div class="shadow-2xl py-4 px-5 border-redlue justify-center" data-aos="fade-up" data-aos-duration="2000">
                    <h1 class="text-redlue text-2xl sm:text-3xl lg:text-4xl font-semibold">Calculator</h1>
                    <p class="text-redlue text-base sm:text-lg lg:text-xl mt-2 mb-6">Easily calculate your wedding costs by
                        selecting your preferred vendors and packages. Plan with confidence and...</p>
                    <a href="#plannings-section" class="text-redlue">Calculator <i
                            class="fa-sharp fa-light fa-arrow-right"></i></a>
                </div>
                <div class="shadow-2xl py-4 px-5 border-redlue justify-center" data-aos="fade-up" data-aos-duration="2500">
                    <h1 class="text-redlue text-2xl sm:text-3xl lg:text-4xl font-semibold">Blogs & Articles</h1>
                    <p class="text-redlue text-base sm:text-lg lg:text-xl mt-2 mb-6">Your guide to a perfect wedding! Lets
                        get tips now, ideas, and inspiration to plan your dream day effortlessly.</p>
                    <a href="" class="text-redlue">See More <i class="fa-sharp fa-light fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section pt-10 pb-20 md:px-10 xl:px-0" id="about-section" style="background-color: #f7f0f0">
        <div class="Prem10rl">
            <div class="gridtemcol" style="width: 100%">
                <div class="text-a" style="width:100%;">
                    <h3 class=" text-3xl text-redlue font-bold md:font-normal " data-aos="fade-up" data-aos-duration="1000">
                        ABOUT US</h3>
                    <p class=" p-48-res text-redlue mt-5 leading-tight" data-aos="fade-up" data-aos-duration="1500">We
                        Realized Preparing Your <br>Big Day Isn’t Always
                        Easy. At <span class="font-semibold">Lovify</span>, <span style="color: #9A7D7A;">We Specialized In
                            <br>Making Your Big Day
                            Unforgettable.</span></p>
                </div>
                <div class="right md:mt-7 xl:mt-0" data-aos="fade-up" data-aos-duration="2000">
                    <div class="grid grid-cols-2 b gap-5 " style="width:fit-content;">
                        <!-- Slider main container -->
                        <div class="swiper swiperone">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <div class="swiper-slide mt-3"><img
                                        src="{{ asset('asset/image/decoration_placeholder1.jpg') }}" alt=""></div>
                                <div class="swiper-slide mt-3"><img
                                        src="{{ asset('asset/image/decoration_placeholder2.jpg') }}" alt=""></div>
                                <div class="swiper-slide mt-3"><img
                                        src="{{ asset('asset/image/decoration_placeholder3.jpg') }}" alt=""></div>
                                <div class="swiper-slide mt-3"><img
                                        src="{{ asset('asset/image/decoration_placeholder4.jpg') }}" alt=""></div>
                                <div class="swiper-slide mt-3"><img
                                        src="{{ asset('asset/image/decoration_placeholder5.jpg') }}" alt=""></div>
                            </div>
                            <!-- If we need pagination -->
                        </div>
                        <div class="swiper swipertwo">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <div class="swiper-slide mt-3"><img
                                        src="{{ asset('asset/image/decoration_placeholder1.jpg') }}" alt="">
                                </div>
                                <div class="swiper-slide mt-3"><img
                                        src="{{ asset('asset/image/decoration_placeholder2.jpg') }}" alt="">
                                </div>
                                <div class="swiper-slide mt-3"><img
                                        src="{{ asset('asset/image/decoration_placeholder3.jpg') }}" alt="">
                                </div>
                                <div class="swiper-slide mt-3"><img
                                        src="{{ asset('asset/image/decoration_placeholder4.jpg') }}" alt="">
                                </div>
                                <div class="swiper-slide mt-3"><img
                                        src="{{ asset('asset/image/decoration_placeholder5.jpg') }}" alt="">
                                </div>
                            </div>
                            <!-- If we need pagination -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="plannings-section pt-10 pb-20 md:px-10 xl:px-0" id="plannings-section" style="background-color: #f7f0f0">
        <div class="Prem10rl">
            <h1 class="template-h1 font-semibold text-redlue" data-aos="fade-up" data-aos-duration="1000">Plannings</h1>
            <div class="box-grid-plannings mt-5">
                <div class="box-plannings shadow-2xl" data-aos="fade-up" data-aos-duration="1000">
                    <img src="{{ asset('asset/image/catering_placeholder.jpg') }}" alt="">
                    <div class="text-box-plannings mt-3">
                        <h2>Catring</h2>
                        <hr class="my-3" style="background-color:#3d0a0550; height: 4px;">
                        <div class="box-overflow" id="box-overflow">
                            <div class="box-check">
                                <p>INI ADALAH CHECK BOX SANGAT BAGUS</p>
                                <label class="custom-checkbox">
                                    <input type="radio" name="group1" onclick="hideshow()" class="input-check"
                                        value="1">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="box-input-pax" id="InNum1" style="display: none;">
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="padding-left: 10px">Jumlah/Pax</span>
                                    <input type="number" inputmode="numeric"
                                        style="width: 50%; background-color:transparent; border: #3D0A05 2px solid; padding-left: 5px;"
                                        class="input-check">
                                </div>
                            </div>
                            <div class="box-check">
                                <p>INI ADALAH CHECK BOX SANGAT BAGUS</p>
                                <label class="custom-checkbox">
                                    <input type="radio" name="group1" onclick="hideshow()" class="input-check"
                                        value="2">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="box-input-pax" id="InNum2" style="display: none;">
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="padding-left: 10px">Jumlah/Pax</span>
                                    <input type="number" inputmode="numeric"
                                        style="width: 50%; background-color:transparent; border: #3D0A05 2px solid; padding-left: 5px;"
                                        class="input-check">
                                </div>
                            </div>
                            <div class="box-check">
                                <p>INI ADALAH CHECK BOX SANGAT BAGUS</p>
                                <label class="custom-checkbox">
                                    <input type="radio" name="group1" onclick="hideshow()" class="input-check"
                                        value="3">
                                    <span class="checkmark"></span>
                            </div>
                            <div class="box-input-pax" id="InNum3" style="display: none;">
                                </label>
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="padding-left: 10px">Jumlah/Pax</span>
                                    <input type="number" inputmode="numeric"
                                        style="width: 50%; background-color:transparent; border: #3D0A05 2px solid; padding-left: 5px;"
                                        class="input-check">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-plannings shadow-2xl" data-aos="fade-up" data-aos-duration="1000">
                    <img src="{{ asset('asset/image/catering_placeholder.jpg') }}" alt="">
                    <div class="text-box-plannings mt-3">
                        <h2>Catring</h2>
                        <hr class="my-3" style="background-color:#3d0a0550; height: 4px;">
                        <div class="box-overflow" id="box-overflow">
                            <div class="box-check">
                                <p>INI ADALAH CHECK BOX SANGAT BAGUS</p>
                                <label class="custom-checkbox">
                                    <input type="radio" name="group1" onclick="hideshow()" class="input-check"
                                        value="1">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="box-input-pax" id="InNum1" style="display: none;">
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="padding-left: 10px">Jumlah/Pax</span>
                                    <input type="number" inputmode="numeric"
                                        style="width: 50%; background-color:transparent; border: #3D0A05 2px solid; padding-left: 5px;"
                                        class="input-check">
                                </div>
                            </div>
                            <div class="box-check">
                                <p>INI ADALAH CHECK BOX SANGAT BAGUS</p>
                                <label class="custom-checkbox">
                                    <input type="radio" name="group1" onclick="hideshow()" class="input-check"
                                        value="2">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="box-input-pax" id="InNum2" style="display: none;">
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="padding-left: 10px">Jumlah/Pax</span>
                                    <input type="number" inputmode="numeric"
                                        style="width: 50%; background-color:transparent; border: #3D0A05 2px solid; padding-left: 5px;"
                                        class="input-check">
                                </div>
                            </div>
                            <div class="box-check">
                                <p>INI ADALAH CHECK BOX SANGAT BAGUS</p>
                                <label class="custom-checkbox">
                                    <input type="radio" name="group1" onclick="hideshow()" class="input-check"
                                        value="3">
                                    <span class="checkmark"></span>
                            </div>
                            <div class="box-input-pax" id="InNum3" style="display: none;">
                                </label>
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="padding-left: 10px">Jumlah/Pax</span>
                                    <input type="number" inputmode="numeric"
                                        style="width: 50%; background-color:transparent; border: #3D0A05 2px solid; padding-left: 5px;"
                                        class="input-check">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-plannings shadow-2xl" data-aos="fade-up" data-aos-duration="1000">
                    <img src="{{ asset('asset/image/catering_placeholder.jpg') }}" alt="">
                    <div class="text-box-plannings mt-3">
                        <h2>Catring</h2>
                        <hr class="my-3" style="background-color:#3d0a0550; height: 4px;">
                        <div class="box-overflow" id="box-overflow">
                            <div class="box-check">
                                <p>INI ADALAH CHECK BOX SANGAT BAGUS</p>
                                <label class="custom-checkbox">
                                    <input type="radio" name="group1" onclick="hideshow()" class="input-check"
                                        value="1">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="box-input-pax" id="InNum1" style="display: none;">
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="padding-left: 10px">Jumlah/Pax</span>
                                    <input type="number" inputmode="numeric"
                                        style="width: 50%; background-color:transparent; border: #3D0A05 2px solid; padding-left: 5px;"
                                        class="input-check">
                                </div>
                            </div>
                            <div class="box-check">
                                <p>INI ADALAH CHECK BOX SANGAT BAGUS</p>
                                <label class="custom-checkbox">
                                    <input type="radio" name="group1" onclick="hideshow()" class="input-check"
                                        value="2">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="box-input-pax" id="InNum2" style="display: none;">
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="padding-left: 10px">Jumlah/Pax</span>
                                    <input type="number" inputmode="numeric"
                                        style="width: 50%; background-color:transparent; border: #3D0A05 2px solid; padding-left: 5px;"
                                        class="input-check">
                                </div>
                            </div>
                            <div class="box-check">
                                <p>INI ADALAH CHECK BOX SANGAT BAGUS</p>
                                <label class="custom-checkbox">
                                    <input type="radio" name="group1" onclick="hideshow()" class="input-check"
                                        value="3">
                                    <span class="checkmark"></span>
                            </div>
                            <div class="box-input-pax" id="InNum3" style="display: none;">
                                </label>
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="padding-left: 10px">Jumlah/Pax</span>
                                    <input type="number" inputmode="numeric"
                                        style="width: 50%; background-color:transparent; border: #3D0A05 2px solid; padding-left: 5px;"
                                        class="input-check">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section class="planning-section xl:px-40 md:px-10 px-4 pt-10 pb-40" id="packets-section" style="background-color: #f7f0f0">
        <h1 class="font-semibold template-h1" data-aos="fade-up" data-aos-duration="1000" style="color: #3D0A05">Packets
        </h1>
        <div class="grid xl:grid-cols-3 md:grid-cols-2 mt-7 gap-7">
            <div class="planning-card p-4 border-2 border-rose-950 shadow-xl" data-aos="fade-up"
                data-aos-duration="1000">
                <img src="{{ asset('asset/image/decoration_placeholder3.jpg') }}" class="w-full" style="height: 230px"
                    alt="">
                <div class="mt-6 flex justify-between mb-3 items-center">
                    <h3 class=" text-rose-950 text-2xl font-bold">Basic</h3>
                    <a href=""
                        class="py-3 px-4 text-white rounded-lg shadow-lg bg-rose hover:bg-white hover:text-black transition-all duration-100">See
                        More</a>
                </div>
            </div>
            <div class="planning-card p-4 border-2 border-rose-950 shadow-xl" data-aos="fade-up"
                data-aos-duration="1000">
                <img src="{{ asset('asset/image/decoration_placeholder2.jpg') }}" class="w-full" style="height: 230px"
                    alt="">
                <div class="mt-6 flex justify-between mb-3 items-center">
                    <h3 class=" text-rose-950 text-2xl font-bold">Silver</h3>
                    <a href=""
                        class="py-3 px-4 text-white rounded-lg shadow-lg bg-rose hover:bg-white hover:text-black transition-all duration-100">See
                        More</a>
                </div>
            </div>
            <div class="planning-card p-4 border-2 border-rose-950 shadow-xl" data-aos="fade-up"
                data-aos-duration="1000">
                <img src="{{ asset('asset/image/decoration_placeholder1.jpg') }}" class="w-full" style="height: 230px"
                    alt="">
                <div class="mt-6 flex justify-between mb-3 items-center">
                    <h3 class=" text-rose-950 text-2xl font-bold">Silver</h3>
                    <a href=""
                        class="py-3 px-4 text-white rounded-lg shadow-lg bg-rose hover:bg-white hover:text-black transition-all duration-100">See
                        More</a>
                </div>
            </div>
            <div class="planning-card p-4 border-2 border-rose-950 shadow-xl" data-aos="fade-up"
                data-aos-duration="1000">
                <img src="{{ asset('asset/image/decoration_placeholder4.jpg') }}" class="w-full" style="height: 230px"
                    alt="">
                <div class="mt-6 flex justify-between mb-3 items-center">
                    <h3 class=" text-rose-950 text-2xl font-bold">Platinum</h3>
                    <a href=""
                        class="py-3 px-4 text-white rounded-lg shadow-lg bg-rose hover:bg-white hover:text-black transition-all duration-100">See
                        More</a>
                </div>
            </div>
            <div class="planning-card p-4 border-2 border-rose-950 shadow-xl" data-aos="fade-up"
                data-aos-duration="1000">
                <img src="{{ asset('asset/image/decoration_placeholder5.jpg') }}" class="w-full" style="height: 230px"
                    alt="">
                <div class="mt-6 flex justify-between mb-3 items-center">
                    <h3 class=" text-rose-950 text-2xl font-bold">Luxury</h3>
                    <a href=""
                        class="py-3 px-4 text-white rounded-lg shadow-lg bg-rose hover:bg-white hover:text-black transition-all duration-100">See
                        More</a>
                </div>
            </div>
            <div class="planning-card p-4 border-2 border-rose-950 shadow-xl" data-aos="fade-up"
                data-aos-duration="1000">
                <img src="{{ asset('asset/image/wedding_placeholder2_bg.jpg') }}" class="w-full" style="height: 230px"
                    alt="">
                <div class="mt-6 flex justify-between mb-3 items-center">
                    <h3 class=" text-rose-950 text-2xl font-bold">Venue</h3>
                    <a href=""
                        class="py-3 px-4 text-white rounded-lg shadow-lg bg-rose hover:bg-white hover:text-black transition-all duration-100">See
                        More</a>
                </div>
            </div>
        </div>
        <div class="flex justify-center items-center mt-7">
            <a href=""
                class="py-4 px-7 text-white rounded-full shadow-lg bg-rose hover:bg-white hover:text-black transition-all duration-100 text-xl"
                data-aos="fade-up" data-aos-duration="1000">See More</a>
        </div>
    </section>

    @include('components.footer')
@endsection
@section('js')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endsection
