@extends('template.master')
@section('title', 'My Planning')
@section('content')
    @push('css')
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/master.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    @endpush
    @include('components.navbar_rose')


    <div class="planning-section md:px-40 px-4 py-32 min-h-screen" style="background-color: #f7f0f0">
        @if ($planning->isNotEmpty())
            <div class="md:flex justify-between items-center mt-5" data-aos="fade-up" data-aos-duration="1000">
                <div class="flex gap-3">
                    <a href="{{ route('planning.store') }}" class="bg-rose text-white py-2 px-4 text-lg rounded-lg">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                    <h2 class="text-redlue font-bold text-3xl">My Planning</h2>
                </div>
            
                @if ($planning->contains(fn ($item) => $item->order))
                <div class="md:flex gap-2">
                    <a href="{{ route('planning', ['filter' => 'all']) }}"
                        class="py-2 px-4 text-md block rounded-lg mt-3 md:mt-0 {{ request('filter') == 'all' || !request('filter') ? 'bg-rose text-white' : 'bg-gray-200 text-gray-800' }}">
                        Semua Planning
                    </a>
                    <a href="{{ route('planning', ['filter' => 'ordered']) }}"
                        class="py-2 px-4 text-md rounded-lg block mt-3 md:mt-0 {{ request('filter') == 'ordered' ? 'bg-rose text-white' : 'bg-gray-200 text-gray-800' }}">
                        Planning dengan Order
                    </a>
                </div>
            @endif
            
            </div>
            
            
            @foreach ($planning as $item)
                <div class="card border-2 rounded-lg border-rose px-5 py-7 mt-4" data-aos="fade-up"
                    data-aos-duration="1500">
                    <div class="md:grid grid-cols-3">
                        <div class="col-span-2">
                            <h4 class="text-rs text-2xl font-bold">{{ $item->title }}</h4>
                            <p class="mt-3 text-rs">{{ $item->description }}</p>
                        </div>
                        <div class="md:flex md:justify-end gap-2 items-center md:mt-0 mt-5">
                            @if ($item->order)
                                <a href="{{ route('planning.detail', $item->id) }}"
                                    class="bg-rose text-white py-2 px-4 text-md rounded-lg"><i
                                        class="fa-regular fa-eye"></i>
                                    Detail</a>
                                <a href="{{ route('client.order.detail', $item->order->id) }}"
                                    class="bg-rose text-white py-2 px-4 text-md rounded-lg"><i
                                        class="fa-regular fa-cart-shopping"></i> Order</a>
                            @else
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('planning.detail', $item->id) }}"
                                        class="bg-rose text-white py-2 px-4 text-md rounded-lg flex items-center">
                                        <i class="fa-regular fa-eye mr-2"></i> Detail
                                    </a>
                                    <a href="{{ route('planning.store', $item->id) }}"
                                        class="bg-rose text-white py-2 px-4 text-md rounded-lg flex items-center">
                                        <i class="fa-regular fa-pen mr-2"></i> Edit
                                    </a>
                                    <form id="delete-avatar-form" action="{{ route('client.delete.planning', $item->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="bg-rose text-white py-2 px-4 text-md rounded-lg flex items-center"
                                            onclick="confirmDelete()">
                                            <i class="fa-regular fa-trash mr-2"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="md:mt-56 mt-28">
                <div class="border-rose py-20 rounded-lg md:px-0 px-4 shadow-xl">
                    <div class="flex justify-center items-center">
                        <h1 class="text-redlue font-bold text-2xl text-center">Belum ada planning, silahkan buat planning
                            terlebih dahulu</h1>
                    </div>
                    <div class="flex justify-center mt-3">
                        <a href="{{ route('planning.store') }}"
                            class="bg-rose text-white py-2 px-4 text-sm rounded-lg">Buat planning sekarang</a>
                    </div>
                </div>
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
