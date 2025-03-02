<footer class="footer">
    <div class="py-16 xl:px-40 md:px-10">
        <div class="grid md:grid-cols-2 xl:grid-cols-4 px-4 md:px-0">
            <div class="py-7 px-6 rounded-2xl col-span-3 md:col-span-1 xl:col-span-1" style="background-color: #f7f0f0;" data-aos="fade-up" data-aos-duration="1000">
                <div class="pt-1">
                    <h6 class="text-redlue font-bold">FEEDBACK</h6>
                </div>
                <div class="mt-5">
                    <h3 class="text-redlue text-3xl">Seeking personalized support? Request a call from our team</h3>
                </div>
                <div class="mt-6">
                    <form action="">
                        @csrf
                        <div class="border border-rose-950 rounded-xl px-3 py-1">
                            <small style="color: #ab9391">YOUR NAME</small>
                            <input type="text"
                                class="bg-transparent w-full placeholder-rose-950 text-lg text-redlue focus:outline-none"
                                placeholder="Enter your name">
                        </div>
                        <div class="border border-rose-950 rounded-xl px-3 py-1 mt-4">
                            <small style="color: #ab9391">PHONE NUMBER</small>
                            <input type="text"
                                class="bg-transparent w-full placeholder-rose-950 text-lg text-redlue focus:outline-none"
                                placeholder="Enter your phone number">
                        </div>
                        <div class="mt-9">
                            <a href=""
                                class="py-3 px-9 block md:inline-block text-sm text-white rounded-full shadow-lg bg-rose hover:bg-white hover:text-black transition-all duration-100">Send
                                a request</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="xl:col-span-3 md:col-span-1 col-span-3 py-10">
                <div class="grid grid-cols-2 xl:grid-cols-3">
                    <div class="flex md:justify-center md:ml-2 mt-20 md:mt-0" data-aos="fade-up" data-aos-duration="1000">
                        <div>
                            <h6 class="text-white font-bold">NAVIGATIONS</h6>
                            <ul class="mt-5">
                                <li><a href="{{ route('client.home') }}" class="text-white font-thin">Home</a></li>
                                <li class="mt-1"><a href="{{ route('article') }}" class="text-white font-thin">Article</a></li>
                                <li class="mt-1"><a href="{{ route('aboutUs') }}" class="text-white font-thin">About Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex md:justify-center md:pl-6 mt-20 md:mt-0" data-aos="fade-up" data-aos-duration="1000">
                        <div>
                            <h6 class="text-white font-bold">ABOUT US</h6>
                            <ul class="mt-5">
                                <li><a href="{{ route('aboutUs') }}" class="text-white font-thin">Gallery</a></li>
                                <li class="mt-1"><a href="{{ route('aboutUs') }}" class="text-white font-thin">Contacts</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="xl:flex md:justify-end hidden" data-aos="fade-up" data-aos-duration="1000">
                        <div class="xl:pl-6 md:pl-16 xl:mt-0 md:mt-10">
                            <a href="{{ route('client.home') }}">
                                <img src="{{ asset('asset/image/name_icon1.png') }}" alt="" style="width: 250px">
                            </a>
                        </div>
                    </div>
                    <div class="mt-20 xl:mt-20 md:mt-10 md:pl-16 2xl:pl-36 flex md:hidden xl:flex" data-aos="fade-up" data-aos-duration="1000">
                        <div>
                            <h6 class="text-white font-bold">CONTACT US</h6>
                            <ul class="mt-5">
                                <li><a href="" class="text-white font-thin">0832-2311-2312</a></li>
                                <li class="mt-1"><a href="" class="text-white font-thin">lovifysupport@gmail.com</a></li>
                                <li class="mt-1"><a href="" class="text-white font-thin">Sukabumi</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-20 xl:mt-20 md:mt-10 2xl:pl-36 lg:pl-16 md:pl-9 hidden md:flex xl:hidden" data-aos="fade-up" data-aos-duration="1000">
                        <div>
                            <h6 class="text-white font-bold">CONTACT US</h6>
                            <ul class="mt-5">
                                <li><a href="" class="text-white font-thin">0832-2311-2312</a></li>
                                <li class="mt-1"><a href="" class="text-white font-thin">lovifysupport@gmail.com</a></li>
                                <li class="mt-1"><a href="" class="text-white font-thin">Sukabumi</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:flex md:justify-end hidden xl:hidden" data-aos="fade-up" data-aos-duration="1000">
                        <div class="xl:pl-6 md:pl-16 xl:mt-0 md:mt-10">
                            <img src="{{ asset('asset/image/name_icon1.png') }}" alt="" style="width: 250px">
                        </div>
                    </div>
                </div>
                <div class="2xl:pl-36 md:pl-9 lg:pl-16 xl:pl-16 xl:pr-2 mt-20" data-aos="fade-up" data-aos-duration="1000">
                    <h6 class="text-white font-bold">SUBSCRIPTION</h6>
                    <form action="">
                        @csrf
                        <div class="w-full mt-5">
                            <input type="text" class="w-full border border-white bg-transparent py-4 px-5 rounded-2xl placeholder-white" readonly placeholder="Coming Soon">
                        </div>
                    </form>
                </div>
                <div class="xl:mt-32 mt-10 2xl:pl-36 xl:pl-16 lg:pl-16 md:pl-9 xl:flex justify-between" data-aos="fade-up" data-aos-duration="1000">
                    <div class="flex xl:justify-end justify-center">
                        <a href="" class="text-white border border-white rounded-full p-4 text-2xl w-16 h-16 flex items-center justify-center">
                            <i class="fa-brands fa-square-facebook"></i>
                          </a>
                        <a href="" class="text-white border border-white ml-4 rounded-full p-4 text-2xl w-16 h-16 flex items-center justify-center">
                            <i class="fa-brands fa-instagram"></i>
                          </a>
                        <a href="" class="text-white border border-white ml-4 rounded-full p-4 text-2xl w-16 h-16 flex items-center justify-center">
                            <i class="fa-brands fa-youtube"></i>
                          </a>
                        <a href="" class="text-white border border-white ml-4 rounded-full p-4 text-2xl w-16 h-16 flex items-center justify-center">
                            <i class="fa-brands fa-twitter"></i>
                          </a>
                    </div>
                    <div class="flex items-center xl:mt-0 mt-10 justify-center xl:justify-end">
                        <small class="text-gray-400">@ {{ now()->year }} - Copyright</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
