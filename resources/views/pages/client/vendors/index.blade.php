@extends('template.master')
@section('title', 'Profile')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendors.css') }}">
    @include('components.navbar_rose')

    <section class="vendors-section py-32 px-40">
        <div class="grid grid-cols-4 gap-7">
        @foreach ($products as $item)

            <div class="border-rose py-8 px-6 shadow-2xl">
                <div class="mb-4">
                    <img src="{{ asset($item->cover) }}" alt="" class="w-full h-48 object-cover">
                </div>
                    <div>
                        <h2 class="text-rose-950 font-bold text-2xl">{{ $item->name }}</h2>
                        <p>{{ $item->mitra }}</p>
                        <h2 class="text-rose-950 font-bold">
                            Rp{{ number_format($item->price, 0, ',', '.') }}
                        </h2>
                        <p style="color: #917270">{{ $item->description }}</p>
                    </div>
                    <div class="flex items-center mt-4">
                        <a href="" class="bg-rose p-3 w-full text-center text-white rounded-lg">Booking</a>
                    </div>
            </div>

            @endforeach
        </div>
    </section>

@endsection
@push('js')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
@endpush
