@extends('template.master')
@section('title', 'Article')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/about-us.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail-packet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    @include('components.navbar_rose')

    <section class="about-us-section relative" style="background-color: #f7f0f0">
        <div class="px-40 pt-24 pb-40">
            <div>
                <img src="{{ asset('asset/image/decoration_placeholder4.jpg') }}" data-aos="fade-up"
                    data-aos-duration="1500" class="w-full object-cover" style="height: 630px" alt="">
            </div>
            <div class="mt-7">
                <h1 class="text-redlue font-bold text-5xl" data-aos="fade-up"
                data-aos-duration="1500">New Wedding Trend : Intimate Outdoor Wedding <br>Theme</h1>
            </div>

            <div class="flex gap-36 mt-8">
                <div>
                    <h6 class="text-redlue font-semibold text-xl" data-aos="fade-up"
                    data-aos-duration="1500"><i class="fa-solid fa-user"></i> Admin</h6>
                </div>
                <div>
                    <h6 class="text-redlue font-semibold text-xl" data-aos="fade-up"
                    data-aos-duration="1500"><i class="fa-solid fa-calendar-days"></i> Mon, January 20,
                        2025</h6>
                </div>
            </div>

            <div class="grid grid-cols-3 mt-10 gap-16">
                <div class="col-span-2" data-aos="fade-up"
                data-aos-duration="1500">
                    <p class="text-redlue font-normal text-xl text-justify">Lorem ipsum dolor, sit amet consectetur
                        adipisicing elit. Eaque ex iusto optio quis, eligendi accusantium voluptas, iure sint consequatur
                        nihil harum sed nobis? Nam dolorum hic eum blanditiis minus, a asperiores, numquam deserunt
                        veritatis ea eligendi!</p>
                    <p class="text-redlue font-normal text-xl text-justify mt-3">Lorem ipsum dolor sit amet consectetur
                        adipisicing elit. Aspernatur nemo corporis hic ullam consequatur optio ad eaque officiis porro totam
                        aperiam dolorum libero laudantium perferendis quaerat, accusantium soluta maiores minima molestias
                        aliquid enim explicabo impedit aliquam. Dignissimos provident voluptatibus inventore recusandae,
                        repellendus asperiores iste aspernatur non voluptate quae fugiat, vel tempore itaque porro fugit
                        quas vero sunt fuga beatae odit.</p>
                    <div class="border-l-4 border-rose-950 pl-4 text-redlue text-xl font-semibold italic mt-5">
                        <p>
                            "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente optio quae praesentium
                            commodi cupiditate tempore aut, neque voluptatum, harum omnis, itaque unde sequi nulla culpa.
                            Illum suscipit repellendus in quaerat!"
                        </p>
                    </div>
                    <p class="text-redlue font-normal text-xl text-justify mt-5">Lorem ipsum dolor sit amet consectetur
                        adipisicing elit. Quam sed suscipit sint amet. Distinctio ullam voluptate provident culpa
                        consequuntur commodi quod molestias! Consectetur nulla culpa incidunt molestiae quas rem quia ipsum
                        doloremque amet cupiditate dolorem ratione exercitationem architecto debitis odio odit, ducimus
                        voluptates laboriosam? Officia.</p>
                    <p class="text-redlue font-normal text-xl text-justify mt-3">Lorem ipsum dolor sit, amet consectetur
                        adipisicing elit. Ut neque architecto voluptates mollitia? Quam animi temporibus repellat cupiditate
                        dicta reiciendis, eum error sapiente, a eos quos soluta, qui neque fugit pariatur illum iusto veniam
                        voluptatum unde? Unde aperiam amet reiciendis incidunt sit, officia ipsam est atque! Dignissimos
                        nostrum est illum ducimus accusantium, reprehenderit, quo culpa architecto, officiis quos hic.
                        Perferendis alias optio enim debitis vel esse temporibus voluptatibus. Quidem excepturi assumenda
                        aliquid tempore debitis recusandae nulla magnam odio dolore iusto perspiciatis velit in, accusantium
                        ipsum iure nemo adipisci maiores esse eaque, beatae harum! Debitis id facere illo modi accusamus
                        minima deserunt? Quae odio quam magnam exercitationem est ipsa pariatur assumenda? Amet nobis iure
                        in distinctio? Et, ratione esse quis nulla sit tempore veniam magnam accusamus ex a eveniet
                        molestiae reiciendis recusandae quisquam dicta quia culpa numquam, porro cupiditate beatae rerum
                        dignissimos voluptates mollitia. Excepturi alias consequuntur adipisci est cumque ullam temporibus
                        corrupti quam accusamus aut consectetur suscipit quisquam, fugit voluptate doloremque ipsam qui
                        asperiores beatae deserunt consequatur molestiae aspernatur at quod blanditiis! Consectetur id
                        laudantium nulla voluptates nesciunt quo aliquid? Labore, tenetur nulla eligendi inventore eveniet
                        eos eum, ullam hic vitae temporibus voluptates ut? Delectus commodi recusandae velit sint? Illo?</p>
                    <p class="text-redlue font-normal text-xl text-justify mt-3">Lorem ipsum dolor sit, amet consectetur
                        adipisicing elit. Ut neque architecto voluptates mollitia? Quam animi temporibus repellat cupiditate
                        dicta reiciendis, eum error sapiente, a eos quos soluta, qui neque fugit pariatur illum iusto veniam
                        voluptatum unde? Unde aperiam amet reiciendis incidunt sit, officia ipsam est atque! Dignissimos
                        nostrum est illum ducimus accusantium, reprehenderit, quo culpa architecto, officiis quos hic.
                        Perferendis alias optio enim debitis vel esse temporibus voluptatibus. Quidem excepturi assumenda
                        aliquid tempore debitis recusandae nulla magnam odio dolore iusto perspiciatis velit in, accusantium
                        ipsum iure nemo adipisci maiores esse eaque, beatae harum! Debitis id facere illo modi accusamus
                        minima deserunt? Quae odio quam magnam exercitationem est ipsa pariatur assumenda? Amet nobis iure
                        in distinctio? Et, ratione esse quis nulla sit tempore veniam magnam accusamus ex a eveniet
                        molestiae reiciendis recusandae quisquam dicta quia culpa numquam, porro cupiditate beatae rerum
                        dignissimos voluptates mollitia. Excepturi alias consequuntur adipisci est cumque ullam temporibus
                        corrupti quam accusamus aut consectetur suscipit quisquam, fugit voluptate doloremque ipsam qui
                        asperiores beatae deserunt consequatur molestiae aspernatur at quod blanditiis! Consectetur id
                        laudantium nulla voluptates nesciunt quo aliquid? Labore, tenetur nulla eligendi inventore eveniet
                        eos eum, ullam hic vitae temporibus voluptates ut? Delectus commodi recusandae velit sint? Illo?</p>
                </div>
                <div>
                    <div>
                        <h2 class="text-redlue text-4xl font-bold" data-aos="fade-up"
                        data-aos-duration="1500">Top Articles</h2>
                    </div>

                    <div class="mt-4">
                        <div class="shadow-xl px-2 py-3 border-redlue bg-transparent" data-aos="fade-up"
                        data-aos-duration="1500">
                            <div>
                                <img src="{{ asset('asset/image/decoration_placeholder2.jpg') }}" alt="">
                            </div>
                            <div class="mt-2">
                                <h3 class="text-3xl text-redlue font-semibold">New : Blue by Yung Kai Being The Trend of
                                    Wedding Music</h3>
                            </div>
                            <div class="mt-3 flex justify-between">
                                <div>
                                    <h6 class="text-redlue font-semibold"><i class="fa-solid fa-user"></i> Admin</h6>
                                </div>
                                <div>
                                    <h6 class="text-redlue font-semibold"><i class="fa-solid fa-calendar-days"></i> Mon,
                                        January 20, 2025</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="shadow-xl px-2 py-3 border-redlue bg-transparent" data-aos="fade-up"
                        data-aos-duration="1500">
                            <div>
                                <img src="{{ asset('asset/image/decoration_placeholder5.jpg') }}" alt="">
                            </div>
                            <div class="mt-2">
                                <h3 class="text-3xl text-redlue font-semibold">New : Blue by Yung Kai Being The Trend of
                                    Wedding Music</h3>
                            </div>
                            <div class="mt-3 flex justify-between">
                                <div>
                                    <h6 class="text-redlue font-semibold"><i class="fa-solid fa-user"></i> Admin</h6>
                                </div>
                                <div>
                                    <h6 class="text-redlue font-semibold"><i class="fa-solid fa-calendar-days"></i> Mon,
                                        January 20, 2025</h6>
                                </div>
                            </div>
                        </div>
                    </div>

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
