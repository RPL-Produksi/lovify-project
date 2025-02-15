@extends('template.master')
@section('title', 'Create Vendor')
@push('css')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush
@section('content')
   <section class="register-section">
        <div class="grid xl:grid-cols-5">
            <div class="xl:col-span-3 col-b shadow-2xl pb-20" style="background-color: #f7f0f0;">
                <div class="xl:px-48 px-7 pb-16 xl:pb-0">
                    <div class="">
                        <img src="{{ asset('asset/image/Lovify-NoBg.png') }}" alt="">
                    </div>
                    <div>
                        <h1 class="text-redlue text-6xl font-bold">Create Vendor</h1>
                    </div>

                    <div class="mt-7">
                        <form action="{{ route('mitra.store.vendor') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="" class="text-redlue text-xl font-medium">Full Name</label>
                                <input required type="text" name="name" value="{{ old('name') }}" class="w-full text-redlue bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your full name">    
                            </div>    
                            <div class="mt-5">
                                <label for="" class="text-redlue text-xl font-medium">Phone Number</label>
                                <input required type="number" name="phone_number" value="{{ old('phone_number') }}" class="w-full text-redlue bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your phone number">    
                            </div>    
                            <div class="mt-5">
                                <label for="" class="text-redlue text-xl font-medium">Email</label>
                                <input required type="email" name="email" value="{{ old('email') }}" class="w-full text-redlue bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5" placeholder="Enter your email">    
                            </div>    
                            <div class="mt-5">
                                <label for="" class="text-redlue text-xl font-medium">Kategori</label>
                                <select name="category_id" id="category_id" class="w-full text-redlue bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5">
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>    
                            <div class="mt-5">
                                <label for="" class="text-redlue text-xl font-medium">Lokasi</label>
                                <select name="location_id" id="location_id" class="w-full text-redlue bg-transparent border mt-2 focus:outline-none rounded-md py-4 border-rose-950 placeholder-rose-950 px-5">
                                    @foreach ($lokasi as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>    
                            <div class="mt-5 w-100">
                                <button type="submit" class="bg-rose w-full text-white text-center py-3 rounded-md">Create Vendor</button>
                            </div>
                            <div>
                                @if ($errors->any())
                                    <p class="text-red-600 font-bold mt-3">{{ $errors->first() }}</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="xl:col-span-2 col-a hidden xl:block">
                
            </div>
        </div>
   </section>
@endsection
@push('js')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endpush
