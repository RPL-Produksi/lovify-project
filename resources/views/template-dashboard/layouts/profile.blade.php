@extends('template-dashboard.layouts.app-admin')
@section('title', 'Profile')

@push('css')
@endpush


@section('content')

    <div class="row">
        <div class="col-7">
            <div class="card p-4">
                <h3 class="text-rose">Profile Info</h3>
                <hr>
                <div class="mt-10">
                    <form action="{{ route('profile.change') }}" method="POST" class="form-group"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="">
                            <label for="" class="form-label">Full Name</label>
                            <input name="fullname" type="text" placeholder="Enter your username"
                                value="{{ $user->fullname }}" class="form-control">
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Username</label>
                            <input type="text" name="username" placeholder="Enter your username"
                                value="{{ $user->username }}" class="form-control">
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Email</label>
                            <input type="text" name="email" placeholder="Enter your email" value="{{ $user->email }}"
                                class="form-control">
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Phone Number</label>
                            <input type="number" name="phone_number" placeholder="Enter your phone number"
                                value="{{ $user->phone_number }}" class="form-control">
                        </div>
                        <div class="flex justify-end mt-3">
                            <button type="submit" class="btn btn-primary">Save
                                Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-5">
            <div class="card p-3">
                <h3 class="text-rose">Profile Picture</h3>
                <hr>
                <div class="card-profile border-2 rounded-lg p-6 border-rose-950 shadow-2xl" data-aos="fade-up"
                    data-aos-duration="1500">
                    <div class="md:flex items-center gap-5">
                        <div class="d-flex justify-content-center">
                            @if (is_null($user->avatar))
                                <img src="{{ asset('asset/image/ix_user-profile-filled.png') }}" class="rounded-full mr-3"
                                    width="276" height="276" alt="">
                            @else
                                <img src="{{ $user->avatar }}" style="object-fit: cover"
                                    class="rounded-circle w-40 h-40 object-cover mr-3" alt="" width="276"
                                    height="276">
                            @endif
                        </div>
                        <div class="d-flex justify-content-center mt-5 md:mt-0">
                            <button type="button" data-toggle="modal" data-target="#editPhotoModal"
                                class="btn btn-primary">
                                Change Picture
                            </button>
                            <form class="w-full ml-2" action="{{ route('profile.deleteAvatar') }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary" onclick="confirmDelete()">
                                    Delete Picture
                                </button>
                            </form>
                        </div>
                        <div class="flex justify-center mt-5 md:mt-0">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editPhotoModal" tabindex="-1" role="dialog" aria-labelledby="editPhotoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPhotoModalLabel">Edit Profile Picture</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="preview-image" src="{{ $user->avatar ?? asset('asset/image/ix_user-profile-filled.png') }}"
                        class="rounded-circle mb-3" width="200" height="200" style="object-fit: cover;">
                    <form id="updatePhotoForm" action="{{ route('profile.change') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="avatar" id="avatarInput" class="form-control" accept="image/*"
                            onchange="previewImage(event)">
                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('vendor/DataTables/datatables.min.js') }}"></script>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview-image');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function openModal() {
            $('#editPhotoModal').modal('show');
        }
    </script>
@endpush
