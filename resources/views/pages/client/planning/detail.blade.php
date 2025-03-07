@extends('template.master')
@section('title', 'Detail Planning')
@section('content')
    @push('css')
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/master.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    @endpush
    @include('components.navbar_rose')

    <div class="cart-section md:px-40 px-4 py-32">
        <div class="md:grid md:grid-cols-9 gap-5">
            <div class="col-span-5">
                <div>
                    @if ($planning->order)
                        <h2 class="text-redlue font-bold text-2xl">
                            Planning {{ $planning->title }}
                        </h2>
                    @else
                        <h2 class="text-redlue font-bold text-2xl">
                            <a href="{{ route('planning.category') }}"
                                class="bg-rose text-white py-1 px-3 mr-1 text-lg rounded-lg"><i
                                    class="fa-solid fa-plus"></i></a> Planning {{ $planning->title }}
                        </h2>
                    @endif
                    <div class="border-rose pt-8 pb-20 px-7 shadow-xl mt-3">
                        <div>
                            @if ($planning->products->isNotEmpty())
                                @foreach ($planning->products as $product)
                                    <div class="flex justify-between mt-6">
                                        <div>
                                            <h2 class="text-redlue font-bold text-2xl">{{ $product->name }}</h2>
                                            <h2 class="text-redlue font-medium">Category :
                                                {{ $product->vendor->category->name }}</h2>
                                        </div>
                                        <h2 class="text-redlue font-bold text-2xl">
                                            Rp{{ number_format($product->price, 0, ',', '.') }}
                                        </h2>

                                    </div>
                                    <hr class="border-rose-950 mt-7">
                                @endforeach
                            @else
                                <div class="flex justify-center">
                                    <h1 class="mt-9 text-rose-950">Belum ada produk, silahkan booking produk terlebih dahulu
                                    </h1>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-4 md:mt-0 mt-10">
                <h2 class="text-redlue font-bold text-2xl">Payment Summary</h2>
                <div class="border-rose w-100 pt-8 pb-20 px-7 shadow-xl mt-3">
                    <div>
                        <div class="flex justify-between">
                            <h2 class="font-medium text-xl" style="color: #917270">Planning</h2>
                            <h2 class="text-redlue font-bold text-2xl">Price</h2>
                        </div>
                        <hr class="border-rose-950 mt-7">
                    </div>
                    @foreach ($planning->products as $product)
                        <div class="mt-5">
                            <div class="flex justify-between">
                                <h2 class="font-medium text-xl" style="color: #917270">{{ $product->name }}</h2>
                                <h2 class="text-redlue font-bold text-2xl">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}</h2>
                            </div>
                        </div>
                    @endforeach
                    @if ($planning->products->isNotEmpty())
                        <hr class="border-rose-950 mt-7">
                    @endif
                    <div class="mt-5">
                        <div class="flex justify-between">
                            <h2 class="font-medium text-xl" style="color: #917270">Total Amount</h2>
                            <h2 class="text-redlue font-bold text-2xl">
                                Rp{{ number_format($planning->products->sum('price'), 0, ',', '.') }}
                            </h2>
                        </div>
                    </div>
                    @if ($planning->order)
                        <div class="mt-5">
                            <div class="mt-7">
                                <button
                                    class="bg-white rounded-lg text-center text-rose-950 border-2 border-rose-950 text-lg font-medium py-3 block w-full cursor-not-allowed"
                                    disabled>
                                    Sudah Dipesan
                                </button>
                            </div>
                        </div>
                    @else
                        <div x-data="{ open: false }">
                            <!-- Tombol Order Now -->
                            <div class="mt-5">
                                <div class="mt-7">
                                    <button @click="open = true"
                                        class="bg-rose rounded-lg text-center text-white text-lg font-medium py-3 block w-full">
                                        Order Now
                                    </button>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div x-show="open"
                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                <div class="bg-white rounded-lg shadow-lg w-96 p-6">
                                    <h2 class="text-md font-bold mb-4 text-rose-950">Enter your marry date</h2>
                                    <form action="{{ route('client.order.store', $planning->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="marry_date" class="text-rose-950">Marry Date</label>
                                            <input
                                                class="w-full px-4 py-2 border text-rose-950 rounded-lg focus:outline-none focus:ring-2 focus:ring-rose-950"
                                                type="date" name="marry_date" required>
                                        </div>
                                        <div class="flex justify-end space-x-2">
                                            <button type="button" @click="open = false"
                                                class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100">
                                                Cancel
                                            </button>
                                            <button type="submit"
                                                class="px-4 py-2 bg-rose-950 text-white rounded-lg hover:bg-rose-950">
                                                Book Now
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>

    @include('components.footer')
@endsection
@push('js')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
