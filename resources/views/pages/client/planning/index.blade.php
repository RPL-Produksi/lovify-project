@extends('template.master')
@section('title', 'My Planning')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    @include('components.navbar_rose')


    <div class="planning-section px-40 py-32 min-h-screen" style="background-color: #f7f0f0">
        <div class="flex gap-3 mt-5">
            <a href="{{ route('planning.store') }}" class="bg-rose text-white py-2 px-4 text-lg rounded-lg"><i
                    class="fa-solid fa-plus"></i></a>
            <h2 class="text-redlue font-bold text-3xl">My Planning</h2>
        </div>
        @foreach ($planning as $item)
            <div class="card border-2 rounded-lg border-rose px-5 py-7 mt-4">
                <div class="grid grid-cols-3">
                    <div class="col-span-2">
                        <h4 class="text-rs text-2xl font-bold">{{ $item->title }}</h4>
                        <p class="mt-3 text-rs">{{ $item->description }}</p>
                    </div>
                    <div class="flex justify-end gap-2 items-center">
                        <a href="{{ route('planning.detail', $item->id) }}"
                            class="bg-rose text-white py-2 px-4 text-xl rounded-lg"><i class="fa-regular fa-eye"></i></a>
                        @if ($item->order)
                            <a href="{{ route('client.order.detail', $item->order->id) }}"
                                class="bg-rose text-white py-2 px-4 text-xl rounded-lg"><i class="fa-regular fa-cart-shopping"></i></a>
                        @endif
                        <form id="delete-avatar-form" action="{{ route('client.delete.planning', $item->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="bg-rose text-white py-2 px-4 text-xl rounded-lg"
                                onclick="confirmDelete()"><i class="fa-regular fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
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
