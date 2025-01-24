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
        <div class="px-4 sm:px-8 lg:px-40">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-semibold text-redlue" data-aos="fade-up"
                data-aos-duration="1000">Our Services</h1>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mt-14 gap-5 justify-center items-center">
                <div class="shadow-2xl py-4 px-5 border-redlue justify-center" data-aos="fade-up" data-aos-duration="1000">
                    <h1 class="text-redlue text-2xl sm:text-3xl lg:text-4xl font-semibold">Plannings</h1>
                    <p class="text-redlue text-base sm:text-lg lg:text-xl mt-2 mb-6">With careful planning, your wedding is
                        set to unfold seamlessly, creating a beautiful moment for everyone involved.</p>
                    <a href="" class="text-redlue">Learn More <i class="fa-sharp fa-light fa-arrow-right"></i></a>
                </div>
                <div class="shadow-2xl py-4 px-5 border-redlue justify-center" data-aos="fade-up" data-aos-duration="1500">
                    <h1 class="text-redlue text-2xl sm:text-3xl lg:text-4xl font-semibold">Plannings</h1>
                    <p class="text-redlue text-base sm:text-lg lg:text-xl mt-2 mb-6">With careful planning, your wedding is
                        set to unfold seamlessly, creating a beautiful moment for everyone involved.</p>
                    <a href="" class="text-redlue">Learn More <i class="fa-sharp fa-light fa-arrow-right"></i></a>
                </div>
                <div class="shadow-2xl py-4 px-5 border-redlue justify-center" data-aos="fade-up" data-aos-duration="2000">
                    <h1 class="text-redlue text-2xl sm:text-3xl lg:text-4xl font-semibold">Plannings</h1>
                    <p class="text-redlue text-base sm:text-lg lg:text-xl mt-2 mb-6">With careful planning, your wedding is
                        set to unfold seamlessly, creating a beautiful moment for everyone involved.</p>
                    <a href="" class="text-redlue">Learn More <i class="fa-sharp fa-light fa-arrow-right"></i></a>
                </div>
                <div class="shadow-2xl py-4 px-5 border-redlue justify-center" data-aos="fade-up" data-aos-duration="2500">
                    <h1 class="text-redlue text-2xl sm:text-3xl lg:text-4xl font-semibold">Plannings</h1>
                    <p class="text-redlue text-base sm:text-lg lg:text-xl mt-2 mb-6">With careful planning, your wedding is
                        set to unfold seamlessly, creating a beautiful moment for everyone involved.</p>
                    <a href="" class="text-redlue">Learn More <i class="fa-sharp fa-light fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>


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
                                <div class="swiper-slide"><img
                                        src="{{ asset('asset/image/decoration_placeholder5.jpg') }}" alt=""></div>
                            </div>
                            <!-- If we need pagination -->
                        </div>
                        <div class="swiper swipertwo">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <div class="swiper-slide"><img
                                        src="{{ asset('asset/image/decoration_placeholder1.jpg') }}" alt=""></div>
                                <div class="swiper-slide"><img
                                        src="{{ asset('asset/image/decoration_placeholder2.jpg') }}" alt=""></div>
                                <div class="swiper-slide"><img
                                        src="{{ asset('asset/image/decoration_placeholder3.jpg') }}" alt=""></div>
                                <div class="swiper-slide"><img
                                        src="{{ asset('asset/image/decoration_placeholder4.jpg') }}" alt="">
                                </div>
                                <div class="swiper-slide"><img
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

    <section class="plannings-section pt-10 pb-20" id="plannings-section" style="background-color: #f7f0f0">
        <div class="Prem10rl">
            <h1 class="template-h1 font-semibold text-redlue" data-aos="fade-up" data-aos-duration="1000">Plannings</h1>
            <di class="box-grid-plannings mt-5">
                <div class="box-plannings" data-aos="fade-up" data-aos-duration="1000">
                    <img src="{{ asset('asset/image/catering_placeholder.jpg') }}" alt="">
                    <div class="text-box-plannings mt-3">
                        <h2>Catring</h2>
                        <hr class="my-3" style="background-color:#3d0a0550; height: 4px;">
                        <div class="box-overflow" id="box-overflow">
                            <div class="box-check">
                                <P>INI ADALAH CHECK BOX SANGAT BAGUS</P>
                                <input type="checkbox" id="check1" name="check1">
                            </div>
                            <div class="box-check">
                                <P>INI ADALAH CHECK BOX SANGAT BAGUS</P>
                                <input type="checkbox" id="check1" name="check1">
                            </div>
                            <div class="box-check">
                                <P>INI ADALAH CHECK BOX SANGAT BAGUS</P>
                                <input type="checkbox" id="check1" name="check1">
                            </div>
                            <div class="box-check">
                                <P>INI ADALAH CHECK BOX SANGAT BAGUS</P>
                                <input type="checkbox" id="check1" name="check1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-plannings" data-aos="fade-up" data-aos-duration="1000">
                    <img src="{{ asset('asset/image/catering_placeholder.jpg') }}" alt="">
                    <div class="text-box-plannings mt-3">
                        <h2>Catring</h2>
                        <hr class="my-3" style="background-color:#3d0a0550; height: 4px;">
                        <div class="box-overflow" id="box-overflow">
                            <div class="box-check">
                                <P>INI ADALAH CHECK BOX SANGAT BAGUS</P>
                                <input type="checkbox" id="check1" name="check1">
                            </div>
                            <div class="box-check">
                                <P>INI ADALAH CHECK BOX SANGAT BAGUS</P>
                                <input type="checkbox" id="check1" name="check1">
                            </div>
                            <div class="box-check">
                                <P>INI ADALAH CHECK BOX SANGAT BAGUS</P>
                                <input type="checkbox" id="check1" name="check1">
                            </div>
                            <div class="box-check">
                                <P>INI ADALAH CHECK BOX SANGAT BAGUS</P>
                                <input type="checkbox" id="check1" name="check1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-plannings" data-aos="fade-up" data-aos-duration="1000">
                    <img src="{{ asset('asset/image/catering_placeholder.jpg') }}" alt="">
                    <div class="text-box-plannings mt-3">
                        <h2>Catring</h2>
                        <hr class="my-3" style="background-color:#3d0a0550; height: 4px;">
                        <div class="box-overflow" id="box-overflow">
                            <div class="box-check">
                                <P>INI ADALAH CHECK BOX SANGAT BAGUS</P>
                                <input type="checkbox" id="check1" name="check1">
                            </div>
                            <div class="box-check">
                                <P>INI ADALAH CHECK BOX SANGAT BAGUS</P>
                                <input type="checkbox" id="check1" name="check1">
                            </div>
                            <div class="box-check">
                                <P>INI ADALAH CHECK BOX SANGAT BAGUS</P>
                                <input type="checkbox" id="check1" name="check1">
                            </div>
                            <div class="box-check">
                                <P>INI ADALAH CHECK BOX SANGAT BAGUS</P>
                                <input type="checkbox" id="check1" name="check1">
                            </div>
                        </div>
                    </div>
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
