@extends('template.master')
@section('title', 'Profile')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    @include('components.navbar_rose')

    <div class="profile-section py-28 flex md:px-0 px-4 items-center justify-center" style="background-color: #f7f0f0">
        <div class="card-profile border-2 rounded-lg p-6 border-rose-950 shadow-2xl" data-aos="fade-up"
            data-aos-duration="1500">
            <div class="md:flex items-center gap-5">
                <div class="flex justify-center">
                    @if (is_null($user->avatar))
                        <img src="{{ asset('asset/image/ix_user-profile-filled.png') }}" class="rounded-full w-40 mr-3"
                            alt="">
                    @else
                        <img src="{{ $user->avatar }}" class="rounded-full w-40 h-40 object-cover mr-3" alt="">
                    @endif
                </div>
                <div class="flex justify-center mt-5 md:mt-0">
                    <a href="javascript:void(0);" onclick="openModal()"
                        class="bg-rose-950 text-center border-2 w-full border-rose-950 text-white rounded-lg font-medium p-3 hover:text-rose-950 hover:border-2 hover:border-rose-950 hover:bg-transparent">
                        Change Picture
                    </a>
                </div>
                <div class="flex justify-center mt-5 md:mt-0">
                    <form id="delete-avatar-form" class="w-full" action="{{ route('profile.deleteAvatar') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                            class="border-2 w-full border-rose-950 text-rose-950 rounded-lg font-medium p-3 hover:text-white hover:bg-rose-950"
                            onclick="confirmDelete()">
                            Delete Picture
                        </button>
                    </form>
                </div>
            </div>
            <div class="mt-10">
                <form action="{{ route('profile.change') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="">
                        <label for="" class="font-medium text-2xl form-label text-rose-950">Full Name</label>
                        <input name="fullname" type="text" placeholder="Enter your username"
                            value="{{ $user->fullname }}"
                            class="w-full mt-1 border text-rose-950 border-rose-950 bg-transparent placeholder-rose-950 py-3 px-3 focus:outline-none rounded-lg">
                    </div>
                    <div class="mt-5">
                        <label for="" class="font-medium text-2xl form-label text-rose-950">Username</label>
                        <input type="text" name="username" placeholder="Enter your username"
                            value="{{ $user->username }}"
                            class="w-full mt-1 border text-rose-950 border-rose-950 bg-transparent placeholder-rose-950 py-3 px-3 focus:outline-none rounded-lg">
                    </div>
                    <div class="mt-5">
                        <label for="" class="font-medium text-2xl form-label text-rose-950">Email</label>
                        <input type="text" name="email" placeholder="Enter your email" value="{{ $user->email }}"
                            class="w-full mt-1 border text-rose-950 border-rose-950 bg-transparent placeholder-rose-950 py-3 px-3 focus:outline-none rounded-lg">
                    </div>
                    <div class="mt-5">
                        <label for="" class="font-medium text-2xl form-label text-rose-950">Phone Number</label>
                        <input type="number" name="phone_number" placeholder="Enter your phone number"
                            value="{{ $user->phone_number }}"
                            class="w-full mt-1 border text-rose-950 border-rose-950 bg-transparent placeholder-rose-950 py-3 px-3 focus:outline-none rounded-lg">
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-rose-950 text-white rounded-lg font-medium p-3 mt-10">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="changePictureModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-rose-950">Change Profile Picture</h2>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <form id="changePictureForm" action="{{ route('profile.change') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="text-center mb-4">
                    <img id="previewImage" src="{{ $user->avatar ?? asset('avatars/default.png') }}"
                        class="rounded-full w-32 h-32 object-cover mx-auto border border-rose-950" alt="Profile Picture">
                </div>
                <div class="mb-4">
                    <label class="block text-rose-950 font-medium">Upload New Picture</label>
                    <input type="file" class="w-full border border-gray-300 p-2 rounded-lg mt-1" id="avatar"
                        name="avatar" accept="image/*" onchange="previewFile()">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 border border-rose-950 text-rose-950 rounded-lg hover:bg-rose-950 hover:text-white transition">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-rose-950 text-white rounded-lg hover:bg-rose-800 transition">Save</button>
                </div>
            </form>
        </div>
    </div>


@endsection
@push('js')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        function openModal() {
            document.getElementById('changePictureModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('changePictureModal').classList.add('hidden');
        }

        function previewFile() {
            const file = document.getElementById('avatar').files[0];
            const preview = document.getElementById('previewImage');
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

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
