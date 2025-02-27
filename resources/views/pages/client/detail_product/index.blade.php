@extends('template.master')
@section('title', 'Detail Paket')
@section('content')
    @push('css')
        <link rel="stylesheet" href="{{ asset('css/detail-packet.css') }}">
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/master.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    @endpush
    @include('components.navbar')

    <div x-data="{ open: false }">
        <section class="hero-section relative">
            <div class="flex justify-center pt-72" style="height: 100vh">
                <div>
                    <h1 class="text-center text-white template-h1 font-semibold" data-aos="fade-up"
                        data-aos-duration="1000">
                        {{ $product->name }}</h1>
                    <h6 class="text-center text-white md:mt-6 text-2xl" data-aos="fade-up" data-aos-duration="1500">
                        {{ $product->description }}
                    </h6>
                    <div class="justify-center mt-7 flex space-x-6">
                        <button type="button" @click="open = true"
                            class="font-light text-white rounded-3xl px-7 py-3 login-btn" style="background-color: #3D0A05">
                            Book Now
                        </button>
                    </div>
                    <div class="justify-center hidden md:flex mt-20">
                        <div class="w-[2px] h-56 bg-white rounded-xl" data-aos="fade-up" data-aos-duration="2000"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-packet-section pt-20 pb-28">
            <div class="md:px-96 px-4">
                <div class="md:px-44">
                    <div>
                        <h5 class="text-redlue text-center text-xl font-semibold" data-aos="fade-up"
                            data-aos-duration="1000">
                            {{ $product->name }}</h5>
                    </div>
                    <div class="mt-7">
                        <h2 class="text-redlue text-4xl font-bold text-center" data-aos="fade-up" data-aos-duration="1000">
                            Unlock the Benefits: <br>Elevate Your Wedding Planning <br>{{ $product->name }}</h2>
                    </div>
                    <div class="mt-7">
                        <p class="text-redlue text-center text-xl" data-aos="fade-up" data-aos-duration="1000">
                            {{ $product->description }}</p>
                    </div>
                </div>
            </div>

            <div class="md:px-40 px-4 mt-14">
                <div class="md:grid grid-cols-3 gap-5 hidden">
                    <div>
                        <img src="{{ asset('asset/image/decoration_placeholder3.jpg') }}" alt="" class="md:h-[600px]"
                            style="object-fit: cover;" data-aos="fade-up" data-aos-duration="1000">
                    </div>
                    <div class="md:mt-12 mt-5">
                        <img src="{{ asset('asset/image/decoration_placeholder2.jpg') }}" alt="" class="md:h-[600px]"
                            style="object-fit: cover;" data-aos="fade-up" data-aos-duration="1000">
                    </div>
                    <div class="md:mt-0 mt-5">
                        <img src="{{ asset('asset/image/decoration_placeholder1.jpg') }}" alt="" class="md:h-[600px]"
                            style="object-fit: cover;" data-aos="fade-up" data-aos-duration="1000">
                    </div>
                </div>

                <div class="md:grid grid-cols-3 mt-36">
                    <div>
                        <div>
                            <img src="{{ asset('asset/image/decoration_placeholder3.jpg') }}" alt="" class="md:h-[600px]"
                                style="object-fit: cover;" data-aos="fade-up" data-aos-duration="1000">
                        </div>
                    </div>
                    <div class="col-span-2 md:pl-20 mt-5 md:mt-0">
                        <div>
                            <h5 class="text-redlue text-xl font-semibold" data-aos="fade-up" data-aos-duration="1000">Detail
                                {{ $product->name }}
                            </h5>
                        </div>
                        <div class="mt-7">
                            <h2 class="text-redlue text-4xl font-bold" data-aos="fade-up" data-aos-duration="1000">The
                                Product
                                is
                                <br>Equipped with
                            </h2>
                        </div>
                        <div class="max-w-4xl mt-8">
                            <div class="grid grid-cols-3 border-b border-rose-950 pb-2" data-aos="fade-up"
                                data-aos-duration="1000">
                            </div>
                            <div class="grid grid-cols-2 gap-6 mt-4" data-aos="fade-up" data-aos-duration="1000">
                                <ul class="list-disc list-inside space-y-2 marker:text-rose-950 text-redlue font-semibold">
                                    <h2 class="text-2xl">Rp.{{ $product->price }}</h2>
                                    <h2>{{ $product->name }}</h2>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-36">
                    <h2 class="text-redlue text-4xl font-bold text-center" data-aos="fade-up" data-aos-duration="1000">Our
                        Galleries</h2>
                    <div class="md:grid grid-cols-3 gap-5 mt-10">
                        <div>
                            <img src="{{ asset('asset/image/decoration_placeholder3.jpg') }}" alt="" class="md:h-[600px]"
                                style="object-fit: cover;" data-aos="fade-up" data-aos-duration="1000">
                        </div>
                        <div class="mt-5 md:mt-0">
                            <img src="{{ asset('asset/image/decoration_placeholder2.jpg') }}" alt="" class="md:h-[600px]"
                                style="object-fit: cover;" data-aos="fade-up" data-aos-duration="1000">
                        </div>
                        <div class="mt-5 md:mt-0">
                            <img src="{{ asset('asset/image/decoration_placeholder1.jpg') }}" alt="" class="md:h-[600px]"
                                style="object-fit: cover;" data-aos="fade-up" data-aos-duration="1000">
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="hero-bottom relative">
            <div class="flex justify-center items-center" style="height: 65vh">
                <div>
                    <h6 class="text-center text-white mt-6 text-2xl" data-aos="fade-up" data-aos-duration="1500">
                        Simplified The Preparation of Your Special Day
                    </h6>
                    <h1 class="text-center text-white template-h1 font-semibold" data-aos="fade-up"
                        data-aos-duration="1000">
                        Book {{ $product->name }}</h1>
                    <div class="flex justify-center mt-3">
                        <button type="button" @click="open = true" class="text-white rounded-3xl px-7 py-3 book-btn"
                            data-aos="fade-up" data-aos-duration="2000" style="background-color: #3D0A05">
                            Book Now!
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow-lg w-96 p-6">
                    <h2 class="text-md font-bold mb-4 text-rose-950">Mau dimasukan ke planning mana?</h2>
                    <form action="{{ route('client.store.planning') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_ids[]" value="{{ $product->id }}">
                        <div class="mb-4">
                            <select name="planning_id" id="planning_id" required
                                class="w-full px-4 py-2 border text-rose-950 rounded-lg focus:outline-none focus:ring-2 focus:ring-rose-950">
                                <option value="" disabled selected>Pilih planning</option>
                                @foreach ($planning as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('planning_id')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" @click="open = false"
                                class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-rose-950 text-white rounded-lg hover:bg-rose-950">
                                Book Now
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>


    @include('components.footer')
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endpush
