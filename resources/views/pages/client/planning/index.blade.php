@extends('template.master')
@section('title', 'Cart')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    @include('components.navbar_rose')

    @if (session('success'))
        <div class="border-rs py-2 px-3 rounded-lg">
            <p class="text-rose text-xl">{{ session('success') }}</p>
        </div>
    @endif

    <div class="planning-section px-40 py-32 min-h-screen" style="background-color: #f7f0f0">
        <div class="flex gap-3">
            <a href="{{ route('planning.store') }}" class="bg-rose text-white py-2 px-4 text-lg rounded-lg"><i class="fa-solid fa-plus"></i></a>
            <h2 class="text-redlue font-bold text-3xl">My Planning</h2>
        </div>
        <div class="card border-2 rounded-lg border-rose shadow-2xl px-5 py-7 mt-4">
            <div class="grid grid-cols-3">
                <div class="col-span-2">
                    <h4 class="text-rs text-2xl font-bold">Bro's Make Up</h4>
                    <p class="mt-3 text-rs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo repudiandae, sint magni exercitationem cupiditate dolorum labore, eos a doloribus commodi tempora mollitia assumenda dicta dignissimos sed beatae officiis doloremque. Error?</p>
                </div>
                <div class="flex justify-end items-center">
                    <a href="{{ route('planning.detail') }}" class="bg-rose text-white py-2 px-4 text-xl rounded-lg">Detail</a>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')
@endsection
@push('js')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
@endpush
