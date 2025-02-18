@extends('template.master')
@section('title', 'Detail Paket')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/detail-packet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    @include('components.navbar')

    <section class="hero-section relative">
        <div class="flex justify-center pt-72" style="height: 100vh">
            <div>
                <h1 class="text-center text-white template-h1 font-semibold" data-aos="fade-up" data-aos-duration="1000">
                    Silver Packet</h1>
                <h6 class="text-center text-white mt-6 text-2xl" data-aos="fade-up" data-aos-duration="1500">Lorem ipsum
                    dolor sit amet, consectetur adipisicing elit. Cupiditate, ab cum.
                </h6>
                <div class="flex justify-center mt-20">
                    <div class="w-[2px] h-56 bg-white rounded-xl" data-aos="fade-up" data-aos-duration="2000"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="detail-packet-section pt-20 pb-28">
        <div class="px-96">
            <div class="px-44">
                <div>
                    <h5 class="text-redlue text-center text-xl font-semibold" data-aos="fade-up" data-aos-duration="1000">
                        Silver Packet</h5>
                </div>
                <div class="mt-7">
                    <h2 class="text-redlue text-4xl font-bold text-center" data-aos="fade-up" data-aos-duration="1000">
                        Unlock the Benefits: <br>Elevate Your Wedding Planning <br>with Our Silver Packet!</h2>
                </div>
                <div class="mt-7">
                    <p class="text-redlue text-center text-xl" data-aos="fade-up" data-aos-duration="1000">Experience an
                        unforgettable wedding day with our exclusive package, featuring an attentive crew of 8 dedicated
                        professionals. Enjoy priority planning services starting 12 months in advance, ensuring every detail
                        is tailored to your vision with the guidance of a Professional Wedding Assistant.</p>
                </div>
            </div>
        </div>

        <div class="px-40 mt-14">
            <div class="grid grid-cols-3 gap-5">
                <div>
                    <img src="{{ asset('asset/image/decoration_placeholder3.jpg') }}" alt=""
                        style="height: 600px; object-fit: cover;" data-aos="fade-up" data-aos-duration="1000">
                </div>
                <div class="mt-12">
                    <img src="{{ asset('asset/image/decoration_placeholder2.jpg') }}" alt=""
                        style="height: 600px; object-fit: cover;" data-aos="fade-up" data-aos-duration="1000">
                </div>
                <div>
                    <img src="{{ asset('asset/image/decoration_placeholder1.jpg') }}" alt=""
                        style="height: 600px; object-fit: cover;" data-aos="fade-up" data-aos-duration="1000">
                </div>
            </div>

            <div class="grid grid-cols-3 mt-36">
                <div>
                    <div>
                        <img src="{{ asset('asset/image/decoration_placeholder3.jpg') }}" alt=""
                            style="height: 600px; object-fit: cover;" data-aos="fade-up" data-aos-duration="1000">
                    </div>
                </div>
                <div class="col-span-2 pl-20">
                    <div>
                        <h5 class="text-redlue text-xl font-semibold" data-aos="fade-up" data-aos-duration="1000">Benefits
                        </h5>
                    </div>
                    <div class="mt-7">
                        <h2 class="text-redlue text-4xl font-bold" data-aos="fade-up" data-aos-duration="1000">The Packet is
                            <br>Equipped with
                        </h2>
                    </div>
                    <div class="max-w-4xl mt-8">
                        <div class="grid grid-cols-3 border-b border-rose-950 pb-2" data-aos="fade-up"
                            data-aos-duration="1000">
                            <h3 class="font-semibold text-xl text-redlue">Bonus</h3>
                            <h3 class="font-semibold text-xl text-redlue">Decorations</h3>
                            <h3 class="font-semibold text-xl text-redlue">Photos & Videos</h3>
                        </div>
                        <div class="grid grid-cols-2 gap-6 mt-4" data-aos="fade-up" data-aos-duration="1000">
                            <!-- Bonus -->
                            <ul class="list-disc list-inside space-y-2 marker:text-rose-950 text-redlue font-semibold">
                                <li>8 Exclusive Crew</li>
                                <li>12 Months Priority Planning</li>
                                <li>50 pcs Helium Balloons</li>
                                <li>Confetti</li>
                                <li>Speakers</li>
                                <li>Stationaries (Ballpoint, Guest Book, etc)</li>
                                <li>Tea Ceremony Set</li>
                                <li>Money Boxes for Akad</li>
                                <li>Stationaries (Ballpoint, Guest Book, etc)</li>
                                <li>Signage “Here Comes The Bride and The Groom”</li>
                                <li>Double Happiness Signboard</li>
                                <li>50 pcs Helium Balloons</li>
                            </ul>
                            <!-- Decorations -->
                            <ul class="list-disc list-inside space-y-2 marker:text-rose-950 text-redlue font-semibold">
                                <li>VIP Tables Signage</li>
                                <li>2 pcs Teddy Bear</li>
                                <li>Mingle Tray</li>
                                <li>Smoke Machine</li>
                                <li>6 pcs White Frame 4R for photo gallery</li>
                                <li>Bridal room decoration with teddy bear</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-36">
                <h2 class="text-redlue text-4xl font-bold text-center" data-aos="fade-up" data-aos-duration="1000">Our
                    Galleries</h2>
                <div class="grid grid-cols-3 gap-5 mt-10">
                    <div>
                        <img src="{{ asset('asset/image/decoration_placeholder3.jpg') }}" alt=""
                            style="height: 600px; object-fit: cover;" data-aos="fade-up" data-aos-duration="1000">
                    </div>
                    <div>
                        <img src="{{ asset('asset/image/decoration_placeholder2.jpg') }}" alt=""
                            style="height: 600px; object-fit: cover;" data-aos="fade-up" data-aos-duration="1000">
                    </div>
                    <div>
                        <img src="{{ asset('asset/image/decoration_placeholder1.jpg') }}" alt=""
                            style="height: 600px; object-fit: cover;" data-aos="fade-up" data-aos-duration="1000">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="hero-bottom relative">
        <div class="flex justify-center items-center" style="height: 65vh">
            <div>
                <h6 class="text-center text-white mt-6 text-2xl" data-aos="fade-up" data-aos-duration="1500">Simplified
                    The Preparation of Your Special Day
                </h6>
                <h1 class="text-center text-white template-h1 font-semibold" data-aos="fade-up" data-aos-duration="1000">
                    Book Silver Packet</h1>
                <div class="flex justify-center mt-3">
                    <a href="" class="text-white rounded-3xl px-7 py-3 book-btn" data-aos="fade-up"
                        data-aos-duration="2000" style="background-color: #3D0A05">Book Now!</a>
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
