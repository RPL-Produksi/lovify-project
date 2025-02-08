@extends('template.master')
@section('title', 'Profile')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    @include('components.navbar_rose')

    <div class="profile-section py-24 flex items-center justify-center" style="background-color: #f7f0f0">
        <div class="card-profile border-2 rounded-lg p-6 border-rose-950 shadow-2xl" data-aos="fade-up"
            data-aos-duration="1500">
            <div class="flex items-center gap-5">
                <div>
                    <img src="{{ asset('asset/image/matching pfp (2).jpg') }}" class="rounded-full w-40 mr-3"
                        alt="">
                </div>
                <div>
                    <a href="" class="bg-rose-950 text-white rounded-lg font-medium p-3 hover:text-rose-950 hover:border-2 hover:border-rose-950 hover:bg-transparent">Change Picture</a>
                </div>
                <div>
                    <a href="" class="border-2 border-rose-950 text-rose-950 rounded-lg font-medium p-3 hover:text-white hover:bg-rose-950">Delete
                        Picture</a>
                </div>
            </div>
            <div class="mt-10">
                <form action="">
                    <div class="">
                        <label for="" class="font-medium text-2xl form-label text-rose-950">Username</label>
                        <input type="text" placeholder="Enter your username"
                            class="w-full mt-1 border text-rose-950 border-rose-950 bg-transparent placeholder-rose-950 py-3 px-3 focus:outline-none rounded-lg">
                    </div>
                    <div class="mt-5">
                        <label for="" class="font-medium text-2xl form-label text-rose-950">Email</label>
                        <input type="text" placeholder="Enter your email"
                            class="w-full mt-1 border text-rose-950 border-rose-950 bg-transparent placeholder-rose-950 py-3 px-3 focus:outline-none rounded-lg">
                    </div>
                    <div class="mt-5">
                        <label for="" class="font-medium text-2xl form-label text-rose-950">Phone Number</label>
                        <input type="text" placeholder="Enter your phone number"
                            class="w-full mt-1 border text-rose-950 border-rose-950 bg-transparent placeholder-rose-950 py-3 px-3 focus:outline-none rounded-lg">
                    </div>
                </form>
            </div>
            <div class="flex justify-end">
                <a href="" class="bg-rose-950 text-white rounded-lg font-medium p-3 mt-10">Save Changes</a>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
@endpush
