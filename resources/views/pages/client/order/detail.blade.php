@extends('template.master')
@section('title', 'Detail Order')
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
                    <h2 class="text-redlue font-bold text-2xl">Order {{ $order->planning->title }}</h2>
                    <div class="border-rose pt-8 pb-20 px-7 shadow-2xl mt-3">
                        @foreach ($order->planning->products as $product)
                            <div class="flex justify-between mt-6">
                                <div>
                                    <h2 class="text-redlue font-bold text-2xl">{{ $product->name }}</h2>
                                    <h2 class="text-redlue font-medium">Category : {{ $product->vendor->category->name }}
                                    </h2>
                                </div>
                                <h2 class="text-redlue font-bold text-2xl">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                </h2>
                            </div>
                            <hr class="border-rose-950 mt-7">
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-span-4">
                <h2 class="text-redlue font-bold text-2xl">Payment Summary</h2>
                <div class="border-rose w-100 pt-8 pb-20 px-7 shadow-2xl mt-3">
                    <div class="mt-5">
                        <div class="flex justify-between">
                            <h2 class="font-medium text-xl text-gray-700">Down Payment</h2>
                            <h2 class="text-redlue font-bold text-2xl">
                                Rp{{ number_format($order->down_payment, 0, ',', '.') }}
                            </h2>
                        </div>
                    </div>
                    <div class="mt-5">
                        <div class="flex justify-between">
                            <h2 class="font-medium text-xl text-gray-700">Full Payment</h2>
                            <h2 class="text-redlue font-bold text-2xl">
                                Rp{{ number_format($order->total_price, 0, ',', '.') }}
                            </h2>
                        </div>
                    </div>

                    @if ($isPaid)
    <div class="mt-5">
        <div class="mt-7">
            <button
                class="bg-white rounded-lg text-center text-rose-950 border-2 border-rose-950 text-lg font-medium py-3 block w-full cursor-not-allowed"
                disabled>
                Payment Completed
            </button>
        </div>
    </div>
@else
    <div x-data="{ open: false }">
        <div class="mt-5">
            <div class="mt-7">
                <button @click="open = true"
                    class="bg-rose rounded-lg text-center text-white text-lg font-medium py-3 block w-full">
                    Pay Now
                </button>
            </div>
        </div>

        <!-- Modal -->
        <div x-show="open"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-96 p-6">
                <h2 class="text-md font-bold mb-4 text-rose-950">Enter your marry date</h2>
                <form id="payment-form">
                    @csrf
                    <input type="hidden" id="order-id" value="{{ $order->id }}">
                    <div class="mb-4">
                        <label for="payment_type" class="text-rose-950">Payment Type</label>
                        <select id="payment_type"
                            class="w-full px-4 py-2 border text-rose-950 rounded-lg focus:outline-none focus:ring-2 focus:ring-rose-950"
                            required>
                            <option value="down_payment">Down Payment</option>
                            <option value="remaining_payment">Remaining Payment</option>
                            <option value="full_payment">Full Payment</option>
                        </select>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="open = false"
                            class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-rose-950 text-white rounded-lg hover:bg-rose-950">
                            Pay Now
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
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('payment-form').addEventListener('submit', function(e) {
            e.preventDefault();

            let orderId = document.getElementById('order-id').value;
            let paymentType = document.getElementById('payment_type').value;

            fetch(`http://127.0.0.1:8000/transactions/${orderId}/pay`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    payment_type: paymentType,
                    _token: '{{ csrf_token() }}'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    window.snap.pay(data.data.snap_token, {
                        onSuccess: function(result) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Pembayaran Berhasil!',
                                text: 'Terima kasih telah melakukan pembayaran.',
                                confirmButtonColor: '#3D0A05',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        onPending: function(result) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Menunggu Pembayaran',
                                text: 'Silakan selesaikan pembayaran Anda.',
                                confirmButtonColor: '#3D0A05',
                                confirmButtonText: 'OK'
                            });
                        },
                        onError: function(result) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Pembayaran Gagal!',
                                text: 'Terjadi kesalahan saat melakukan pembayaran.',
                                confirmButtonColor: '#3D0A05',
                                confirmButtonText: 'Coba Lagi'
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message,
                        confirmButtonColor: '#3D0A05',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                    text: 'Gagal memproses permintaan. Coba lagi nanti.',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            });
        });
    </script>
@endpush

