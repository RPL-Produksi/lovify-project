<footer class="footer">
    <div class="py-16 px-40">
        <div class="grid grid-cols-4">
            <div class="py-7 px-6 rounded-2xl" style="background-color: #f7f0f0;" data-aos="fade-up" data-aos-duration="1000">
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
                                class="py-3 px-9 text-sm text-white rounded-full shadow-lg bg-rose hover:bg-white hover:text-black transition-all duration-100">Send
                                a request</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-span-3 py-10">
                <div class="grid grid-cols-3">
                    <div class="flex justify-center ml-2" data-aos="fade-up" data-aos-duration="1000">
                        <div>
                            <h6 class="text-white font-bold">NAVIGATIONS</h6>
                            <ul class="mt-5">
                                <li><a href="" class="text-white font-thin">Home</a></li>
                                <li class="mt-1"><a href="" class="text-white font-thin">Packets</a></li>
                                <li class="mt-1"><a href="" class="text-white font-thin">Vendors</a></li>
                                <li class="mt-1"><a href="" class="text-white font-thin">About Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex justify-center pl-6" data-aos="fade-up" data-aos-duration="1000">
                        <div>
                            <h6 class="text-white font-bold">ABOUT US</h6>
                            <ul class="mt-5">
                                <li><a href="" class="text-white font-thin">Gallery</a></li>
                                <li class="mt-1"><a href="" class="text-white font-thin">Contacts</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex justify-center" data-aos="fade-up" data-aos-duration="1000">
                        <div class="pl-6">
                            <h1 class="text-white text-2xl">Logo</h1>
                        </div>
                    </div>
                    <div class="mt-20 pl-36" data-aos="fade-up" data-aos-duration="1000">
                        <div>
                            <h6 class="text-white font-bold">CONTACT US</h6>
                            <ul class="mt-5">
                                <li><a href="" class="text-white font-thin">0832-2311-2312</a></li>
                                <li class="mt-1"><a href="" class="text-white font-thin">lovifysupport@gmail.com</a></li>
                                <li class="mt-1"><a href="" class="text-white font-thin">Sukabumi</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="pl-36 pr-40 mt-20" data-aos="fade-up" data-aos-duration="1000">
                    <h6 class="text-white font-bold">SUBSCRIPTION</h6>
                    <form action="">
                        @csrf
                        <div class="w-full mt-5">
                            <input type="text" class="w-full border border-white bg-transparent py-4 px-5 rounded-2xl placeholder-white" placeholder="E-mail">
                        </div>
                    </form>
                </div>
                <div class="mt-32 pl-36 pr-40 flex justify-between" data-aos="fade-up" data-aos-duration="1000">
                    <div class="flex">
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
                    <div class="flex items-center">
                        <small class="text-gray-400">@2024 - Copyright</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
