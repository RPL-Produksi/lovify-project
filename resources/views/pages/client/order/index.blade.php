@extends('template.master')
@section('title', 'My Order')
@section('content')
    @push('css')
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/master.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    @endpush
    @include('components.navbar_rose')


    <div class="planning-section md:px-40 px-4 py-32 min-h-screen" style="background-color: #f7f0f0">
        @if ($order->isNotEmpty())
            @foreach ($order as $item)
                <div class="card border-2 rounded-lg border-rose shadow-2xl px-5 py-7 mt-4">
                    <div class="grid grid-cols-3">
                        <div class="col-span-2">
                            <h4 class="text-rs text-2xl font-bold">{{ $item->planning->title }}</h4>
                            <p class="mt-3 text-rs">{{ $item->marry_date }}</p>
                        </div>
                        <div class="flex justify-end gap-2 items-center">
                            <a href="{{ route('client.order.detail', $item->id) }}"
                                class="bg-rose text-white py-2 px-4 text-xl rounded-lg">Detail Order</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-span-4 text-center mt-80">
                <p class="text-redlue">Belum ada order.</p>
            </div>
        @endif
    </div>

    @include('components.footer')
@endsection
@push('js')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        function confirmDelete() {
            Swal.fire({
                title: "Are you sure?",
                text: "Your avatar will be permanently deleted!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3D0A05",
                cancelButtonColor: "#3D0A05",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel",
                customClass: {
                    popup: "rounded-lg shadow-lg",
                    title: "text-lg text-rose-950 font-bold",
                    confirmButton: "bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700",
                    cancelButton: "bg-gray-300 text-white px-4 py-2 rounded-md hover:bg-gray-400",
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("delete-avatar-form").submit();
                }
            });
        }
    </script>
@endpush
