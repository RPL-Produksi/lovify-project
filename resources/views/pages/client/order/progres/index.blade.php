@extends('template.master')
@section('title', 'Progres Order')
@section('content')
    @push('css')
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/master.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    @endpush
    @include('components.navbar_rose')

    <div class="cart-section md:px-40 py-32 px-4">
        <div>
            <h2 class="text-redlue font-bold text-2xl">Order Progress</h2>
            <div class="border-rose pt-8 pb-20 px-7 shadow-2xl mt-3">
                @foreach ($progres->groupBy('product_id') as $productId => $items)
                    @php
                        $firstItem = $items->first();
                        $product = $firstItem->product;
                    @endphp
                    <div class="flex justify-between mt-6 bg-white border-rose p-5 rounded-lg">
                        <div>
                            <h2 class="text-redlue font-bold text-2xl">
                                {{ $product->name }}
                            </h2>
                            <h2 class="text-redlue font-medium">
                                {{ optional($product->vendor?->category)->name ?? 'Kategori tidak ditemukan' }}
                            </h2>
                        </div>
                        <h2 class="text-redlue font-bold text-2xl">
                            {{ $firstItem->status }}
                        </h2>
                    </div>
                    <hr class="border-rose-950 mt-7">
                @endforeach
            </div>
        </div>
    </div>

    @include('components.footer')
@endsection

@push('js')
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
