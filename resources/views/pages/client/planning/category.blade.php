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
        <h1 class="font-bold text-3xl" data-aos="fade-up" data-aos-duration="1000" style="color: #3D0A05">
            Pilih Kategori
        </h1>
        <div class="md:grid xl:grid-cols-3 md:grid-cols-2 mt-7 gap-7">
            @foreach ($category as $item)
                <div class="planning-card md:mt-0 mt-5 p-4 border-2 border-rose-950 shadow-xl" data-aos="fade-up"
                    data-aos-duration="1000">
                    <img src="{{ $item->image }}" class="w-full hover:opacity-50" style="height: 230px; object-fit: cover;"
                        alt="">
                    <div class="mt-6 flex justify-between mb-3 items-center">
                        <h3 class=" text-rose-950 text-2xl font-bold">{{ $item->name }}</h3>
                        <a href="{{ route('vendors', $item->id) }}"
                            class="py-3 px-4 text-white rounded-lg shadow-lg bg-rose hover:bg-white hover:text-black transition-all duration-100">See
                            More</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('components.footer')
@endsection
@push('js')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
@endpush
