@extends('template-dashboard.layouts.app-admin')
@section('title', 'Change Password User')

@push('css')
@endpush


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card p-4">
                <h3 class="text-rose">Change Password User</h3>
                <hr>
                <div class="mt-10">
                    <form action="{{ route('client.update.password') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <input type="hidden" class="form-control" name="user_id" value="{{ $userChoose->id }}">
                        </div>
                        <div class="mt-3">
                            <label for="new_password" class="text-redlue text-xl font-medium"><i class="fa-regular fa-lock"></i> New Password</label>
                            <input type="text" name="new_password"
                                class="form-control"
                                placeholder="Enter your new password">
                        </div>
                        <div class="mt-3">
                            <label for="new_password_confirmation" class="text-redlue text-xl font-medium"><i class="fa-regular fa-lock"></i> Confirmation New Password</label>
                            <input type="text" name="new_password_confirmation"
                                class="form-control"
                                placeholder="Confirmation your new password">
                        </div>
                        <div class="mt-3 w-100">
                            <button type="submit"
                                class="btn btn-primary">Change Password</button>
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
@endpush
