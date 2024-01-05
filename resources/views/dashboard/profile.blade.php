@extends('layouts.app')
@section('title', 'Profile')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Your Profile</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Hi, {{ auth()->user()->name }}!</h2>
            <p class="section-lead">
                Change information about yourself on this page.
            </p>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="post" action="{{ route('user-profile-information.update') }}"
                            class="needs-validation" novalidate="">
                            @csrf
                            @method('put')
                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text"
                                        class="form-control @error('name', 'updateProfileInformation') is-invalid @enderror"
                                        value="{{ auth()->user()->name }}" name="name" required>
                                    @error('name', 'updateProfileInformation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Email</label>
                                        <input type="email"
                                            class="form-control @error('email', 'updateProfileInformation') is-invalid @enderror"
                                            value="{{ auth()->user()->email }}" name="email" required="">
                                        @error('email', 'updateProfileInformation')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Change Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card">
                        <form method="post" action="{{ route('user-password.update') }}"
                            class="needs-validation" novalidate="">
                            @csrf
                            @method('put')
                            <div class="card-header">
                                <h4>Change Password</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <input type="password"
                                        class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                        name="current_password" required>
                                    @error('current_password', 'updatePassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-7 col-12">
                                        <label>New Password</label>
                                        <input type="password"
                                            class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                            name="password" required>
                                        @error('password', 'updatePassword')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-5 col-12">
                                        <label>Confirm Password</label>
                                        <input type="password"
                                            class="form-control"
                                            name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.css">
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.js"></script>
@endpush
