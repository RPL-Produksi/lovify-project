@extends('template.master')
@section('title', 'Cart')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    @include('components.navbar_rose')

    <div class="cart-section px-40 py-32">
        <div class="grid grid-cols-9 gap-5">
            <div class="col-span-5">
                <div>
                    <h2 class="text-redlue font-bold text-2xl">Order</h2>
                    <div class="border-rose pt-8 pb-20 px-7 shadow-2xl mt-3">
                        <div>
                            <div class="flex justify-between">
                                <h2 class="text-redlue font-bold text-2xl">Bro's Make Up</h2>
                                <h2 class="text-redlue font-bold text-2xl">Rp3.900.000</h2>
                            </div>
                            <hr class="border-rose-950 mt-7">
                        </div>
                        <div class="mt-5">
                            <div class="flex justify-between">
                                <h2 class="text-redlue font-bold text-2xl">Bro's Make Up</h2>
                                <h2 class="text-redlue font-bold text-2xl">Rp3.900.000</h2>
                            </div>
                            <hr class="border-rose-950 mt-7">
                        </div>
                        <div class="mt-5">
                            <div class="flex justify-between">
                                <h2 class="text-redlue font-bold text-2xl">Bro's Make Up</h2>
                                <h2 class="text-redlue font-bold text-2xl">Rp3.900.000</h2>
                            </div>
                            <hr class="border-rose-950 mt-7">
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <h2 class="text-redlue font-bold text-2xl">Payment</h2>
                    <div class="border-rose pt-4 pb-20 px-4 shadow-2xl mt-3">
                        <div>
                            <h2 class="font-medium text-xl" style="color: #917270">Personal Informations</h2>
                            <div class="mt-5">
                                <form action="">
                                    <div class="grid grid-cols-2 gap-5">
                                        <div>
                                            <input type="text" class="border-2 rounded-lg text-xl border-rose-950 bg-transparent p-2 w-full" placeholder="Name">
                                        </div>
                                        <div>
                                            <input type="text" class="border-2 rounded-lg text-xl border-rose-950 bg-transparent p-2 w-full" placeholder="Phone Number">
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <input type="text" class="border-2 rounded-lg text-xl border-rose-950 bg-transparent p-2 w-full" placeholder="Address">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-4">
                <h2 class="text-redlue font-bold text-2xl">Payment Summary</h2>
                <div class="border-rose w-100 pt-8 pb-20 px-7 shadow-2xl mt-3">
                    <div>
                        <div class="flex justify-between">
                            <h2 class="font-medium text-xl" style="color: #917270">Transaction Code</h2>
                            <h2 class="text-redlue font-bold text-2xl">LV0198273</h2>
                        </div>
                        <hr class="border-rose-950 mt-7">
                    </div>
                    <div class="mt-5">
                        <div class="flex justify-between">
                            <h2 class="font-medium text-xl" style="color: #917270">Order Summary</h2>
                            <h2 class="text-redlue font-bold text-2xl">Rp30.000.000</h2>
                        </div>
                    </div>
                    <div class="mt-5">
                        <div class="flex justify-between">
                            <h2 class="font-medium text-xl" style="color: #917270">Additional Service</h2>
                            <h2 class="text-redlue font-bold text-2xl">Rp20.000</h2>
                        </div>
                    </div>
                    <div class="mt-5">
                        <div class="flex justify-between">
                            <h2 class="font-medium text-xl" style="color: #917270">Total Amount</h2>
                            <h2 class="text-redlue font-bold text-2xl">Rp30.020.000</h2>
                        </div>
                    </div>
                    <div class="mt-5">
                        <form action="">
                            @csrf
                            <div>
                                <select name="" id="" style="color: #917270"
                                    class="font-medium w-full text-xl p-2 border-2 rounded-lg border-rose-950 bg-transparent">
                                    <option value="" disabled selected>Payment Method</option>
                                    <option value="">Bank Mandiri</option>
                                    <option value="">Bank BCA</option>
                                    <option value="">Bank Syriah</option>
                                </select>
                            </div>
                            <div class="mt-7">
                                <a href=""
                                    class="bg-rose rounded-lg text-center text-white text-lg font-medium py-3 block">Book
                                    Now</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')
@endsection
@push('js')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
@endpush
