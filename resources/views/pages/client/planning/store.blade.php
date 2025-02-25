@extends('template.master')
@section('title', 'Tambah Planning')
@section('content')
    @push('css')
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/master.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    @endpush
    @include('components.navbar_rose')

    <div class="planning-section md:px-40 px-4 py-32 min-h-screen" style="background-color: #f7f0f0">
        <div class="flex gap-3">
            <h2 class="text-redlue font-bold text-3xl" data-aos="fade-up" data-aos-duration="1000">Buat planning baru</h2>
        </div>
        <div class="card-profile border-2 mt-4 rounded-lg p-6 border-rose-950 shadow-2xl" data-aos="fade-up" data-aos-duration="1000">
            <div class="mt-10">
                <form
                    action="{{ $planning == null ? route('client.store.planning') : route('client.update.planning', $planning->id) }}"
                    method="POST">
                    @csrf
                    <div class="">
                        <label for="" class="font-medium text-2xl form-label text-rose-950">Judul</label>
                        <input value="{{ $planning == null ? '' : $planning->title }}" type="text"
                            placeholder="Masukan judul planning" name="title" required
                            class="w-full mt-1 border text-rose-950 border-rose-950 bg-transparent placeholder-rose-950 py-3 px-3 focus:outline-none rounded-lg">
                    </div>
                    <div class="mt-5">
                        <label for="" class="font-medium text-2xl form-label text-rose-950">Deskripsi</label>
                        <textarea value="" type="text" name="description" placeholder="Masukan deskripsi planning"
                            style="height: 20rem"
                            class="w-full mt-1 border text-rose-950 border-rose-950 bg-transparent placeholder-rose-950 py-3 px-3 focus:outline-none rounded-lg">{{ $planning == null ? '' : $planning->description }}</textarea>
                    </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class=" text-white rounded-lg font-medium p-3 mt-10 bg-rose">Save Planning</button>
            </div>
            </form>
        </div>
    </div>

    @include('components.footer')
@endsection
@push('js')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
@endpush
